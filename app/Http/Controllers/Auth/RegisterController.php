<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Request;
use DB;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin_views/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'coachingName' => 'required|string|max:255',
            'user_name' => 'string|max:255',
            'phone' => 'string|size:10',
            'key' => 'required|regex:(aman12345678)',
            'location' => 'required',
            'user_key' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */


    protected function create(array $data)
    {
//        $ip = Request::ip();
//
//        $secretKey = '6Ldc1VwUAAAAAPM83lDIi9S6wJy8Q0ptZwJ4ztYr';
//        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$data['g-recaptcha']."&remoteip=".$ip);
//        $responseKeys = json_decode($response,true);
//        if(intval($responseKeys["success"]) != null) {
//          return view('welcome');
//        }

        $c = DB::table('users')->where([['user_key',$data['user_key']]])->count();
        if($c>0){
            return back();
        }

        function random_username($string,$id) {
            $k = 666+$id;
            settype($k, "string");
            $name = strtolower((str_replace(' ', '',$string)));
            return $name.$k;
        }

        $id =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'coachingName' => $data['coachingName'],
            'user_name' => '',
            'phone' => $data['phone'],
            'location' => $data['location'],
            'user_key' => $data['user_key'],
        ]);

        $i = $id->id;
        $u_name = $id->name;
        $id->user_name = random_username($u_name,$i);
        $d=trim($data['email']);
        $nae=$data['name'];
        $id->save();
        Mail::send('emails.register_coaching', [ ], function ($message) use ($d, $nae) {
            $message->from('support@smrtbook.in', 'Support | SmrtBook.in');
            $message->to($d, $nae);
            $message->subject('Welcome to SmrtBook | Smrtbook.in');
        });
        return $id;


    }
}
