<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Models\User;
use App\Models\Branch;
use Mail;
use Hash;
use Auth;

class AccountManagementController extends Controller
{


  public function index()
  {
    $getBranch = Branch::get();
    $getUser  = User::join('fra_branch', 'fra_branch.id', '=', 'fra_users.branch_id')
                ->select('fra_users.*', 'fra_branch.name as branch_name')
                ->paginate(10);

    return view('back.pages.account.index', compact('getBranch', 'getUser'));
  }

  public function create(Request $request)
  {
    // dd($request);
    $activation_code = str_random(30).time();

    $message = [
      'level.required' => 'Fill This Field.',
      'level.not_in' => 'Fill This Field.',
      'branch_id.required' => 'Fill This Field.',
      'branch_id.not_in' => 'Fill This Field.',
      'email.required' => 'Fill This Field.',
      'email.email' => 'Email Format Not Valid.',
      'email.unique' => 'Email Has Been Resgistered.',
    ];

    $akses = "";
    if($request->level=="1") {
      $validator = Validator::make($request->all(), [
        'level' => 'required|not_in:-- Choose --',
        'email' => 'required|email|unique:fra_users,email',
      ], $message);

      if($validator->fails()) {
        return redirect()->route('account')->withErrors($validator)->withInput();
      }

      $akses = "Administrator";
      $user = new User;
      $user->email = $request->email;
      $user->level = $request->level;
      $user->activation_code = $activation_code;
      $user->flag_active = 0;
      $user->save();
    }
    else if($request->level=="2" || $request->level=="3" || $request->level=="4" || $request->level=="5") {
      $validator = Validator::make($request->all(), [
        'level' => 'required|not_in:-- Choose --',
        'branch_id' => 'required|not_in:-- Choose --',
        'email' => 'required|email|unique:fra_users,email',
      ], $message);

      if($validator->fails()) {
        return redirect()->route('account')->withErrors($validator)->withInput();
      }

        if($request->level == "2")
        {
          $akses = "Manager";
        }
        else if($request->level == "3")
        {
          $akses = "Reservation";
        }
        else if($request->level == "4")
        {
          $akses = "Reservation Admin";
        }
        else if($request->level == "5")
        {
          $akses = "Kitchen";
        }

      $user = new User;
      $user->email = $request->email;
      $user->level = $request->level;
      $user->branch_id = $request->branch_id;
      $user->activation_code = $activation_code;
      $user->flag_active = 0;
      $user->save();
    } else {
      $validator = Validator::make($request->all(), [
        'level' => 'required|not_in:-- Pilih --',
        'id_skpd' => 'required|not_in:-- Pilih --',
        'email' => 'required|email|unique:fra_users,email',
      ], $message);

      if($validator->fails()) {
        return redirect()->route('account')->withErrors($validator)->withInput();
      }
    }

    // SEND EMAIL
    if($akses!="")
    {
      $data = array([
        'akses' => $akses,
        'activation_code' => $activation_code,
        'email' => $request->email,
        ]);

        Mail::send('email.verifyuser', ['data' => $data], function($message) {
          $message->to(Input::get('email'), Input::get('email'))->subject('Activation Account Hurricanes System');
        });
    }

    return redirect()->route('account')->with('message', 'New Account Has Been Created and Email Activation Has Been Sent.');
  }

  public function verify($code)
  {
    $user = User::where('activation_code', $code)->first();
    if($user!="")
    {
      return view('auth.createpassword')->with('email', $user->email)->with('verifytoken', $code);
    }
    else {
      return redirect()->route('welcomepage')->with('messageactivationfailed', "Activation Code is not Valid.");
    }
  }

  public function setpassword(Request $request)
  {
    $message = [
      'name.required' => "Fill This Field",
      'password.required' => "Fill This Field.",
      'password.confirmed' => "Password Did Not Match.",
      'password_confirmation.required' => "Fill This Field.",
    ];

    $validator = Validator::make($request->all(), [
      'name'  => 'required',
      'password' => 'required|confirmed|min:8',
      'password_confirmation' => 'required',
    ], $message);

    if($validator->fails()) {
      return redirect()->route('account.verify', ['code' => $request->verifytoken])->withErrors($validator);
    }

    $user = User::where('email', $request->email)->first();
    $user->password = Hash::make($request->password);
    $user->name = $request->name;
    $user->activation_code = null;
    $user->flag_active = 1;
    $user->save();

    if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password, 'flag_active'=>1]))
    {
      $set = User::find(Auth::user()->id);
      $getcounter = $set->login_counter;
      $set->save();

      return redirect('dashboard')->with('firsttimelogin', "Anda telah berhasil melakukan aktifasi akun. Selanjutnya, anda bisa menggunakan akun ini untuk login ke dalam sistem dan dapat menggunakan fitur yang telah disediakan.");
    }
    else {
      return redirect()->route('welcomepage')->with('message', "Silahkan lakukan login.");
    }
  }

  public function disable($id)
  {
    $set = User::find($id);
    $set->flag_active = 0;
    $set->save();

    return redirect()->route('account')->with('message', 'The Account Has Been Disabled');
  }

  public function active($id)
  {
    $set = User::find($id);
    $set->flag_active = 1;
    $set->save();

    return redirect()->route('account')->with('message', 'The Account Has Been Activated');
  }

  public function bind($id)
  {
    $get  = User::find($id);
    return $get;
  }

  public function resend($id)
  {
    $activation_code = str_random(30).time();

    $resend = User::find($id);
    $resend->activation_code = $activation_code;
    $resend->save();

    if($resend->level == "2")
    {
      $akses = "Manager";
    }
    else if($resend->level == "3")
    {
      $akses = "Reservation";
    }
    else if($resend->level == "4")
    {
      $akses = "Reservation Admin";
    }
    else if($resend->level == "5")
    {
      $akses = "Kitchen";
    }

    $data = array([
      'akses' => $akses,
      'activation_code' => $activation_code,
      'email' => $resend->email,
      ]);

      Mail::send('email.verifyuser', ['data' => $data], function($message) use($data) {
        $message->to($data[0]['email'], $data[0]['email'])->subject('Activation Account Hurricanes System');
      });

    return redirect()->route('account')->with('message', 'Email Activation Has Been Sent to "'.$resend->email.'"');
  }

  public function update(Request $request)
  {
    $message = [
      'editLevel.required' => 'Fill This Field',
      'editBranch_id.required' => 'Fill This Field'
    ];

    $validator = Validator::make($request->all(), [
        'editLevel'     => 'required',
        'editBranch_id' => 'required'
      ], $message);

    if($validator->fails()) {
      return redirect()->route('account')->withErrors($validator);
    }

    $update = User::find($request->id);
    $update->level = $request->editLevel;
    $update->branch_id = $request->editBranch_id;
    $update->save();

    return redirect()->route('account')->with('message', 'Account Data Has Been Edited');
  }
}
