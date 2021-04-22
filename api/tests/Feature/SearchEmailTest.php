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
            $json->has('data', $count)
                ->has('data', $count, fn ($json) =>
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
            $json->has('data', $count)
                ->has('data', $count, fn ($json) =>
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

        //see it returns 5 record all 'to' is the $to created
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data', $count)
                ->has('data', $count, fn ($json) =>
                $json
                    ->where('subject', $subject)
                    ->etc()
                )
            );


    }
//    public function testSearchWithStatusParameters(){
//
//    }
//      public function testSearchWithFromAndToParameters(){
//
//    }
}
