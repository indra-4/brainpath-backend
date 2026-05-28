<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@brainpath.dev'],
            [
                'name' => 'Admin BrainPath',
                'password' => \Illuminate\Support\Facades\Hash::make('password')
            ]
        );
    }
}
