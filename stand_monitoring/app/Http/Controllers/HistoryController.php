<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\MarkInfo;
use vendor\laravelcollective\html;
use Collective\Html\FormFacade as Form;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class HistoryController extends Controller
{
    public function getData() {
        return view('monitoring', [
            'sorted'=> DB::table('histories')->orderBy('State', 'desc')->orderBy('updated_at', 'desc')->Paginate(6)
        ]);
    }

    public function setData(Request $request) {
        $idRequest = $request->get('ID_stanok');
        $rfidRequest = $request->get('RFID');
        $countRequest = $request->get('Count');
        $stateRequest = $request->get('State');
        $purposeRequest = $request->get('Purpose');
        $countryRequest = $request->get('Country');

        $historyData = [
            'ID_stanok' => $idRequest,
            'RFID' => $rfidRequest,
            'Count' => $countRequest,
            'State' => $stateRequest,
        ];

        $markinfoData = [
            'Mark' => $rfidRequest,
            'Purpose' => $purposeRequest,
            'Country' => $countryRequest,
        ];

        $updateOrCreateHistory = History::updateOrCreate([
            'RFID' => $rfidRequest,
            ], $historyData
        );

        $updateOrCreateMarkInf = MarkInfo::updateOrCreate([
            'Mark' => $rfidRequest,
            ], $markinfoData
        );

        dump($idRequest, $rfidRequest, $countRequest, $stateRequest);
    }

    public function deleteData() {
        // $data = History::withTrashed()->find(2); //поиск с учетом softDelete
        // $data->restore();
        
        $data = History::find(2);
        $data->delete();
    }

    public function findOrCreate() {
        $lastEntry = History::all()->last()->RFID;
        $enteredDatas = [
            'ID_stanok' => 111,
            'RFID' => '14FCDE12',
            'Count' => 222
        ];

        $entry = History::firstOrCreate([
            'RFID' => $lastEntry
            ], $enteredDatas
        );

        dump($entry->RFID);
        dd('end'); //created or the entry is already exist
    }
}
