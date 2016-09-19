@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('breadcrumb')
  <h1>
      Reservation Management <small>Create New Reservation</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="{{ route('reservation') }}">Reservation Management</a></li>
    <li class="active">New Reservation</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <div class="alert alert-success panjang">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Succeed!</h4>
        <p>{{ Session::get('message') }}</p>
      </div>
      @endif
    </div>
    <div class="col-md-6">
      <form class="form-horizontal" method="post" action="{{ route('reservation.store') }}">
        {{ csrf_field() }}
      <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">New Reservation</h3>
        </div>
        <div class="box-body">
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
              <input type="text" name="handphone" class="form-control" placeholder="Handphone" value="{{ old('handphone') }}" maxlength="17" onkeypress="return isNumber(event)">
              @if($errors->has('handphone'))
                <span class="help-block">
                  <i>* {{$errors->first('handphone')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('size') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Size</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('size') ? 'has-error' : '' }}">
              <input type="text" name="size" class="form-control" placeholder="Size" value="{{ old('size') }}" maxlength="3" onkeypress="return isNumber(event)">
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
            <div class="">
              <label class="col-sm-3 control-label">Special Request</label>
            </div>
            <div class="col-sm-9">
              <textarea class="textarea form-control" name="specialreq" placeholder="Special Request Form Customer" style="width: 100%; height: 200px; font-size: 14px; border: 1px solid #dddddd; padding: 10px;">{{ old('specialreq') }}</textarea>
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn bg-orange pull-right btn-sm btn-flat">Create Reservation</button>
        </div>
      </div>
      </form>
    </div>
@endsection


@section('script')
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
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
  //Date picker
  $('#reserve_date').datepicker({
    startDate: '+d',
    format: 'dd-M-yyyy',
    todayHighlight: true,
    autoclose: true
  });
</script>
<script>
  $(function () {
    $(".textarea").wysihtml5({
      toolbar: {
          "font-styles": false, //Font styling, e.g. h1, h2, etc.
          "emphasis": false, //Italics, bold, etc.
          "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers.
          "html": false, //Button which allows you to edit the generated HTML.
          "link": false, //Button to insert a link.
          "image": false, //Button to insert an image.
          "color": false, //Button to change color of font
          "blockquote": false
        }
    });
  });
</script>
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
