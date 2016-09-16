<!DOCTYPE html>
<html lang="en">
<head>
<title>Hurricane's Grill | Reservation</title>

<meta name="keywords" content="hurricanes grill, hurricanes grill indonesia, hurricanes grill jakarta, steak restaurant, restaurant, steakhouse indonesia, steakhouse jakarta" />
<meta name="robots" content="noindex,follow">
<meta name="description" content="Hurricane's Grill Indonesia, Best Steaks and Ribs. Hurricanes Grill Indonesia, Hurricanes Grill Jakarta">

<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
<link rel="icon" href="{{ asset('front/img/icon.png') }}" type="image/x-icon" />
<link type="text/css" rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
<style>
  img:hover.news {
         opacity: 0.7;
      filter: alpha(opacity=40); /* For IE8 and earlier */
  }

  a:focus {outline:none !important}
  .caret {

      border-left: 8px solid transparent;
      border-right: 8px solid transparent;
      border-top: 8px solid #FFF;
  }
  @media (max-width: 1000px) {
    .navbar-header {
        float: none;
    }
    .produkutama {
        font-size:20px;
    }
    .navbar-toggle {
        display: block;
    }
    .navbar-collapse {
        border-top: 1px solid transparent;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
    }
    .navbar-collapse.collapse {
        display: none!important;
    }
    .navbar-nav {
        float: none!important;
        margin: 7.5px -15px;
    }
    .navbar-nav>li {
        float: none;
    }
    .navbar-nav>li>a {
        padding-top: 10px;
        padding-bottom: 10px;
    }
  }

  .groupbook{
    border:1px #f93 solid;
    background:#f93;
    color:#000000;
    transition:0.5s all;
    -webkit-transition:0.5s all;
    -moz-transition:0.5s all;
    -o-transition:0.5s all;
  -ms-transition:0.5s all;
  }

  .groupbook:hover{
    border:1px #000 solid;
    background:transparent;
    color:#000000;
    transition:0.5s all;
    -webkit-transition:0.5s all;
    -moz-transition:0.5s all;
    -o-transition:0.5s all;
    -ms-transition:0.5s all;
  }
