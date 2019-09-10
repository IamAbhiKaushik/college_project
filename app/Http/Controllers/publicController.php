<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use DB;
use Illuminate\Support\Facades\Storage;

class publicController extends Controller
{

public function purple(Request $req){
//    return var_dump(phpinfo());
    if (session('username')){
        return view('purple.index');
    }
    if ($req->data == 'PurplePie02'){
        session(['username' => 'AB']);
//        $topics = DB::table('subject_topics')->where([['subject','P'],['class','11']])->get();
//        return $topics;
        return view('purple.index');
    }
    else {
        echo 'Bad request';
        session()->flush();
    }
}

    public function post_question(Request $req){
            #save the data to new table..
//            return $req->solution_text;
        $solutionImage = 0;
        $questionImage = 0;
            if($req->hasFile('question_image')) {
//                return 'Hello Bro';
                //get filename with extension
//                $filenamewithextension = $req->file('question_image')->getClientOriginalName();
                //get filename without extension
//                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                //get file extension
                $extension = $req->file('question_image')->getClientOriginalExtension();
//                filename to store
                    $fileNameToStore = 'questions/' . time() . '.' . $extension;
//                 Storage::disk('s3')->put('avatars/1', $fileContents);
                    Storage::disk('s3')->put($fileNameToStore, fopen($req->file('question_image'), 'r+'), 'public');
//                https://s3.ap-south-1.amazonaws.com/smrtbook/questions/A_1529533760.png

                $questionImage = $fileNameToStore;

            }
        if($req->hasFile('solution_image')) {
            $extensionS = $req->file('solution_image')->getClientOriginalExtension();
            $fileNameToStoreS = 'solutions/' . time() . '.' . $extensionS;
            Storage::disk('s3')->put($fileNameToStoreS, fopen($req->file('solution_image'), 'r+'), 'public');
            $solutionImage = $fileNameToStoreS;
        }

        DB::table('public_question')->insert([
            'question_type'=>$req->cat,'class'=>$req->class,'topic'=>$req->sub_cat,'subject'=>$req->subject,
            'correct_answer'=>$req->answer,'marks'=>$req->marks,'negative'=>$req->penulty,
            'question'=>$req->question,'solution'=>$req->solution,'question_image'=>$questionImage,
            'solution_image'=>$solutionImage
        ]);

//            DB::table('public_question')->insert([
//                'question_type'=>$req->cat,'subject'=>$req->subject,
//                'correct_answer'=>$req->answer,'marks'=>$req->marks,'negative'=>$req->penulty,
//                'question'=>$req->question,'solution'=>$req->solution,'question_image'=>$req->question_text,
//                'solution_image'=>$req->solution_text
//            ]);
//            $link = 'https://s3.ap-south-1.amazonaws.com/smrtbook/questions/'.$filenametostore;
//            $msg = 'Question Added Successfully';
//            $response = array(
//                'status' => 'success',
//                'msg' => $msg,
//            );
//            return $req;
//            return $msg;
//            return response()->json($response);
                return back()->with('key','question added successfully., File Name: '. $questionImage.'<br> and Solution Image is '.$solutionImage);
        }


    public function add_question(Request $req){

        $topics = DB::table('subject_topics')->where([['class','11']])->get();
        return view('purple.add_question',compact('req','topics'));

}







    public function contact_us(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
       

          DB::table('master_contact')->insert([
              ['name' => $request->name , 'phone' => $request->subject , 'email' => $request->email ,'message' => $request->message ]
          ]);
          $email = $request->email;
          $name = $request->name;
          Mail::send('emails.contact',[], function ($message) use ($email, $name) {
            $message->from('sales@smrtbook.in', 'Sales | SmrtBook.in');
            $message->to($email, $name);
            $message->subject('Sales support | Smrtbook.in');
        });

        $email = '13annon@gmail.com';
        $name = $request->name;
        Mail::send('emails.contact_me',['request'=>$request], function ($message) use ($email, $name) {
            $message->from('sales@smrtbook.in', 'Sales | SmrtBook.in');
            $message->to($email, $name);
            $message->subject('Sales support | Smrtbook.in');
        });

        return redirect('/')->with('status', 'Your Response has been recorded');
    }
}
