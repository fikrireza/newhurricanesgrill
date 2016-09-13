<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>
      Dear, {{ $data[0]['email'] }}.
    </p>

    <p>
      Your Email Has Been Registered as <b>{{ $data[0]['akses'] }}</b> Role on Hurricane's Grill Website.
      <br>Please Click This Link For Activation :<br><br>

      <a href="{{ URL::to('hurricanesmenu/verify//' . $data[0]['activation_code']) }}">
        {{ URL::to('hurricanesmenu/verify/' . $data[0]['activation_code']) }}
      </a>
    </p>

  </body>
</html>
