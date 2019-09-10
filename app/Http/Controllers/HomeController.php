<?php

namespace App\Http\Controllers;



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Http\Request;
use Mail;

use Illuminate\Support\Facades\Storage;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use Illuminate\Support\Facades\Validator;
use App\Test;
use App\User;
use Auth;
use DateTime;
use DateTimeZone;
use App\Question;
use App\Student;
use DB;
use File;

use Response;
use function Sodium\compare;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

// Trims an image then optionally adds padding around it.
// $im  = Image link resource
// $bgcol  = The background color to trim from the image (using imagecolorallocate in gd)
// $pad = Amount of padding to add to the trimmed image
//        (acts similar to the "padding" CSS property: "top [right [bottom [left]]]")
    function imagetrim($im, $bgcol, $pad = null)
    {

        // Calculate padding for each side.
        if (isset($pad)) {
            $pada = explode(' ', $pad);
            if (isset($pada[3])) {
                $p = array((int)$pada[0], (int)$pada[1], (int)$pada[2], (int)$pada[3]);
            } else if (isset($pada[2])) {
                $p = array((int)$pada[0], (int)$pada[1], (int)$pada[2], (int)$pada[1]);
            } else if (isset($pada[1])) {
                $p = array((int)$pada[0], (int)$pada[1], (int)$pada[0], (int)$pada[1]);
            } else {
                $p = array_fill(0, 4, (int)$pada[0]);
            }
        } else {
            $p = array_fill(0, 4, 0);
        }
        $im = imagecreatefromJPEG($im);
        // Get the width and height of the image.
        $imw = imagesx($im);
        $imh = imagesy($im);

        // Set the X variables.
        $xmin = $imw;
        $xmax = 0;

        // find the endges.
        for ($iy = 0; $iy < $imh; $iy++) {
            $first = true;
            for ($ix = 0; $ix < $imw; $ix++) {
                $ndx = imagecolorat($im, $ix, $iy);
                if ($ndx != $bgcol) {
                    if ($xmin > $ix) {
                        $xmin = $ix;
                    }
                    if ($xmax < $ix) {
                        $xmax = $ix;
                    }
                    if (!isset($ymin)) {
                        $ymin = $iy;
                    }
                    $ymax = $iy;
                    if ($first) {
                        $ix = $xmax;
                        $first = false;
                    }
                }
            }
        }

        // The new width and height of the image. (not including padding)
        $imw = 1 + $xmax - $xmin; // Image width in pixels
        $imh = 1 + $ymax - $ymin; // Image height in pixels

        // Make another image to place the trimmed version in.
        $im2 = imagecreatetruecolor($imw + $p[1] + $p[3], $imh + $p[0] + $p[2]);

        // Make the background of the new image the same as the background of the old one.
        $bgcol2 = imagecolorallocate($im2, ($bgcol >> 16) & 0xFF, ($bgcol >> 8) & 0xFF, $bgcol & 0xFF);
        imagefill($im2, 0, 0, $bgcol2);

        // Copy it over to the new image.
        imagecopy($im2, $im, $p[3], $p[0], $xmin, $ymin, $imw, $imh);

        // To finish up, return the new image.
        return $im2;
    }

    public function count_students()
    {
        $t = DB::table('master_students')->where([['status', 0], ['coaching', Auth::user()->user_name]])->get();
        $n = sizeof($t);


        return ($n - 5);
    }

    public function aier($r, $d)
    {

        if ($r < 38) {
            return "13k+";
        }

        if ($d == 1) {
            $b = -6.373;
            $a = 99.273;
        } elseif ($d == 2) {
            $b = -7.075;
            $a = 108.52;
        } elseif ($d == 3) {
            $b = -6.529;
            $a = 106.08;
        } elseif ($d == 4) {
            $b = -7.785;
            $a = 105.9;
        } else {
            $b = -7.155;
            $a = 101.12;
        }

        $aki = exp(($r - $a) / $b);
        return $aki;

    }

    public function index()
    {
        return view('home');
    }


    public function dashboard()
    {
        $test = Test::where([['coach_id', Auth::user()->user_name], ['public_exam', 0]])->get();
        $exam = Test::where([['coach_id', Auth::user()->user_name], ['public_exam', 1]])->get();
        $noss = $this->count_students();
        return view('/admin_views/dashboard', compact('test', 'noss', 'exam'));
    }

    public function show()
    {
        $batches = Student::where('coaching_id', Auth::user()->user_name)->get();
        return view('/admin_views/create_test', compact('batches'));
    }


    public function update_test($test_id)
    {
        $batches = Student::where('coaching_id', Auth::user()->user_name)->get();
        $testk = Test::find($test_id);
        if ($testk->public_exam == 1) {
            return view('/admin_views/error')->with('msg', 'Cannot Update public exam');
        }
        if ($testk == null) {
            return view('admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }
        if ($testk->coach_id != Auth::user()->user_name) {
            return view('admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }
        $date = new DateTime($testk->livetime, new DateTimeZone('Asia/Kolkata'));
        $pre = $date->getTimestamp();
        $teler = $pre - time();
        if ($teler < 0) {
            return view('admin_views/error')->with('msg', 'Cannot update Exams after once exam have started ...');
        }
        return view('admin_views/update_test', compact('testk', 'batches'));

    }

    public function see($test_id)
    {

        $testk = Test::find($test_id);
        if ($testk == null) {
            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }
        $new = null;

        if ($testk->coach_id == Auth::user()->user_name) {
            return view('/admin_views/see', compact('testk', 'new'));
        } else {
            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }

    }

    public function examResult($exam_code)
    {

//        $test = Test::where('coach_id',Auth::user()->user_name)->get();
        $exam = Test::where([['coach_id', Auth::user()->user_name], ['exam_code', $exam_code]])->first();

        $f = $exam->duration;
        $ex = $exam->time_live;
        $ex = (int)$ex*60;
        $f = (int)$f*60+$ex;
        $date = new DateTime($exam->livetime,new DateTimeZone('Asia/Kolkata'));
        $pre = $date->getTimestamp();
        $teler = $pre - time();
        //$c11 = '';
        //$c21 = "href=/admin_views/progress/{$testk->id}";
        if( $teler > 0 ){
            $k='Not Active';
            //$c='#ffff00';
        }
        elseif($teler>-1*$f && $teler < 0){
            $k = 'Active';
            //$c= '#00ff00';
        }
        if($teler< -1*$f){
           // $c ='#ff0000';
            $k='Over';
            //$c11 = "href=/admin_views/get_results/{$testk->exam_code}";
        }
        if ($k != 'Over') {return view('admin_views/error')->with('msg', 'Wait for the exam to finish to declare the results.
            Rank can be declared after 10 Minutes from end of the exam.'.$k);}


//        $exam_id = $exam->id;
        $results = DB::table('master_response')->where('examCode', $exam->id)->orderBy('result->totalM', 'DESC')->get();
        $exam->get_result = 1;
        $exam->save();
        $no = count($results);
//        return var_dump($results[0]->examRank);
        $qid = (int)substr($exam_code, 4) - 1000;
        $questions = Question::where('test_id', $qid)->get();
        $qno = array();
        $avg = array();

        foreach ($questions as $q) {
            if (($q['not_attempted'] + $q['correct_attempt'] + $q['false_attempt']) != 0) {
                $avg[] = ($q['left_time'] + $q['correct_time'] + $q['false_time']) / ($q['not_attempted'] + $q['correct_attempt'] + $q['false_attempt']);
                $qno[] = $q['question_number'];
            } else {
                $avg[] = 0;
                $qno[] = $q['question_number'];

            }
        }
        $i = 0;
        $k = 0;
//        $totalMarks = array_sum($results->)
        if ($exam->public_exam == 0) {
            if (empty($results[0]->examRank)) {
                //we do the rank distro function
                foreach ($results as $key => $result) {
//                $data = DB::table('master_response')->where([['username',$result->username],['examCode',$exam->id]])->first();
                    DB::table('master_response')->where([['username', $result->username], ['examCode', $exam->id]])->update(['examRank' => $key + 1]);
                    $p = ($no - $key) / $no;
                    $p = $p * 100;
                    DB::table('master_response')->where([['username', $result->username], ['examCode', $exam->id]])->update(['percentile' => $p]);
                    $k = $k + json_decode($result->result)->totalM;
                    $i = $i + 1;
//                $result->totalM

//                return var_dump($data);
                }
            }
        } else {
            if (!empty($results[0]->examRank)) {
                //we do the rank distro function
                foreach ($results as $key => $result) {
//                $data = DB::table('master_response')->where([['username',$result->username],['examCode',$exam->id]])->first();
                    DB::table('master_response')->where([['username', $result->username], ['examCode', $exam->id]])->update(['examRank' => $key + 1]);
                    $p = ($no - $key) / $no;
                    $p = $p * 100;
                    DB::table('master_response')->where([['username', $result->username], ['examCode', $exam->id]])->update(['percentile' => $p]);
                    $k = $k + json_decode($result->result)->totalM;
                    $i = $i + 1;
//                $result->totalM

//                return var_dump($data);
                }
            }
        }


        if ($i > 0) {
            $k11 = Test::find($qid);
            $k11->avg = $k / $i;
            $k11->save();
        }
//        return var_dump(json_decode($results[0]->result)->totalAttempt);
//        return view('/admin_views/detailed_student',compact('students','batch'));

//        return var_dump($results);
        $arr = array();
        $srr = array();
        foreach ($results as $t) {
            $arr[] = array_sum(explode(",", json_decode($t->result)->totalM));
            $srr[] = json_decode($t->result)->name;
        }
        $arr = implode(',', $arr);
        $srr = implode(',', $srr);
        $qno = implode(',', $qno);
        $avg = implode(',', $avg);

        return view('/admin_views/detailed_result', compact('results', 'exam_code', 'arr', 'srr', 'qno', 'avg'));

//        return view('',compact());
//        return var_dump($results);
    }


    public function seepdf($test_id)
    {
        $testk1 = Test::find($test_id);
        if ($testk1 == null) {
            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }
        if ($testk1->coach_id != Auth::user()->user_name) {

            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }
        $file = 'files/' . Test::find($test_id)->pdf . '.pdf';
        // $filename = '2017p1.pdf';
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($file);


        // $tt = $testk.'.pdf';
        // $pdf = '/files/'.$testk.'.pdf';
        // return $pdf;
        //  $filename = '2017p1.pdf';
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename="'.$tt.'"');
        // header('Content-Transfer-Encoding: binary');
        // header('Accept-Ranges: bytes');
        // @readfile($pdf);

    }

    public function seesolution($test_id)
    {
        $testk1 = Test::find($test_id);
        if ($testk1 == null) {
            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }
        if ($testk1->coach_id != Auth::user()->user_name) {

            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }
        if (Test::find($test_id)->solution == null) {
            return view('/admin_views/adminLog')->with('msg', 'Please upload solution PDF.');
        }
        $file = 'files/' . Test::find($test_id)->solution . '.pdf';
        // $filename = '2017p1.pdf';
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($file);


        // $tt = $testk.'.pdf';
        // $pdf = '/files/'.$testk.'.pdf';
        // return $pdf;
        //  $filename = '2017p1.pdf';
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename="'.$tt.'"');
        // header('Content-Transfer-Encoding: binary');
        // header('Accept-Ranges: bytes');
        // @readfile($pdf);

    }

    public function delete(Request $test)
    {

        $testk = Test::find($test['id']);
        if ($testk == null) {
            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }
        if ($testk->coach_id != Auth::user()->user_name) {
            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }

        $date = new DateTime($testk->livetime, new DateTimeZone('Asia/Kolkata'));
        $pre = $date->getTimestamp();
        $teler = $pre - time();
        $f = $testk->duration;
        $f = (int)$f * 3600;
        if ($testk->public_exam == 0) {
            if ($teler > -1 * $f && $teler < 0) {
                return view('/admin_views/error')->with('msg', 'Exam Running cannot delete ...');
            }
        }
        if (file_exists(public_path('files\\' . $testk->pdf . '.pdf'))) {
            unlink(public_path('files\\' . $testk->pdf . '.pdf'));
        }


        DB::table('tests')->where('id', '=', $test['id'])->delete();
        DB::table('questions')->where('test_id', '=', $test['id'])->delete();
        return redirect('/admin_views/see_all');

    }

    public function question_details($test_id)
    {

        $test = Question::where('test_id', $test_id)->get();
        $t = Test::find($test_id);
        if ($test == null) {
            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }
        if ($t == null) {
            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }
        if ($t->coach_id != Auth::user()->user_name) {
            return view('/admin_views/error')->with('msg', 'What you are looking for is not available at this moment ...');
        }

        return view('/admin_views/question_details')->with('test', $test);
    }

    public function see_all()
    {

        $test = Test::where([['coach_id', Auth::user()->user_name], ['public_exam', 0]])->get();
        $exam = Test::where([['coach_id', Auth::user()->user_name], ['public_exam', 1]])->get();


        return view('/admin_views/see_all', compact('test', 'exam'));
    }

    public function update(Request $request)
    {


        $request->validate([
            'test_name' => 'required',
            'pdf' => 'nullable|mimes:pdf',
            'excel' => 'nullable',
            'livetime' => 'required',
            'livedate' => 'required',
            'duration' => 'required|min:0',
            'student_tag' => 'required',
            'time_live' => 'required',
            'type' => 'required',
            'difficulty' => 'required',
            'max_marks' => 'required',


        ]);
        $c = implode(',', $request['student_tag']);
        $update = Test::find($request['id']);
        $update->test_name = $request['test_name'];
        $update->type = $request['type'];
        $update->livetime = $request['livedate'] . ' ' . $request['livetime'];
        $update->duration = $request['duration'];
        $update->tag = $c;
        $update->time_live = ((int)$request['time_live']) * 60;
        $update->max_marks = $request['max_marks'];
        $update->difficulty = $request['difficulty'];
        $rand = substr(md5(microtime()), rand(0, 26), 4);
        $i = (int)$request['id'] + 1000;
        $k = $i - 1000;
        $flag_error = 55;
        $excel = 0;
        $highestRow = 0;
        $highestColumnIndex = 0;
        if ($request['excel'] != null) {
            $excel = 1;
            $update->excel = 'excel' . $rand . $i;
            $xx = $request->file('excel');
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($xx);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();

            $highestColumnIndex = 7;
            $row = 0;
            $col = 0;
            $flag_error = 0;
            $cel = '0';

            for ($row = 2; $row <= $highestRow; ++$row) {
                for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                    $value[$col] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                }
                if (is_numeric($value[1]) == False) {
                    $flag_error = 4;
                    $cel = 'A';
                    $mkk = $row;
                    break;
                }
                if (is_numeric($value[2]) == False or $value[2] < 0 == True or $value[2] > 3 == True) {
                    $flag_error = 1;
                    $cel = 'B';
                    break;
                }
                if (in_array($value[3], array('P', 'C', 'M', 'L', 'E', 'O', 'l', 'e', 'o', 'B')) == False) {
                    $flag_error = 1;
                    $cel = 'C';
                    break;
                }

                if (is_numeric($value[6]) == False) {
                    $flag_error = 1;
                    $cel = 'F';
                    break;
                }
                if (is_numeric($value[7]) == False) {
                    $flag_error = 1;
                    $cel = 'G';
                    break;
                }

            }
        }


        if ($flag_error == 1) {


            return view('/admin_views/error')->with('msg', 'Error in reading  ' . $cel . $row . ' of your uploaded xlsx file.All updates are rejected !');
        } elseif ($flag_error == 4) {
            DB::table('questions')->where('test_id', '=', $k)->delete();
            for ($row = 2; $row < $mkk; ++$row) {
                for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                    $value1[$col] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                }

                Question::create([
                    'test_id' => $k,
                    'question_number' => $value1[1],
                    'question_type' => $value1[2],
                    'subject' => $value1[3],
                    'level' => $value1[4],
                    'correct_answer' => $value1[5],
                    'marks' => $value1[6],
                    'negative' => $value1[7],
                ]);

            }
            $row = $row - 2;
            if ($request['pdf'] != null) {

                $update->pdf = 'pdf' . $rand . $i;
                $request->file('pdf')->move(public_path() . '/files', $update->pdf . '.pdf');
            }
            if ($request['solution']) {
                $update->solution = 'solution' . $i;
                $request->file('solution')->move(public_path() . '/files', $update->solution . '.pdf');
            }
            $update->save();
            $tesid = $k;
            return view('/admin_views/adminLog')->with('msg', 'One test updated in database with number of question:' . $row);


        } elseif ($flag_error == 0) {
            DB::table('questions')->where('test_id', '=', $k)->delete();
            for ($row = 2; $row <= $highestRow; ++$row) {
                for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                    $value[$col] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                }

                Question::create([
                    'test_id' => $k,
                    'question_number' => $value[1],
                    'question_type' => $value[2],
                    'subject' => $value[3],
                    'level' => $value[4],
                    'correct_answer' => $value[5],
                    'marks' => $value[6],
                    'negative' => $value[7],
                ]);

            }
            $row = $row - 2;

            if ($request['pdf'] != null) {

                $update->pdf = 'pdf' . $rand . $i;
                $request->file('pdf')->move(public_path() . '/files', $update->pdf . '.pdf');
            }
            if ($request['solution']) {
                $update->solution = 'solution' . $i;
                $request->file('solution')->move(public_path() . '/files', $update->solution . '.pdf');
            }
            $update->save();
            return view('/admin_views/adminLog')->with('msg', 'One test updated in database with number of question:' . $row);
        } else {
            if ($request['pdf'] != null) {

                $update->pdf = 'pdf' . $rand . $i;
                $request->file('pdf')->move(public_path() . '/files', $update->pdf . '.pdf');
            }
            if ($request['solution']) {
                $update->solution = 'solution' . $i;
                $request->file('solution')->move(public_path() . '/files', $update->solution . '.pdf');
            }
            $update->save();
            return view('/admin_views/adminLog')->with('msg', 'One test updated in database');

        }

    }


    public function store(Request $request)
    {


        $request->validate([
            'test_name' => 'required',
            'pdf' => 'required|mimes:pdf',
            'excel' => 'required',
            'livetime' => 'required',
            'livedate' => 'required',
            'duration' => 'required|min:0',
            'student_tag' => 'required',
            'type' => 'required',
            'difficulty' => 'required',
            'max_marks' => 'required',
            'time_live' => 'required',
        ]);

        $c1 = implode(',', $request['student_tag']);
        $obj = Test::create([
            'test_name' => $request['test_name'],
            'pdf' => '',
            'excel' => '',
            'livetime' => $request['livedate'] . ' ' . $request['livetime'],
            'duration' => $request['duration'],
            'exam_code' => '',
            'coach_id' => Auth::user()->user_name,
            'solution_key' => 'null',
            'tag' => $c1,
            'type' => $request['type'],
            'difficulty' => $request['difficulty'],
            'max_marks' => $request['max_marks'],
            'time_live' => ((int)$request['time_live']) * 60,
        ]);
        $cel = '0';

        $rand = substr(md5(microtime()), rand(0, 26), 4);
        $randi = substr(md5(microtime()), rand(0, 26), 3);
        $k = $obj->id;
        $k = $k + 1000;
        settype($k, "string");
        $c = 'SMRT' . $k;
        $obj->exam_code = strtoupper($c);
        $obj->excel = 'excel' . $rand . $k;
        $obj->pdf = 'pdf' . $rand . $k;
        $obj->tag = $c1;

        if ($request['solution']) {
            $obj->solution = 'solution' . $k;
        }


        $xx = $request->file('excel');

        //reading excel
        $reader1 = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader1->setReadDataOnly(true);
        $spreadsheet = $reader1->load($xx);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        $highestColumnIndex = 7;
        $row = 0;
        $col = 0;
        $flag_error = 0;
        for ($row = 2; $row <= $highestRow; ++$row) {
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $value[$col] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
            if (is_numeric(trim($value[1])) == False) {
                $flag_error = 4;
                $cel = 'A';
                break;
            }
            if (is_numeric(trim($value[2])) == False or $value[2] < 0 == True or $value[2] > 3 == True) {
                $flag_error = 1;
                $cel = 'B';
                break;
            }

            if (in_array(trim($value[3]), array('P', 'C', 'M', 'L', 'E', 'O', 'l', 'e', 'o', 'B')) == False) {
                $flag_error = 1;
                $cel = 'C';
                break;
            }

            if (is_numeric(trim($value[6])) == False) {
                $flag_error = 1;
                $cel = 'F';
                break;
            }
            if (is_numeric(trim($value[7])) == False) {
                $flag_error = 1;
                $cel = 'G';
                break;
            }
            Question::create([
                'test_id' => $k - 1000,
                'question_number' => $value[1],
                'question_type' => $value[2],
                'subject' => $value[3],
                'level' => strtoupper($value[4]),
                'correct_answer' => $value[5],
                'marks' => $value[6],
                'negative' => $value[7],
            ]);

        }
        $k = $k - 1000;
        if ($flag_error == 4) {

            $request->file('pdf')->move(public_path() . '/files', $obj->pdf . '.pdf');
            if ($request['solution']) {
                $request->file('solution')->move(public_path() . '/files', $obj->solution . '.pdf');
            }
            $obj->save();
            $new = Question::where('test_id', $k)->count();
            //return $k;
            $tesid = $k;
            $testk = Test::find($obj->id);
            return view('/admin_views/see', compact('testk', 'new'));
            //  return view('/admin_views/adminLog')->with('msg','One test added to  database with number of question:' .$row);
        }
        if ($flag_error == 1) {

            DB::table('questions')->where('test_id', '=', $k)->delete();
            DB::table('tests')->where('id', '=', $k)->delete();
            return view('/admin_views/error')->with('msg', 'Error in reading  ' . $cel . $row . ' of your uploaded xlsx file');
        } else {
            $request->file('pdf')->move(public_path() . '/files', $obj->pdf . '.pdf');
            if ($request['solution']) {
                $request->file('solution')->move(public_path() . '/files', $obj->solution . '.pdf');
            }
            $obj->save();
            $testk = Test::find($obj->id);
            $new = Question::where('test_id', $k)->count();
            return view('/admin_views/see', compact('testk', 'new'));
            //    return view('/admin_views/adminLog')->with('msg','One test added to  database with number of question:' .($row-2));
        }
    }

    public function view_change_info()

    {
        // $val=null;
        $test = Test::where([['coach_id', Auth::user()->user_name], ['public_exam', 0]])->get();
        $noss = $this->count_students();
        return view('/admin_views/view_change_info', compact('test', 'noss'));
    }

    public function change_info(Request $updated_user)
    {

        $updated_user->validate([
            'name' => 'required',
            'email' => 'required',
            'coachingName' => 'required',
        ]);

        $user = Auth::user();
        if ($updated_user['logo']) {
            if (file_exists(public_path('logo\\' . Auth::user()->user_name . 'image.' . $updated_user['logo']->getClientOriginalExtension()))) {
                unlink(public_path('logo\\' . Auth::user()->user_name . 'image.' . $updated_user['logo']->getClientOriginalExtension()));
            }
            $updated_user->file('logo')->move(public_path() . '/logo', Auth::user()->user_name . 'image.' . $updated_user['logo']->getClientOriginalExtension());
            $user->logo = Auth::user()->user_name . 'image.' . $updated_user['logo']->getClientOriginalExtension();
        }
        $user->name = $updated_user['name'];
        $user->email = $updated_user['email'];
        $user->coachingName = $updated_user['coachingName'];
        $user->cdescription = $updated_user['cdescription'];

        $user->save();
        return redirect('/admin_views/view_change_info')->with('val', 'Information Updated Successfully');
    }

    public function add_students()
    {
//        $batch = Student::where('coaching_id',Auth::user()->user_name);
        $batches = Student::where('coaching_id', Auth::user()->user_name)->get();
        return view('/admin_views/add_students', compact('batches'));
    }

    public function added_student(Request $students)
    {
        $students->validate([
            'student_tag_1' => 'required',

            'student_excel' => 'required'
        ]);

        $xx = $students->file('student_excel');
        $reader1 = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader1->setReadDataOnly(true);
        $spreadsheet = $reader1->load($xx);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumnIndex = 3;
        $row = 0;
        $col = 0;
        $flag_error = 0;
        $k = 0;
        $count = 0;
        $error = 0;

        $sa = null;
        $sb = null;
        $sc = null;
        for ($row = 2; $row <= $highestRow; ++$row) {

            $sa[$row - 2] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $sb[$row - 2] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $sc[$row - 2] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

            if ($sa[$row - 2] == null) {
                break;
            }
//                echo $worksheet->getCellByColumnAndRow(1, $row)->getValue().'<br>'.$sa[$row-2].'<br>';

        }

//        $c = DB::table('students')->where([
//            ['student_tag', '=', $students['student_tag']],
//            ['coaching_id', '=', Auth::user()->user_name],
//        ]);
        $tt = implode(',', $sa);
//        return var_dump($tt);

        if ($this->count_students() + sizeof($sa) - 1 > Auth::user()->nos) {
            return 'Max Student limit exceeded';
        }
        if (sizeof($sa) == 0) {
            return 'Submission Failed';
        } else {
            $bbc = DB::table('students')->where([['student_tag', $students['student_tag_1']],
                ['coaching_id', Auth::user()->user_name]
            ])->get();
            if (count($bbc) == 0) {
                DB::table('students')->insert([
                    'coaching_id' => Auth::user()->user_name,
                    'roll_no' => ' ',
                    'student_tag' => $students['student_tag_1'],

                ]);
            }

            DB::table('students')->where([
                ['student_tag', '=', $students['student_tag_1']],
                ['coaching_id', '=', Auth::user()->user_name],
            ])->update(['roll_no' => $tt]);
            for ($count = 0; $count < sizeof($sa); $count = $count + 1) {
                $check = DB::table('master_students')->where([['coaching_rollno', $sa[$count]], ['coaching', Auth::user()->user_name]])->get();
                if (sizeof($check) == 0) {
                    try {
                        DB::table('master_students')->insert([
                            'coaching' => Auth::user()->user_name,
                            'class' => 'Not Updated',
                            'name' => $sb[$count],
                            'email' => $sc[$count],
                            'coaching_rollno' => $sa[$count],
                            'coaching_batch' => $students->student_tag_1,
                            'pass' => substr($sc[$count], 0, -10),
                            'phone' => '',
                            'dob' => '',
                            'username' => Auth::user()->user_key . '_' . $sa[$count],
                        ]);
                    } catch (\Illuminate\Database\QueryException $e) {
                        $error = $error + 1;
                    }
                    DB::table('master_students_record')->insert(
                        ['username' => Auth::user()->user_key . '_' . $sa[$count]],
                        ['email' => $sc[$count]]
                    );
                    $student = [];
                    $nae = $sb[$count];
                    $d = trim((string)$sc[$count]);
                    $student['email'] = $sc[$count];
                    # TODO: Check mail correctness
                    $student['unamee'] = Auth::user()->user_key . '_' . $sa[$count];
                    Mail::send('emails.register', ['student' => $student], function ($message) use ($d, $nae) {
                        $message->from('support@smrtbook.in', 'Support | SmrtBook.in');
                        $message->to($d, $nae);
                        $message->subject('Welcome to SmrtBook | Smrtbook.in');
                    });
                }
            }
        }

        return 'Submitted with ' . $error . ' errors in batch ' . $students['student_tag_1'];
    }


//added_students_update


    public function added_students_update(Request $students)
    {
//single student addition

        if (!$students->email) {
            $email = null;
        } else {
            $email = $students->email;
        }

        if ($this->count_students() + 1 > Auth::user()->nos) {
            return ('Limit of students exceeded');
        }
        $check = DB::table('master_students')->where([['coaching_rollno', $students->roll_nos], ['coaching', Auth::user()->user_name]])->first();
        if ($check == 0) {
            try {
                DB::table('master_students')->insert([
                    'coaching' => Auth::user()->user_name,
                    'username' => Auth::user()->user_key . '_' . $students->roll_nos,
                    'class' => 'Not Updated',
                    'name' => $students->name,
                    'email' => $email,
                    'pass' => substr($email, 0, -10),
                    'coaching_rollno' => $students->roll_nos,
                    'coaching_batch' => $students->student_tag,
                    'phone' => '',
                ]);
            } catch (\Illuminate\Database\QueryException $e) {


                return 'Form submit unsuccessful';

            }
            DB::table('master_students_record')->insert(
                ['username' => Auth::user()->user_key . '_' . $students->roll_nos]
            );
            $student = [];
//            $uname = Auth::user()->user_key . '_' . $students->roll_nos;
            //$pass = $email;
            $nae = $students->name;
            $student['email'] = $email;
            $student['unamee'] = Auth::user()->user_key . '_' . $students->roll_nos;
            Mail::send('emails.register', ['student' => $student], function ($message) use ($email, $nae) {
                $message->from('support@smrtbook.in', 'Support | SmrtBook.in');
                $message->to($email, $nae);
                $message->subject('Welcome to SmrtBook | Smrtbook.in');
            });
            return 'One Student Added';
        } else {
            return 'RollNo Already Exist';
        }
    }


    public function show_students()
    {


        $student = Student::where('coaching_id', Auth::user()->user_name)->get();
        return view('/admin_views/show_students')->with('student', $student);

    }

    public function delete_students()
    {
        $batches = Student::where('coaching_id', Auth::user()->user_name)->get();
        return view('/admin_views/delete_students', compact('batches'));

    }

    public function deleted_students(Request $delete_list)
    {

      $c =  DB::table('master_students')->where([
            ['coaching_batch', $delete_list['student_tag']],
            ['coaching', Auth::user()->user_name],
            ['coaching_rollno', $delete_list['roll']]
        ])->first();

        if ($c != null) {
            DB::table('master_students')->where([['id',$c->id]])->delete();
            return redirect('/admin_views/detailed_student/' . $delete_list['student_tag']);
        } else {
            return view('/admin_views/adminLog')->with('msg', 'Unsuccessful');
        }
    }

    public function add_batch()
    {
        $batches = Student::where('coaching_id', Auth::user()->user_name)->get();
//        return $batch[0]->student_tag;
        return view('/admin_views/add_batch', compact('batches'));
    }

    public function added_batch(Request $request)
    {

        $request->validate([
            'student_tag' => 'required',]);
        $k = str_replace(',', ' ', $request['student_tag']);
        $bb = DB::table('students')->where([
            ['student_tag', '=', $k],
            ['coaching_id', '=', Auth::user()->user_name]
        ])->get();

        if (count($bb) > 0) {
            return 'Batch Already exist';
        }
        Student::create([
            'coaching_id' => Auth::user()->user_name,
            'student_tag' => $k,
        ]);
        return 'Batch Added Successfully';
    }

    public function detailed_student($batch)
    {
//        $student = Student::where([
//            ['coaching_id','=',Auth::user()->user_name],
//            ['student_tag','=',$batch]])->first();
//
//        $roll_list = explode(',',$student['roll_no']);
////     return $students;
//        $students= [];
//        foreach ($roll_list as $key=>$roll_no){
//            $info= DB::table('master_students')
//                ->where([['coaching',Auth::user()->user_name],['coaching_batch',$batch],['coaching_rollno',$roll_no]])
//                ->first();
//
//            if (!empty($info)) {
////             echo $info->username;
//                $students[$key] = ['name'=>$info->name,'username'=>$info->username,'roll_no'=>$roll_no];
////             $students[$key]->name = $info->name;
////             $students[$key]->resultCode = $info->username;
//            }
//            else $students[$key] = ['roll_no'=>$roll_no];
//
//        }

        $students = DB::table('master_students')->where([['coaching', Auth::user()->user_name], ['coaching_batch', $batch]])->get();
//     foreach ($students as $st){
//         if (!empty($st['name'])) echo $st['name'];
//         echo $st['roll_no'].'<br>';
//     }
//     return $students;
        return view('/admin_views/detailed_student', compact('students', 'batch'));

    }


    public function download_result($exam_code)
    {
        $exam = Test::where([['coach_id', Auth::user()->user_name], ['exam_code', $exam_code]])->first();

        $results = DB::table('master_response')->where('examCode', $exam->id)->orderBy('result->totalMarks', 'DESC')->get();
        $arrayData = [['Name', 'Roll No', 'Batch', 'Total Attempt', 'Total Correct', 'Total Marks', 'Student Rank']];
        foreach ($results as $result) {
            array_push($arrayData, [json_decode($result->result)->name,
                json_decode($result->result)->roll_no,
                json_decode($result->result)->batch,
                array_sum(explode(",", json_decode($result->result)->totalQ)) - array_sum(explode(",", json_decode($result->result)->totalNotAttempted)),
                array_sum(explode(",", json_decode($result->result)->totalCorrect)) + 0,
                array_sum(explode(",", json_decode($result->result)->totalMarks)),
                $result->examRank,
            ]);
        }


        $spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/

        $Excel_writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $spreadsheet->setActiveSheetIndex(0);

        $activeSheet = $spreadsheet->getActiveSheet();

        $activeSheet->getStyle("A1:G1")->getFont()->setBold(true);

        $activeSheet->fromArray($arrayData, NULL, 'A1');

        if (file_exists(public_path('files\\file.xlsx'))) {
            unlink(public_path('files\\files.xlsx'));
        }
        $Excel_writer->save(public_path('files/file.xlsx'));


        return Response::download(public_path('files/file.xlsx'), 'file.xlsx');


    }

    public function notification($st_tg)
    {


        $notif = DB::table('master_notification')->where([['coaching_code', Auth::user()->user_name], ['batch_name', $st_tg]])->get();

        $st_id = $st_tg;

        return view('admin_views/notification', compact('notif', 'st_id'));
    }


    public function add_notification(Request $request)
    {
        if ($request->message == null) {
            return back();
        }
        $time = time();
        DB::table('master_notification')->insert([
            ['batch_name' => $request->st_id, 'coaching_name' => Auth::user()->coachingName, 'coaching_code' => Auth::user()->user_name, 'message' => $request->message, 'time' => $time]
        ]);
        $c  = DB::table('master_students')->where([['coaching', Auth::user()->username], ['coaching_batch', $request->st_id]])->get();
//        foreach ($c as $cc) {
//            $student['msg'] = $request['message'];
//            $d = $c->email;
//            $nae = $c->name;
//            Mail::send('emails.notification', ['student' => $student], function ($message) use ($d, $nae) {
//                $message->from('support@smrtbook.in', 'Support | SmrtBook.in');
//                $message->to($d, $nae);
//                $message->subject('Welcome to SmrtBook | Smrtbook.in');
//            });
//        }
        return back();


    }

    public function delete_notif(Request $request)
    {
        DB::table('master_notification')->where('id', '=', $request->iid)->delete();
        return back();
    }

    public function charts()
    {
        $a = ['Aman', 'Abhinav', 'ada'];
        $a = implode(',', $a);
        return view('htmls/charts', compact('a'));
    }

    public function rule_book()
    {
        return view('/admin_views/rule_book');
    }

    public function fetch_student($student)
    {
        $st = DB::table('master_students')->where([['username', $student]])->first();

        if ($st->coaching != Auth::user()->user_name) {
            return view("admin_views/error")->with('msg', 'Sorry ,What you are looking for cannot be found');
        }
        $roll = $st->coaching_rollno;
        $exams = DB::table('tests')->where('coach_id', Auth::user()->user_name)->get();
        $records = '';
        $finalRecords = [];
        $finalRecords['sections'] = ['P' => 'Physics', 'C' => 'Chemistry', 'M' => 'Maths', 'B' => 'Biology', 'E' => 'English', 'L' => 'Logic Reasoning', 'O' => 'Other'];

        foreach ($exams as $key => $exam) {
            $responseData = DB::table('master_response')->where([['username', $student], ['examCode', $exam->id]])->first();
            $topperData = DB::table('master_response')->where('examCode', $exam->id)->orderBy('result->totalM', 'DESC')->first();
            if (!empty($topperData)) {
                $dataNames[] = $exam->exam_code;
                $dataTop[] = substr(json_decode($topperData->result)->totalM * 100 / $exam->max_marks, 0, 5);
                $dataAvg[] = substr($exam->avg * 100 / ($exam->max_marks), 0, 5);//this will be available in the $exam itself vut later

                if (empty($responseData)) {
                    $exam->ifAttempted = false;
                    $dataMe[] = 0;
                } else {
                    $performanceData = $responseData->result;
                    $dataSet = explode(',', json_decode($performanceData)->sections);

                    foreach ($dataSet as $key => $dataKey) {
                        if (!isset($records->totalQ[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)])) {
                            $records->totalQ[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->totalQ)[$key];
                            $records->totalAttempted[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->totalQ)[$key] - explode(',', json_decode($performanceData)->totalNotAttempted)[$key];
                            $records->totalCorrect[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->totalCorrect)[$key];
                            $records->totalMarks[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->totalMarks)[$key];
                            $records->examMarks[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->examMarks)[$key];
                            $records->totalTime[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->totalTime)[$key];
                        } else {
                            $records->totalQ[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->totalQ)[$key];
                            $records->totalAttempted[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->totalQ)[$key] - explode(',', json_decode($performanceData)->totalNotAttempted)[$key];
                            $records->totalCorrect[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->totalCorrect)[$key];
                            $records->totalMarks[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->totalMarks)[$key];
                            $records->examMarks[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->examMarks)[$key];
                            $records->totalTime[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->totalTime)[$key];
                        }
                    }
                    $exam->result = json_decode($responseData->result);
                    $sunMarks = array_sum(explode(",", $exam->result->totalMarks));
                    $dataMe[] = substr($sunMarks * 100 / ($exam->max_marks), 0, 5);
                }
            } else {
                if (empty($responseData)) {
                    $exam->ifAttempted = false;
                } else {
                    $exam->ifAttempted = true;
                }
            }
        }

//        return var_dump($records);
        if ($records == NULL) {
            return 'No exams attempted till now';
        }
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

//            $piData[$subject] = json_encode($piData[$subject]);
            //            return $loopData;
        }


//        $records = (array)($records);
//        return array_sum($records['totalQ']['P']);
//        foreach ($records as $kzt => $record){
//            return var_dump();
//            kzt are totalQ, totalcorrect and all
//            echo $kzt.'<br>';

//            foreach ((array)$record as $oneKey=>$rec){
//                foreach ((array)$rec as $qT=>$ques){
//                    $t = $record[$oneKey][0];
//                    $ttt = 6;
//                    $ttt = array_sum($record[$oneKey]);
//                        $piSets[$kzt][$oneKey][$qT] = ['value'=>round($t/$ttt),
//                            'name'=>$infoSet[$qT].' '.$record[$oneKey][$qT],
//                            'itemStyle'=>$itemStyle[$qT]
//                        ];
//
//                }
//            }
//        }


//        $public_exams = DB::table('master_response')->where([['username',session('username')], ['owner','!=',$data->coaching]])
//            ->get();
//
//        foreach ($public_exams as $key=>$public_exam){
//            $examInfo = DB::table('tests')->where('id',$public_exam->examCode)->first();
//            $public_exam->test_name = $examInfo->test_name;
//            $public_exam->exam_code = $examInfo->exam_code;
//            $public_exam->duration = $examInfo->duration;
//            $public_exam->livetime = $examInfo->livetime;
//            $public_exam->result = json_decode($public_exam->result);
//        }
//        return $piData;

        $gData = ['dataNames' => json_encode($dataNames), 'dataMe' => json_encode($dataMe), 'dataAvg' => json_encode($dataAvg),
            'dataTop' => json_encode($dataTop)];

        return view('admin_views/fetch_student', compact('roll', 'data', 'exams', 'public_exams', 'gData', 'records', 'infoSet', 'piData'));
        // return view('/admin_views/fetch_student',compact('gData','roll'));

    }

    public function delete_one(Request $r)
    {

        $r->validate([
            'student_tag' => 'required',
            'roll' => 'required',
        ]);


        $st = DB::table('students')->where([['student_tag', $r->student_tag], ['coaching_id', Auth::user()->user_name]])->first();

        $k = str_replace(',' . $r->roll, '', ',' . $st->roll_no);
        if (substr($k, 0, 1) == ',') {
            $k = substr($k, 1);
        }
        DB::table('students')
            ->where('id', $st->id)
            ->update(['roll_no' => $k]);
        return redirect('/admin_views/show_students');
    }

    public function deleted_one(Request $r)
    {

        $r->validate([
            'student_tag' => 'required',
        ]);

        $cc = DB::table('students')->where([['id', $r->student_tag]])->first();
        if ($cc->coaching_id != Auth::user()->user_name) {
            return view('admin_views/error')->with('msg', 'Sorry , what you are looking for isn\'t available');
        }
        DB::table('students')->where([['id', $r->student_tag]])->delete();
        $ttt = DB::table('master_students')->where([['coaching', Auth::user()->user_name], ['coaching_batch', $cc->student_tag]])->get();
        foreach ($ttt as $rrt) {
            DB::table('master_students')->where([['id', $rrt->id]])->delete();
        }

        return redirect('/admin_views/manage_students');
    }


    public function student_results($id)
    {

        //  if (session('username')==NULL) return redirect('/student/login')->with('status', 'Session Expired, Please Login again');

//        $coaching = DB::table('users')->where('user_name',$data->coaching)->first();
//        $data->coachingName = $coaching->coachingName;
////        create a session for that exam ...
//        $examCode = substr($id,4) - 1000;

        $examData = DB::table('master_response')->where([['id', $id]])->first();
        $examCode = $examData->examCode;
        if ($examData->owner != Auth::user()->user_name) {
            return view('/admin_views/error')->with('msg', 'What you are looking for isn\'t awailable');
        }
        $data = DB::table('master_students')->where('username', $examData->username)->first();
        $topData = DB::table('master_response')->where('examCode', $examCode)->orderBy('result->totalM', 'DESC')->first();
//        return json_decode($examData->response);
        $timeData = json_decode($examData->response);
        $topperData = json_decode($topData->response);
        $keys = '0';
        $times = '0';
        $correct = 0;
        $wrong = 0;

        $keysT = '0';
        $timesT = '0';
        $correctT = 0;

        $wrongT = 0;
        $performanceData = $examData->result;
        $dataSet = explode(',', json_decode($performanceData)->sections);
//        $records = '';
        foreach ($dataSet as $key => $dataKey) {
            if (!isset($records->totalQ[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)])) {
                $records->totalQ[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->totalQ)[$key];
                $records->totalAttempted[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->totalQ)[$key] - explode(',', json_decode($performanceData)->totalNotAttempted)[$key];
                $records->totalCorrect[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->totalCorrect)[$key];
                $records->totalMarks[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->totalMarks)[$key];
                $records->examMarks[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->examMarks)[$key];
                $records->totalTime[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] = explode(',', json_decode($performanceData)->totalTime)[$key];
            } else {
                $records->totalQ[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->totalQ)[$key];
                $records->totalAttempted[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->totalQ)[$key] - explode(',', json_decode($performanceData)->totalNotAttempted)[$key];
                $records->totalCorrect[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->totalCorrect)[$key];
                $records->totalMarks[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->totalMarks)[$key];
                $records->examMarks[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->examMarks)[$key];
                $records->totalTime[substr($dataKey, 0, 1)][substr($dataKey, 1, 1)] += explode(',', json_decode($performanceData)->totalTime)[$key];
            }
        }
        $sectionsInExam = explode(',', json_decode($examData->result)->sections);
//        return var_dump($sectionsInExam);
//        foreach ($timeData-> )
//        $props = [''];
        foreach ($sectionsInExam as $sectionInExam) {

            $noOfTotalQuestion[$sectionInExam[0]] = 0;
            $noOfCorrectQuestion[$sectionInExam[0]] = 0;
            $noOfNotAttemptedQuestion[$sectionInExam[0]] = 0;

            $timeOfTotalQuestion[$sectionInExam[0]] = 0;
            $timeOfCorrectQuestion[$sectionInExam[0]] = 0;
            $timeOfWrongQuestion[$sectionInExam[0]] = 0;
        }
//        return var_dump($noOfCorrectQuestion);
//            return $timeData;
//        $correctAns = ['P'=>0,'C'=>0,'M'=>0,'B'=>0];

        foreach ($timeData as $key => $time) {
            if ($key > 0) {
                $noOfTotalQuestion[($time->qType)[0]]++;
                $timeOfTotalQuestion[($time->qType)[0]] = $timeOfTotalQuestion[($time->qType)[0]] + $time->time;
                $keys = $keys . ',' . $key;
                $times = $times . ',' . $time->time;
                if ($time->correct == $time->answer) {
//                    $times = $times.','.$time->time;
                    $noOfCorrectQuestion[($time->qType)[0]]++;
                    $timeOfCorrectQuestion[($time->qType)[0]] = $timeOfCorrectQuestion[($time->qType)[0]] + $time->time;
//                    $correct++;
                } else {
                    if (empty($time->answer)) {
                        $noOfNotAttemptedQuestion[($time->qType)[0]]++;
                    } else {
                        $timeOfWrongQuestion[($time->qType)[0]] = $timeOfWrongQuestion[($time->qType)[0]] + $time->time;
                    }
//                    $times = $times.','.($time->time);
                }

            }
        }
        foreach ($topperData as $key => $time) {
            if ($key > 0) {
                $timesT = $timesT . ',' . ($time->time);
                $keysT = $keysT . ',' . $key;
                if ($time->correct == $time->answer) $correctT++;
                else $wrongT++;
            }
        }
//        return $timeData;
//        return var_dump(array_sum($noOfTotalQuestion )- array_sum($noOfNotAttemptedQuestion));

        $inExam = json_decode($examData->result);

//        return var_dump($inExam);
        $gData[] = ['times' => $times, 'keys' => $keys, 'correct' => $correct, 'wrong' => $wrong];
        $gData[] = ['times' => $timesT, 'keys' => $keysT, 'correct' => $correctT, 'wrong' => $wrongT];

        session(['question-paper' => $id]);

        $subT = ['P' => 'Physics', 'C' => 'Chemistry', 'M' => 'Maths', 'B' => 'Biology', 'E' => 'English', 'L' => 'Logic Reasoning', 'O' => 'Other'];
//        $ss[] = ['t'=>'','c'=>'','na'=>''];
//        $subject = [''];

        $sub = array_keys($noOfTotalQuestion);
        foreach ($sub as $s) {
            $subjects[] = $subT[$s];
            $subjectObs['marks'][$s] = 0;
            $subjectObs['time'][$s] = 0;
            $ss[$s] = [$noOfTotalQuestion[$s], $noOfCorrectQuestion[$s], $noOfTotalQuestion[$s] - $noOfCorrectQuestion[$s] - $noOfNotAttemptedQuestion[$s]];
            $ssTime[$s] = [$timeOfCorrectQuestion[$s], $timeOfWrongQuestion[$s], $timeOfTotalQuestion[$s]];

            //            $timeOfCorrectQuestion[$sectionInExam[0]] = 0;
//            $timeOfWrongQuestion[$sectionInExam[0]] = 0;

        }

        $sectionsList = explode(',', $inExam->sections);
        foreach ($sectionsList as $key => $section) {
            $subjectObs['marks'][$section[0]] = $subjectObs['marks'][$section[0]] + explode(',', $inExam->totalMarks)[$key];
            $subjectObs['time'][$section[0]] = $subjectObs['time'][$section[0]] + explode(',', $inExam->totalTime)[$key];
        }
//        return $subjectObs['marks'];

        $examName = DB::table('tests')->where('id', $examData->examCode)->first();
//        return var_dump($examData);
        $inExam->examName = $examName->test_name;
        $inExam->examDate = $examData->created_at;
//        return var_dump(array_sum($records->examMarks['P']));
        return view('/admin_views/student_results', compact('data', 'inExam', 'gData', 'subjects', 'ss', 'ssTime', 'subjectObs', 'records'));

    }


    public function easylrn_xx($id)
    {

        $sections = [];
        $sec = [];
        $exam = DB::table('tests')->where('exam_code', $id)->first();
        if ($exam == null) {
            return view('admin_views/error')->with('msg', 'Sorry,what you are looking for is not available');
        }
        if ($exam->coach_id != Auth::user()->user_name) {
            return view('admin_views/error')->with('msg', 'Sorry,what you are looking for is not available');
        }
        $questions = DB::table('questions')->where([['test_id', $exam->id]])->get();

        if ($questions == null) {
            return view('/admin_views/error')->with('msg', 'Question not uploaded properly');
        }
//            return var_dump($questions);
//            $current = '';
        $previous = 'X';

        $c = 1;
        $tt = array('P' => 'PHY SEC', 'C' => 'CHEM SEC', 'M' => 'MATH SEC', 'B' => 'BIO SEC', 'E' => 'English', 'L' => 'Logic Reasoning', 'O' => 'Other');
//            $qType = array('P0'=>'PHY SEC1','P1'=>'PHY SEC2','P2'=>'PHY SEC3','C0'=>'CHEM SEC1','C1'=>'CHEM SEC2','C2'=>'CHEM SEC3','M0'=>'MATH SEC1','M1'=>'MATH SEC2','M2'=>'MATH SEC3');
        foreach ($questions as $key => $question) {
            $current = $question->subject . $question->question_type;
            if ($current == $previous) {
            } else {
                if ($previous[0] == $current[0]) {
                    $c++;
                } else $c = 1;
                $previous = $current;
//                    $types[$question->subject.$c] = $tt[$question->subject].$c;
            }
            $sec[$question->subject . $c][] = $question;
//                $sec[$question->subject.$question->question_type][] = $question;
        }
        foreach ($sec as $key => $section) {
            $sections[] = [$key, $tt[$key[0]] . $key[1]];
        }
        $firstQ[] = array();
        foreach ($sections as $key => $section) {
            $firstQ[$key] = $sec[$section[0]][0]->question_number;
        }

        return view('vue.design_demo', ['exam' => $exam, 'sections' => $sections, 'sec' => $sec, 'firstQ' => $firstQ]);
    }

    public function merge()
    {

        $exam = DB::table('tests')->where([['coach_id', Auth::user()->user_name], ['get_result', 1]])->get();


        return view('/admin_views/merge', compact('exam'));
    }

    public function make_merge(Request $request)
    {

        $exam_one = $request['one'];

        $exam_two = $request['two'];

        if ($exam_one == $exam_two) {
            return back();
        }
        $arr = array();

        $result_1 = DB::table('master_response')->where('examCode', $exam_one)->orderBy('result->totalM', 'DESC')->get();
        $result_2 = DB::table('master_response')->where('examCode', $exam_two)->orderBy('result->totalM', 'DESC')->get();
        foreach ($result_1 as $r) {

            $arr[$r->username]->total = array_sum(explode(",", json_decode($r->result)->totalM));
        }
        foreach ($result_2 as $r) {
            if ($arr[$r->username]) {

                $arr[$r->username]->total = $arr[$r->username]->total + array_sum(explode(",", json_decode($r->result)->totalM));
            } else {

                $arr[$r->username]->total = array_sum(explode(",", json_decode($r->result)->totalM));
            }
        }
        return var_dump($arr);
        return view('/admin_views/merge_result', compact('arr'));
    }

    public function show_public()
    {
        return view('/admin_views/public_exam');
    }

    public function store_public(Request $request)
    {
        $new = null;

        $request->validate([
            'test_name' => 'required',
            'pdf' => 'required|mimes:pdf',
            'excel' => 'required',
            'livetime' => 'required',

            'duration' => 'required|min:0',

            'type' => 'required',
            'difficulty' => 'required',
            'max_marks' => 'required',
            'topic' => 'required',
        ]);
        $c13 = str_replace(',', '', $request['topic']);
        $c1 = null;
        $obj = Test::create([
            'test_name' => $request['test_name'],
            'pdf' => '',
            'excel' => '',
            'livetime' => $request['livetime'],
            'duration' => $request['duration'],
            'exam_code' => '',
            'coach_id' => Auth::user()->user_name,
            'solution_key' => 'null',

            'tag' => 'Public Exam',
            'type' => $request['type'],
            'difficulty' => $request['difficulty'],
            'max_marks' => $request['max_marks'],
            'topics' => $c13,
            'public_exam' => 1,
        ]);
        $cel = '0';

        $rand = substr(md5(microtime()), rand(0, 26), 4);
        $randi = substr(md5(microtime()), rand(0, 26), 3);
        $k = $obj->id;
        $k = $k + 1000;
        settype($k, "string");
        $c = 'SMRT' . $k;
        $obj->exam_code = strtoupper($c);
        $obj->excel = 'excel' . $rand . $k;
        $obj->pdf = 'pdf' . $rand . $k;
        $obj->tag = $c1;
        if ($request['solution']) {
            $obj->solution = 'solution' . $k;
        }


        $xx = $request->file('excel');

        //reading excel
        $reader1 = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader1->setReadDataOnly(true);
        $spreadsheet = $reader1->load($xx);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        $highestColumnIndex = 7;
        $row = 0;
        $col = 0;
        $flag_error = 0;
        for ($row = 2; $row <= $highestRow; ++$row) {
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $value[$col] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
            if (is_numeric($value[1]) == False) {
                $flag_error = 4;
                $cel = 'A';
                break;
            }
            if (is_numeric($value[2]) == False or $value[2] < 0 == True or $value[2] > 3 == True) {
                $flag_error = 1;
                $cel = 'B';
                break;
            }
            if (in_array($value[3], array('P', 'C', 'M', 'L', 'E', 'O', 'l', 'e', 'o', 'B')) == False) {
                $flag_error = 1;
                $cel = 'C';
                break;
            }


            if (is_numeric($value[6]) == False) {
                $flag_error = 1;
                $cel = 'F';
                break;
            }
            if (is_numeric($value[7]) == False) {
                $flag_error = 1;
                $cel = 'G';
                break;
            }
            Question::create([
                'test_id' => $k - 1000,
                'question_number' => $value[1],
                'question_type' => $value[2],
                'subject' => $value[3],
                'level' => $value[4],
                'correct_answer' => $value[5],
                'marks' => $value[6],
                'negative' => $value[7],
            ]);

        }
        $k = $k - 1000;
        if ($flag_error == 4) {

            $request->file('pdf')->move(public_path() . '/files', $obj->pdf . '.pdf');
            if ($request['solution']) {
                $request->file('solution')->move(public_path() . '/files', $obj->solution . '.pdf');
            }
            $obj->save();
            $new = Question::where('test_id', $k)->count();
            //return $k;
            $tesid = $k;
            $testk = Test::find($obj->id);
            return view('/admin_views/see', compact('testk', 'new'));
            //  return view('/admin_views/adminLog')->with('msg','One test added to  database with number of question:' .$row);
        }
        if ($flag_error == 1) {

            DB::table('questions')->where('test_id', '=', $k)->delete();
            DB::table('tests')->where('id', '=', $k)->delete();
            return view('/admin_views/error')->with('msg', 'Error in reading  ' . $cel . $row . ' of your uploaded xlsx file');
        } else {
            $request->file('pdf')->move(public_path() . '/files', $obj->pdf . '.pdf');
            if ($request['solution']) {
                $request->file('solution')->move(public_path() . '/files', $obj->solution . '.pdf');
            }
            $obj->save();
            $testk = Test::find($obj->id);
            return view('/admin_views/see', compact('testk', 'new'));
            //    return view('/admin_views/adminLog')->with('msg','One test added to  database with number of question:' .($row-2));
        }
    }

    public function smart_test()
    {
        return view('/admin_views/smrttest');
    }


    public function manage_students()
    {
        $count = null;
        $student = Student::where('coaching_id', Auth::user()->user_name)->get();
        foreach ($student as $d) {
            $count[$d->student_tag] = DB::table('master_students')->where([['coaching_batch', $d->student_tag], ['coaching', Auth::user()->user_name]])->count();
        }
        return view('/admin_views/manage_students', compact('student', 'count'));
    }


    public function get_results($exam_code)
    {
        $k = null;
        $exam = Test::where([['coach_id', Auth::user()->user_name], ['exam_code', $exam_code]])->first();

        //return var_dump($exam);

        $date = new DateTime($exam->livetime, new DateTimeZone('Asia/Kolkata'));

        $pre = $date->getTimestamp() + (($exam->duration+$exam->time_live )* 60) + 300;
        $teler = $pre - time();
        if ($teler > 0) return view('admin_views/error')->with('msg', 'Wait for the exam to finish to declare the results.
            Rank can be declared after 10 Minutes from end of the exam.');
        $position = 1;
        $average_marks = 0;
        $max_marks = 0;
        $bottom_marks = 100000;
        $top_marks = 0;

        $response = DB::table('master_response')->where('examCode', $exam->id)->orderBy('result->totalM', 'DESC')->get();
        if(sizeof($response)==null){
            $bottom_marks = 0;
        }
        //return var_dump($response);
        $total_students = sizeof($response);
        if ($exam->public_exam == 0) {
            foreach ($response as $r) {

                DB::table('master_response')->where([['id', $r->id]])->update(['examRank' => $position]);
                $p = ($total_students - $position + 1) * 100 / $total_students;
                DB::table('master_response')->where([['id', $r->id]])->update(['percentile' => $p]);
                $position += 1;

            }
            $exam->get_result = 1;
            $exam->save();
        }
        if ($exam->public_exam == 1) {
            foreach ($response as $r) {
                DB::table('master_response')->where([['id', $r->id]])->update(['examRank' => $position]);
                $p = ($total_students - $position + 1) * 100 / $total_students;
                DB::table('master_response')->where([['id', $r->id]])->update(['percentile' => $p]);
                $position += 1;
            }
        }
        $c = 1;

        foreach ($response as $r) {
            $average_marks = $average_marks + json_decode($r->result)->totalM;
            $c += 1;
            $tt = json_decode($r->result)->totalM;
            //  $bt = json_decode($r->result)->totalM;
            if ($tt > $top_marks) {
                $top_marks = $tt;
            }
            if ($bottom_marks > $tt) {
                $bottom_marks = $tt;
            }
        }
//         $cq = Question::where('test_id',44)->get();
//         foreach ($cq as $a){
//             $a->test_id=31;
//             $a->save();
//         }
        $average_marks = $average_marks / $c;
        $max_marks = $exam->max_marks;
        $qid = (int)substr($exam_code, 4) - 1000;
        $questions = Question::where('test_id', $qid)->get();

        //  return var_dump($questions);
        $qno = array();
        $avg = array();
        $total_correct = array();
        $total_incorrect = array();
        $total_not_attempted = array();
        $total_attempted = array();
        foreach ($questions as $q) {
            if (($q['not_attempted'] + $q['correct_attempt'] + $q['false_attempt']) != 0) {
                $avg[] = ($q['left_time'] + $q['correct_time'] + $q['false_time']) / ($q['not_attempted'] + $q['correct_attempt'] + $q['false_attempt']);
                $qno[] = $q['question_number'];
            } else {
                $avg[] = 0;
                $qno[] = $q['question_number'];

            }
            $total_correct[] = $q['correct_attempt'];
            $total_incorrect[] = $q['false_attempt'];
            $total_attempted[] = $q['correct_attempt'] + $q['false_attempt'];
            $total_not_attempted[] = $q['not_attempted'];
        }

        $arr = array();
        $srr = array();
        foreach ($response as $t) {
            $arr[] = array_sum(explode(",", json_decode($t->result)->totalM));
            $srr[] = json_decode($t->result)->name;
        }
        $arr = implode(',', $arr);
        $srr = implode(',', $srr);
        $qno = implode(',', $qno);
        $avg = implode(',', $avg);
        $tc = implode(',', $total_correct);
        $tic = implode(',', $total_incorrect);
        $ta = implode(',', $total_attempted);
        $tna = implode(',', $total_not_attempted);
        //I have ranks
        $question_details = array($tc, $tic, $ta, $tna);
        $test_details = array($max_marks, $top_marks, $bottom_marks, $average_marks);
        return view('/admin_views/get_results', compact('srr', 'arr', 'avg', 'qno', 'response', 'exam_code', 'test_details', 'exam', 'question_details'));

    }

    public function download_students($batch)
    {

        $arrayData = [['Name', 'Roll No','Email','Phone No.']];
        $results = DB::table('master_students')->where([['coaching', Auth::user()->user_name], ['coaching_batch', $batch]])->get();
        $d = 'N|A';
        foreach ($results as $result) {
            if($result->phone != null ){
                $d = $result->phone;
            }
            array_push($arrayData, [$result->name,
                $result->coaching_rollno,
                $result->email,
                $d,
            ]);
        }


        $spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/

        $Excel_writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $spreadsheet->setActiveSheetIndex(0);

        $activeSheet = $spreadsheet->getActiveSheet();

        $activeSheet->getStyle("A1:D1")->getFont()->setBold(true);

        $activeSheet->fromArray($arrayData, NULL, 'A1');

        if (file_exists(public_path('files\\xfile.xlsx'))) {
            unlink(public_path('files\\xfiles.xlsx'));
        }
        $Excel_writer->save(public_path('files/xfile.xlsx'));


        return Response::download(public_path('files/xfile.xlsx'), 'xfile.xlsx');

    }


    public function test_sel()
    {
        return view('/admin_views/test_view');
    }
//    public function test_l(Request $r){
//          	$myim = $r->fileToUpload;
//          	$k = $myim->getClientOriginalExtension();
//            $newImage = imagecreatefromJPEG($myim);
//        	$myim = $this->imagetrim($myim, imagecolorallocate($newImage, 0xFF, 0xFF, 0xFF), 0);
//	        //$myim now holds the new image which has had white trimmed and a padding of 10px around the image added.
//            if (file_exists(public_path('files\\xwimage.'.$k))) {
//            unlink(public_path('files\\xwimage.'.$k));
//        }
//
//        imagejpeg($myim)->save(public_path('files/xwimage.'.$k));
//
//
//        return Response::download(public_path('files/xwimage.'.$k), 'files/xwimage.'.$k);
//         //   return $myim;
//    }

    public function activate_student($id)
    {


        $c = DB::table('master_students')->where([['id', $id], ['coaching', Auth::user()->user_name]]);

        if ($this->count_students() + sizeof($c) - 1 > Auth::user()->nos) {
            return view('admin_views/adminLog')->with('msg', 'Limit of Student is exceeded');
        }
        DB::table('master_students')->where([['id', $id], ['coaching', Auth::user()->user_name]])->update(['status' => 0]);

        return back();
    }

    public function upload_question()
    {
        return view('/question_bank/upload_question');
    }

    public function process(Request $request)
    {
        $xx = $request->file('excel');

        //reading excel
        $reader1 = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader1->setReadDataOnly(true);
        $spreadsheet = $reader1->load($xx);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        $highestColumnIndex = 8;
        $folder = $request->file('folder');
        $data_c = [];
        $solution = $request->file('solution');
        $row = 0;
        $col = 0;
        $image_name = array();
        for ($row = 2; $row <= $highestRow; ++$row) {
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $value[$col] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            }


            $id = DB::table('master_questions')->insertGetId([
                'correct_marks' => $value[2],
                'negative_marks' => $value[3],
                'question_type' => $value[4],
                'subject' => $value[5],
                'level' => $value[6],
                'topic' => $value[7],
                'correct_answer' => $value[8]
            ]);
            $data_c[] = $id;
            $pn = md5(uniqid(rand(), true));
            $folder[$row - 2]->move(public_path() . '/question', $pn . '.' . $folder[$row - 2]->getClientOriginalExtension());
            $solution[$row - 2]->move(public_path() . '/solution', $pn . '.' . $folder[$row - 2]->getClientOriginalExtension());
            DB::table('master_questions')->where([['id', $id]])->update([
                'image_name' => $pn
            ]);

        }
        $details = [];
        foreach ($data_c as $qid) {
            $details[] = DB::table('master_questions')->where([['id', $qid]])->first();
        }
        return view('/admin_views/check', compact('details'));
    }


    public function performance()
    {

    }

    public function topic_add(Request $request)
    {
        $xx = $request->file('excel');

        //reading excel
        $reader1 = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader1->setReadDataOnly(true);
        $spreadsheet = $reader1->load($xx);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = 37;

        $highestColumnIndex = 2;
        $d=0;
        $row = 0;
        $col = 0;
        $topic = 'default';
        for ($row = 1; $row <= $highestRow; ++$row) {
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $value[$col] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
            if($value[1]!= ''){
                $topic = $value[1];
            }
            DB::table('subject_topics')->insert([
                'class' => 11,
                'subject' => 'Biology',
                'sub_topic'=> $value[2],
                'topic' => $topic,
            ]);
            $d=$d+1;
        }
        return $d;


    }
    public function topic(){
        return view('/admin_views/add_topic');
    }
    public function progress($test_id){
        $c =  DB::table('master_response')->where([['examCode',$test_id]])->get();
        $exam = DB::table('tests')->where([['id',$test_id]])->first();
        $data = array();
        foreach($c as $k ){
            $tt = DB::table('master_students')->where([['username',$k->username]])->first();
            if(!empty($tt)){
                $data[] = $tt;
            }

        }
        return view('/admin_views/progress',compact('data','exam'));
    }
}
