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

    public function show(Request $request) {
        
    }
}
