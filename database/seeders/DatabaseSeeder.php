<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models as Database;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => '1235@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
