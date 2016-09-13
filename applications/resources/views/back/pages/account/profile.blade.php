@extends('back.layout.master')

@section('content')
  <div class="row">

    @if(Session::has('message'))
    <div class="col-md-12">
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Succeed!</h4>
          <p>{{ Session::get('message') }}</p>
        </div>
    </div>
    @endif

    <div class="col-md-3">
      <div class="box box-danger">
        <div class="box-body box-profile"
          @if(Auth::user()->level=="1")
            style="height:225px;"
          @else
            style="height:265px;"
          @endif
        >
          <img class="profile-user-img img-responsive img-circle" src="{{ url('/') }}/images/{{$getProfile->avatar}}" alt="User profile picture">

          <h3 class="profile-username text-center">{{ $getProfile->name }}</h3>
          <p class="text-muted text-center">
            @if(Auth::user()->level == "1")
              {{ "Administrator" }}
            @elseif(Auth::user()->level == "2")
              {{ "Manager" }}
            @elseif(Auth::user()->level == "3")
              {{ "Reservation" }}
            @elseif(Auth::user()->level == "4")
              {{ "Reservation Admin" }}
            @elseif(Auth::user()->level == "5")
              {{ "Kitchen" }}
          @endif
          </p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Login Times</b> <span class="pull-right badge bg-maroon">
                2
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>

      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li id="tabUbahProfile"
              @if(Session::has('errors')))
                class="active"
              @endif
             ><a href="#settings" data-toggle="tab">Change Profile</a></li>
            <li
              @if(Session::has('erroroldpass'))
                class="active"
              @endif
            ><a href="#password" data-toggle="tab">Change Password</a></li>
          </ul>
          <div class="tab-content">
            <div class="
              @if(!(Session::has('errors') || Session::has('erroroldpass')))
                {{ 'active' }}
              @endif
              tab-pane" id="settings">
              <form class="form-horizontal" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="Name" value="{{ $getProfile->name }}">
                    <input name="id" type="hidden" class="form-control" placeholder="Name" value="{{ $getProfile->id }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input readonly name="email" type="email" class="form-control" placeholder="Email" value="{{ $getProfile->email }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Avatar</label>
                  <div class="col-sm-10">
                    <input name="avatar" type="file" class="form-control" accept=".png, .jpg" value="{{ $getProfile->avatar }}">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                  </div>
                </div>
              </form>
            </div>

            <div class="
              @if(Session::has('errors') || Session::has('erroroldpass'))
                {{ 'active' }}
              @endif
            tab-pane" id="password">
            <form class="form-horizontal" action="{{ route('profile.changePassword') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group {{ $errors->has('oldpass') ? 'has-error' : '' }} {{ Session::has('erroroldpass') ? 'has-error' : ''  }}">
                <label class="col-sm-2 control-label">Old Password</label>
                <div class="col-sm-10">
                  <input name="oldpass" type="password" class="form-control" placeholder="Old Password"   @if(!$errors->has('oldpass'))
                    value="{{ old('oldpass') }}"
                  @endif
                  >
                  <input name="id" type="hidden" class="form-control" value="{{ $getProfile->id }}">
                  @if($errors->has('oldpass'))
                    <span class="help-block">
                      <strong>{{ $errors->first('oldpass') }}
                      </strong>
                    </span>
                  @endif

                  @if(Session::has('erroroldpass'))
                    <span class="help-block">
                      <strong>{{ Session::get('erroroldpass') }}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('newpass') ? 'has-error' : '' }} ">
                <label class="col-sm-2 control-label">New Password</label>
                <div class="col-sm-10">
                  <input name="newpass" type="password" class="form-control" placeholder="New Password" @if(!$errors->has('newpass'))
                    value="{{ old('newpass') }}"
                  @endif
                  >
                  @if($errors->has('newpass'))
                    <span class="help-block">
                      <strong>{{ $errors->first('newpass') }}
                      </strong>
                    </span>
                  @endif
                </div>
            </div>
              <div class="form-group {{ $errors->has('newpass_confirmation') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Confirm New Password</label>
                <div class="col-sm-10">
                  <input name="newpass_confirmation" type="password" class="form-control" placeholder="Confirm New Password"
                  @if(!$errors->has('newpass_confirmation'))
                    value="{{ old('newpass_confirmation') }}"
                  @endif
                  >
                  @if($errors->has('newpass_confirmation'))
                    <span class="help-block">
                      <strong>{{ $errors->first('newpass_confirmation') }}
                      </strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-flat">Change Password</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection


@section('script')
<script>
  window.setTimeout(function() {
    $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
  }, 2000);
  window.setTimeout(function() {
    $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
  }, 5000);
</script>

@endsection
