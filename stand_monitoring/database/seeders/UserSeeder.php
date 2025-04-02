<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operator = Role::where('slug','operator')->first();
        $admin = Role::where('slug', 'admin')->first();
        $monitoring = Permission::where('slug','monitoring')->first();
        $all = Permission::where('slug','all')->first();


        $user1 = new User();
        $user1->name = 'Main';
        $user1->email = 'main@gmail.com';
        $user1->password = '12345';
        $user1->Role = "Администратор";
        $user1->save();
        $user1->roles()->attach($admin);
        $user1->permissions()->attach($all);

        $user2 = new User();
        $user2->name = 'Андрей Михеев';
        $user2->email = 'andrey_mih@gmail.com';
        $user2->password = '1';
        $user2->Role = "Оператор";
        $user2->save();
        $user2->roles()->attach($operator);
        $user2->permissions()->attach($monitoring);

        //Выдача прав и ролей
        // $curUser = User::where('name', 'main')->first();
        // $curUser->roles()->attach($admin);
        // $curUser->permissions()->attach($all);
    }
}