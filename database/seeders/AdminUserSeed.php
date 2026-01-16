<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminUserSeed extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'test@admin.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role'=>'admin',
            'password'=>Hash::make('abcd1234')
        ]);
    }
}
