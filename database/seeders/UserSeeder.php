<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        DB::table('users')->insert([
            'name' => 'salam hammad',
            'email' => 'salamhammad@gmail.com',
            'password' => Hash::make('p@ssw0rd'),
        ]);
    }

}