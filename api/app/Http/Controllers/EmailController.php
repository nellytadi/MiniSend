<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmailCollection;
use App\Http\Resources\EmailResource;
use App\Models\Email;
use App\Models\EmailAttachment;
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
            'attachments.*' => 'nullable|file|max:2048'
        ]);


        $files = [];

        if($request->hasfile('attachments'))
        {
            foreach($request->file('attachments') as $file)
            {
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('attachments', $filename);
                $files[] = 'attachments/'.$filename;
            }
        }

        $email = Email::create([
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'subject' => $request->input('subject'),
            'text_content' => $request->input('text_content'),
            'html_content' => $request->input('html_content'),
            'status' => 'Posted'
        ]);


        if(count($files)>0){
            foreach ($files as $file){
                EmailAttachment::create([
                    'email_id'=>$email->id,
                    'attachment' => $file
                ]);
            }
        }



        return $this->emailResult($email);

    }
    public function getAllEmails(Request $request){

        $per_page = $request->input("per_page") ?? 10;
        $emails = Email::paginate($per_page);

        return $this->emailResults($emails);

    }
    public function getById($id){
        $email = Email::find($id);

        return $this->emailResult($email);

    }


    public function getByRecipient(Request $request,$recipient){
        $per_page = $request->input("per_page") ?? 10;
        $emails = Email::where('to',$recipient)->paginate($per_page);

        return $this->emailResults($emails);

    }

    public function search(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        $subject = $request->input('subject');
        $status = $request->input('status');
        $per_page = $request->input("per_page") ?? 10;

        $emails = Email::when($from,function ($query, $from) {
            return $query->where('from', $from);
        })
            ->when($to,function ($query, $to) {
                return $query->where('to', $to);
            })
            ->when($subject,function ($query, $subject) {
                return $query->where('subject','LIKE', $subject.'%');
            })
            ->when($status,function ($query, $status) {
                return $query->where('status', $status);
            })
            ->paginate($per_page);

        return $this->emailResults($emails);

    }

    private function emailResults($emails)
    {
        if ($emails->isEmpty()){
            return response()->json([
                'message'=>'Email resource not found'
            ],404);
        }
        return new EmailCollection($emails);
    }

    private function emailResult($email){

        if (!$email){
            return response()->json([
                'message'=>'Email resource not found'
            ],404);
        }
        return new EmailResource($email);

    }
}
