<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmailCollection;
use App\Http\Resources\EmailResource;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'from' => 'required|email',
            'to' => 'required|email',
            'subject' => 'required|string',
            'text_content'=>'nullable|string',
            'html_content' =>'nullable|string',
            'attachments.*' => 'nullable|file'
        ]);

        $email = Email::create([
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'subject' => $request->input('subject'),
            'text_content' => $request->input('text_content'),
            'html_content' => $request->input('html_content')
        ]);

        return new EmailResource($email);
    }

    public function getById($id){
        $email = Email::find($id);

        if ($email){
            return new EmailResource($email);
        }

        return response()->json([
            'message'=>'Email resource not found'
        ],404);
    }


    public function getByRecipient($recipient){
        $emails = Email::where('to',$recipient)->get();

        if (count($emails) > 0){
            return new EmailCollection($emails);
        }

        return response()->json([
            'message'=>'Email resource not found'
        ],404);
    }

    public function search(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        $subject = $request->input('subject');
        $status = $request->input('status');

        $emails = Email::when($from,function ($query, $from) {
            return $query->where('from', $from);
        })
            ->when($to,function ($query, $to) {
                return $query->where('to', $to);
            })
            ->when($subject,function ($query, $subject) {
                return $query->where('subject','LIKE', $subject);
            })
//            ->when($status,function ($query, $status) {
//                return $query->whereIn('status', $status);
//            })
            ->get();



        if ($emails){
            return new EmailCollection($emails);
        }

        return response()->json([
            'message'=>'Email resource not found'
        ],404);
    }
}
