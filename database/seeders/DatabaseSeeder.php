<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Email;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

       // Email::factory()->count(3)->make();

         // for ($i=0; $i < 5000; $i++) {
                Email::factory()->count(200)->create();
        // }


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
