<html>
  <head>
    <title>Group Booking Payment Confirmation</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  </head>
<body style="font-family:Verdana, Geneva, sans-serif">
  <div style="background:#000;margin:0;">
    <img src="http://hurricanesgrill.co.id/img/logo2.png"  width="150">
  </div>

  <table style="color:#000;font-size:14px;font-family:Verdana, Geneva, sans-serif;">
    <tr>
      <td colspan="3" style="font-size:20px">Group Booking Payment Confirmation<br><br></td>
    </tr>
    <tr>
      <td>Reservation Code</td>
      <td>:</td>
      <td>{{ $data[0]['booking_code'] }}</td>
    </tr>
    <tr>
      <td>Payment Date</td>
      <td>:</td>
      <td>{{ $data[0]['date_payment'] }}</td>
    </tr>
    <tr>
      <td>Payment from Bank</td>
      <td>:</td>
      <td>{{ $data[0]['acc_no'] }}</td>
    </tr>
    <tr>
      <td>Acc Name</td>
      <td>:</td>
      <td>{{ $data[0]['acc_name'] }}</td>
    </tr>
    <tr>
      <td>Total Amount</td>
      <td>:</td>
      <td>Rp. {{ number_format($data[0]['total_payment'],0,',','.') }}</td>
    </tr>
    <tr>
      <td>Notes</td>
      <td>:</td>
      <td>@if ($data[0]['notes'] != null) {{ $data[0]['notes'] }} @else - @endif</td>
    </tr>
  </table>

  <p align="left">
    <font color="#000000" style="font-size:14px">
    Our Location : <br>
    {{ $branch[0]->address }}<br />
    </font>
  </p>
</body>
</html>
