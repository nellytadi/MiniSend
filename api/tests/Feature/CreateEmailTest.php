<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Email;
use App\Models\EmailAttachment;

class CreateEmailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoringEmail()
    {
        $data = Email::factory()->make()->toArray();

        $response = $this->post('/api/email/store',$data);

        $response->assertStatus(201);
    }

    public function testStoringEmailWithAttachments(){
        $emails = Email::factory(2)
            ->has(EmailAttachment::factory()->count(rand(1,3)))
            ->make();

        foreach ($emails as $email){
            $response = $this->post('/api/email/store',$email->toArray());

            $response->assertStatus(201);
        }

    }

    public function testEmailDataIsValidated(){
        $data = Email::factory()->state([
            'from'=>'wrong email',
            'to'=>'wrong email format',
            'subject' => '',
        ])->make()->toArray();

        $response = $this->post('/api/email/store',$data);

        $response->assertStatus(422)->assertJsonValidationErrors(['from','to','subject']);
    }
}
