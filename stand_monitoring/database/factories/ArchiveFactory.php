<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ArchiveFactory extends Factory
{
    protected $model = \App\Models\Archive::class;

    public function definition()
    {
        return [
            'ID_stanok' => $this->faker->unique()->numberBetween(1,100),
            'RFID' => $this->faker->unique()->text(10), // Генерирование случайной строки
            'Count' => $this->faker->numberBetween(0,10000),
            'State' => $this->faker->numberBetween(0, 1),
            'Condition' => 100.0,
            'worktime' => $this->faker->numberBetween(0,1000),
            'Purpose' => $this->faker->name(),
            'Country' => $this->faker->name(),
            'Authenticity' => True
        ];
    }
}
