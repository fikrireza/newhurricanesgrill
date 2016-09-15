<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Booking Confirmation</title>
  </head>

  <body style="font-family:Verdana, Geneva, sans-serif">
  <div style="background:#000;margin:0;">
    <img src="http://hurricanesgrill.co.id/img/logo2.png"  width="150">
  </div>

  <div>
  <table style="color:#000;font-size:14px;font-family:Verdana, Geneva, sans-serif;">
    <tr>
      <td colspan="3" style="font-size:20px">Congratulation, your reservation has been confirmed!<br/><br/></td>
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
      <td>{{ $data[0]['size'] }} pax</td>
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
      <td>{{ $data[0]['specialreq'] }}</td>
    </tr>
  </table>

  <p align="left">
    <font color="#000000" style="font-size:14px">
    Please show this e-mail upon your arrival.<br />
    To Cancel Booking, Please Call : <a href="tel:+622127513388">+6221 2751 3388</a> (Hurricanes Grill Indonesia)
    </font>
  </p>
  <p align="left">
    <font color="#000000" style="font-size:14px">
    Please arrive at least 10 minutes in advance of the scheduled reservation time. The restaurant reserves the right to cancel your booking and allocate your table to other guests if you have not arrived within 15 minutes of the scheduled seating time.
    </font>
  </p>
  </div>
  </body>
</html>
