<?php

namespace Tests\Feature;

use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class GetEmailTest extends TestCase
{

    public function testGetEmailById()
    {


        $emails = Email::inRandomOrder()->limit(2)->get()->toArray();
        foreach($emails as $email){
            $response = $this->get('/api/email/id/'.$email['id'],['Bearer Token'=>$this->getAuthenticatedUser()]);
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
        $email = Email::whereId($id)->exists();
        if (!$email){
            $response = $this->get('/api/email/id/'.$id,['Bearer Token'=>$this->getAuthenticatedUser()]);
            $response->assertStatus(404);
        }else{
            $this->testGetEmailByIdReturnsEmptyIfEmailDoesNotExist();
        }
    }


    public function testGetEmailByRecipient(){

        Email::factory(5)->create();

        $emails = Email::inRandomOrder()->limit(2)->get()->toArray();
        foreach($emails as $email){
            $response = $this->get('/api/email/recipient/'.$email['to'],['Bearer Token'=>$this->getAuthenticatedUser()]);
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
        $email = Email::whereTo($recipient)->exists();
        if (!$email){
            $response = $this->get('/api/email/recipient/'.$recipient,['Bearer Token'=>$this->getAuthenticatedUser()]);
            $response->assertStatus(404);
        }else{
            $this->testGetEmailByIdReturnsEmptyIfEmailDoesNotExist();
        }
    }

    /**
     * Function to fetch authenticated user.
     *
     * @return String
     */
    private function getAuthenticatedUser(): string
    {
        $data = [
            'email' => 'test@minisender.com',
            'password' => 'password'
        ];
        $token = $this->json('POST','/api/login',$data);

        return $token['access_token'];
    }
}
