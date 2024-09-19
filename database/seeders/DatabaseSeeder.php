<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Campain;
use App\Models\CustomerLoundry;
use App\Models\HistoryCampain;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ReqCamp;
use App\Models\SpesificationLoundry;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => "Maya",
        //     'email' => "maya@gmail.com",
        //     'password' => Hash::make('password'),
        //     'role' => "admin"
        // ]);
        UserRole::create([
            "role_name" => "admin"
        ]);
        UserRole::create([
            "role_name" => "instructor"
        ]);
        UserRole::create([
            "role_name" => "user"
        ]);
    }
}
