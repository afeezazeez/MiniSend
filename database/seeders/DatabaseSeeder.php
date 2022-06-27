<?php

namespace Database\Seeders;

use App\Models\EmailAttachment;
use App\Models\User;
use App\Models\Email;
use Database\Factories\EmailFactory;
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


        // seed 200 emails with each having 1 to 3 attachments

        \App\Models\Email::factory()->count(200)->create()->each(function ($email) {
            \App\Models\EmailAttachment::factory()->count(array_rand([1, 2, 3]) + 1)->create(['email_id' => $email->id]);
        });


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
