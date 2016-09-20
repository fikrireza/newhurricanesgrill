<!DOCTYPE html>
<html lang="id">
<head>
  <title>Hurricane's Grill Confirm Payment</title>
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
  <link rel="icon" href="{{ asset('front/img/icon.png')}}" type="image/x-icon" />
  <link type="text/css" rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body style="background:#000;font-family:font1;">
  <div class="col-md-12 column">

    <div style="height:100px">
      <img src="{{ asset('front/img/logo.png')}}" style="width:150px;display:block;position:absolute;left:0;right:0;z-index:1;top:0px;margin:auto;">
    </div>
    <div class="row" style="background:#FFF;">

      <div class="col-md-4" style="padding-left:15px">
        <br>
        <br>
        @if(Session::has('error'))
          <script>alert('{{ Session::get('error')}}');window.close();</script>
        @endif
      </div>

    </div>

    <div class="row" style="font-family:font2;font-size:14px;background:#FFF">
      <div class="col-md-1"></div>
        <div class="col-md-4" style="font-family:font2">
        <br />
        <font style="font-size:30px;font-family:font1;">Payment Confirmation</font>
        <br />
        <br />
        <br />
        <form class="form-horizontal" method="post" action="{{ route('web.confirm') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <div class="{{ $errors->has('booking_code') ? 'has-error' : '' }}">
              <label class="col-sm-4 control-label">Reservation Code</label>
            </div>
            <div class="col-sm-8 {{ $errors->has('booking_code') ? 'has-error' : '' }}">
              <input type="text" name="booking_code" class="form-control" placeholder="Name" value="{{ $booking_code[0]->booking_code }}" readonly="">
              <input type="hidden" name="reservation_id" class="form-control" placeholder="Name" value="{{ $booking_code[0]->id }}" readonly="">
              @if($errors->has('booking_code'))
                <span class="help-block">
                  <i>* {{$errors->first('booking_code')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('date_payment') ? 'has-error' : '' }}">
              <label class="col-sm-4 control-label">Payment Date</label>
            </div>
            <div class="col-sm-8 {{ $errors->has('date_payment') ? 'has-error' : '' }}">
              <input type="text" name="date_payment" class="form-control" id="date_payment" value="{{ old('date_payment') }}">
              @if($errors->has('date_payment'))
                <span class="help-block">
                  <i>* {{$errors->first('date_payment')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('acc_no') ? 'has-error' : '' }}">
              <label class="col-sm-4 control-label">Payment From Bank</label>
            </div>
            <div class="col-sm-8 {{ $errors->has('acc_no') ? 'has-error' : '' }}">
              <input type="text" name="acc_no" class="form-control" placeholder="BCA" value="{{ old('acc_no') }}">
              @if($errors->has('acc_no'))
                <span class="help-block">
                  <i>* {{$errors->first('acc_no')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('acc_name') ? 'has-error' : '' }}">
              <label class="col-sm-4 control-label">Acc Name</label>
            </div>
            <div class="col-sm-8 {{ $errors->has('acc_name') ? 'has-error' : '' }}">
              <input type="text" name="acc_name" class="form-control" placeholder="Account Name" value="{{ old('acc_name') }}">
              @if($errors->has('acc_name'))
                <span class="help-block">
                  <i>* {{$errors->first('acc_name')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('total_payment') ? 'has-error' : '' }}">
              <label class="col-sm-4 control-label">Total Amount</label>
            </div>
            <div class="col-sm-8 {{ $errors->has('total_payment') ? 'has-error' : '' }}">
              <input type="text" name="total_payment" class="form-control" placeholder="Ex: 1500000" value="{{ old('total_payment') }}" maxlength="17" onkeypress="return isNumber(event)">
              @if($errors->has('total_payment'))
                <span class="help-block">
                  <i>* {{$errors->first('total_payment')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="">
              <label class="col-sm-4 control-label">Receipt</label>
            </div>
            <div class="col-sm-8">
              <input type="file" name="paymentimg" accept=".jpg, .png, .bmp">
              <span class="help-block">
                <i>* If Any</i>
              </span>
            </div>
          </div>
          <div class="form-group">
            <div class="">
              <label class="col-sm-4 control-label">Notes</label>
            </div>
            <div class="col-sm-8">
              <textarea class="textarea form-control" name="notes" placeholder="Special Request" style="width: 100%; height: 150px; font-size: 14px; border: 1px solid #dddddd; padding: 10px;">{{ old('notes') }}</textarea>
              <input type="hidden" name="user_id" value="0">
            </div>
          </div>
          <p align="center">
            <button type="submit" class="btn btn-info groupbook">Confirm Now</button>
          </p>
        </form>
        </div>

        <div class="col-md-6"><br />
        <br />
        <br />
        </div>

        <div class="col-md-1"></div>
    </div>
</div>


<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script type="text/javascript">
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
  }
</script>
<script type="text/javascript">
  $('#date_payment').datepicker({
    startDate: '-2d',
    endDate: '+2d',
    format: 'dd-M-yyyy',
    todayHighlight: true,
    autoclose: true
  });
</script>

</body>
</html>
