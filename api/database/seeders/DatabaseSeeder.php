<?php

namespace Database\Seeders;

use App\Models\Email;
use App\Models\EmailAttachment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        if (env('APP_ENV') === 'production') exit('Fatal! APP is in production');

        User::factory()
            ->state([
                'email'=>'test@minisender.com',
            ])
            ->has(
                Email::factory(50)
                    ->has(EmailAttachment::factory()->count(rand(1,3)))
            )->create();


    }
}