</style>
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body style="background:#000;font-family:font1;">
	<div class="col-md-12 column">
    <div class="container">
      <nav class="navbar navbar-default pc_only" role="navigation" style="display:none;background:#000;border:none;font-family: 'Josefin Sans', sans-serif;">
        <ul class="nav navbar-nav pull-left">
          <li style="padding-top:70px"><a style="font-size:14px;color:#000">f</a></li>
          <li style="padding-top:70px"><a  style="font-size:14px;color:#000">e</a></li>
          <li style="padding-top:70px"><a style="font-size:14px;color:#000">d</a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li style="width:20%; display:block; position:absolute; left:0; right:0; bottom:0;top:5px;z-index:1; margin:auto;"><img src="{{ asset('front/img/logo.png') }}" style="width:200px;"></li>
        </ul>
        <ul class="nav navbar-nav pull-right">
          <li style="padding-top:70px"><a style="font-size:14px;color:#000" >c</a></li>
          <li style="padding-top:70px"><a style="font-size:14px;color:#000"  >b</a></li>
          <li style="padding-top:70px"><a style="font-size:14px;color:#000">a</a></li>
        </ul>
      </nav>
    </div>

    @if(Session::has('message'))
      <script>alert('{{ Session::get('message')}}');</script>
    @endif
    @if(Session::has('success'))
      <script>alert('{{ Session::get('success')}}');window.close();</script>
    @endif
    <div  class="mobile_only" style="height:100px">
      <img src="{{ asset('front/img/logo.png') }}" style="width:150px;display:block; position:absolute; left:0; right:0; z-index:1;top:0px; margin:auto;">
    </div>

    <div class="row" style="background:#FFF;">
      <br />
      <br />
      <div class="col-md-1"></div>
      {{-- <div class="col-md-6">
        <div class="pc_only" style="display:none">
          <font style="font-size:30px;" face="font1">Reservation Online</font>
          <font style="font-size:20px;" face="font1">
            <p>
              <a href="tel:+622127513388" style="color:#000;text-decoration:none"> +6221 2751 3388 </a>|
              <a href="tel:+622127513399" style="color:#000;text-decoration:none">+6221 2751 3399 </a>
            </p>
            <p>
              <a href="tel:+622127513399" style="color:#000;text-decoration:none"> Hotline : +62812 9002 5555 </a>
            </p>
          </font>
        </div>
      </div> --}}
      <div class="col-md-4">
        <div style="padding-left:15px">
          <font style="font-size:25px;" face="font1">RESERVATION ONLINE</font>
          <font style="font-size:16px;" face="font1">
            <p>
              <a href="tel:+622127513388" style="color:#000;text-decoration:none"> +6221 2751 3388 </a>|
              <a href="tel:+622127513399" style="color:#000;text-decoration:none">+6221 2751 3399 </a>
            </p>
            <p>
              <a href="tel:+622127513399" style="color:#000;text-decoration:none"> HOTLINE : +62812 9002 5555 </a>
            </p>
          </font>
        </div>
      </div>
    </div>

    <div class="row" style="font-family:font1;font-size:14px;background:#FFF">
      <div class="col-md-1"></div>
      <div class="col-md-4" style="font-family:font2">
        <br />
        <p align="justify">For group booking ( 10 people or more ), please kindly click this button :</p>
        <p align="center">
          <a href="{{ route('groupbook') }}"><button class="btn btn-info groupbook">Group Booking</button></a>
        </p>

        <form class="form-horizontal" method="post" action="{{ route('web.store') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <div class="{{ $errors->has('branch_id') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Location</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('branch_id') ? 'has-error' : '' }}">
              <select name="branch_id" class="form-control">
                <option value="-- Choose --">-- Choose --</option>
                @foreach($getBranch as $key)
                  <option value="{{ $key->id }}" {{ old('branch_id') == $key->id ? 'selected' : '' }}>{{ $key->name }}</option>
                @endforeach
              </select>
              @if($errors->has('branch_id'))
                <span class="help-block">
                  <i>* {{$errors->first('branch_id')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Name</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('name') ? 'has-error' : '' }}">
              <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
              @if($errors->has('name'))
                <span class="help-block">
                  <i>* {{$errors->first('name')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('handphone') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Handphone</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('handphone') ? 'has-error' : '' }}">
              <div class="input-group">
                <span class="input-group-addon">+62</span>
                <input type="text" name="handphone" class="form-control" placeholder="Ex: 8129012382" value="{{ old('handphone') }}" maxlength="17" onkeypress="return isNumber(event)">
              </div>
              @if($errors->has('handphone'))
                <span class="help-block">
                  <i>* {{$errors->first('handphone')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('size') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Party Size</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('size') ? 'has-error' : '' }}">
              <select name="size" class="form-control" >
                <option value="1" {{ old('size') == '1' ? 'selected' : '' }}>1 pax</option>
                <option value="2" {{ old('size') == '2' ? 'selected' : '' }}>2 pax</option>
                <option value="3" {{ old('size') == '3' ? 'selected' : '' }}>3 pax</option>
                <option value="4" {{ old('size') == '4' ? 'selected' : '' }}>4 pax</option>
                <option value="5" {{ old('size') == '5' ? 'selected' : '' }}>5 pax</option>
                <option value="6" {{ old('size') == '6' ? 'selected' : '' }}>6 pax</option>
                <option value="7" {{ old('size') == '7' ? 'selected' : '' }}>7 pax</option>
                <option value="8" {{ old('size') == '8' ? 'selected' : '' }}>8 pax</option>
                <option value="9" {{ old('size') == '9' ? 'selected' : '' }}>9 pax</option>
              </select>
              @if($errors->has('size'))
                <span class="help-block">
                  <i>* {{$errors->first('size')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Email</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('email') ? 'has-error' : '' }}">
              <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
              @if($errors->has('email'))
                <span class="help-block">
                  <i>* {{$errors->first('email')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('reserve_date') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Date</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('reserve_date') ? 'has-error' : '' }}">
              <input type="text" name="reserve_date" class="form-control" id="reserve_date" value="{{ old('reserve_date') }}">
              @if($errors->has('reserve_date'))
                <span class="help-block">
                  <i>* {{$errors->first('reserve_date')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('reserve_time') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Time</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('reserve_time') ? 'has-error' : '' }}">
              <select name="reserve_time" class="form-control">
                <option value="-- Choose --">-- Choose --</option>
                <option value="11:00" {{ old('reserve_time') == '11:00' ? 'selected' : '' }}>11:00</option>
                <option value="11:30" {{ old('reserve_time') == '11:30' ? 'selected' : '' }}>11:30</option>
                <option value="12:00" {{ old('reserve_time') == '12:00' ? 'selected' : '' }}>12:00</option>
                <option value="12:30" {{ old('reserve_time') == '12:30' ? 'selected' : '' }}>12:30</option>
                <option value="13:00" {{ old('reserve_time') == '13:00' ? 'selected' : '' }}>13:00</option>
                <option value="13:30" {{ old('reserve_time') == '13:30' ? 'selected' : '' }}>13:30</option>
                <option value="14:00" {{ old('reserve_time') == '14:00' ? 'selected' : '' }}>14:00</option>
                <option value="14:30" {{ old('reserve_time') == '14:30' ? 'selected' : '' }}>14:30</option>
                <option value="15:00" {{ old('reserve_time') == '15:00' ? 'selected' : '' }}>15:00</option>
                <option value="15:30" {{ old('reserve_time') == '15:30' ? 'selected' : '' }}>15:30</option>
                <option value="16:00" {{ old('reserve_time') == '16:00' ? 'selected' : '' }}>16:00</option>
                <option value="16:30" {{ old('reserve_time') == '16:30' ? 'selected' : '' }}>16:30</option>
                <option value="17:00" {{ old('reserve_time') == '17:00' ? 'selected' : '' }}>17:00</option>
                <option value="17:30" {{ old('reserve_time') == '17:30' ? 'selected' : '' }}>17:30</option>
                <option value="18:00" {{ old('reserve_time') == '18:00' ? 'selected' : '' }}>18:00</option>
                <option value="18:30" {{ old('reserve_time') == '18:30' ? 'selected' : '' }}>18:30</option>
                <option value="19:00" {{ old('reserve_time') == '19:00' ? 'selected' : '' }}>19:00</option>
                <option value="19:30" {{ old('reserve_time') == '19:30' ? 'selected' : '' }}>19:30</option>
                <option value="20:00" {{ old('reserve_time') == '20:00' ? 'selected' : '' }}>20:00</option>
                <option value="20:30" {{ old('reserve_time') == '20:30' ? 'selected' : '' }}>20:30</option>
                <option value="21:00" {{ old('reserve_time') == '21:00' ? 'selected' : '' }}>21:00</option>
                <option value="22:00" {{ old('reserve_time') == '22:00' ? 'selected' : '' }}>22:00</option>
                <option value="23:00" {{ old('reserve_time') == '23:00' ? 'selected' : '' }}>23:00</option>
              </select>
              @if($errors->has('reserve_time'))
                <span class="help-block">
                  <i>* {{$errors->first('reserve_time')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="">
              <label class="col-sm-3 control-label">Special Request</label>
            </div>
            <div class="col-sm-9">
              <textarea class="textarea form-control" name="specialreq" placeholder="Special Request" style="width: 100%; height: 200px; font-size: 14px; border: 1px solid #dddddd; padding: 10px;">{{ old('specialreq') }}</textarea>
              <input type="hidden" name="user_id" value="0">
            </div>
          </div>
          <p align="center">
            <button type="submit" class="btn btn-info groupbook">Booking Now</button>
          </p>
        </form>

      </div>

      <div class="col-md-6"><br />
      	<img  src="{{ asset('front/img/booking.jpg')}}" width="100%">
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
  $('#reserve_date').datepicker({
    startDate: '+d',
    format: 'dd-M-yyyy',
    todayHighlight: true,
    autoclose: true
  });
</script>
</body>
</html>
