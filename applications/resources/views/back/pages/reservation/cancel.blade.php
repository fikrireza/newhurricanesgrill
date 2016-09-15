@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('breadcrumb')
  <h1>
      Reservation Management <small>Cancelled Reservation</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="{{ route('reservation') }}">Reservation Management</a></li>
    <li class="active">Cancelled Reservation</li>
  </ol>
@stop

@section('content')
  <div class="row">

    <div class="col-md-12">
      @if(Session::has('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Succeed!</h4>
          <p>{{ Session::get('message') }}</p>
        </div>
      @endif
    </div>

    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr class="bg-red">
                <th>Booking Code</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Name</th>
                <th>Handphone</th>
                <th>Size</th>
                <th>Email</th>
                <th>Special Request</th>
                <th>Creator</th>
                <th>Action</th>
              </tr>
            </thead>
            @foreach($allCancel as $key)
            <tr>
              <td>{{ $key->booking_code  }}</td>
              <td>{{date("d-M-Y",strtotime($key->reserve_date))}}</td>
              <td>{{ $key->reserve_time  }}</td>
              <td>{{ $key->branch_name  }}</td>
              <td>{{ $key->name  }}</td>
              <td>{{ $key->handphone  }}</td>
              <td>{{ $key->size  }}</td>
              <td>{{ $key->email  }}</td>
              <td>{{ $key->specialreq  }}</td>
              <td>{{ $key->username  }}</td>
              <td>@if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 3 || Auth::user()->level == 4)
              <span data-toggle="tooltip" title="Edit Reservation">
                <a href="{{ url('hurricanesmenu/reservation-bind') }}{{'/'.$key->id }}" class="btn bg-blue btn-block btn-xs" data-value="{{ $key->id }}"><i class="fa fa-edit"></i></a>
              </span>&nbsp;@endif
              @if($key->size > 9)
                @if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 3 || Auth::user()->level == 4)
              <span data-toggle="tooltip" title="Confirm Reservation">
                <a href="{{ url('hurricanesmenu/reservation-accept') }}{{'/'.$key->id }}" class="btn btn-default btn-flat btn-xs" data-value="{{ $key->id }}"><i class="fa fa-check-square-o"></i></a>
              </span>
                @endif
              @endif</td>
            </tr>
            @endforeach
          </table>
        </div>
        <div class="box-footer">
          <div class="pagination pagination-sm no-margin pull-right">
            {{ $allCancel->links() }}
          </div>
        </div>
      </div>
    </div>

  </div>
@stop

@section('script')
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
<script type="text/javascript">
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script>
<script type="text/javascript">
  $(function(){
    $('a.nonactive').click(function(){
      var a = $(this).data('value');
      $('#setnonactive').attr('href', "{{ url('/') }}/hurricanesmenu/branch-nonactive/"+a);
    });

    $('a.active').click(function(){
      var a = $(this).data('value');
      $('#setactive').attr('href', "{{ url('/') }}/hurricanesmenu/branch-active/"+a);
    });
  });
</script>

<script type="text/javascript">
@if (count($errors) > 0)
  $('#myModalEdit').modal('show');
@endif
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
