<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UpdateConditionEvent;
use App\Models\Archive;
use Illuminate\Support\Facades\DB;

class ConditionUpdateListener
{
    /**
     * Create the event listener.
     */
    public function __construct() { }

    /**
     * Handle the event.
     */
    public function handle(UpdateConditionEvent $event): void
    {
        $condition = $event->request[1]->Condition - ((float)$event->request[0]->Count / 100000.0) * 100.0;

        DB::table('archive')
                    ->where('id', $event->request[1]->id)
                    ->update(['Condition' => $condition]);
    }
}