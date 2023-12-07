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
        // DB::statement('truncate table mark_infos'); для очистки таблицы

        $toSortData = DB::table('archive')
        ->select('*')
        ->whereIn(DB::raw("(RFID, updated_at)"), function($query) {
            $query->select(DB::raw('RFID, MAX(updated_at)'))
                  ->from('archive')
                  ->groupBy('RFID');
            })
        //выборка без удаленных меток, т.к. удаленные записи багом дублируются
        //удаленные записи мон через строку поиска посмотреть
        ->whereNull('deleted_at')
        ->orderBy('State', 'desc')
        ->orderBy('updated_at', 'desc')
        ->limit(10)
        ->get()
        ->toArray();

        foreach ($toSortData as $record) {
            History::updateOrCreate([
                'ID_stanok' => $record->ID_stanok,
                'RFID' => $record->RFID,
                'State' => $record->State, 
            ],[
               'Count' => $record->Count,
               'Purpose' => $record->Purpose, 
               'Country' => $record->Country, 
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
        $IDStanokRequest = $request->get('ID_stanok');
        $RFIDRequest = $request->get('RFID');
        $StateRequest = $request->get('State');

        $requestData = $request->validate([
            'ID_stanok' => 'integer',
            'RFID' => 'string',
            'Count' => 'integer',
            'State' => 'integer',
            'Purpose' => 'string',
            'Country' => 'string',
        ]);

        // $historyRecord = History::where('RFID', $RFIDRequest)->orderBy('updated_at', 'desc')->updateOrCreate([
        //     'ID_stanok' => $IDStanokRequest,
        //     'RFID' => $RFIDRequest,
        //     'State' => $StateRequest,
        // ], $requestData);

        $archiveRecord = Archive::where('RFID', $RFIDRequest)->orderBy('updated_at', 'desc')->updateOrCreate([
            'ID_stanok' => $IDStanokRequest,
            'RFID' => $RFIDRequest,
            'State' => $StateRequest,
        ], $requestData);

        return redirect()->action([HistoryController::class, 'index']);
    }

    public function search(Request $request) {
        $input = $request->RFID;
        $result = Archive::withTrashed()->where("RFID", "LIKE", "%{$input}%")->orderBy('State', 'desc')->orderBy('updated_at', 'desc')->Paginate(6);                                                             //->whereNull('deleted_at') поиск без учета удаленных записей
        return view('monitoring.search', compact('result'));
    }

    public function edit(Archive $archive, Request $request) {
        $requiredRFID = $request->get('RFID');
        $requiredID = $request->get('ID');
        $neededEntry = Archive::withTrashed()->where('RFID', $requiredRFID)->where('id', $requiredID)->get()->toArray();

        return view('monitoring.edit', compact('archive', 'neededEntry', 'requiredID'));        
    }

    public function update(Request $request, History $history) {
        
        $controlRequest = $request->get('RFID');

        $historyDBDatas = $request->validate([
            'ID_stanok' => 'integer',
            'RFID' => 'string',
            'Count' => 'integer',
            'State' => 'integer',
            'Purpose' => 'string',
            'Country' => 'string',
        ]);

        History::where('RFID', $controlRequest)
                ->latest('updated_at')
                ->first()
                ->updateOrFail($historyDBDatas);

        return redirect()->action([HistoryController::class, 'index']);
    }

    public function destroy(History $history, Request $request) {
        $requireMark = $request->get('RFID');
        History::where('RFID', $requireMark)->first()->delete();
        
        return redirect()->action([HistoryController::class, 'index']);
    }

    public function restore(History $history, Request $request) {
        $requireMark = $request->get('RFID');
        History::withTrashed()->where('RFID', $requireMark)->first()->restore();
        
        return redirect()->action([HistoryController::class, 'index']);
    }

    
    ///Далее идут методы обработки данных с датчика непосредственно

    //набросок
    public function setOrUpdateData(Request $request) {
        $controlRequest = $request->get('Mark');

        $markInfosDBDatas = $request->validate([
            'Mark' => 'string',
            'Purpose' => 'string',
            'Country' => 'string',
        ]);
        $historyDBDatas = $request->validate([
            'ID_stanok' => 'integer',
            'RFID' => 'string',
            'Count' => 'integer',
            'State' => 'integer',
        ]);

        MarkInfo::updateOrCreate([
            'Mark' => $controlRequest,
        ], $markInfosDBDatas);
        History::updateOrCreate([
            'RFID' => $controlRequest,
        ], $historyDBDatas);
    }

    public function deleteData() {
        // $data = MarkInfo::withTrashed()->find(34); //поиск с учетом softDelete
        // $data->restore();

        // $dataMark = MarkInfo::find(39);
        $dataHistory = History::find(17);
        // $dataMark->delete(); //софт делит уже установлен в моделе. 
        $dataHistory->delete(); //софт делит уже установлен в моделе. 
    }
}
