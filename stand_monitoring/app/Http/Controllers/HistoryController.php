<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\History;
use App\Models\User;
use vendor\laravelcollective\html;
use Collective\Html\FormFacade as Form;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class HistoryController extends Controller
{
    public function index() {

        $falseRFIDQuery = DB::select("SELECT RFID FROM archive WHERE Authenticity = 'False'");
        
        //обновление подлинности меток
        if (!empty($falseRFIDQuery)) {
            $uniqueRFID = array_values(array_unique($falseRFIDQuery, false));
            
            for ($index = 0; $index < count($uniqueRFID); $index++) {
                $uniquePick = $uniqueRFID[$index]->RFID;
                $allData = Archive::select('*')->where('RFID', $uniquePick)->get()->toArray();
                
                for ($entry = 0; $entry < count($allData); $entry++) { 
                    DB::table('archive')
                        ->where('id',$allData[$entry]["id"])
                        ->update(['Authenticity' => 'False']);
                }
            }
        }

        //обновление состояний меток
        $allEntries = Archive::all();
        foreach ($allEntries as $key => $entry) {
            $currentCondition = $entry[$key]["Condition"];
            /*
            Состояние метки рассчитывается исходя из данных об износе - количестве смыканий Count,
            однако числитель может быть заменен на время работы - Worktime,
            а знаменатель - предел работоспособности метки, т.е., например, её хватает на 100к смыканий
            */
            $condition = ($currentCondition - ($entry->Count / 100000)) * 100;

            DB::select("UPDATE `archive` SET `Condition` = $condition WHERE `id` = $entry->id");
        }

        //выборка уникальных данных из архива
        $toSortData = DB::table('archive')
        ->select('*')
        ->whereIn(DB::raw("(RFID, updated_at)"), function($query) {
            $query->select(DB::raw('RFID, MAX(updated_at)'))
                  ->whereNull('deleted_at')
                  ->from('archive')
                  ->groupBy('RFID');
            })
        ->orderBy('State', 'desc')
        ->orderBy('updated_at', 'desc')
        ->limit(100)
        ->get()
        ->toArray();

        //очистка таблицы histories
        $overloadData = DB::select("SELECT count(*) FROM histories");
        if ($overloadData > "100") History::truncate();

        //перенос из archive в histories актуальных уникальных данных
        foreach ($toSortData as $record) {
            History::updateOrCreate([
                'ID_stanok' => $record->ID_stanok,
                'RFID' => $record->RFID,
                'State' => $record->State, 
            ],[
               'Condition' => $record->Condition,
               'worktime' => $record->worktime, 
               'Count' => $record->Count,
               'Purpose' => $record->Purpose, 
               'Country' => $record->Country, 
               'Authenticity' => $record->Authenticity,
               'created_at' => $record->created_at, 
               'updated_at' => $record->updated_at,
               'deleted_at' => $record->deleted_at
            ]);
        }

        return view('monitoring.index', [
            'sorted'=> DB::table('histories')
                    ->orderBy('State', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->Paginate(6)
        ]);                   
    }

    public function create() {
        return view('monitoring.create');
    }

    public function store(Request $request) {
        $idStanokRequest = $request->get('ID_stanok');
        $RFIDRequest = $request->get('RFID');
        $stateRequest = $request->get('State');
        $conditionRequest = $request->get('Condition');

        $requestData = $request->validate([
            'ID_stanok' => 'integer',
            'RFID' => 'string',
            'Count' => 'integer',
            'State' => 'integer',
            'Condition' => 'integer',
            'Purpose' => 'string',
            'Country' => 'string',
            'Authenticity' => 'string',
        ]);

        History::where('RFID', $RFIDRequest)->delete(); 

        $archiveRecord = Archive::where('RFID', $RFIDRequest)
            ->orderBy('updated_at', 'desc')->updateOrCreate([
            'ID_stanok' => $idStanokRequest,
            'RFID' => $RFIDRequest,
            'State' => $stateRequest,
            'Condition' => $conditionRequest,
        ], $requestData);

        return redirect()->action([HistoryController::class, 'index']);
    }

    public function search(Request $request, Archive $archive) {
        $input = $request->RFID;
        $result = Archive::withTrashed()
                ->where("RFID", "LIKE", "%{$input}%")
                ->orWhere('ID_stanok', 'LIKE', "%{$input}%")
                ->orderBy('State', 'desc')
                ->orderBy('updated_at', 'desc')
                ->Paginate(6);                                                             //->whereNull('deleted_at') поиск без учета удаленных записей
        return view('monitoring.search', compact('result'));
    }

    public function edit(Archive $archive, Request $request) {
        $requiredRFID = $request->get('RFID');
        $requiredID = $request->get('ID');
        $neededEntry  = Archive::withTrashed()
                        ->where('RFID', $requiredRFID)->where('id', $requiredID)
                        ->get()
                        ->toArray();

        return view('monitoring.edit', compact('archive', 'neededEntry', 'requiredID'));        
    }

    public function update(Request $request, Archive $archive, History $history) {

        $RFIDRequest = $request->get('RFID');
        $idRequest = $request->get('id');

        $DBDatas = $request->validate([
            'ID_stanok' => 'integer',
            'RFID' => 'string',
            'State' => 'integer',
            'Purpose' => 'string',
            'Country' => 'string',
            'Authenticity' => 'string',
        ]);
        
        if ($DBDatas["Authenticity"] == "True") {
                $allData = Archive::select('*')->where('RFID', $RFIDRequest)->get()->toArray();
                for ($entry = 0; $entry < count($allData); $entry++) { 
                    DB::table('archive')
                        ->where('id',$allData[$entry]["id"])
                        ->update(['Authenticity' => 'True']);
                }
            } 
            
        History::where('RFID', $RFIDRequest)
               ->delete(); 
            
        Archive::where('RFID', $RFIDRequest)
               ->where('id', $idRequest)
               ->first()
               ->updateOrFail($DBDatas);

        return redirect()->action([HistoryController::class, 'index']);
    }

    public function destroy(Archive $archive, Request $request, History $history) {
        $requireMark = $request->get('RFID');
        $requireID = $request->get('id');

        History::where('RFID', $requireMark)
               ->delete();  

        Archive::where('RFID', $requireMark)
               ->where('id', $requireID)
               ->delete();
        
        return redirect()->action([HistoryController::class, 'index']);
    }

    public function restore(Archive $archive, Request $request) {
        $requireMark = $request->get('RFID');
        $requireID = $request->get('id');
        
        Archive::withTrashed()
               ->where('RFID', $requireMark)
               ->where('id', $requireID)
               ->restore();
        
        return redirect()->action([HistoryController::class, 'index']);
    }

    public function setOrUpdateData(Request $request) {
        $RFIDRequest = $request->get('RFID');
        $IDStanokRequest = $request->get('ID_stanok');
        $StateRequest = $request->get('State');

        $requestData = $request->validate([
            'RFID' => 'string',
            'ID_stanok' => 'integer',
            'Count' => 'integer',
            'WorkTime' => 'integer',
            'State' => 'integer',
            'Purpose' => 'string',
            'Country' => 'string',
        ]);

        History::where('RFID', $RFIDRequest)->delete(); 

        $archiveRecord = Archive::where('RFID', $RFIDRequest)
            ->orderBy('updated_at', 'desc')->updateOrCreate([
            'RFID' => $RFIDRequest,
            'ID_stanok' => $IDStanokRequest,
            'State' => $StateRequest,
        ], $requestData);

    }
}
