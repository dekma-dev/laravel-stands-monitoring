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

    /**
     * Временно отключает SoftDeletes для модели.
     *
     * @param callable $callback Функция, которая будет выполнена без SoftDeletes.
     *
     * @return mixed Результат выполнения callback.
     *
     * @throws \Throwable Если callback выбрасывает исключение.
     */
    public static function withoutSoftDeletes(callable $callback)
    {
        $originalUsesSoftDeletes = in_array(SoftDeletes::class, class_uses(static::class));

        if ($originalUsesSoftDeletes) {
            $uses = class_uses(static::class);
            unset($uses[SoftDeletes::class]);
            class_alias(static::class, 'Temporary' . static::class);
            $code = 'class ' . static::class . ' extends \\Temporary' . static::class . ' {';
            foreach ($uses as $trait) {
                $code .= ' use \\' . $trait . ';';
            }
            $code .= '}';
            eval($code);
        }

        try {
            return $callback();
        } finally {
            if ($originalUsesSoftDeletes) {
                 // Восстанавливаем исходное состояние модели
                class_alias('Temporary' . static::class, static::class);
                $code = 'class ' . static::class . ' extends \\Temporary' . static::class . ' { use Illuminate\\Database\\Eloquent\\SoftDeletes; }';
                eval($code);
            }
        }
    }

    // public function getTimeStamps() 
    // { 
    //     return $this->timestamps;
    // }
    // public function setTimeStamps($value) 
    // {
    //     $this->timestamps = $value;
    // }
}
