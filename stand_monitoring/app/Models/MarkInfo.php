<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarkInfo extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'mark_infos';
    protected $guarded = [];
}
