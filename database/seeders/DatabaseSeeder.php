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
use App\Models\DifficultyLevel;
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
        //     'role_id' => "adminrole_id",
        // ]);
        User::create([
            'name' => "Alif",
            'email' => "Alif@gmail.com",
            'password' => Hash::make('password'),
            // role_id user
            'role_id' => "66f22af4ff7200cc84002fc0",
        ]);
        User::create([
            'name' => "Bintang",
            'email' => "Bintang@gmail.com",
            'password' => Hash::make('password'),
            // role_id user
            'role_id' => "66f22af4ff7200cc84002fc0",
        ]);
        User::create([
            'name' => "Cantika",
            'email' => "Cantika@gmail.com",
            'password' => Hash::make('password'),
            // role_id user
            'role_id' => "66f22af4ff7200cc84002fc0",
        ]);
        User::create([
            'name' => "Daniel",
            'email' => "Daniel@gmail.com",
            'password' => Hash::make('password'),
            // role_id user
            'role_id' => "66f22af4ff7200cc84002fc0",
        ]);
        // UserRole::create([
        //     "role_name" => "admin"
        // ]);
        // UserRole::create([
        //     "role_name" => "instructor"
        // ]);
        // UserRole::create([
        //     "role_name" => "user"
        // ]);
        // DifficultyLevel::create([
        //     "level_name" => "beginner"
        // ]);
        // DifficultyLevel::create([
        //     "level_name" => "middle"
        // ]);
        // DifficultyLevel::create([
        //     "level_name" => "advanced"
        // ]);
    }
}
