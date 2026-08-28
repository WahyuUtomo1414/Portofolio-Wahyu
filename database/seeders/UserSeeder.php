<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'wahyuxd14@gmail.com',
        ], [
            'name' => 'Wahyu Dwi Utomo',
            'password' => Hash::make('wahyu141402'),
        ]);
    }
}
