<?php

namespace Tests\Feature;

use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class SearchEmailTest extends TestCase
{
    use WithFaker;

    public function testSearchWithFromParameter(){
        $from = Str::random(10).'@mailsender.com';
        $count = 5;
        Email::factory($count)->state([
            'from' => $from
        ])->create();

        $response = $this->json('GET','/api/email/search?from='.$from);

        //see it returns 5 record all 'from' is the $from created

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data', $count, fn ($json) =>
                $json
                    ->where('from', $from)
                    ->etc()
                )
            );

    }

    public function testSearchWithToParameter(){
        $to = Str::random(10).'@mailsender.com';
        $count = 5;
        Email::factory($count)->state([
            'to' => $to
        ])->create();

        $response = $this->json('GET','/api/email/search?to='.$to);

        //see it returns 5 record all 'to' is the $to created
         $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data', $count, fn ($json) =>
                $json
                    ->where('to', $to)
                    ->etc()
                )
            );



    }

    public function testSearchWithSubjectParameter(){
        $subject = $this->faker->sentence;
        $count = 5;
        Email::factory($count)->state([
            'subject' => $subject
        ])->create();

        $response = $this->json('GET','/api/email/search?subject='.$subject);

        //see it returns 5 record and 'subject' has the $subject created
        $response->assertStatus(200)
            ->assertSeeText($subject)
            ->assertJsonCount($count, 'data');

    }
    public function testSearchWithStatusParameters(){


        $emails = Email::factory(10)->create();

        $statuses = ['Posted','Sent','Failed'];
        $status = $statuses[rand(0,2)];

        $response = $this->json('GET', '/api/email/search?status=' .$status );

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data.0',fn ($json) =>
                $json
                ->where('status', $status)
                ->etc()
            )
            );



    }
//      public function testSearchWithFromAndToParameters(){
//
//    }
}
