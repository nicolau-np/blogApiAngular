<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => "Nicolau NP",
            'email' => "nic340k@gmail.com",
            'password' => bcrypt("olamundo2015"),
            'nivel'=>"admin",
        ]);
    }
}
