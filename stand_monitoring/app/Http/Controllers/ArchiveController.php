<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;
use vendor\laravelcollective\html;
use Collective\Html\FormFacade as Form;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class ArchiveController extends Controller
{
    /**
     * Display the latest 10 records from archive table.
     */
    public function index(Archive $archive, Request $request)
    {
        $requireRFID = $request->get('RFID');
        $requireID = $request->get('ID');
        $requireDateFrom = $request->get('DateFrom');
        $requireDateTo = $request->get('DateTo');

        $allEntries = Archive::withTrashed()
                    ->where('RFID', $requireRFID)
                    ->where('updated_at', '>=', $requireDateFrom)
                    ->where('updated_at', '<=', $requireDateTo)
                    ->orderBy('updated_at', 'desc')
                    ->get();


        if ($allEntries == null) return abort(411);

        return view('monitoring.show', compact('requireID','allEntries', 'requireRFID',  'requireDateFrom', 'requireDateTo'));       
    }

    public function show(Archive $archive, Request $request)
    {
        $requireRFID = $request->get('RFID');
        $requireDateFrom = $request->get('DateFrom');
        $requireDateTo = $request->get('DateTo');

        $allEntries = Archive::withTrashed()
                    ->where('RFID', $requireRFID)
                    ->where('updated_at', '>=', $requireDateFrom)
                    ->where('updated_at', '<=', $requireDateTo)
                    ->orderBy('updated_at', 'desc')
                    ->get()
                    ->toArray();

        return view('monitoring.print', compact( 'allEntries', 'requireDateFrom', 'requireDateTo'));           
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Archive $archive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Archive $archive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archive $archive)
    {
        //
    }
}
