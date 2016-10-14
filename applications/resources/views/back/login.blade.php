<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hurricane's Grill Indonesia</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/custom2.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue-light hold-transition login-page">
    @if(Session::has('messageactivationfailed'))
    <div class="alert alert-success panjang">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
      <p>{{ Session::get('messageactivationfailed') }}</p>
    </div>
    @endif
    <div class="login-box">
      <div class="login-logo">
        <img src="{{asset('images/logo-kecil-2.png')}}" alt="SPD" />
        &nbsp;&nbsp;<b>Hurricane's Grill Indonesia</b>
      </div>
      <div class="login-box-body">
        <p class="login-box-msg">Please Login With Your Account.</p>
        <form action="{{ route('login') }}" method="post">
          {!! csrf_field() !!}
          <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email')}}" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if($errors->has('email'))
              <span class="help-block">
                <i>* {{ $errors->first('email') }}</i>
              </span>
            @endif
          </div>
          <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if($errors->has('password'))
              <span class="help-block">
                <i>* {{ $errors->first('password') }}</i>
              </span>
            @endif
          </div>
          <div class="form-group {{ Session::has('error') ? 'has-error' : ''}}">
            @if(Session::has('error'))
              <span class="help-block">
                <i>* {{ Session::get('error') }}</i>
              </span>
            @endif
          </div>
          <div class="row">
            <div class="col-sm-8">
              <a href="#">Forgot Password</a>
            </div>
            <div class="col-sm-4 pull-right">
              <button type="submit" class="btn btn-success btn-block btn-flat">Login</button>
            </div>
          </div>
        </form>

      </div>
    </div>

    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%'
        });
      });
    </script>
  </body>
</html>
