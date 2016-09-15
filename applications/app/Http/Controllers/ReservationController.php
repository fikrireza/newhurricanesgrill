<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Models\User;
use App\Models\Branch;
use App\Models\Reservation;
use DB;
use Mail;
use Auth;

class ReservationController extends Controller
{

    public function index()
    {
      $today = date('Y-m-d');
      $branch = Auth::user()->branch_id;

      if($branch != null)
      {
        $getReservation = Reservation::join('fra_branch', 'fra_branch.id', '=', 'fra_reservation.branch_id')
                                  ->leftjoin('fra_users', 'fra_users.id', '=', 'fra_reservation.user_id')
                                  ->select('fra_reservation.*', 'fra_branch.name as branch_name', 'fra_users.name as username')
                                  ->where('reserve_date', '=', $today)
                                  ->where('fra_branch.id', '=', $branch)
                                  ->where('status', '!=', 2)
                                  ->orderBy('reserve_time', 'asc')
                                  ->get();

        $grouping = collect($getReservation);
        $allReservation = $grouping->groupBy('reserve_time')->toArray();

        $getSize = DB::table('fra_reservation')
                          ->select(DB::raw('SUM(size) as total_size'))
                          ->where('branch_id', '=', $branch)
                          ->where('status', '!=', 2)
                          ->where('reserve_date', '=', $today)
                          ->get();
      }
      else
      {
        $getReservation = Reservation::join('fra_branch', 'fra_branch.id', '=', 'fra_reservation.branch_id')
                                  ->leftjoin('fra_users', 'fra_users.id', '=', 'fra_reservation.user_id')
                                  ->select('fra_reservation.*', 'fra_branch.name as branch_name', 'fra_users.name as username')
                                  ->where('reserve_date', '=', $today)
                                  ->where('status', '!=', 2)
                                  ->orderBy('reserve_time', 'asc')
                                  ->get();

        $grouping = collect($getReservation);
        $allReservation = $grouping->groupBy('reserve_time')->toArray();

        $getSize = DB::table('fra_reservation')
                          ->select(DB::raw('SUM(size) as total_size'))
                          ->where('reserve_date', '=', $today)
                          ->where('status', '!=', 2)
                          ->get();
      }

      return view('back.pages.reservation.index', compact('allReservation', 'getSize'));

    }

    public function create()
    {
      $branch = Auth::user()->branch_id;

      if($branch != null)
      {
        $getBranch = Branch::where('id', $branch)->get();
      }
      else
      {
        $getBranch = Branch::get();
      }

      return view('back.pages.reservation.create', compact('getBranch'));
    }

    public function store(Request $request)
    {
      $message = [
        'branch_id.required' => 'Fill This Field',
        'reserve_date.required'  => 'Fill This Field',
        'reserve_time.required'  => 'Fill This Field',
        'name.required' => 'Fill This Field',
        'size.required' => 'Fill This Field',
        'handphone.required'  => 'Fill This Field'
      ];

      $validator = Validator::make($request->all(), [
        'branch_id' => 'required|not_in:-- Choose --',
        'reserve_date' => 'required',
        'reserve_time'  => 'required|not_in:-- Choose --',
        'name'    => 'required',
        'size'    => 'required',
        'handphone' => 'required'
      ], $message);


      if($validator->fails()) {
        return redirect()->route('reservation.create')->withErrors($validator)->withInput();
      }

      $dates = date("Y-m-d",strtotime($request->reserve_date));
      // Booking Code
      function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
      }
      $bookcode = generateRandomString();

      // Get Branch Name
      $branch = DB::table('fra_branch')->where('id', $request->branch_id)->first();

