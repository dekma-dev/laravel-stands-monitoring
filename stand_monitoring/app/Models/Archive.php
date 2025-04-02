<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archive extends Model
{
    use HasFactory;
    use SoftDeletes;
    // public $timestamps = false;

    protected $table = 'archive';
    protected $guarded = [];

    // public function getTimeStamps() 
    // { 
    //     return $this->timestamps;
    // }
    // public function setTimeStamps($value) 
    // {
    //     $this->timestamps = $value;
    // }
}
