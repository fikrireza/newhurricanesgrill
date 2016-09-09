<?php namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

use Mail;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Models\User;
class AuthController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */
  use AuthenticatesAndRegistersUsers, ThrottlesLogins;
  /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
  //protected $redirectTo = '/';
  /**
   * Create a new authentication controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
  }
	/**
	 * Handle a login request to the application.
	 *
	 * @param  App\Http\Requests\LoginRequest  $request
	 * @param  Guard  $auth
	 * @return Response
	 */
	public function postLogin(LoginRequest $request, Guard $auth)
	{
    // dd($request);
		$logValue = $request->input('email');
    // dd($logValue);
		$logAccess = filter_var($logValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
    // dd($logAccess);
		$throttles = in_array(ThrottlesLogins::class, class_uses_recursive(get_class($this)));
    //dd($throttles);
		if ($throttles && $this->hasTooManyLoginAttempts($request))
		{
			return redirect('login')->with('error', trans('front/login.maxattempt'))->withInput($request->only('email'));
		}
    
		$credentials = [
			$logAccess  => $logValue,
			'password'  => $request->input('password')
		];

		if(!$auth->validate($credentials))
		{
			if ($throttles)
			{
			  $this->incrementLoginAttempts($request);
			}
			return redirect('login')->with('error', trans('front/login.credentials'))->withInput($request->only('email'));
		}

		$user = $auth->getLastAttempted();
		//dd($user->role->slug === 'admin');

		if($user->activated)
		{
			if ($throttles)
			{
				$this->clearLoginAttempts($request);
			}

			$auth->login($user, $request->has('memory'));
			if($request->session()->has('user_id'))
			{
				$request->session()->forget('user_id');
			}

			if($user->role->slug === 'admin')
			{
				$set = User::find(Auth::user()->id);
        $getcounter = $set->login_counter;
        $set->login_counter = $getcounter+1;
        $set->save();
				return redirect('admin/dashboard');
			}
			else if($user->role->slug === 'redac')
			{
				$set = User::find(Auth::user()->id);
        $getcounter = $set->login_counter;
        $set->login_counter = $getcounter+1;
        $set->save();
				return redirect('admin/dashboard');
			}
			else if($user->role->slug === 'user')
			{
				$set = User::find(Auth::user()->id);
        $getcounter = $set->login_counter;
        $set->login_counter = $getcounter+1;
        $set->save();
				return redirect('/');
			}
		}
		$request->session()->put('user_id', $user->id);
		return redirect('login')->with('error', trans('front/verify.again'));
	}
  /**
   * Form Registrasi
   *
   * @param App\Http\Requests\RegisterRequest $request
   * @return Response
   */
  public function postRegister(RegisterRequest $request)
  {
      $confirmation_code	= str_random(30).time();
  		$user = new User;
  		$user->name		= $request->name;
  		$user->email	=	$request->email;
  		$user->password	= bcrypt($request->password);
  		$user->role_id	= 3;
  		$user->activated	= 0;
  		$user->confirmation_code	= $confirmation_code;
  		$user->save();
  		$data	= [
  			'title'  => trans('front/verify.email-title'),
        'intro'  => trans('front/verify.email-intro'),
        'link'   => trans('front/verify.email-link'),
  			'name'	=> $request->name,
  			'confirmation_code' => $confirmation_code,
  			];
  		Mail::send('emails.auth.verify', $data, function($message){
  			$message->to(Input::get('email'), Input::get('name'))->subject('Aktivasi Akun Kitapunyaacara');
  		});
  		return redirect('/')->with('message', 'Silahkan Cek Folder Inbpx/Spam Pada Email Anda');
  }
  /**
   * Untuk Konfirmasi Request
   *
   * @param string $confirmation_code $token
   * @return Response
   */
  public function getConfirm($token)
  {
		$user = User::where('confirmation_code', $token)->first();
      if($user->role_id == "3")
      {
        $user->confirmation_code = null;
        $user->activated = 1;
        $user->save();
      }
			return redirect('/')->with('message', "Terimakasih, Akun Anda Telah di Verifikasi");
  }
  /**
	 * Handle a resend request.
	 *
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @param  Illuminate\Http\Request $request
	 * @return Response
	 */
	public function getResend(Request $request)
	{
		//Belum bisa resend email
		return redirect('/');
	}
}

/*
<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |


    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string

    protected $redirectTo = 'hurricanesmenu/dahsboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
