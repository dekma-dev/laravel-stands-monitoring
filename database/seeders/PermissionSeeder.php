<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $monitoring = new Permission();
        $monitoring->name = 'Monitoring';
        $monitoring->slug = 'monitoring';
        $monitoring->save();

        $all = new Permission();
        $all->name = 'All';
        $all->slug = 'all';
        $all->save();
    }
}