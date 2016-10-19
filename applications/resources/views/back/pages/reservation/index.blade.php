@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('breadcrumb')
  <h1>
      Reservation Management <small>Reservation List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Reservation Management</li>
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

    <div class="modal fade" id="myModalAktif" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Activated Branch</h4>
          </div>
          <div class="modal-body">
            <p>Are You Sure to Activated This Branch ?</p>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">No</button>
            <a class="btn btn-danger btn-flat" id="setactive">Yes, I'm Sure</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="myModalNonAktif" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">DeActivated Branch</h4>
          </div>
          <div class="modal-body">
            <p>Are You Sure to DeActivated This Branch ?</p>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">No</button>
            <a class="btn btn-danger btn-flat" id="setnonactive">Yes, I'm Sure</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-10 col-md-offset-1">
      <div class="box box-danger">
        <div class="box-header with-border">
          <div class="box-title">
            <p>Search Reservation</p>
          </div>
        </div>
        <form action="{{ route('reservation.search') }}" method="POST">
        {{ csrf_field() }}
        <div class="box-body">
          <div class="row">
            <div class="col-xs-3">
              <input type="text" class="form-control" name="booking_code" placeholder="Booking Code" value="">
            </div>
            <div class="col-xs-3">
              <input type="text" class="form-control" name="reserve_date" id="reserve_date" value="">
            </div>
            <div class="col-xs-3">
              <select name="season" class="form-control">
                <option value="all">-- Choose --</option>
                <option value="lunch">Lunch</option>
                <option value="dinner">Dinner</option>
              </select>
            </div>
            <div class="col-xs-3">
              <select name="branch_id" class="form-control">
                <option value="all">-- Choose --</option>
                @foreach($branch_id as $key)
                  <option value="{{ $key->id }}">{{ $key->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button class="btn btn-block bg-orange">Search</button>
        </div>
        </form>
      </div>
    </div>

    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <div class="box-title">
            <a href="{{ route('reservation.create') }}"><button class="btn btn-block bg-orange">New Reservation</button></a>
          </div>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped">
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
                <th>Input Time</th>
                <th>Action</th>
              </tr>
            </thead>
            @if($allReservation == null)
            <tbody>
              <tr>
                <td colspan="12" align="center">Empty Data</td>
              </tr>
            </tbody>
            @else
              <?php $grandTotal = 0; ?>
              @foreach($allReservation as $reservation)
              @foreach($reservation as $reservation_time)

              @if($reservation_time['size'] > 9 && $reservation_time['status'] == 0)
              <tr style="background:#000;color:#FFF">
              @elseif($reservation_time['username'] == '' && $reservation_time['status'] == 0)
              <tr style="background:#C96;">
              @elseif($reservation_time['status'] == 1)
              <tr style="background:#CCC">
              @elseif($reservation_time['status'] == 5)
              <tr style="background:#F96">
              @endif
                <td>{{ $reservation_time['booking_code'] }}</td>
                <td>{{date("d-M-Y",strtotime($reservation_time['reserve_date']))}}</td>
                <td>{{ $reservation_time['reserve_time'] }}</td>
                <td>{{ $reservation_time['branch_name'] }}</td>
                <td>{{ $reservation_time['name'] }}</td>
                <td>{{ $reservation_time['handphone'] }}</td>
                <td>{{ $reservation_time['size'] }}</td>
                <td>{{ $reservation_time['email'] }}</td>
                <td>{!! $reservation_time['specialreq'] !!}</td>
                <td>@if($reservation_time['username'] != '')
                    {{ $reservation_time['username'] }}
                  @else
                    Web
                  @endif</td>
                <td>{{ $reservation_time['created_at'] }}</td>
                <td>
                  @if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 3 || Auth::user()->level == 4)
                  <span data-toggle="tooltip" title="Edit Reservation">
                    <a href="{{ url('hurricanesmenu/reservation-bind') }}{{'/'.$reservation_time['id']}}" class="btn bg-blue btn-block btn-xs" data-value="{{ $reservation_time['id'] }}"><i class="fa fa-edit"></i></a>
                  </span>&nbsp;
                  @if($reservation_time['status'] == 0)
                  <span data-toggle="tooltip" title="Cancel Reservation">
                    <a href="{{ url('hurricanesmenu/reservation-cancelled') }}{{'/'.$reservation_time['id']}}" class="btn bg-red btn-block btn-xs" data-value="{{ $reservation_time['id'] }}"><i class="fa fa-ban"></i></a>
                  </span>&nbsp;
                  <span data-toggle="tooltip" title="Accept Reservation">
                    <a href="{{ url('hurricanesmenu/reservation-accept') }}{{'/'.$reservation_time['id']}}" class="btn bg-olive btn-block btn-xs" data-value="{{ $reservation_time['id'] }}"><i class="fa fa-check"></i></a>
                  </span>
                  @else
                  <span data-toggle="tooltip" title="Cancel Reservation">
                    <a href="{{ url('hurricanesmenu/reservation-cancelled') }}{{'/'.$reservation_time['id']}}" class="btn bg-red btn-block btn-xs disabled" data-value="{{ $reservation_time['id'] }}"><i class="fa fa-ban"></i></a>
                  </span>&nbsp;
                  <span data-toggle="tooltip" title="Accept Reservation">
                    <a href="{{ url('hurricanesmenu/reservation-accept') }}{{'/'.$reservation_time['id']}}" class="btn bg-olive btn-block btn-xs disabled" data-value="{{ $reservation_time['id'] }}"><i class="fa fa-check"></i></a>
                  </span>&nbsp;
                  @endif
                  @endif
                  @if($reservation_time['size'] > 9)
                    @if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 4)
                  <span data-toggle="tooltip" title="Confirm Reservation">
                    <a href="{{ url('hurricanesmenu/reservation-accept') }}{{'/'.$reservation_time['id']}}" class="btn bg-green btn-block btn-xs" data-value="{{ $reservation_time['id'] }}"><i class="fa fa-check-square-o"></i></a>
                  </span>
                    @endif
                  @endif</td>
              </tr>
              <?php $grandTotal++; ?>
              @endforeach
              <tr style="background:#069;color:#FFF">
                <td colspan="6">Reservation Total : </td>
                <td></td>
                <td colspan="5"></td>
              </tr>
              @endforeach
              <tr style="background:#069;color:#FFF">
                <td colspan="6">Reservation Grand Total : {{ $grandTotal }}</td>
                <td>{{ $getSize[0]->total_size }}</td>
                <td colspan="5"></td>
              </tr>
            @endif
          </table>
        </div>
        <div class="box-footer">
          <div class="pagination pagination-sm no-margin pull-right">
            {{-- {{ $getReservation->links() }} --}}
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
    $('#reserve_date').datepicker({
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
  $(function () {
    $(".textarea").wysihtml5({
      toolbar: {
          "font-styles": true, //Font styling, e.g. h1, h2, etc.
          "emphasis": false, //Italics, bold, etc.
          "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers.
          "html": true, //Button which allows you to edit the generated HTML.
          "link": false, //Button to insert a link.
          "image": false, //Button to insert an image.
          "color": true //Button to change color of font
        }
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
