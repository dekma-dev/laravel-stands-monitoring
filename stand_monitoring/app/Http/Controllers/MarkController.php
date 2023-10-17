<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarkInfo;

class MarkController extends Controller
{

    public function index() {
        $mark = MarkInfo::find(1);
        dd($mark->Purpose);
        // return 'here is the history of stands work';
    }
}
