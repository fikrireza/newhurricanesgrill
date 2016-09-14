<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  <title>Group Booking for Hurricane’s Grill Indonesia</title>
</head>
<body style="font-family:Verdana, Geneva, sans-serif">
<div style="background:#000;margin:0;">
  <img src="http://hurricanesgrill.co.id/img/logo2.png"  width="150">
</font>
</div>

<div>
  <table style="color:#000;font-size:14px;font-family:Verdana, Geneva, sans-serif;">
    <tr>
      <td colspan="3" style="font-size:20px">Thank you for your reservation<br><br></td>
    </tr>
    <tr>
      <td>Reservation Code</td>
      <td>:</td>
      <td>{{ $data[0]['booking_code'] }}</td>
    </tr>
    <tr>
      <td>Location</td>
      <td>:</td>
      <td>{{ $branch[0]->address }}</td>
    </tr>
    <tr>
      <td>Name</td>
      <td>:</td>
      <td>{{ $data[0]['name'] }}</td>
    </tr>
    <tr>
      <td>Contact Number</td>
      <td>:</td>
      <td>{{ $data[0]['handphone'] }}</td>
    </tr>
    <tr>
      <td>Party Size</td>
      <td>:</td>
      <td>{{ $data[0]['size'] }}</td>
    </tr>
    <tr>
      <td>Email</td>
      <td>:</td>
      <td>{{ $data[0]['email'] }}</td>
    </tr>
    <tr>
      <td>Date</td>
      <td>:</td>
      <td>{{ $data[0]['reserve_date'] }}</td>
    </tr>
    <tr>
      <td>Time</td>
      <td>:</td>
      <td>{{ $data[0]['reserve_time'] }}</td>
    </tr>
    <tr>
      <td>Special Request</td>
      <td>:</td>
      <td>{!! $data[0]['specialreq'] !!}</td>
    </tr>
  </table>

  <p align="left">
    <font color="#000000" style="font-size:14px"><br />
    Your reservation is noted. Please kindly proceed to deposit Rp. {{ number_format($data[0]['totalpay'],0,',','.') }} (Rp. 100.000,- per pax/ person) before <font style="text-transform:capitalize"><strong>{{ date("l, jS F Y", strtotime('+5 hours, +1 days')) }} 12:00 PM</strong></font> to :
    <br />
    <br />
    <br />

  <table>
  <tr>
    <td>Bank</td>
    <td>:</td>
    <td>BCA</td>
  </tr>
  <tr>
    <td>A/C Name</td>
    <td>:</td>
    <td>PT. Indoboga Jaya Kusuma</td>
  </tr>
  <tr>
    <td>A/C No.</td>
    <td>:</td>
    <td>86 5016 7687</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>Total</td>
    <td>:</td>
    <td>Rp. {{ number_format($data[0]['totalpay'],0,',','.') }}</td>
  </tr>
  <tr>
    <td>Remarks</td>
    <td>:</td>
    <td>{{ $data[0]['booking_code'] }}</td>
  </tr>
  </table>

  <strong>After you make payment, please kindly confirm your payment by clicking this
    <a href="{{ URL::to('hurricanesmenu/payment-confirm//' . $data[0]['booking_code']) }}" >link</a>. </strong>
    <br />
    <br />
    For more information, Please Call : <a href="tel:+622127513388">+6221 2751 3388</a> (Hurricanes Grill Indonesia)
    <br />
    <br />
    Thank you and we are looking forward to serve you,
    <br />
    <br />
    Hurricane'."'".'s Grill<br />
    Gunawarman 20, Kebayoran Baru<br />
    Jakarta 12110 - Indonesia
    <br />
    <br />

    ph  : <a href="tel:+622127513388">+6221 2751 3388</a>

    </font>
  </p>
  </div>
</body>
</html>
