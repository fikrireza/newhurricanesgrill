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

    @if(Session::has('success'))
    <script>alert('{{ Session::get('success')}}');window.close();</script>
    @endif

    <div  class="mobile_only" style="height:100px">
      <img src="{{ asset('front/img/logo.png')}}" style="width:150px;display:block;position:absolute;left:0;right:0;z-index:1;top:0px;margin:auto;">
    </div>

    <div class="row" style="background:#FFF;">
      <br />
      <br />
      <div class="col-md-1"></div>
      <div class="col-md-11">
        <div class="pc_only" style="display:none">
          <font style="font-size:36px;" face="font1">Hurricane's Grill Newsletter</font>
          <br>
          <font style="font-size:20px;" face="font1">keep in touch with our News & Promo</font>
          <br>
          <br>
        </div>
      </div>

      <div class="mobile_only" style="padding-left:15px">
        <font style="font-size:30px;" face="font1">Hurricane's Grill Newsletter</font>
        <br>
        <font style="font-size:20px;" face="font1">keep in touch with our News & Promo</font>
        <br>
        <br>
      </div>
    </div>

    <div class="row" style="font-family:font1;font-size:14px;background:#FFF">
      <div class="col-md-1"></div>
      <div class="col-md-4" style="font-family:font2">
        <form method="post" name="formnews" action="{{ route('web.subscribePost') }}">
          {{ csrf_field() }}
          <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
            Email: <input  type="email" class="form-control" name="email" value="{{ old('email') }}"/>
            @if($errors->has('email'))
              <span class="help-block">
                <i>* {{$errors->first('email')}}</i>
              </span>
            @endif
          </div>
          <br />
          <p align="center">
            <input type="image" src="{{ asset('front/img/signup.png') }}" onmouseover="this.src='{{ asset('front/img/signup2.png')}}'" onmouseout="this.src='{{ asset('front/img/signup.png') }}'" alt="Submit Form" width="50%" />
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

</body>
</html>
