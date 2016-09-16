<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Branch;
use App\Models\Reservation;
use App\Models\BlockReservation;
use App\Models\BlockReservationDetail;
use Mail;
use DB;
use Validator;
use DateTime;


class WebReservationController extends Controller
{

    public function index()
    {
      $getBranch  = Branch::where('flag_active', '=', 1)->get();

      return view('front.reservation', compact('getBranch'));
    }

    public function groupbook()
    {
      $getBranch = Branch::where('flag_active', '=', 1)->get();

      return view('front.groupbook', compact('getBranch'));
    }

    public function store(Request $request)
    {
      // dd($request);
      $message  = [
        'branch_id.required'  => 'Fill This Field',
        'name.required'   => 'Fill This Field',
        'handphone.required'  => 'Fill This Field',
        'size.required'       => 'Fill This Field',
        'email.required'      => 'Fill This Field',
        'reserve_date.required' => 'Fill This Field',
        'reserve_time.required' => 'Fill This Field',
        'user_id.required'  => 'Fill This Field',
      ];

      $validator = Validator::make($request->all(), [
        'branch_id' => 'required|not_in:-- Choose --',
        'name'      => 'required',
        'handphone' => 'required',
        'size'      => 'required',
        'email'     => 'required|email',
        'reserve_date'  => 'required',
        'reserve_time'  => 'required|not_in:-- Choose --'
      ], $message);

      if($validator->fails()){
        return redirect()->route('web.reservation')->withErrors($validator)->withInput();
      }

      $nowdate    =   date("Y-m-d",strtotime('+5 hours'));
      $time       =   $request->reserve_time.":00";
      $dates      =   date("Y-m-d",strtotime($request->reserve_date));
    	$date       =   date("d-m-Y",strtotime($dates));
    	$branch   =   $request->branch_id;
    	$email      =   $request->email;
    	$name       =   $request->name;
    	$specialrequest  = $request->specialreq;
    	$person    = $request->size;
    	$date2     = date("Y-m-d",strtotime($dates));
    	$handphone = "62".$request->handphone;
      $hitung=0;
    	$salah=0;
    	$maxcap=0;

      $time2 = date("H:i:s" ,strtotime($time)+ 60*60);
    	$time3 = date("H:i:s", strtotime($time)- 60*60);

      $cap1 = Reservation::where('reserve_date', '=', $dates)
                          ->where('branch_id', '=', $branch)
                          ->whereBetween('reserve_time', [$time, $time2])
                          ->sum('size');

      $cap2 = Reservation::where('reserve_date', '=', $dates)
                          ->where('branch_id', '=', $branch)
                          ->whereBetween('reserve_time', [$time3, $time])
                          ->sum('size');

      $maxcap = Reservation::where('reserve_date', '=', $dates)
                            ->where('branch_id', '=', $branch)
                            ->where('reserve_time', '=', $time)
                            ->sum('size');
      $maxcap = $maxcap+$person;

      $times = strtotime($dates);
      $dw = date( "w", strtotime($dates));

      // Cek By Time
  		$maxcap2=0;
  		if($time == "11:00:00" || $time == "14:00:00" || $time == "15:00:00" || $time == "16:00:00" || $time=="17:00:00" || $time=="18:00:00" || $time == "21:00:00")
  		{
  			$maxcap2=100;
  		}
  		if($time == "13:00:00" || $time == "20:00:00")
  		{
  			$maxcap2=80;
  		}
  		if($time == "12:00:00" || $time == "19:00:00")
  		{
  			$maxcap2=120;
  		}

      // Cek By Day
      if($dw == "0" || $dw == "6" || $dw == "5")
			{
				if($hitung>12 || $maxcap>$maxcap2)
				{
					if($salah == 0)
					{
            if($person>9)
            {
              return redirect()->route('groupbook')->with('message', 'Reservation is full on '.$dates.' at '.$time.'')->withInput();
            }
            else
            {
              return redirect()->route('web.reservation')->with('message', 'Reservation is full on '.$dates.' at '.$time.'')->withInput();
            }
					  $salah=1;
					}
				}
				if($cap1>160 || $cap2>160)
				{
					if($salah==0)
					{
            if($person>9)
            {
              return redirect()->route('groupbook')->with('message', 'Reservation is full on '.$dates.' at '.$time.'')->withInput();
            }
            else
            {
              return redirect()->route('web.reservation')->with('message', 'Reservation is full on '.$dates.' at '.$time.'')->withInput();
            }
					$salah=1;
					}
				}
			}
			if($dw == "1" || $dw == "2" || $dw== "3" || $dw == "4")
			{
				if($hitung>12 || $maxcap>$maxcap2)
				{
					if($salah == 0)
					{
            if($person>9)
            {
              return redirect()->route('groupbook')->with('message', 'Reservation is full on '.$dates.' at '.$time.'')->withInput();
            }
            else
            {
              return redirect()->route('web.reservation')->with('message', 'Reservation is full on '.$dates.' at '.$time.'')->withInput();
            }
					$salah=1;
					}
				}

				if($cap1>160||$cap2>160)
				{
					if($salah==0)
					{
            if($person>9)
            {
              return redirect()->route('groupbook')->with('message', 'Reservation is full on '.$dates.' at '.$time.'')->withInput();
            }
            else
            {
              return redirect()->route('web.reservation')->with('message', 'Reservation is full on '.$dates.' at '.$time.'')->withInput();
            }
          $salah=1;
					}
				}
			}

      if($salah==0)
			{
        $block = DB::table('fra_blockreservation')
                    ->join('fra_blockreservationdetail', 'fra_blockreservationdetail.blockreservation_id', '=', 'fra_blockreservation.id')
                    ->where('fra_blockreservation.branch_id', '=', $branch)
                    ->where('fra_blockreservationdetail.times', '=', $time)
                    ->get();

        if ($block != null) {
          if($person>9)
          {
            return redirect()->route('groupbook')->with('message', $block[0]->notification)->withInput();
          }
          else
          {
            return redirect()->route('web.reservation')->with('message', $block[0]->notification)->withInput();
          }
        }
			}

      if($salah==0)
      {
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

        $email = $request->email;
        // Save & Send Email
        if($request->size > 9)
        {
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

          if($email != null)
          {
            Mail::send('email.webbookinggroup', ['data' => $data, 'branch' => $branch], function($message) use($email) {
              $message->to($email)->to('contact@hurricanesgrill.co.id')->subject('Group Booking Request for Hurricanes Grill Indonesia');
            });
          }

          if($request->size > 9)
          {
            return redirect()->route('groupbook')->with('success', 'Thank you for reservation');
          }
          else
          {
            return redirect()->route('web.reservation')->with('success', 'Thank you for reservation');
          }

        }
        else
        {

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

          if($email != null)
          {
            Mail::send('email.webbooking', ['data' => $data, 'branch' => $branch], function($message) use($email) {
              $message->to($email)->to('contact@hurricanesgrill.co.id')->subject('Reservation for Hurricanes Grill Indonesia');
            });
          }

          if($request->size > 9)
          {
            return redirect()->route('groupbook')->with('success', 'Thank you for reservation');
          }
          else
          {
            return redirect()->route('web.reservation')->with('success', 'Thank you for reservation');
          }
        }
      }
    }
}
