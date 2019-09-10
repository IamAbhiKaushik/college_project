<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use DateTime;
use DateTimeZone;
use Mail;
use Illuminate\Support\Facades\URL;
use Tzsk\Payu\Facade\Payment;



class studentController extends Controller
{
    public function  student(){
        return redirect('student/login');
//        return view('events.index');
    }


    public function  payment(){
        $attributes = [
            'txnid' => strtoupper(str_random(8)), # Transaction ID.
            'amount' => rand(1, 2), # Amount to be charged.
            'productinfo' => "This is Product Information",
            'firstname' => "Aman G", # Payee Name.
            'email' => "13annon@gmail.com", # Payee Email Address.
            'phone' => "9415056043", # Payee Phone Number.
        ];

        return Payment::make($attributes, function ($then) {
            $then->redirectTo('payment/status');
            # OR...
            $then->redirectRoute('payment.status');
            # OR...
            $then->redirectAction('studentController@status');
        });
    }

    public function status(){
        $payment = Payment::capture();
        return var_dump($payment->isCaptured());
    }



    public function  exam0($id){
        if (!session('username')) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        $exam = DB::table('tests')->where('exam_code',$id)->first();
        $coachingInfo = DB::table('users')->where('user_name',$exam->coach_id)->first();
        session(['coachingName' => $coachingInfo->coachingName]);
//        $exam->coachingName = $coachingInfo->coachingName;

//        return var_dump($exam);

        return view('events.exam0',compact('exam'));
    }

    public function  exam1($id){
        if (!session('username')) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        //check if the user had already attempted that exam before ?
        $exam = DB::table('tests')->where('exam_code',$id)->first();
//        $coachingInfo = DB::table('users')->where('user_name',$exam->coach_id)->first();
        $data = DB::table('master_students')->where('username',session('username'))->first();
        $attempted = DB::table('master_response')->where([['username',session('username')],['examCode',$exam->id]])->first();
        // check if he can give the exam or not and is it the right time to attempt the exam ?
//        return var_dump(empty($attempted));

        $date = new DateTime($exam->livetime, new DateTimeZone('Asia/Kolkata'));
        $pre = $date->getTimestamp();
        $timeChecker = time() - $pre;
        $batches = explode(",",$exam->tag);
        //and $timeChecker >= (-600) and $timeChecker <= (600)
        $activeTime = $exam->time_live*60*60;
        if (in_array($data->coaching_batch,$batches) and $timeChecker >= 0 and $timeChecker <= $activeTime ) {
            if (empty($attempted)) {
                $checkAttempt = DB::table('master_students')->where('username', session('username'))->first();
                if ($checkAttempt->status != 0) {
                    // he is attempting an exxam so not allowed.
                    echo '<script>
                alert("Can not attempt two exams at Once.");
                parent.window.close();
                </script>';
                } else {
                    DB::table('master_students')->where('username', session('username'))
                        ->update(['status' => $id]);
                    $examUrl = URL::temporarySignedRoute(
                        'design', now()->addMinutes(30), ['id' => $id]
                    );
                    return view('events.exam1', compact('exam', 'examUrl'));
                }
            } else {
                echo '<script>
            alert("This exam has already been attempted by You, In case there is any error, Please contact your Institute or SmrtBook.in Support.")
            parent.window.close();
            </script>';
            }
        }
        else{
            echo '<script>
            alert("Time to attempt this exam has passed, you can not attempt this exam Now.");
            parent.window.close();
            </script>';

        }
    }


    public function pdf_x($id){
//        return $id;
        if (!session('username')) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        $data = DB::table('master_students')->where('username',session('username'))->first();
        $exam= DB::table('tests')->where([['exam_code',$id],['coach_id',$data->coaching]])->first();
//        return var_dump($exam->tag);
//        $data->coaching_batch = 'AA';
        $tt = strpos($exam->tag,$data->coaching_batch);
//        return $tt;
//        echo $exam->tag.'<br>'.$data->coaching_batch.'<br>';
        if (strlen($tt)>0){
//            echo 'Hello0';
            $filename = 'files/'.$exam->pdf.'.pdf';
//            echo $filename;
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="'.$filename.'"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($filename);
        }
        else return 'null';
    }


    public function pdf_x_sol($id){
        if (!session('username')) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        $data = DB::table('master_students')->where('username',session('username'))->first();

        $exam= DB::table('tests')->where([['exam_code',$id],['coach_id',$data->coaching]])->first();
        $tt = strpos($exam->tag,$data->coaching_batch);
        if (strlen($tt)>0){
            $filename = 'files/'.$exam->solution.'.pdf';
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="'.$filename.'"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($filename);
        }
        else return 'null';
    }


    public function ab()
    {
        $t = 'img/sprite.png';

        $src = imagecreatefrompng($t);
        $dest = imagecreatetruecolor(80, 40);
// Copy
        imagecopy($dest, $src, 0, 0, 20, 13, 80, 40);
// Output and free from memory
        header('Content-Type: image/png');
        imagegif($dest);
        imagedestroy($dest);
        imagedestroy($src);


        // $im = imagecreatefrompng($t);
        // $rgb = imagecolorat($im, 100, 150);
        // // return gd_info();
        // $r = ($rgb >> 16) & 0xFF;
        // $g = ($rgb >> 8) & 0xFF;
        // $b = $rgb & 0xFF;

        // return var_dump($r, $g, $b);
        // return $rgb;
    }
    public function getRegister(){
        $coaching = DB::table('users')->get();
        return view('material.register',compact('coaching'));
    }

    public function getRegisterId($id){
        $coaching = DB::table('users')->where([['user_key',$id]])->first();
//        return var_dump($coaching);
        if (empty($coaching)){
            return redirect('/');
        }
        $batches = DB::table('students')->where('coaching_id',$coaching->user_name)->get();

        return view('material.registerId',compact('coaching','batches'));

    }



    public function techfest(){

        $coaching = DB::table('users')->where([['user_key','TF']])->first();
        if (empty($coaching)){
            return redirect('/');
        }
//        if ($id == 'techfest') return view('material.registerTF',compact('coaching','batches'));
        $batches = DB::table('students')->where('coaching_id',$coaching->user_name)->get();
        return view('material.registerTF',compact('coaching','batches'));
    }








    public function logout(){
//        clear all session and redirect ot login page
        session()->flush();
        return redirect('/student/login');
    }

    public function postRegister(Request $req){
        $data = $req;
        // substr("Hello world",6);
        $pass = md5(date("Y/m/d"));
        $pass = substr($pass,0,10);
        $username = 'smrt_'.$pass;
        // $data = $data;
        // return var_dump($data);
        $check = DB::table('master_students')->where('email',$req->emailid)->first();
//        return $check;
        if ($check != NULL){
            return redirect('/student/login')->with('status', 'Email Already exist, Login to proceed.');
        }
        $req->class = 'Not Updated';
        $newID = DB::table('master_students')->insertGetId(
            ['name'=>$req->name,'email'=>$req->emailid,'phone'=>$req->phone,'class'=>$req->class,'username'=>$username,'pass'=>$pass,'coaching'=>$req->coaching]
        );
        $username = 'smrt_'.substr($req->name,0,2).$newID;
        $rank = DB::table('master_students')->orderBy('rank','desc')->first();
        $newRank =  $rank->rank+1;
        $data['rank']= $newRank;
        $data['username'] = $username;
        DB::table('master_students')->where('id', $newID)
            ->update(['username' => $username,'rank'=>$newRank]);

        DB::table('master_students_record')->insert(
            ['username'=>$username]
        );

        // return view('events.dashboard',['data',$data]);
        //send a mail to user on that email id and return to login page..
        $email =$req->emailid;
        $name = $req->name;
        $userData = ['name'=>$name,'email'=>$email,'username'=>$username,'pass'=>$pass];

        Mail::send('emails.login_detail',['userData'=>$userData], function ($message) use ($email,$name) {
            $message->from('support@smrtbook.in', 'Support | SmrtBook.in');
            $message->to($email, $name);
            $message->subject('Registration Successful | SmrtBook.in');
        });

//        return $username.'<br>'.$pass;
        return redirect('/student/login')->with('status', 'Registration successful, check your mailbox for login credentials.Thanks');
        //have to email verification here...
    }





