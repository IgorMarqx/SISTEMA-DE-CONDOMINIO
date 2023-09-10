<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'igor',
            'email' => 'igor@gmail.com',
            'password' => Hash::make('12345'),
            'condominium_id' => '1',
            'apartment_id' => '1'
        ]);
    }
}
