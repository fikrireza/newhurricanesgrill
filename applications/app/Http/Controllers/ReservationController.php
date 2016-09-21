<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Models\User;
use App\Models\Branch;
use App\Models\Reservation;
use App\Models\BlockReservation;
use App\Models\BlockReservationDetail;
use DB;
use Mail;
use Auth;

class ReservationController extends Controller
{

    public function index()
    {
      $user = Auth::user()->branch_id;

      if($user != null)
      {
        $branch_id = Branch::where('id', '=', $user)->get();
      }
      else
      {
        $branch_id = Branch::get();
      }

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

      return view('back.pages.reservation.index', compact('allReservation', 'getSize', 'branch_id'));

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
            $message->to($request->email)->to('contact@hurricanesgrill.co.id')->subject('Group Booking for Hurricane’s Grill Indonesia');
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
            $message->to($request->email)->to('contact@hurricanesgrill.co.id')->subject('Booking Confirmation for Hurricane’s Grill Indonesia');
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
      $user = Auth()->user()->id;

      $accept = Reservation::find($id);

      $accept->status   = 5;
      $accept->user_id  = $user;
      $accept->save();

      $dates = date("Y-M-d",strtotime($accept->reserve_date));

      $branch = DB::table('fra_branch')->where('id', $accept->branch_id)->first();

      $email = $accept->email;

      if($accept->size > 9)
      {
        $totalpay = $accept->size*100000;

        $data = array([
          'booking_code'  => $accept->booking_code,
          'branch_name'   => $branch->name,
          'name'          => $accept->name,
          'handphone'     => $accept->handphone,
          'size'          => $accept->size,
          'email'         => $accept->email,
          'reserve_date'  => $dates,
          'reserve_time'  => $accept->reserve_time,
          'specialreq'    => $accept->specialreq,
          'totalpay'      => $totalpay
          ]);

        $branch = array($branch);

        if($email != null)
        {
          Mail::send('email.bookinggroup', ['data' => $data, 'branch' => $branch], function($message) use($email) {
            $message->to($email)->to('contact@hurricanesgrill.co.id')->subject('Group Booking for Hurricane’s Grill Indonesia');
          });
        }

        return redirect()->route('reservation')->with('message', 'Reservation Has Been Accepted and Email Confirmation Has Been Sent.');
      }
      else
      {
        $data = array([
          'booking_code'  => $accept->booking_code,
          'branch_name'   => $branch->name,
          'name'          => $accept->name,
          'handphone'     => $accept->handphone,
          'size'          => $accept->size,
          'email'         => $accept->email,
          'reserve_date'  => $dates,
          'reserve_time'  => $accept->reserve_time,
          'specialreq'    => $accept->specialreq
          ]);

        $branch = array($branch);

        if($email != null)
        {
          Mail::send('email.booking', ['data' => $data, 'branch' => $branch], function($message) use($email) {
            $message->to($email)->to('contact@hurricanesgrill.co.id')->subject('Booking Confirmation for Hurricane’s Grill Indonesia');
          });
        }

        return redirect()->route('reservation')->with('message', 'New Reservation Has Been Created and Email Confirmation Has Been Sent.');

      }
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

    public function search(Request $request)
    {
      $setBooking_code = $request->booking_code;
      $setReserve_date = $request->reserve_date;
      $setSeason       = $request->season;
      $setBranch_id    = $request->branch_id;

      $user = Auth::user()->branch_id;
      if($user != null){
        $getBranch = Branch::where('id', '=', $user)->get();
      }
      else {
        $getBranch = Branch::get();
      }

      if($setBooking_code != null)
      {
        $getReservation = Reservation::join('fra_branch', 'fra_branch.id', '=', 'fra_reservation.branch_id')
                                  ->leftjoin('fra_users', 'fra_users.id', '=', 'fra_reservation.user_id')
                                  ->select('fra_reservation.*', 'fra_branch.name as branch_name', 'fra_users.name as username')
                                  ->where('fra_branch.id', $user)
                                  ->where('fra_reservation.booking_code', $setBooking_code)
                                  ->orderBy('reserve_time', 'asc')
                                  ->get();

        $grouping = collect($getReservation);
        $allReservation = $grouping->groupBy('reserve_time')->toArray();

        $getSize = DB::table('fra_reservation')
                          ->select(DB::raw('SUM(size) as total_size'))
                          ->where('branch_id', '=', $user)
                          ->where('fra_reservation.booking_code', $setBooking_code)
                          ->get();
      }

      return view('back.pages.reservation.search', compact('setBooking_code', 'setReserve_date', 'setSeason', 'setBranch_id', 'allReservation', 'search', 'getSize', 'getBranch'));
    }


    public function block()
    {
      $getBranch = Branch::get();
      $getReservationBlock  = BlockReservation::join('fra_branch', 'fra_branch.id', '=', 'fra_blockreservation.branch_id')
                                              ->join('fra_users', 'fra_users.id', '=', 'fra_blockreservation.user_id')
                                              ->join('fra_blockreservationdetail', 'fra_blockreservationdetail.blockreservation_id', '=', 'fra_blockreservation.id')
                                              ->select('fra_blockreservation.block_date', 'fra_blockreservation.notification', 'fra_branch.name as name', 'fra_users.name as username', 'fra_blockreservationdetail.*')
                                              ->get();

      $getReservationBlockDetail = BlockReservationDetail::join('fra_blockreservation', 'fra_blockreservation.id', '=', 'fra_blockreservationdetail.blockreservation_id')->get();

      return view('back.pages.reservation.block', compact('getBranch', 'getReservationBlock', 'getReservationBlockDetail'));
    }

    public function blockreservation(Request $request)
    {
      $user = Auth::user()->id;

      $message = [
        'branch_id.required'  => 'Fill This Field',
        'block_date.required' => 'Fill This Field',
        'block_date.unique' => 'This Date Has Been Used',
        'notification.required' => 'Fill This Field',
      ];

      $validator = Validator::make($request->all(), [
        'branch_id' => 'required|not_in:-- Choose --',
        'block_date'  => 'required|unique:fra_blockreservation',
        'notification'  => 'required',
      ], $message);

      if($validator->fails()){
        return redirect()->route('reservation.block')->withErrors($validator)->withInput();
      }

      DB::transaction(function() use($request){
        $block = BlockReservation::create([
          'branch_id' => $request->branch_id,
          'block_date'  =>  date("Y-m-d",strtotime($request->block_date)),
          'notification'  => $request->notification,
          'user_id' => $request->user_id
        ]);

      	$isiblockDetail = new BlockReservationDetail;
        $isiblockDetail->times = $request->times;
        $isiblockDetail->times1 = $request->times1;
        $isiblockDetail->times2 = $request->times2;
        $isiblockDetail->times3 = $request->times3;
        $isiblockDetail->times4 = $request->times4;
        $isiblockDetail->times5 = $request->times5;
        $isiblockDetail->times6 = $request->times6;
        $isiblockDetail->times7 = $request->times7;
        $isiblockDetail->times8 = $request->times8;
        $isiblockDetail->times9 = $request->times9;
        $isiblockDetail->times10 = $request->times10;
      	$isiblockDetail->times11 = $request->times11;
        $isiblockDetail->blockreservation_id = $block->id;
      	$isiblockDetail->save();

      });

      return redirect()->route('reservation.block')->with('message', 'Reservation Date Has Been Blocked');
    }

    public function blockbind($id)
    {
      $blockFind = BlockReservation::join('fra_blockreservationdetail', 'fra_blockreservationdetail.blockreservation_id', '=', 'fra_blockreservation.id')->where('fra_blockreservation.id', '=', $id)->get();

      $getBranch = Branch::get();

      if($blockFind->isEmpty()){
        abort('404');
      }
      else{
        return view('back.pages.reservation.blockedit', compact('blockFind', 'getBranch'));
      }
    }

    public function blockedit(Request $request)
    {
      DB::transaction(function() use($request){
        $block = BlockReservation::find($request->blockreservation_id);
        $block->block_date = $request->block_date;
        $block->notification = $request->notification;
        $block->save();

        $isiblockDetail = BlockReservationDetail::find($request->id);
        $isiblockDetail->times = $request->times;
        $isiblockDetail->times1 = $request->times1;
        $isiblockDetail->times2 = $request->times2;
        $isiblockDetail->times3 = $request->times3;
        $isiblockDetail->times4 = $request->times4;
        $isiblockDetail->times5 = $request->times5;
        $isiblockDetail->times6 = $request->times6;
        $isiblockDetail->times7 = $request->times7;
        $isiblockDetail->times8 = $request->times8;
        $isiblockDetail->times9 = $request->times9;
        $isiblockDetail->times10 = $request->times10;
        $isiblockDetail->times11 = $request->times11;
        $isiblockDetail->blockreservation_id = $request->blockreservation_id;
        $isiblockDetail->save();

      });

      return redirect()->route('reservation.block')->with('message', 'Reservation Block Has Been Edited');
    }
}
