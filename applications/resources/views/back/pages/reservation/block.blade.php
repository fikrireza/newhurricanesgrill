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
      <form class="form-horizontal" method="post" action="{{ route('reservation.blockcreate') }}">
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
            <div class="{{ $errors->has('block_date') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label">Date</label>
            </div>
            <div class="col-sm-9 {{ $errors->has('block_date') ? 'has-error' : '' }}">
              <input type="text" name="block_date" class="form-control" id="block_date" placeholder="yyyy-mm-dd" value="{{ old('block_date') }}">
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
              <input type="text" name="notification" class="form-control" value="{{ old('notification') }}">
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
              <input type="checkbox" class="minimal-red" name="times" value="11:00"/>&nbsp;11:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times1" value="12:00"/>&nbsp;12:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times2" value="13:00"/>&nbsp;13:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times3" value="14:00"/>&nbsp;14:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times4" value="15:00"/>&nbsp;15:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times5" value="16:00"/>&nbsp;16:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times6" value="17:00"/>&nbsp;17:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times7" value="18:00"/>&nbsp;18:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times8" value="19:00"/>&nbsp;19:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times9" value="20:00"/>&nbsp;20:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times10" value="21:00"/>&nbsp;21:00&nbsp;
              <input type="checkbox" class="minimal-red" name="times11" value="22:00"/>&nbsp;22:00&nbsp;
              @if($errors->has('blockreservationdetail'))
                <span class="help-block">
                  <i>* {{$errors->first('blockreservationdetail')}}</i>
                </span>
              @endif
            </div>
            <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn bg-orange pull-right btn-sm btn-flat">Block Reservation</button>
        </div>
      </div>
      </form>
    </div>

    <div class="col-md-8">
      <div class="box box-danger">
        <div class="box-header with-border">
          <div class="box-title">
            All Blocked Reservation
          </div>
        </div>
        <div class="box-body">
          <table class="table table-hover">
            <tr class="bg-red">
              <th>Branch</th>
              <th>Date</th>
              <th>Times</th>
              <th>Notification</th>
              <th>Creator</th>
              <th colspan="2">Action</th>
            </tr>
            @if($getReservationBlock->isEmpty())
            <tr>
              <td colspan="7">Empty Data</td>
            </tr>
            @else
            @foreach($getReservationBlock as $block)
            <tr style="font-size:13px;">
              <td>{{ $block->name }}</td>
              <td>{{ date('Y-M-d', strtotime($block->block_date)) }}</td>
              <td>{{ $block->times }} {{$block->times1}} {{$block->times2}} {{$block->times3}} {{$block->times4}} {{$block->times5}} {{$block->times6}} {{$block->times7}} {{$block->times8}} {{$block->times9}} {{$block->times10}} {{$block->times11}}</td>
              <td>{{ $block->notification }}</td>
              <td>{{ $block->username}}</td>
              <td><span data-toggle="tooltip" title="Edit">
                    <a href="{{ url('hurricanesmenu/reservation-blockbind/') }}{{'/'.$block->blockreservation_id}}" class="btn btn-warning btn-flat btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                  </span>
                  <span data-toggle="tooltip" title="Delete">
                    <a href="" class="btn btn-danger btn-flat btn-xs delete" data-toggle="modal" data-target="#myModalDelete" data-value="{{ $block->id }}"><i class="fa fa-trash"></i> Delete</a>
                  </span>
              </td>
            </tr>
            @endforeach
            @endif
          </table>
        </div>
      </div>
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
