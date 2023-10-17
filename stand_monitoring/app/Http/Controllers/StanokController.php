<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StanokInfo;

class StanokController extends Controller
{

    public function index() {
        $stanok = StanokInfo::find(1);
        dd($stanok->Performer);
    }
}
