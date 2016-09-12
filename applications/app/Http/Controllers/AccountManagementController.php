<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Branch;
use Mail;

class AccountManagementController extends Controller
{


    public function index()
    {
      $getBranch = Branch::get();
      $getUser  = User::paginate(10);

      return view('back.pages.account.index', compact('getBranch', 'getUser'));
    }
}
