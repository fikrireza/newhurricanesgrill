@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('breadcrumb')
  <h1>
      Reservation Management <small>Payment List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    @if(isset($paymentSearch))
    <li><a href="{{ route('reservation.payment') }}">Payment List</a></li>
    <li class="active">Payment List Seacrh</li>
    @else
    <li class="active">Payment List</li>
    @endif
  </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-5 col-md-offset-3">
      <div class="box box-danger">
        <div class="box-header with-border">
          <div class="box-title">
            <p>Search Payment Date</p>
          </div>
        </div>
        <form action="{{ route('reservation.paymentsearch') }}" method="POST">
        {{ csrf_field() }}
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              From
              <input type="text" class="form-control" name="from" id="from" placeholder="yyyy-mm-dd" value="@if(isset($paymentSearch)){{ $from }} @endif">
            </div>
            <div class="col-xs-6">
              To
              <input type="text" class="form-control" name="to" id="to" placeholder="yyyy-mm-dd" value="@if(isset($paymentSearch)){{ $to }} @endif">
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
        <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="example1">
            <thead>
              <tr class="bg-red">
                <th>Transfer Date</th>
                <th>Account Name</th>
                <th>Total Payment</th>
                <th>Booking Date</th>
                <th>Booking Code</th>
                <th>Receipt</th>
                <th>Branch</th>
              </tr>
            </thead>
            @if (isset($paymentSearch))
              @foreach($paymentSearch as $key)
              <tr>
                <td>{{ $key->date_payment }}</td>
                <td>{{ $key->acc_name }}</td>
                <td>Rp. {{ number_format($key->total_payment,0,',','.') }},-</td>
                <td>{{ date('Y-M-d', strtotime($key->booking_date)) }}</td>
                <td>{{ $key->booking_code }}</td>
                <td>@if($key->paymentimg != null)<a href="{{ asset('documents') }}/{{$key->paymentimg}}">{{ $key->paymentimg }}</a> @else - @endif</td>
                <td>{{ $key->branch_name }}</td>
              </tr>
              @endforeach
            @else
              @foreach($payments as $payment)
              <tr>
                <td>{{ $payment->date_payment }}</td>
                <td>{{ $payment->acc_name }}</td>
                <td>Rp. {{ number_format($payment->total_payment,0,',','.') }},-</td>
                <td>{{ date('Y-M-d', strtotime($payment->booking_date)) }}</td>
                <td>{{ $payment->booking_code }}</td>
                <td>@if($payment->paymentimg != null)<a href="{{ asset('documents') }}/{{$payment->paymentimg}}" download>{{ $payment->paymentimg }}</a> @else - @endif</td>
                <td>{{ $payment->branch_name }}</td>
              </tr>
              @endforeach
            @endif
          </table>
        </div>
        <div class="box-footer">

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
    $('#from').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    });

    $('#to').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    });

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script>

@endsection
