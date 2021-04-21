<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmailResource;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function store(Request $request){

        $email = Email::create([
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'subject' => $request->input('subject'),
            'text_content' => $request->input('text_content'),
            'html_content' => $request->input('html_content')
        ]);

        return new EmailResource($email);
    }
    public function search(){

    }
    public function getById(){

    }
    public function getByRecipient(){

    }

}
