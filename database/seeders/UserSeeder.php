<?php

namespace Database\Seeders;

use Hamcrest\Core\HasToString;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds for default user
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'name' => "Admin",
            'role'=> 1,
            'created_at'=>now(),
        ]);
    }
}