    public function postRegisterId(Request $req,$id){
//        return var_dump($req->coaching);

        $check = DB::table('master_students')->where([['coaching_rollno', $req->rollno],['coaching',$req->coaching]])->get();
        if(sizeof($check )== 0) {
            try {
                DB::table('master_students')->insert([
                    'coaching' => $req->coaching,
                    'class' => 'B.Tech',
                    'name' => $req->name,
                    'email' => $req->emailid,
                    'coaching_rollno' => $req->rollno,
                    'coaching_batch' => $req->batch,
                    'pass' => substr($req->emailid, 0, -11),
                    'phone' => $req->phone,
                    'dob' => '',
                    'username' => $id . '_' . $req->rollno,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/student/register/'.$id)->with('status', 'Registration Failed, Please try again.');
            }
            DB::table('master_students_record')->insert(
                ['username'=>$id . '_' . $req->rollno,
                'email'=> $req->emailid]
            );
            $student = [];
            $student['email'] = $req->emailid;
            $insti = DB::table('users')->where('user_name',$req->coaching)->first();
            $student['insti'] = $insti->coachingName;
            $d = $req->emailid;
            $nae = $req->name;
            # TODO: Check mail correctness
            $student['unamee'] = $id. '_' . $req->rollno;
            Mail::send('emails.registerId', ['student' => $student], function ($message) use ($d, $nae) {
                $message->from('support@smrtbook.in', 'Support | SmrtBook.in');
                $message->to($d, $nae);
                $message->subject('Welcome to SmrtBook | Smrtbook.in');
            });

            return redirect('/student/login')->with('status', 'Registration successful, check your mailbox for login credentials.Thanks');
        }
        else{
            return redirect('/student/register/'.$id)->with('status', 'This roll No is already registered on our platform, Please contact your DPC.');
        }

//        return $username.'<br>'.$pass;

        //have to email verification here...
    }



    public function postTechfest(Request $req){
//        return var_dump($req->coaching);

        $check = DB::table('master_students')->where([['coaching_rollno', $req->rollno],['coaching','akash703']])->get();
        if(sizeof($check )== 0) {
            try {
                DB::table('master_students')->insert([
                    'coaching' => 'akash703',
                    'name' => $req->name,
                    'email' => $req->emailid,
                    'class'=>'Not Updated',
                    'coaching_rollno' => $req->rollno,
                    'coaching_batch' => $req->batch,
                    'pass' => substr($req->emailid, 0, -11),
                    'phone' => $req->phone,
                    'dob' => '',
                    'username' =>  'TF_' . $req->rollno,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/student/techfest')->with('status', 'Registration Failed, Please try again.');
            }
            DB::table('master_students_record')->insert(
                ['username'=>'TF_' . $req->rollno,
                    'email'=> $req->emailid]
            );
            $student = [];
            $student['email'] = $req->emailid;
            $insti = DB::table('users')->where('user_name','akash703')->first();
            $student['insti'] = $insti->coachingName;
            $student['name'] = $req->name;
            $d = $req->emailid;
            $nae = $req->name;
            # TODO: Check mail correctness
            $student['unamee'] = 'TF_' . $req->rollno;

            Mail::send('emails.registerTF', ['student' => $student], function ($message) use ($d, $nae) {
                $message->from('support@smrtbook.in', 'Support | SmrtBook.in');
                $message->to($d, $nae);
                $message->subject('Welcome to SmrtBook | Smrtbook.in');
            });

            return redirect('/student/login')->with('status', 'Registration successful, check your mailbox for login credentials.Thanks');
        }
        else{
            return redirect('/student/techfest')->with('status', 'This roll No is already registered on our platform, Please contact Techfest Team or mail at innovation@techfest.org.');
        }

//        return $username.'<br>'.$pass;

        //have to email verification here...
    }




    public function dashboard(Request $req){
        $data = DB::table('master_students')->where([
            ['username',$req->username],
            ['pass',$req->password]
        ])->first();
        // return var_dump($data);
        if ($data != NULL) {
            session(['username' => $data->username]);
            DB::table('master_students_record')->where('username',session('username'))->update(
                ['login_record'=>time()]
            );
            return redirect('/student/dashboard');
        }
        else{
            $data2 = DB::table('master_students')->where([
                ['email',$req->username],
                ['pass',$req->password]
            ])->first();
            if ($data2== NULL) return back()->with('status', 'Login Failed, Please check your credentials');
            session(['username' => $data2->username]);
            return redirect('/student/dashboard');
        }
    }

    public function getDashboard(){
        if (!session('username')) return redirect('/student/login')->with('status', 'Session Expired, Please login again.');
        $data = DB::table('master_students')->where('username',session('username'))->first();
        if (empty($data)) return redirect('/student/login')->with('status', 'User not found, Please login and try again.');
        $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
        $data->coachingName = $coaching->coachingName;
        if($data->coaching == 'akash703'){
            if($data->class == 'Not Updated' or $data->dob == NULL or $data->school == NULL or $data->passport == NULL or $data->coaching_batch==NULL){
                return redirect('/student/updateInfo')->with('status','Please Update your Information before attempting the Exam.');
            }
        }
            $totalExams = [];
            $exams = DB::table('tests')->where([['coach_id',$data->coaching],['public_exam',0]])->get();
//            return $exams;
            if (!empty($exams)) {
                foreach ($exams as $key => $exam) {
                    $date = new DateTime($exam->livetime, new DateTimeZone('Asia/Kolkata'));
                    $pre = $date->getTimestamp();
                    $timeChecker = time() - $pre;
                    $batches = explode(",",$exam->tag);
                    //and $timeChecker >= (-600) and $timeChecker <= (600)

                    $activeTime = $exam->time_live*60;
//                    echo $activeTime;
//                    echo var_dump($timeChecker <= $activeTime );
                    if (in_array($data->coaching_batch,$batches) and $timeChecker >= 0 and $timeChecker <= ($activeTime) ) {
                        //if exam is attempted already, then do not allow to attempt the exam...
                        $examId = $exam->id;
                        // now for each total exams check if the user had already attemplted it
                        // in the table of exam - student -coaching -response table
                        $alreadyAttempted = DB::table('master_response')->
                        where([['username', session('username')], ['examCode', $examId]])->first();
                        if (empty($alreadyAttempted)) $exam->attempted = 0;
                        else $exam->attempted = 1;
                        $totalExams[] = $exam;
                    }
                }
            }
//            update the required exam variable
            $exams = $totalExams;
            //send notification data for batch ..
            if ($data->coaching_batch !=NULL) {
                $infos = DB::table('master_notification')->where([['coaching_code',$data->coaching],['batch_name',$data->coaching_batch]])->get();
            }
        $dataNames = [];
        $dataTop = [];
        $dataAvg = [];
        $dataMe = [];
        $exam_performances = DB::table('tests')->where([['coach_id',$data->coaching],['public_exam',0]])->get();
//        $finalRecords['sections'] = ['P'=>'Physics','C'=>'Chemistry','M'=>'Maths','B'=>'Biology','E'=>'English','L'=>'Logic Reasoning','O'=>'Other'];
        foreach ($exam_performances as $key1=>$exam_performance){
            $responseData = DB::table('master_response')->where([['username',session('username')], ['examCode',$exam_performance->id]])->first();
            $topperData = DB::table('master_response')->where('examCode',$exam_performance->id)->orderBy('result','DESC')->first();
            if (!empty($topperData)) {
                $dataNames[] = $exam->exam_code;
                $dataTop[] = substr(json_decode($topperData->result)->totalM*100/$exam_performance->max_marks,0,5);
                $dataAvg[] = substr($exam_performance->avg*100/($exam_performance->max_marks),0,5);//this will be available in the $exam itself vut later
                if (empty($responseData)) {
                    $exam_performance->ifAttempted = false;
                    $dataMe[] = 0;
                } else {
                    $exam_performance->result = json_decode($responseData->result);
                    $sunMarks= array_sum(explode(",", $exam_performance->result->totalMarks));
                    $dataMe[] =substr($sunMarks*100/($exam_performance->max_marks),0,5);
                }
            }
            else{
                if (empty($responseData)) {
                    $exam_performance->ifAttempted = false;
                } else {
                    $exam_performance->ifAttempted = true;
                }
            }
        }
        $gData = ['dataNames'=>json_encode($dataNames),'dataMe'=>json_encode($dataMe),'dataAvg'=>json_encode($dataAvg),
            'dataTop'=>json_encode($dataTop)];

        return view('events.dashboard',compact('data','exams','infos','gData','$exam_performances'));





    }

    public function performance(){

        if (!session('username')) return redirect('/student/login')->with('status', 'Session Expired, Please login again.');
        $data = DB::table('master_students')->where('username',session('username'))->first();
        if (empty($data)) return redirect('/student/login')->with('status', 'User not found, Please login and try again.');
        $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
        $data->coachingName = $coaching->coachingName;
        $exams = DB::table('tests')->where('coach_id',$data->coaching)->get();
        $records = '';
        $finalRecords = [];
        $finalRecords['sections'] = ['P'=>'Physics','C'=>'Chemistry','M'=>'Maths','B'=>'Biology','E'=>'English','L'=>'Logic Reasoning','O'=>'Other'];
        foreach ($exams as $key=>$exam){
            $responseData = DB::table('master_response')->where([['username',session('username')], ['examCode',$exam->id]])->first();
            $topperData = DB::table('master_response')->where('examCode',$exam->id)->orderBy('result','DESC')->first();
            if (!empty($topperData)) {
                $dataNames[] = $exam->exam_code;
                $dataTop[] = substr(json_decode($topperData->result)->totalM*100/$exam->max_marks,0,5);
                $dataAvg[] = substr($exam->avg*100/($exam->max_marks),0,5);//this will be available in the $exam itself vut later
                if (empty($responseData)) {
                    $exam->ifAttempted = false;
                    $dataMe[] = 0;
                } else {
                    $performanceData = $responseData->result;
                    $dataSet = explode(',',json_decode($performanceData)->sections);
                    foreach ($dataSet as $key=>$dataKey){
                        if (!isset($records->totalQ[substr($dataKey,0,1)][substr($dataKey,1,1)] )){
                            $records->totalQ[substr($dataKey,0,1)][substr($dataKey,1,1)] = explode(',',json_decode($performanceData)->totalQ)[$key];
                            $records->totalAttempted[substr($dataKey,0,1)][substr($dataKey,1,1)]  = explode(',',json_decode($performanceData)->totalQ)[$key] - explode(',',json_decode($performanceData)->totalNotAttempted)[$key];
                            $records->totalCorrect[substr($dataKey,0,1)][substr($dataKey,1,1)]  =explode(',',json_decode($performanceData)->totalCorrect)[$key];
                            $records->totalMarks[substr($dataKey,0,1)][substr($dataKey,1,1)]  =explode(',',json_decode($performanceData)->totalMarks)[$key];
                            $records->examMarks[substr($dataKey,0,1)][substr($dataKey,1,1)]  =explode(',',json_decode($performanceData)->examMarks)[$key];
                            $records->totalTime[substr($dataKey,0,1)][substr($dataKey,1,1)]  =explode(',',json_decode($performanceData)->totalTime)[$key];
                        }
                        else{
                            $records->totalQ[substr($dataKey,0,1)][substr($dataKey,1,1)]  += explode(',',json_decode($performanceData)->totalQ)[$key];
                            $records->totalAttempted[substr($dataKey,0,1)][substr($dataKey,1,1)]  += explode(',',json_decode($performanceData)->totalQ)[$key] - explode(',',json_decode($performanceData)->totalNotAttempted)[$key];
                            $records->totalCorrect[substr($dataKey,0,1)][substr($dataKey,1,1)]  +=explode(',',json_decode($performanceData)->totalCorrect)[$key];
                            $records->totalMarks[substr($dataKey,0,1)][substr($dataKey,1,1)]  +=explode(',',json_decode($performanceData)->totalMarks)[$key];
                            $records->examMarks[substr($dataKey,0,1)][substr($dataKey,1,1)]  +=explode(',',json_decode($performanceData)->examMarks)[$key];
                            $records->totalTime[substr($dataKey,0,1)][substr($dataKey,1,1)]  +=explode(',',json_decode($performanceData)->totalTime)[$key];
                        }
                    }
                    $exam->result = json_decode($responseData->result);
                    $sunMarks= array_sum(explode(",", $exam->result->totalMarks));
                    $dataMe[] =substr($sunMarks*100/($exam->max_marks),0,5);
                }
            }
            else{
                if (empty($responseData)) {
                    $exam->ifAttempted = false;
                } else {
                    $exam->ifAttempted = true;
                }
            }
        }
        if ($records != NULL) {
//            return 'No exams attempted till now';
//        }
            $subjects = array_keys($records->totalQ);
            $infoSet = ['P' => 'Physics', 'C' => 'Chemistry', 'M' => 'Maths', 'B' => 'Biology', 'E' => 'English', 'L' => 'Logic Reasoning', 'O' => 'Other', '0' => 'Single_Correct', '1' => 'Multiple_Correct', '2' => 'Integer_Correct'];
            $itemStyle = [0 => 'single_correct', 1 => 'multiple_correct', 2 => 'int_correct'];
            foreach ($subjects as $subject) {
                $loopData = array_keys($records->totalQ[$subject]);
                foreach ($loopData as $qType) {
                    $piData[$subject][] = ['name' => $infoSet[$qType], 'type' => 'bar',
                        'tooltip' => '{trigger: "item"}',
                        'stack' => 'A',
                        'data' => [$records->totalQ[$subject][$qType], $records->totalAttempted[$subject][$qType], $records->totalCorrect[$subject][$qType]]
                    ];
                }
            }
            $gData = ['dataNames' => json_encode($dataNames), 'dataMe' => json_encode($dataMe), 'dataAvg' => json_encode($dataAvg),
                'dataTop' => json_encode($dataTop)];
            return view('events.performance',compact('data','exams','public_exams','gData','records','infoSet','piData'));
        }
//        return $records;
        return view('events.performance',compact('data','exams','public_exams','records','infoSet','piData'));
    }

    public function records(){
        // return all the exams he has already attempted...
        if (session('username')!=NULL) {
            $totalExams = [];
            #fetch all exams and user info applicable to that student..
            $data = DB::table('master_students')->where('username',session('username'))->first();
            if (empty($data)) return redirect('/student/login')->with('status', 'User not found, Please login and try again.');
            $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
            $data->coachingName = $coaching->coachingName;
            if($data->coaching == 'akash703'){
                return redirect('/student/dashboard')->with('status','You are not allowed to view previous exams');
            }

            $exams = DB::table('tests')->where([['coach_id',$data->coaching],['public_exam',0]])->get();

            foreach ($exams as $key => $exam) {

                $tt = $exam->duration;
                $tt = $tt*3600 + $exam->time_live*60;
                $date = new DateTime($exam->livetime, new DateTimeZone('Asia/Kolkata'));
                $pre = $date->getTimestamp()+$tt;
                $timeChecker = $pre - time();
                $batches = explode(",",$exam->tag);
                //and $timeChecker >= (-600) and $timeChecker <= (600)
                if (in_array($data->coaching_batch,$batches) and $timeChecker <= (-3600)  ) {
                    $exam->ifAllowed = true;
                    $responseData = DB::table('master_response')->where([['username',session('username')],['examCode',$exam->id]])
                        ->first();
                    if (empty($responseData)) {
                        $exam->ifAttempted = false;
                    }
                    else{
                        $exam->ifAttempted = true;
                        $exam->response = $responseData->response;
                        $exam->result = $responseData->result;
                        $exam->examRank = $responseData->examRank;
                    }

                }
                else{
                    $exam->ifAllowed = false;
                }
//                $exam->endTime = $timeChecker;

            }
            $public_exams = DB::table('master_response')
                ->where([['username',session('username')],['owner','!=',$data->coaching]])->get();
            foreach ($public_exams as $key => $exam) {
                $examInfo = DB::table('tests')->where('id',$exam->examCode)->first();
                $exam->test_name = $examInfo->test_name;
                $exam->exam_code = $examInfo->exam_code;
                $exam->duration = $examInfo->duration;
                $exam->livetime = $examInfo->livetime;
//                $totalExams[] = $exam;
            }
            // now for each total exams check if the user had already attemplted it
            // in the table of exam - student -coaching -response table
//             return $exams;
            return view('events.record',compact('data','exams','public_exams'));
        }
        else{
            return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        }
    }


    public function publicExam(){
        if (session('username')==NULL) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');

        #fetch all exams and user info applicable to that student..
        $data = DB::table('master_students')->where('username',session('username'))->first();
        $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
        $data->coachingName = $coaching->coachingName;

//        $exams = DB::table('public_tests')->where('status','live')->get();
        $exams = DB::table('tests')->where([['public_exam',1]])->get();

        foreach ($exams as $exam){
            $coaching = DB::table('users')->where('user_name',$exam->coach_id)->first();
            $exam->coachingName = $coaching->coachingName;
            $attempt = DB::table('master_response')->where([['username',session('username')],['examCode',$exam->id]])->first();
            if (empty($attempt)){
                $exam->attempted = true;
            }
            else{
                $exam->attempted = false;
            }
        }
//        return $exams;
        return view('events.public_exam',compact('data','exams'));
    }

    public function solutionApi($id){
        if (session('username')==NULL) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        $userResponse = DB::table('master_response')->where([['examCode',$id],['username',session('username')]])->first();
        if (empty($userResponse)){
            $userResponse = DB::table('master_response')->where([['examCode',$id]])->orderBy('result','DESC')->first();
        }
        $res = json_decode($userResponse->response);
        foreach ( $res as $key=>$response) {
            if ($key != 0) {
                $data = DB::table('questions')->where('id', $response->q_id)->first();
                $response->avgTime = intdiv(($data->left_time+$data->correct_time+$data->false_time),(1+$data->not_attempted+$data->correct_attempt+$data->left_time));
                $response->MaxMarks = $data->marks;
                $response->negative = $data->negative;
                $response->q_type = $data->question_type;
            }
        }
        $userResponse->response = json_encode($res);
        $tt = json_encode($userResponse);
        return $tt;
    }


    public function solutionApiDemo($id){
        if (session('username')==NULL) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        $userResponse = DB::table('master_response')->where([['examCode',$id],['username',session('username')]])->first();
        if (empty($userResponse)){
            $userResponse = DB::table('master_response')->where([['examCode',$id]])->orderBy('result','DESC')->first();
        }
        $res = json_decode($userResponse->response);
        foreach ( $res as $key=>$response) {
            if ($key != 0) {
            $data = DB::table('questions')->where('id', $response->q_id)->first();
            $response->avgTime = substr(($data->left_time+$data->correct_time+$data->false_time)/(1+$data->not_attempted+$data->correct_attempt+$data->left_time),0,5);
            $response->MaxMarks = $data->marks;
            $response->negative = $data->negative;
            $response->q_type = $data->question_type;
            }
        }
        return $res;
        $userResponse->response = json_encode($res);
        $tt = json_encode($userResponse);
        return $tt;
    }




    public function markImpo(Request $request){
        $data = DB::table('master_important')->where([['user',session('username')],['exam_id',$request->examID]])->first();
        $newData = ['no'=>$request->question,'sub'=>$request->subject];
        $q = [];
        $q[] = $newData;
        $qJson = json_encode($q);
        if (empty($data)){
            DB::table('master_important')->insert(['user' =>session('username'),'exam'=>$request->paper,'questions'=>$qJson,'exam_id'=>$request->examID]);
        }
        else{
            $cc = json_decode($data->questions);
            if (in_array($newData,$cc)){
                return 'Question Already Marked Important.';
            }
            else{
                $cc[] =$newData;
                $updated = json_encode($cc);
                DB::table('master_important')->where([['user',session('username')],['exam_id',$request->examID]])->update(['questions'=>$updated]);
            }
        }
        return 'Updated Successfully';
    }

    public function showImportant(){
        if (session('username')==NULL) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        $data = DB::table('master_students')->where('username',session('username'))->first();
        $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
        $data->coachingName = $coaching->coachingName;
        $marked = DB::table('master_important')->where('user',session('username'))->get();

//        return  var_dump($marked[0]->questions)[0];
        foreach ($marked as $key=>$m){
            $m->questions = json_decode($m->questions);
            foreach ($m->questions as $question){
                $subject[$key][substr($question->sub,0,1)][] = $question->no;
            }
        }
        return view('events.showImportant',compact('marked','data','subject'));
    }






    public function addIssue(Request $req){
        if (session('username')==NULL) return 'bad Request, You are not logged In. Refresh and retry';
        else{

            // if user has right to attempt that question paper..
            $data = DB::table('master_students')->where('username',session('username'))->first();
            $exam = DB::table('tests')->where([['exam_code',$req->paper],['coach_id',$data->coaching]])->first();
            $checkForBatch = empty(strpos($exam->tag,$data->coaching_batch));

            if ($checkForBatch){
                $stud1 = ['username'=>session('username'),'name'=>$data->name,'coaching'=>$data->coaching,'batch'=>$data->coaching_batch,'roll'=>$data->coaching_rollno];
                $stud = json_encode($stud1);
                $paper1 = ['paper'=>$req->paper,'q_no'=>$req->q,'paper_admin'=>$exam->coach_id];
                $paper = json_encode($paper1);
                DB::table('master_issues')->insert(
                    ['student'=>$stud,'paper' => $paper,'issue'=>$req->message]
                );
//                DB::table('master_issues')->insert();
                return 'Your issue has been submitted Successfully';
            }
            else{
                return 'You are not allowed to submit issue for this question.';
            }

        }

    }

    public function solution($id){
        if (session('username')==NULL) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        $data = DB::table('master_students')->where('username',session('username'))->first();
        $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
        $data->coachingName = $coaching->coachingName;
        $userResponse = DB::table('master_response')->where([['examCode',$id],['username',session('username')]])->first();
        $examInfo = DB::table('tests')->where('exam_code',$id)->first();
        if (empty($examInfo)) return redirect('/student/dashboard')->with('status','The requested Exam does not exist,
            Please try for a valid Exam.');
        return view('events.solution',compact('userResponse','examInfo','data'));
    }

    public function solution_v2($id){
        if (session('username')==NULL) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        $data = DB::table('master_students')->where('username',session('username'))->first();
        $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
        $data->coachingName = $coaching->coachingName;
        $examCode = substr($id,4)-1000;
//        return $examCode;

        $userResponse = DB::table('master_response')->where([['examCode',$examCode],['username',session('username')]])->first();
//        $userResponse = DB::table('master_response')->where([['examCode',$id],['username',session('username')]])->first();
        $examInfo = DB::table('tests')->where('exam_code',$id)->first();
//        $detailedResponse = json_decode($userResponse->response);
//        return dd($userResponse);
        $res = json_decode($userResponse->response);
        foreach ( $res as $key=>$response) {
            if ($key != 0) {
                $data_v2 = DB::table('questions')->where('id', $response->q_id)->first();
                if ($data_v2->correct_attempt==0){$response->avgTime = 0;}
                else {$response->avgTime = intdiv(($data_v2->correct_time),($data_v2->correct_attempt));}
                $response->MaxMarks = $data_v2->marks;
                $response->negative = $data_v2->negative;
                $response->attempt = $data_v2->correct_attempt.' | '.($data_v2->correct_attempt+$data_v2->false_attempt);
            }
        }


//        return var_dump($detailedResponse);
        if (empty($examInfo)) return redirect('/student/dashboard')->with('status','The requested Exam does not exist,
            Please try for a valid Exam.');
        return view('events.solution_v2',compact('userResponse','examInfo','data','res'));
    }


    public function graphical($id){
        if (session('username')==NULL) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
        $data = DB::table('master_students')->where('username',session('username'))->first();
        $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
        $data->coachingName = $coaching->coachingName;
        $examCode = substr($id,4) - 1000;
        $examData = DB::table('master_response')->where([['username',session('username')],['examCode',$examCode]])->first();
        $topData = DB::table('master_response')->where('examCode',$examCode)->orderBy('result','DESC')->first();
        $timeData = json_decode($examData->response);
        $topperData = json_decode($topData->response);
        $data->examRank = $examData->examRank;
        $data->percentile = $examData->percentile;
        $data->examId = $id;

        session(['question-paper' => $id]);
        $keys = '0';
        $times = '0';
        $correct = 0;
        $wrong = 0;
        $keysT = '0';
        $timesT = '0';
        $correctT = 0;
        $wrongT = 0;

        $performanceData = $examData->result;
        $dataSet = explode(',',json_decode($performanceData)->sections);

        foreach ($dataSet as $key=>$dataKey){
            if (!isset($records->totalQ[substr($dataKey,0,1)][substr($dataKey,1,1)] )){
                $records->totalQ[substr($dataKey,0,1)][substr($dataKey,1,1)] = explode(',',json_decode($performanceData)->totalQ)[$key];
                $records->totalAttempted[substr($dataKey,0,1)][substr($dataKey,1,1)]  = explode(',',json_decode($performanceData)->totalQ)[$key] - explode(',',json_decode($performanceData)->totalNotAttempted)[$key];
                $records->totalCorrect[substr($dataKey,0,1)][substr($dataKey,1,1)]  =explode(',',json_decode($performanceData)->totalCorrect)[$key];
                $records->totalMarks[substr($dataKey,0,1)][substr($dataKey,1,1)]  =explode(',',json_decode($performanceData)->totalMarks)[$key];
                $records->examMarks[substr($dataKey,0,1)][substr($dataKey,1,1)]  =explode(',',json_decode($performanceData)->examMarks)[$key];
                $records->totalTime[substr($dataKey,0,1)][substr($dataKey,1,1)]  =explode(',',json_decode($performanceData)->totalTime)[$key];
            }
            else{
                $records->totalQ[substr($dataKey,0,1)][substr($dataKey,1,1)]  += explode(',',json_decode($performanceData)->totalQ)[$key];
                $records->totalAttempted[substr($dataKey,0,1)][substr($dataKey,1,1)]  += explode(',',json_decode($performanceData)->totalQ)[$key] - explode(',',json_decode($performanceData)->totalNotAttempted)[$key];
                $records->totalCorrect[substr($dataKey,0,1)][substr($dataKey,1,1)]  +=explode(',',json_decode($performanceData)->totalCorrect)[$key];
                $records->totalMarks[substr($dataKey,0,1)][substr($dataKey,1,1)]  +=explode(',',json_decode($performanceData)->totalMarks)[$key];
                $records->examMarks[substr($dataKey,0,1)][substr($dataKey,1,1)]  +=explode(',',json_decode($performanceData)->examMarks)[$key];
                $records->totalTime[substr($dataKey,0,1)][substr($dataKey,1,1)]  +=explode(',',json_decode($performanceData)->totalTime)[$key];
            }
        }
//    total marks are the marks scored by user and exam marks are the total marks the exam can let you socre.
        $sectionsInExam = explode(',',json_decode($examData->result)->sections);
        foreach ($sectionsInExam as $sectionInExam){
            $noOfTotalQuestion[$sectionInExam[0]] = 0;
            $noOfCorrectQuestion[$sectionInExam[0]] = 0;
            $noOfNotAttemptedQuestion[$sectionInExam[0]] = 0;
            $timeOfTotalQuestion[$sectionInExam[0]] = 0;
            $timeOfCorrectQuestion[$sectionInExam[0]] = 0;
            $timeOfWrongQuestion[$sectionInExam[0]] = 0;
        }
        foreach ($timeData as $key=>$time) {
            if ($key > 0) {
                $noOfTotalQuestion[($time->qType)[0]] ++;
                $timeOfTotalQuestion[($time->qType)[0]] = $timeOfTotalQuestion[($time->qType)[0]]+$time->time;
                $keys = $keys.','.$key;
                $times = $times.','.$time->time;
                if ($time->correct == $time->answer) {
                    $noOfCorrectQuestion[($time->qType)[0]]++;
                    $timeOfCorrectQuestion[($time->qType)[0]] = $timeOfCorrectQuestion[($time->qType)[0]] + $time->time;
                }
                else {
                    if (empty($time->answer)){
                        $noOfNotAttemptedQuestion[($time->qType)[0]]++;
                    }
                    else{
                        $timeOfWrongQuestion[($time->qType)[0]] =  $timeOfWrongQuestion[($time->qType)[0]] + $time->time;
                    }
                }
            }
        }

        foreach ($topperData as $key=>$time) {
            if ($key > 0) {
                $timesT = $timesT.','.($time->time);
                $keysT = $keysT.','.$key;
                if ($time->correct == $time->answer) $correctT++;
                else $wrongT++;
            }
        }
        $inExam = json_decode($examData->result);
        $gData[] = ['times'=>$times,'keys'=>$keys,'correct'=>$correct,'wrong'=>$wrong];
        $gData[] = ['times'=>$timesT,'keys'=>$keysT,'correct'=>$correctT,'wrong'=>$wrongT];
        $subT = ['P'=>'Physics','C'=>'Chemistry','M'=>'Maths','B'=>'Biology','O'=>'Other','0'=>'Single Correct','1'=>'Multiple Correct','2'=>'Integer Correct','3'=>'Integer Correct'];
        $sub = array_keys($noOfTotalQuestion);
        foreach ($sub as $s){
            $subjects[] = $subT[$s];
            $subjectObs['marks'][$s] = 0;
            $subjectObs['time'][$s] = 0;
            $ss[$s] = [$noOfTotalQuestion[$s],$noOfCorrectQuestion[$s],$noOfTotalQuestion[$s]-$noOfCorrectQuestion[$s]-$noOfNotAttemptedQuestion[$s]];
            $ssTime[$s] = [$timeOfCorrectQuestion[$s],$timeOfWrongQuestion[$s],$timeOfTotalQuestion[$s]];
        }
        $sectionsList = explode(',',$inExam->sections);
        foreach ($sectionsList as $key=>$section){
            $subjectObs['marks'][$section[0]] =  $subjectObs['marks'][$section[0]] + explode(',',$inExam->totalMarks)[$key];
            $subjectObs['time'][$section[0]] =  $subjectObs['time'][$section[0]] + explode(',',$inExam->totalTime)[$key];
        }
        $examName = DB::table('tests')->where('id',$examData->examCode)->first();
                $inExam->examName = $examName->test_name;
                $inExam->examDate = $examData->created_at;

//        now is the time to calculate the student standing in differnet segments of exam.
        $all_responses = DB::table('master_response')->where('examCode',$examName->id)->get();
        $data->all_responses = sizeof($all_responses);
//        return var_dump($all_responses);
        $gData_one = json_encode(['0','10','20','30','40','50','60','70','80','90','100']); // x-axis
        $gData_two= ['0','0','0','0','0','0','0','0','0','0','0']; //y-axis
        $gData_latest = [];

        foreach ($all_responses as $all_response){
//            return $all_response;
            $sum01  =json_decode($all_response->result)->examMarks;
            $sum01 = explode(",",$sum01); //now its an array of marks in each section
            $stu_result = intdiv((json_decode($all_response->result)->totalM)*100,array_sum($sum01));
//            return $stu_result;
//            echo intdiv($stu_result,10) .'<br>';
            if ($stu_result<0) $stu_result = 0;
            $gData_two[intdiv($stu_result,10)] = $gData_two[intdiv($stu_result,10)]+1;
        }
        foreach ($gData_two as $kk=>$two){
            if (array_sum($gData_two) == 0){}
            else $gData_latest[] = intdiv($two*100,array_sum($gData_two));
        }
        $gData_latest = json_encode($gData_latest);

//        $gData_one = json_encode(['0','10','20','30','40','50','60','70','80','90','100']);
//        $gData_two= json_encode(['1','2','3','4','5','6','7','8','9','10','11']);
        return view('events.graphical',compact('data','inExam','gData','subjects','ss','ssTime','subjectObs','records','subT','gData_one','gData_latest'));
    }

    public  function studGraph($paper,$id){
        if (session('username')==NULL ) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
//        or I got the question paper and now redirect to that question paper on that ID
//        echo session('username').'<br>'.$id;
//        session(['q_no' => $id]);
        return redirect('/solutions/'.$paper)->with('q_no',$id);

        //        return $id;
    }

    public function graphicalApi($id){
//        $data =
        if (session('username')==NULL) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');

        $examData = DB::table('master_response')->where([['username',session('username')],['examCode',$id]])->first();
        return $examData->response;
//        return var_dump($examData->response);
//        return view('events.graphical',compact('data','examData'));
    }



    public function exams(){
        return view('events.exams');
    }
    public function updateInfo(){
        if (!session('username')) return redirect('/student/login');


        $data = DB::table('master_students')->where('username',session('username'))->first();
        $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
        $data->coachingName = $coaching->coachingName;
        $data->support_phone = $coaching->phone;
        $data->support_email = $coaching->email;


//        $exams = DB::table('master_response')->where('username',session('username'))->orderBy('examCode')->get();
//        $batches = DB::table('students')->where('coaching_id',$data->coaching)->get();
//        foreach ($batches as $key=>$batch){
//            $data->batch[$key] = $batch->student_tag;
//        }

        return view('events.updateInfo',compact('data'));

//        return view('events.updateInfo');
    }

    public function examTechfest(){
        if (!session('username')) return redirect('/student/login');

        $data = DB::table('master_students')->where('username',session('username'))->first();
        $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
        if ($data->coaching != 'akash703'){
            return redirect('/student');
        }
        $data->coachingName = $coaching->coachingName;
        $sub = DB::table('techfest_essay_response')->where('db_id',$data->id)->first();
//        return var_dump($sub->submission);
        if (!empty($sub)){
            $data->submission = $sub->submission;
        }
        else{
            $data->submission = '1';
        }
        return view('events.tf_exam',compact('data'));
    }

//    public function passport_tf(){
//        $data = DB::table('master_students')->get();
//        $data1 = DB::table('master_students')->where('passport' == 'No')->get();
//        $data2 = DB::table('master_students')->where('passport' == NULL)->get();
//        return sizeof($data)-sizeof($data2)-sizeof($data1);
//    }

    public function exam_postTechfest(Request $req){
        if (!session('username')) return 'Session expired due to Inactivity, Copy your written data, reload the page and try again.';
        if ($req->data !=NULL){
            $data = DB::table('master_students')->where('username',session('username'))->first();
//            DB::table('techfest_essay_response')->

            $sub = DB::table('techfest_essay_response')->where('db_id',$data->id)->first();
            if (!empty($sub)){
                #update
                DB::table('techfest_essay_response')->where('db_id',$data->id)->update(
                    ['submission'=>$req->data]
                );
                return '!!Confirmation !! Submission Updated successfully for User: '. $data->name;
            }
            else{
                #insert
                DB::table('techfest_essay_response')->insert(
                    ['db_id'=>$data->id,'name' => $data->name,'batch'=>$data->coaching_batch,'submission'=>$req->data,'entry_time'=>time()]
                );
                return '!!Confirmation !! New Submission recorded successfully for User: '. $data->name;
            }
        }
        else{
            return 'no data recieved, Please retry';
        }
    }




    public function updateInfo_post(Request $req){
//        return $req->address;

        if (session('username')==NULL) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');

        $data = DB::table('master_students')->where('username',session('username'))->first();



        if ( strlen($req->passport) <7){
            $req->passport = 'No';
        }
            if ($req->password == $req->re_password and $req->password != '' and strlen($req->password) >=6){
                DB::table('master_students')->where('username',session('username'))->update(
                    ['name'=>$req->name,'phone'=>$req->mobile,'coaching_batch'=>$req->coaching_batch,'class'=>$req->class,'gender'=>$req->gender,'dob'=>$req->dob,'pincode'=>$req->pincode,'school'=>$req->school_name,
                        'school_email'=>$req->school_email,'school_mobile'=>$req->school_mobile,'city'=>$req->city,'state'=>$req->state,'passport'=>$req->passport,'pass'=>$req->password]
                );
                //send a mail
                return redirect('/student/dashboard')->with('message','Password and other Information Updated Successfully. Go to dashboard for further information');
            }
            elseif(($req->password != '' and strlen($req->password)<6) or $req->password != $req->re_password ){
                return redirect('/student/updateInfo')->with('status','Please select a password of length more than 6 digits and make sure values of password and update password are same.');
            }
            else{
                DB::table('master_students')->where('username',session('username'))->update(
                    ['name'=>$req->name,'phone'=>$req->mobile,'coaching_batch'=>$req->coaching_batch,'class'=>$req->class,'gender'=>$req->gender,'dob'=>$req->dob,'pincode'=>$req->pincode,'school'=>$req->school_name,
                        'school_email'=>$req->school_email,'school_mobile'=>$req->school_mobile,'city'=>$req->city,'state'=>$req->state,'passport'=>$req->passport]
                );
                //send a mail
                return redirect('/student/dashboard')->with('message','Information except password are Updated. Visit Dashboard for further information');
            }
    }

    //
    public function design(){
        // send all the info inside
        //fetch sections from exams table ->where(examCode)-> sections
        // $sect = ['PHY SEC1','PHY SEC2','PHY SEC3','CHEM SEC1','CHEM SEC2','CHEM SEC3','MATH SEC1','MATH SEC2','MATH SEC3'];
        // this table will be created from database so need to be here
        $sections = [];
        $sec = [];
//        $firstQ =[];
        //we will have all the questions in the table
        //db::table(quesitons)->where('admin',@admin and 'examCode',$examCode)->get;
        $questions = DB::table('questions')->where([['test_id','10']])->get();
//        return $questions;
        foreach ($questions as $key => $question) {
            $sec[$question->subject.$question->question_type][] = $question;
        }
//        return var_dump($sec);
        foreach ($sec as $key => $section) {
            $sections[] = $key;
        }
        foreach ($sections as $key=>$section){
            $firstQ[$key] = $sec[$section][0]->question_number;
        }
//        return 'Hello';
        // return $sec['P2'][0]->q_no;
        // return var_dump($sec['M0'][0]->id);
            $id = 10;
//        ['exam_id'=>$id,'sections'=>$sections,'sec'=>$sec,'firstQ'=>$firstQ]
        return view('vue.design',['exam_id'=>$id,'sections'=>$sections,'sec'=>$sec,'firstQ'=>$firstQ]);

    }



    public function design_x(Request $req,$id){
        if (! $req->hasValidSignature()) {
            abort(401);
        }

        if (!session('username')) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');
//        if(empty(session('username'))) return 'Null';
//        id is the exam ID
        $sections = [];
        $sec = [];
        $exam = DB::table('tests')->where('exam_code',$id)->first();
        $user = DB::table('master_students')->where('username',session('username'))->first();
//        now check for his batch in the exam...
        $batches = explode(",",$exam->tag);
//        return $batches;
        if (in_array($user->coaching_batch,$batches)){
            $questions = DB::table('questions')->where([['test_id',$exam->id]])->get();
//            return var_dump($questions);
//            $current = '';
            $previous = 'X';
            $c = 1;
            $tt = array('P'=>'PHY SEC','C'=>'CHEM SEC','M'=>'MATH SEC','B'=>'BIO SEC','E'=>'English','L'=>'Logic Reasoning','O'=>'Other');
//            $qType = array('P0'=>'PHY SEC1','P1'=>'PHY SEC2','P2'=>'PHY SEC3','C0'=>'CHEM SEC1','C1'=>'CHEM SEC2','C2'=>'CHEM SEC3','M0'=>'MATH SEC1','M1'=>'MATH SEC2','M2'=>'MATH SEC3');
            foreach ($questions as $key => $question) {
                $current = $question->subject.$question->question_type;
                if ($current == $previous){}
                else{
                    if ($previous[0] == $current[0]){
                        $c++;
                    }
                    else $c =1;
                    $previous = $current;
//                    $types[$question->subject.$c] = $tt[$question->subject].$c;
                }
                $sec[$question->subject.$c][] = $question;
//                $sec[$question->subject.$question->question_type][] = $question;
            }
            foreach ($sec as $key => $section) {
                $sections[] = [$key,$tt[$key[0]].$key[1]];
            }
            foreach ($sections as $key=>$section){
                $firstQ[$key] = $sec[$section[0]][0]->question_number;
            }
            return view('vue.design',['exam'=>$exam,'user'=>$user,'sections'=>$sections,'sec'=>$sec,'firstQ'=>$firstQ]);

        }

    }


    public function easylrn_x($id){

        $sections = [];
        $sec = [];
        $exam = DB::table('tests')->where('exam_code',$id)->first();

            $questions = DB::table('questions')->where([['test_id',$exam->id]])->get();
//            return var_dump($questions);
//            $current = '';
            $previous = 'X';
            $c = 1;
            $tt = array('P'=>'PHY SEC','C'=>'CHEM SEC','M'=>'MATH SEC','B'=>'BIO SEC','E'=>'English','L'=>'Logic Reasoning','O'=>'Other');
//            $qType = array('P0'=>'PHY SEC1','P1'=>'PHY SEC2','P2'=>'PHY SEC3','C0'=>'CHEM SEC1','C1'=>'CHEM SEC2','C2'=>'CHEM SEC3','M0'=>'MATH SEC1','M1'=>'MATH SEC2','M2'=>'MATH SEC3');
            foreach ($questions as $key => $question) {
                $current = $question->subject.$question->question_type;
                if ($current == $previous){}
                else{
                    if ($previous[0] == $current[0]){
                        $c++;
                    }
                    else $c =1;
                    $previous = $current;
//                    $types[$question->subject.$c] = $tt[$question->subject].$c;
                }
                $sec[$question->subject.$c][] = $question;
//                $sec[$question->subject.$question->question_type][] = $question;
            }
            foreach ($sec as $key => $section) {
                $sections[] = [$key,$tt[$key[0]].$key[1]];
            }
            foreach ($sections as $key=>$section){
                $firstQ[$key] = $sec[$section[0]][0]->question_number;
            }
            return view('vue.easylrn',['exam'=>$exam,'sections'=>$sections,'sec'=>$sec,'firstQ'=>$firstQ]);
    }

    public function submitExam(Request $req, $id){

//        $responseArray = $req->response;
        $r = json_decode($req->response);
//        return var_dump($r[15]->answer);

        $questions = DB::table('questions')->where('test_id',$id)->get();
        // to get only the starting questiosn
        $responses =  array_splice($r,0,sizeof($questions)+1);
//        return var_dump($responses);
//        return sizeof($questions);


        $inExam['totalQ'] = sizeof($questions);
        $previous = 'AX';
        $c = 0;
        $tt = array('P'=>'PHY SEC','C'=>'CHEM SEC','M'=>'MATH SEC','B'=>'BIO SEC','E'=>'English','L'=>'Logic Reasoning','O'=>'Other');

        foreach ($responses as $key => $response) {
            if ($key >0 and $key<=$inExam['totalQ']) {//this much response we need.
                $current = $questions[$key - 1]->subject.$questions[$key - 1]->question_type;
                $response->qType = $current;
                if ($current == $previous){}
                else{
                    if ($previous[0] == $current[0])$c++;
                    else $c =0;
                    $result['totalQ'][$current[0].$c] = 0;
                    $result['totalNotAttempted'][$current[0].$c] = 0;
                    $result['correctAttempt'][$current[0].$c] = 0;
                    $result['examMarks'][$current[0].$c] = 0;
                    $result['totalMarks'][$current[0].$c] = 0;
                    $result['attemptedMarks'][$current[0].$c] = 0;
                    $result['totalTime'][$current[0].$c] = 0;
                    $previous = $current;
                }
                $correctAnswer = $questions[$key - 1]->correct_answer;

                $sectionID = $questions[$key - 1]->subject.$c;
                $result['totalQ'][$sectionID]++;
                $result['examMarks'][$sectionID] =  $result['examMarks'][$sectionID]+$questions[$key - 1]->marks;
                $response->correct = $correctAnswer;
                $response->q_id = $questions[$key - 1]->id;
                $result['totalTime'][$sectionID] = $result['totalTime'][$sectionID]+$response->time;
                if (is_array($response->answer) and !empty($response->answer)) {
                    //this to make a final response from BAD to ABD in array response
                    //this is a multiple choice question, right?
                    $attemptedResponse= $response->answer;
                    $result['attemptedMarks'][$sectionID] += $questions[$key - 1]->marks;

                    $v = implode("", $attemptedResponse);
                        $stringParts = str_split($v);
                        sort($stringParts);
                        $finalResponse = implode('', $stringParts);
                        $response->answer = $finalResponse;
                        //check answer
//                    echo var_dump($finalResponse).' is the response(multiple) and answer is: '.var_dump($correctAnswer).' ,';
                        if ($finalResponse == $correctAnswer) {
//                            echo 'corrected right<br>';
                            $questions[$key-1]->correct_attempt++;
                            $questions[$key-1]->correct_time = $questions[$key-1]->correct_time+$response->time;
                            $result['correctAttempt'][$sectionID]++;
                            $result['totalMarks'][$sectionID] =$result['totalMarks'][$sectionID]+$questions[$key - 1]->marks;
//                            $result['examMarks'][$sectionID] =$result['examMarks'][$sectionID]+$questions[$key - 1]->marks;
                        }
                        else {
//                            echo 'wronge answer.<br>';
//                            //wrong result
                            $questions[$key-1]->false_attempt++;
                            $questions[$key-1]->false_time = $questions[$key-1]->false_time+$response->time;
//                            $result['examMarks'][$sectionID] =$result['examMarks'][$sectionID]-$questions[$key - 1]->negative;
                            $result['totalMarks'][$sectionID] =$result['totalMarks'][$sectionID]-$questions[$key - 1]->negative;
//                            $result['totalNegativeMarks'][$sectionID] = $result['totalNegativeMarks'][$sectionID]+$questions[$key - 1]->negative;
                        }
                    } elseif (!empty($response->answer)){
//                    $finalResponse = ;
//                    $response->answer = implode('', $response->answer);

//                    It means if the response is single correct or integer correct
//                    echo var_dump($response->answer).' this is single correct'.var_dump($correctAnswer).' is the correct answer<br>';

                    $result['attemptedMarks'][$sectionID] += $questions[$key - 1]->marks;
                    if ($response->answer == $correctAnswer) {
//                            correct choice
                            $questions[$key-1]->correct_attempt++;
                            $questions[$key-1]->correct_time = $questions[$key-1]->correct_time+$response->time;
                            $result['correctAttempt'][$sectionID]++;
                            $result['totalMarks'][$sectionID] =$result['totalMarks'][$sectionID]+$questions[$key - 1]->marks;
//                            echo 'For question' . $key .' Answer is correct.<br>';
                        }
                        else {
                            $questions[$key-1]->false_attempt++;
                            $questions[$key-1]->false_time = $questions[$key-1]->false_time+$response->time;
                            $result['totalMarks'][$sectionID] =$result['totalMarks'][$sectionID]-$questions[$key - 1]->negative;
                        }
                    }
                    else {
                    //not attempted
                        $questions[$key-1]->not_attempted++;
                        $questions[$key-1]->left_time = $questions[$key-1]->left_time+$response->time;
                        $result['totalNotAttempted'][$sectionID]++;
                    }


                DB::table('questions')->where('id',$questions[$key-1]->id)
                    ->update(['correct_attempt'=>$questions[$key-1]->correct_attempt,
                        'false_attempt'=>$questions[$key-1]->false_attempt,
                        'correct_time'=>$questions[$key-1]->correct_time,
                        'false_time'=>$questions[$key-1]->false_time,
                        'left_time'=>$questions[$key-1]->left_time,
                        'not_attempted'=>$questions[$key-1]->not_attempted]);
            }
        }


        $inExam['totalQ'] = implode(",",$result['totalQ']);
        $inExam['sections'] = implode(',',array_keys($result['examMarks']));
        $inExam['totalNotAttempted'] = implode(",",$result['totalNotAttempted']);
        $inExam['totalCorrect'] = implode(",",$result['correctAttempt']);
        $inExam['totalMarks'] = implode(",",$result['totalMarks']);
        $inExam['totalM'] = array_sum($result['totalMarks']);
        $inExam['examMarks'] = implode(",",$result['examMarks']);
        $inExam['attemptedMarks'] = implode(",",$result['attemptedMarks']);
        $inExam['totalTime'] = implode(",",$result['totalTime']);

//        $inExam['totalNegativeMarks'] = ;
//        $inExam['percentage']=0;
        $inExam['percentile']='Not Updated';
//        $inExam['CPI']=0;
//        $inExam['rank']=0;
//        $inExam['smrtRank']=0;

        DB::table('master_students')->where('username',session('username'))
            ->update(['status' =>0]);

        $studentData = DB::table('master_students')->where('username',session('username'))->first();
        $inExam['name']= $studentData->name;
        $inExam['batch']= $studentData->coaching_batch;
        $inExam['roll_no']= $studentData->coaching_rollno;
        $inExam_string = json_encode($inExam);
//        return $responses;
        //result will store an array or a json value with Overall exam evaluations.
        $responses = json_encode($responses);
        $owner = DB::table('tests')->where('id',$id)->first()->coach_id;
        DB::table('master_response')->insert(
            ['username'=>session('username'),'examCode' => $id,'owner'=>$owner,'response'=>$responses,'result'=>$inExam_string]
        );
         return view('events.response',compact('inExam'));
    }




    public function submitEasy(Request $req, $id){

//        $responseArray = $req->response;
        $r = json_decode($req->response);

        $questions = DB::table('questions')->where('test_id',$id)->get();

        $responses =  array_splice($r,0,sizeof($questions)+1);

        $inExam['totalQ'] = sizeof($questions);
        $previous = 'AX';
        $c = 0;
        $tt = array('P'=>'PHY SEC','C'=>'CHEM SEC','M'=>'MATH SEC','B'=>'BIO SEC','E'=>'English','L'=>'Logic Reasoning','O'=>'Other');

        foreach ($responses as $key => $response) {
            if ($key >0 and $key<=$inExam['totalQ']) {//this much response we need.
                $current = $questions[$key - 1]->subject.$questions[$key - 1]->question_type;
                if ($current == $previous){}
                else{
                    if ($previous[0] == $current[0])$c++;
                    else $c =0;

                    $result['totalQ'][$current[0].$c] = 0;
                    $result['totalNotAttempted'][$current[0].$c] = 0;
                    $result['correctAttempt'][$current[0].$c] = 0;
                    $result['examMarks'][$current[0].$c] = 0;
                    $result['totalMarks'][$current[0].$c] = 0;
                    $result['totalTime'][$current[0].$c] = 0;

                    $previous = $current;
                }
                $correctAnswer = $questions[$key - 1]->correct_answer;
                $sectionID = $questions[$key - 1]->subject.$c;
                $result['totalQ'][$sectionID]++;
                $result['examMarks'][$sectionID] =  $result['examMarks'][$sectionID]+$questions[$key - 1]->marks;
                $response->correct = $correctAnswer;
                $response->q_id = $questions[$key - 1]->id;
                $result['totalTime'][$sectionID] = $result['totalTime'][$sectionID]+$response->time;
                if (is_array($response->answer) and !empty($response->answer)) {
                    //this to make a final response from BAD to ABD in array response
                    $attemptedResponse= $response->answer;
                    $v = implode("", $attemptedResponse);
                    $stringParts = str_split($v);
                    sort($stringParts);
                    $finalResponse = implode('', $stringParts);
                    $response->answer = $finalResponse;
                    //check answer
//                    echo var_dump($finalResponse).' is the response(multiple) and answer is: '.var_dump($correctAnswer).' ,';
                    if ($finalResponse == $correctAnswer) {
//                            echo 'corrected right<br>';
                        $questions[$key-1]->correct_attempt++;
                        $questions[$key-1]->correct_time = $questions[$key-1]->correct_time+$response->time;
                        $result['correctAttempt'][$sectionID]++;
                        $result['totalMarks'][$sectionID] =$result['totalMarks'][$sectionID]+$questions[$key - 1]->marks;
//                            $result['examMarks'][$sectionID] =$result['examMarks'][$sectionID]+$questions[$key - 1]->marks;
                    }
                    else {
//                            echo 'wronge answer.<br>';
//                            //wrong result
                        $questions[$key-1]->false_attempt++;
                        $questions[$key-1]->false_time = $questions[$key-1]->false_time+$response->time;
//                            $result['examMarks'][$sectionID] =$result['examMarks'][$sectionID]-$questions[$key - 1]->negative;
                        $result['totalMarks'][$sectionID] =$result['totalMarks'][$sectionID]-$questions[$key - 1]->negative;
//                            $result['totalNegativeMarks'][$sectionID] = $result['totalNegativeMarks'][$sectionID]+$questions[$key - 1]->negative;
                    }
                } elseif (!empty($response->answer)){
//                    It means if the response is single correct or integer correct
//                    echo var_dump($response->answer).' this is single correct'.var_dump($correctAnswer).' is the correct answer<br>';
                    if ($response->answer == $correctAnswer) {
//                            correct choice
                        $questions[$key-1]->correct_attempt++;
                        $questions[$key-1]->correct_time = $questions[$key-1]->correct_time+$response->time;
                        $result['correctAttempt'][$sectionID]++;
                        $result['totalMarks'][$sectionID] =$result['totalMarks'][$sectionID]+$questions[$key - 1]->marks;
//                            echo 'For question' . $key .' Answer is correct.<br>';
                    }
                    else {
                        $questions[$key-1]->false_attempt++;
                        $questions[$key-1]->false_time = $questions[$key-1]->false_time+$response->time;
                        $result['totalMarks'][$sectionID] =$result['totalMarks'][$sectionID]-$questions[$key - 1]->negative;
                    }
                }
                else {
                    $questions[$key-1]->not_attempted++;
                    $questions[$key-1]->left_time = $questions[$key-1]->left_time+$response->time;
                    $result['totalNotAttempted'][$sectionID]++;
                }
//                DB::table('questions')->where('id',$questions[$key-1]->id)
//                    ->update(['correct_attempt'=>$questions[$key-1]->correct_attempt,
//                        'false_attempt'=>$questions[$key-1]->false_attempt,
//                        'correct_time'=>$questions[$key-1]->correct_time,
//                        'false_time'=>$questions[$key-1]->false_time,
//                        'left_time'=>$questions[$key-1]->left_time,
//                        'not_attempted'=>$questions[$key-1]->not_attempted]);
            }
        }
        $inExam['totalQ'] = implode(",",$result['totalQ']);
        $inExam['totalNotAttempted'] = implode(",",$result['totalNotAttempted']);
        $inExam['totalCorrect'] = implode(",",$result['correctAttempt']);
        $inExam['totalMarks'] = implode(",",$result['totalMarks']);
        $inExam['totalM'] = array_sum($result['totalMarks']);
        $inExam['examMarks'] = implode(",",$result['examMarks']);
        $inExam['totalTime'] = implode(",",$result['totalTime']);

//        $inExam['totalNegativeMarks'] = ;
//        $inExam['percentage']=0;
        $inExam['percentile']='Not Updated';
//        $inExam['CPI']=0;
//        $inExam['rank']=0;
//        $inExam['smrtRank']=0;
//        $studentData = DB::table('master_students')->where('username',session('username'))->first();
//        $inExam['name']= $studentData->name;
//        $inExam['batch']= $studentData->coaching_batch;
//        $inExam['roll_no']= $studentData->coaching_rollno;
        $inExam_string = json_encode($inExam);
//        return $responses;
        //result will store an array or a json value with Overall exam evaluations.
        $responses = json_encode($responses);
//        $owner = DB::table('tests')->where('id',$id)->first()->coach_id;
//        DB::table('master_response')->insert(
//            ['username'=>session('username'),'examCode' => $id,'owner'=>$owner,'response'=>$responses,'result'=>$inExam_string]
//        );
        return view('events.responseEasy',compact('inExam'));
    }


    public  function  examResult($id){
        //first check if he is logged in..
        //second if its his exammination
        //then
        $results = DB::table('master_response')->where('examCode',$id)->orderBy('result->totalM','DESC')->get();

        foreach ($results as $key=>$result){

            $response[$key+1] = json_decode($result->response);
            $report[$key+1] = json_decode($result->result);
        }
        return $report;
    }
    public function readaws(Request $request)
    {
        if($request->hasFile('profile_image')) {

            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File to s3
            // Storage::disk('s3')->put('avatars/1', $fileContents);

            Storage::disk('s3')->put($filenametostore, fopen($request->file('profile_image'), 'r+'), 'public');
            return $filenametostore;
            //Store $filenametostore in the database
        }
    }

    public function vue(){
        $url = Storage::disk('s3')->url('2017p1.pdf');

        // Storage::setVisibility(asset('storage'), 'public');
        // $visibility = Storage::getVisibility(asset('storage/2017p1.pdf'));
// http://localhost:8000/storage/140100043.jpg
        //   	$url = Storage::temporaryUrl(
        //   		'2017p1.pdf', now()->addMinutes(5)
        // );
        // return asset('storage/2017p1.pdf');
        // return Storage::download('2017p1.pdf');
        // return asset('storage/2017p1.pdf');
        return view('vue.index',['url'=>$url]);
    }
    public function vuepdf(){
        if (session('username')) {
            return "no username exists, So no pdf";
        }
        else{
            $file = 'https://s3.ap-south-1.amazonaws.com/smrtbook/2017p1.pdf';
            $filename = '2017p1.pdf';
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="'.$filename.'"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($file);
        }

    }

    public  function institute($id){

        $coaching = DB::table('users')->where('user_key',$id)->first();
        if (empty($coaching)){
            return redirect('/');
        }
        $exams = DB::table('tests')->where([['public_exam',1],['coach_id',$coaching->user_name]])->get();
        foreach ($exams as $exam){
            $exam->coachingName = $coaching->coachingName;
        }

        return view('profiles.index',compact('coaching','exams'));



    }
}
