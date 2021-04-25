<?php

namespace Tests\Feature;

use App\Models\Email;
use App\Models\EmailAttachment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

class GetEmailTest extends TestCase
{

    public function testGetEmailById()
    {

        $user = User::where('email','test@minisender.com')->first();
        Sanctum::actingAs($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        $emails = Email::where('user_id',$user->id)->inRandomOrder()->limit(2)->get()->toArray();

        foreach($emails as $email){
            $response = $this->get('/api/email/id/'.$email['id'],['Bearer Token'=>$token]);
            $response->assertStatus(200)->assertJsonStructure([
                'data' => [
                    'id',
                    'from',
                    'to',
                    'subject',
                    'text_content',
                    'html_content',
                    'status',
                    'created_at'
                ]
           ]);
        }

    }
    public function testGetEmailByIdReturnsEmptyIfEmailDoesNotExist(){
        $id = Str::random(32);

        $user = User::where('email','test@minisender.com')->first();
        Sanctum::actingAs($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        $email = Email::where('user_id',$user->id)->whereId($id)->exists();
        if (!$email){
            $response = $this->get('/api/email/id/'.$id,['Bearer Token'=>$token]);
            $response->assertStatus(404);
        }else{
            $this->testGetEmailByIdReturnsEmptyIfEmailDoesNotExist();
        }
    }


    public function testGetEmailByRecipient(){

        $user = User::where('email','test@minisender.com')->first();
        Sanctum::actingAs($user);
        $token = $user->createToken('auth_token')->plainTextToken;


        $emails = Email::where('user_id',$user->id)->inRandomOrder()->limit(3)->get()->toArray();
        foreach($emails as $email){
            $response = $this->get('/api/email/recipient/'.$email['to'],['Bearer Token'=>$token]);
            $response->assertStatus(200)->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'from',
                        'to',
                        'subject',
                        'text_content',
                        'html_content',
                        'status',
                        'created_at'
                    ]
                ]
            ]);
        }

    }


    public function testGetEmailByRecipientReturnsEmptyIfRecipientDoesNotExist()
    {
        //generate random name
        $recipient = Str::random(20);

        $user = User::where('email','test@minisender.com')->first();
        Sanctum::actingAs($user);
        $token = $user->createToken('auth_token')->plainTextToken;


        $email = Email::where('user_id',$user->id)->whereTo($recipient)->exists();
        if (!$email){
            $response = $this->get('/api/email/recipient/'.$recipient,['Bearer Token'=>$token]);
            $response->assertStatus(404);
        }else{
            $this->testGetEmailByIdReturnsEmptyIfEmailDoesNotExist();
        }
    }
}