      // Save & Send Email
      if($request->size > 9){
        $totalpay = $request->size*100000;

        $set = new Reservation;
        $set->branch_id     = $request->branch_id;
        $set->reserve_date  = $dates;
        $set->reserve_time  = $request->reserve_time;
        $set->name          = $request->name;
        $set->handphone     = $request->handphone;
        $set->size          = $request->size;
        $set->email         = $request->email;
        $set->specialreq    = $request->specialreq;
        $set->user_id       = $request->user_id;
        $set->booking_code  = $bookcode;
        $set->status        = 5;
        $set->save();

        $data = array([
          'booking_code'  => $bookcode,
          'branch_name'   => $branch->name,
          'name'          => $request->name,
          'handphone'     => $request->handphone,
          'size'          => $request->size,
          'email'         => $request->email,
          'reserve_date'  => $dates,
          'reserve_time'  => $request->reserve_time,
          'specialreq'    => $request->specialreq,
          'totalpay'      => $totalpay
          ]);

        $branch = array($branch);

        if($request->email != null)
        {
          Mail::send('email.bookinggroup', ['data' => $data, 'branch' => $branch], function($message) {
            $message->to(Input::get('email'), Input::get('email'))->subject('Group Booking for Hurricane’s Grill Indonesia');
          });
        }

        return redirect()->route('reservation')->with('message', 'New Reservation Has Been Created and Email Confirmation Has Been Sent.');

      }
      else{

        $set = new Reservation;
        $set->branch_id     = $request->branch_id;
        $set->reserve_date  = $dates;
        $set->reserve_time  = $request->reserve_time;
        $set->name          = $request->name;
        $set->handphone     = $request->handphone;
        $set->size          = $request->size;
        $set->email         = $request->email;
        $set->specialreq    = $request->specialreq;
        $set->user_id       = $request->user_id;
        $set->booking_code  = $bookcode;
        $set->status        = 1;
        $set->save();

        $data = array([
          'booking_code'  => $bookcode,
          'branch_name'   => $branch->name,
          'name'          => $request->name,
          'handphone'     => $request->handphone,
          'size'          => $request->size,
          'email'         => $request->email,
          'reserve_date'  => $dates,
          'reserve_time'  => $request->reserve_time,
          'specialreq'    => $request->specialreq
          ]);

        $branch = array($branch);

        if($request->email != null)
        {
          Mail::send('email.booking', ['data' => $data, 'branch' => $branch], function($message) {
            $message->to(Input::get('email'), Input::get('email'))->subject('Booking Confirmation for Hurricane’s Grill Indonesia');
          });
        }

        return redirect()->route('reservation')->with('message', 'New Reservation Has Been Created and Email Confirmation Has Been Sent.');

      }
    }

    public function bind($id)
    {
      $get  = Reservation::find($id);

      return view('back.pages.reservation.update', compact('get'));
    }

    public function update(Request $request)
    {
      $message = [
        'reserve_date.required'  => 'Fill This Field',
        'reserve_time.required'  => 'Fill This Field',
        'name.required' => 'Fill This Field',
        'size.required' => 'Fill This Field',
        'handphone.required'  => 'Fill This Field'
      ];

      $validator = Validator::make($request->all(), [
        'reserve_date' => 'required',
        'reserve_time'  => 'required',
        'name'    => 'required',
        'size'    => 'required',
        'handphone' => 'required'
      ], $message);


      if($validator->fails()) {
        return redirect()->route('reservation.bind', array('id' => $request->id))->withErrors($validator)->withInput();
      }

      $update = Reservation::find($request->id);
      $update->reserve_date = $request->reserve_date;
      $update->reserve_time = $request->reserve_time;
      $update->name         = $request->name;
      $update->size         = $request->size;
      $update->handphone    = $request->handphone;
      $update->user_id      = $request->user_id;
      $update->save();

      return redirect()->route('reservation')->with('message', 'The Reservation Has Been Updated.');
    }

    public function cancelled($id)
    {
      $user = Auth()->user()->id;

      $cancel = Reservation::find($id);

      $cancel->status   = 2;
      $cancel->user_id  = $user;
      $cancel->save();

      return redirect()->route('reservation')->with('message', 'The Reservation Has Been Cancelled.');
    }

    public function accept($id)
    {
      $accept = Reservation::find($id);
      dd($accept);
    }

    public function cancel()
    {
      $branch = Auth::user()->branch_id;

      if($branch != null)
      {
        $allCancel = Reservation::join('fra_branch', 'fra_branch.id', '=', 'fra_reservation.branch_id')
                                  ->leftjoin('fra_users', 'fra_users.id', '=', 'fra_reservation.user_id')
                                  ->select('fra_reservation.*', 'fra_branch.name as branch_name', 'fra_users.name as username')
                                  ->where('status', '=', 2)
                                  ->where('fra_reservation.branch_id', '=', $branch)
                                  ->orderBy('reserve_time', 'asc')
                                  ->paginate(10);
      }
      else
      {
        $allCancel = Reservation::join('fra_branch', 'fra_branch.id', '=', 'fra_reservation.branch_id')
                                  ->leftjoin('fra_users', 'fra_users.id', '=', 'fra_reservation.user_id')
                                  ->select('fra_reservation.*', 'fra_branch.name as branch_name', 'fra_users.name as username')
                                  ->where('status', '=', 2)
                                  ->orderBy('reserve_time', 'asc')
                                  ->paginate(10);
      }

      return view('back.pages.reservation.cancel', compact('allCancel'));
    }
}
