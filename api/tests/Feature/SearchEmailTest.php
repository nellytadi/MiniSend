<?php

namespace Tests\Feature;

use App\Helpers\Helper;
use App\Models\Email;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class SearchEmailTest extends TestCase
{
    use WithFaker;

    public function testSearchWithFromParameter(){
        $from = $this->randomEmail();
        $count = 5;

        $user = User::where('email','test@minisender.com')->first();
        Sanctum::actingAs($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        Email::factory($count)->state([
            'user_id'=>$user->id,
            'from' => $from
        ])->create();

        $response = $this->json('GET','/api/email/search?from='.$from,['Bearer Token'=>$token]);

        //see it returns 5 record all 'from' is the $from created

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('meta')
                ->has('links')
            ->has('data', $count, fn ($json) =>
                $json
                    ->where('from', $from)
                    ->etc()
                )
            );

    }

    public function testSearchWithToParameter(){
        $to = $this->randomEmail();

        $count = 5;

        $user = User::where('email','test@minisender.com')->first();
        Sanctum::actingAs($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        Email::factory($count)->state([
            'user_id'=>$user->id,
            'to' => $to
        ])->create();

        $response = $this->json('GET','/api/email/search?to='.$to,['Bearer Token'=>$token]);

        //see it returns 5 record all 'to' is the $to created
         $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('meta')
                ->has('links')
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

        $user = User::where('email','test@minisender.com')->first();
        Sanctum::actingAs($user);
        $token = $user->createToken('auth_token')->plainTextToken;


        Email::factory($count)->state([
            'user_id'=>$user->id,
            'subject' => $subject
        ])->create();

        $response = $this->json('GET','/api/email/search?subject='.$subject,['Bearer Token'=>$token]);

        //see it returns 5 record and 'subject' has the $subject created
        $response->assertStatus(200)
            ->assertSeeText($subject)
            ->assertJsonCount($count, 'data');

    }
    public function testSearchWithStatusParameters(){

        $user = User::where('email','test@minisender.com')->first();
        Sanctum::actingAs($user);
        $token = $user->createToken('auth_token')->plainTextToken;


        $statuses = (new Helper)->getStatuses();

        $status = $statuses[rand(0,2)];

        $response = $this->json('GET', '/api/email/search?status=' .$status,['Bearer Token'=>$token] );

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('meta')
                ->has('links')
                ->has('data.0',fn ($json) =>
                $json
                ->where('status', $status)
                ->etc()
            )
            );



    }

    public function testSearchWithMultipleParameters(){

        $from = $this->randomEmail();
        $to = $this->randomEmail();
        $subject = $this->faker->sentence;
        $statuses = (new Helper)->getStatuses();

        $status = $statuses[rand(0,2)];
        $count = 5;

        $user = User::where('email','test@minisender.com')->first();
        Sanctum::actingAs($user);
        $token = $user->createToken('auth_token')->plainTextToken;


        Email::factory($count)->state([
            'user_id'=>$user->id,
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
            'status' => $status
        ])->create();

        $response = $this->json('GET',"/api/email/search?from=$from&to=$to&subject=$subject&status=$status",['Bearer Token'=>$token]);

        //see it returns 5 record all 'from' is the $from created

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('meta')
                ->has('links')
                ->has('data', $count, fn ($json) =>
            $json
                ->where('from', $from)
                ->where('to', $to)
                ->where('subject', $subject)
                ->where('status', $status)
                ->etc()
            )
            );

    }

    private function randomEmail(){
        return Str::random(10).'@mailsender.com';
    }


}
