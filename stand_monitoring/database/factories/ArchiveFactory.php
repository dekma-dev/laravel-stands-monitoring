<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TestArchiveFactory extends Factory
{
    protected $model = Archive::class;

    public function definition()
    {
        return [
            'ID_stanok' => $this->faker->randomNumber(),
            'RFID' => $this->faker->unique()->text(10), // Генерирование случайной строки
            'Count' => $this->faker->randomNumber(),
            'State' => '1',
            'Purpose' => $this->faker->name(),
            'Country' => $this->faker->name()
        ];
    }
}
