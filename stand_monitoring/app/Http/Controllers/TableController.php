<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\MarkInfo;
use App\Models\Table;
use vendor\laravelcollective\html;
use Illuminate\Support\Facades\DB;
use Collective\Html\FormFacade as Form;


class TableController extends Controller
{
    protected $casts = [
        'id' => 'integer'
    ];

    public function index(Request $request) {
        $requireRFID = $request->get('RFID');
        $requireID = $request->get('ID');
        $allEntries = History::all()->where('RFID', $requireRFID);
        $addInf = MarkInfo::all()->where('Mark', $requireRFID);

        return view('table', compact('allEntries', 'requireID', 'addInf'));
    }
}
