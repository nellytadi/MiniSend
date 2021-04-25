<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Email;
use App\Models\EmailAttachment;

class CreateEmailTest extends TestCase
{

    public function testStoringEmail()
    {


        $data = Email::factory()->make()->toArray();

        $response = $this->post('/api/email/store',$data,['Bearer Token'=>$this->getAuthenticatedUser()]);

        $response->assertStatus(201);
    }

    public function testStoringEmailWithAttachments(){
        $email = Email::factory()->make()->toArray();

        Storage::fake('document');

        $email['attachments'] = [UploadedFile::fake()->create('document.pdf', 100),UploadedFile::fake()->create('document.pdf', 250)];

        $response = $this->post('/api/email/store',$email,['Bearer Token'=>$this->getAuthenticatedUser()]);

        $response->assertStatus(201);


    }

    public function testEmailDataIsValidated(){
        $data = Email::factory()->state([
            'from'=>'wrong email',
            'to'=>'wrong email format',
            'subject' => '',
        ])->make()->toArray();

        $response = $this->post('/api/email/store',$data,['Bearer Token'=>$this->getAuthenticatedUser()]);

        $response->assertStatus(422)->assertJsonValidationErrors(['from','to','subject']);
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
