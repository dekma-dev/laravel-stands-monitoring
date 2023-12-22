<?php

namespace Database\Seeders;

use App\Models\Archive;
use Illuminate\Database\Seeder;

class ArchiveSeeder extends Seeder
{
    public function run()
    {
        Archive::factory()->count(50)->create();
    }
}