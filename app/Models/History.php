<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Toast;

class History extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'histories';
    protected $guarded = [];

        /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            ModalToggle::make('Launch demo modal')
                ->modal('exampleModal')
                ->method('action')
                ->icon('full-screen'),
        ];
}

    /**
     * Views.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::modal('exampleModal', [
                Layout::rows([]),
            ])->open(),
        ];
    }

    /**
     * The action that will take place when
     * the form of the modal window is submitted
     */
    public function action(): void
    {
        Toast::info('Hello, world! This is a toast message.');
    }
}
