<?php

namespace Database\Seeders;

use App\Models\Archive;
use Illuminate\Database\Seeder;

class ArchiveSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Archive::factory()->count(500)->create();
    }
}