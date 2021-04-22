<?php

namespace Tests\Feature;

use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class SearchEmailTest extends TestCase
{
  //  use WithFaker;

    public function testSearchWithFromParameter(){
        $from = Str::random(10).'@mailsender.com';
        $count = 5;
        Email::factory($count)->state([
                'from' => $from
            ])->create();

        $response = $this->get('/api/email/search?from='.$from);
        //see it returns 5 record where from = testmail
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
        ])->assertJsonCount($count, 'data');

    }

    public function testSearchWithToParameter(){
        $to = Str::random(10).'@mailsender.com';
        $count = 5;
        Email::factory($count)->state([
            'to' => $to
        ])->create();

        $response = $this->get('/api/email/search?to='.$to);
        //see it returns 5 record where from = testmail
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
        ])->assertJsonCount($count, 'data');
    }
//
//    public function testSearchWithSubjectParameter(){
//
//    }
//    public function testSearchWithStatusParameters(){
//
//    }
//      public function testSearchWithFromAndToParameters(){
//
//    }
}
