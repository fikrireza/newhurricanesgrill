<?php namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

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

  public function index()
  {
    return view('back.login');
  }

	/**
	 * Handle a login request to the application.
	 *
	 * @param  App\Http\Requests\LoginRequest  $request
	 * @param  Guard  $auth
	 * @return Response
	 */
	public function postLogin(Request $request, Guard $auth)
	{
    $message = [
      'email.required' => 'Fill This Field',
      'password.required' => 'Fill This Field'
    ];

    $validator = Validator::make($request->all(), [
      'email' => 'required',
      'password' => 'required|min:8',
    ], $message);

    if($validator->fails()) {
      return redirect()->route('index')->withErrors($validator)->withInput();
    }

		$logValue = $request->input('email');

		$logAccess = filter_var($logValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

		$throttles = in_array(ThrottlesLogins::class, class_uses_recursive(get_class($this)));

		if ($throttles && $this->hasTooManyLoginAttempts($request))
		{
			return redirect()->route('index')->with('error', 'You have reached the maximum number of login attempts. Try again in one minute.')->withInput($request->only('email'));
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
			return redirect()->route('index')->with('error', 'These credentials do not match our records.')->withInput($request->only('email'));
		}

		$user = $auth->getLastAttempted();

		if($user->flag_active)
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

			// $set = User::find(Auth::user()->id);
      // $getcounter = $set->login_counter;
      // $set->login_counter = $getcounter+1;
      // $set->save();
			return redirect()->route('dashboard');
		}

		$request->session()->put('user_id', $user->id);

    return redirect()->route('index');
	}

  public function getLogout()
    {
      session()->flush();
      Auth::logout();
      return redirect()->route('index');
    }

}
