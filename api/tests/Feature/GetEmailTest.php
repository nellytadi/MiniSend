<?php

namespace Tests\Feature;

use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class GetEmailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetEmailById()
    {
        Email::factory(5)->create();

        $emails = Email::inRandomOrder()->limit(2)->get()->toArray();
        foreach($emails as $email){
            $response = $this->get('/api/email/'.$email['id']);
            $response->assertStatus(200)->assertJsonStructure([
                'data'=>[
                    'from',
                    'to',
                    'subject',
                    'text_content',
                    'html_content',
                    'status'
                ]
           ]);
        }

    }
    public function testGetEmailByIdReturnsEmptyIfEmailDoesNotExist(){
        $id = Str::random(10);
        $email = Email::whereId($id)->exists();
        if (!$email){
            $response = $this->get('/api/email/'.$id);
            $response->assertStatus(404);
        }else{
            $this->testGetEmailByIdReturnsEmptyIfEmailDoesNotExist();
        }
    }

}
