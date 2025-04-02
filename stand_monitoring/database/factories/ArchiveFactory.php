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
        $statementOptions = ["Установлена", "Не установлена"];
        $authOptions = ["True", "False"];
        
        return [
            'ID_stanok' => $this->faker->numberBetween(1,100),
            'RFID' => $this->faker->text(10), // Генерирование случайной строки
            'Count' => $this->faker->numberBetween(0,10000),
            'State' => $this->faker->randomElement($statementOptions),
            'Condition' => 100.0,
            'worktime' => $this->faker->numberBetween(0,1000),
            'Purpose' => $this->faker->name(),
            'Country' => $this->faker->name(),
            'Authenticity' => $this->faker->randomElement($authOptions)
        ];
    }
}
