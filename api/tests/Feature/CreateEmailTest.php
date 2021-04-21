<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Email;

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
