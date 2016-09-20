@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css')}}">
@endsection

@section('breadcrumb')
  <h1>
      Reservation Management <small>Create New Block Reservation</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="{{ route('reservation') }}">Reservation Management</a></li>
    <li class="active">New Block Reservation</li>
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

    <div class="col-md-4">
      <form class="form-horizontal" method="post" action="{{ route('reservation.blockedit') }}">
        {{ csrf_field() }}
      <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">New Block Reservation</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <div class="{{ $errors->has('branch_id') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Branch</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('branch_id') ? 'has-error' : '' }}">
              <select name="branch_id" class="form-control">
                <option value="-- Choose --">-- Choose --</option>
                @foreach($getBranch as $key)
                  <option value="{{ $key->id }}" {{ $blockFind[0]->branch_id == $key->id ? 'selected' : '' }}>{{ $key->name }}</option>
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
            <div class="{{ $errors->has('block_date') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Date</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('block_date') ? 'has-error' : '' }}">
              <input type="text" name="block_date" class="form-control" id="block_date" value="{{ $blockFind[0]->block_date }}">
              @if($errors->has('block_date'))
                <span class="help-block">
                  <i>* {{$errors->first('block_date')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('notification') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Notification</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('notification') ? 'has-error' : '' }}">
              <input type="text" name="notification" class="form-control" value="{{ $blockFind[0]->notification }}">
              @if($errors->has('notification'))
                <span class="help-block">
                  <i>* {{$errors->first('notification')}}</i>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="{{ $errors->has('blockreservationdetail') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Times</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('blockreservationdetail') ? 'has-error' : '' }}">
              <input type="checkbox" class="minimal-red" name="times" {{  $blockFind[0]->times == '11:00:00' ? 'checked' : '' }} value="11:00"/>&nbsp;11:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times1" {{  $blockFind[0]->times1 == '12:00:00' ? 'checked' : '' }} value="12:00"/>&nbsp;12:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times2" {{  $blockFind[0]->times2 == '13:00:00' ? 'checked' : '' }} value="13:00"/>&nbsp;13:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times3" {{  $blockFind[0]->times3 == '14:00:00' ? 'checked' : '' }} value="14:00"/>&nbsp;14:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times4" {{  $blockFind[0]->times4 == '15:00:00' ? 'checked' : '' }} value="15:00"/>&nbsp;15:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times5" {{  $blockFind[0]->times5 == '16:00:00' ? 'checked' : '' }} value="16:00"/>&nbsp;16:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times6" {{  $blockFind[0]->times6 == '17:00:00' ? 'checked' : '' }} value="17:00"/>&nbsp;17:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times7" {{  $blockFind[0]->times7 == '18:00:00' ? 'checked' : '' }} value="18:00"/>&nbsp;18:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times8" {{  $blockFind[0]->times8 == '19:00:00' ? 'checked' : '' }} value="19:00"/>&nbsp;19:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times9" {{  $blockFind[0]->times9 == '20:00:00' ? 'checked' : '' }} value="20:00"/>&nbsp;20:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times10" {{  $blockFind[0]->times10 == '21:00:00' ? 'checked' : '' }} value="21:00"/>&nbsp;21:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times11" {{  $blockFind[0]->times11 == '22:00:00' ? 'checked' : '' }} value="22:00"/>&nbsp;22:00&nbsp;
              @if($errors->has('blockreservationdetail'))
                <span class="help-block">
                  <i>* {{$errors->first('blockreservationdetail')}}</i>
                </span>
              @endif
            </div>
            <input type="hidden" name="id" class="form-control" value="{{ $blockFind[0]->id }}">
            <input type="hidden" name="blockreservation_id" class="form-control" value="{{ $blockFind[0]->blockreservation_id }}">
            <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn bg-orange pull-right btn-sm btn-flat">Block Reservation</button>
        </div>
      </div>
      </form>
    </div>
  </div>
@endsection


@section('script')
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/iCheck/icheck.min.js')}}"></script>

<script language="javascript">
  //Red color scheme for iCheck
  $('input[type="checkbox"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red'
  });

  $('#block_date').datepicker({
    startDate: '+d',
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true
  });

</script>
@endsection
