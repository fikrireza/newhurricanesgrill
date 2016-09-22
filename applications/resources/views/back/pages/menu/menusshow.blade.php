@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('breadcrumb')
  <h1>
      Menu Management <small>Menu Recipe</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="{{ route('menu.category') }}">Menu Category</a></li>
    <li><a href="{{ route('menu.menus') }}">Menu</a></li>
    <li class="active">Menu Recipe</li>
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
      @if(Session::has('success'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Succeed!</h4>
          <p>{{ Session::get('success') }}</p>
        </div>
      @endif
      <br />
    </div>
  </div>

  <div class="row">
    <?php
      if($menus[0]->image == null){
          $bg = asset('images/default-menu.png');
      }else{
          $bg = asset('images/').$menus[0]->image;
      }
    ?>
    <div class="col-md-5">
      <div class="box box-widget widget-user">
        <div class="widget-user-header bg-black" style="background: url('{{ $bg }}') center center;min-height:350px;">
          <h3 class="widget-user-username">{{ $menus[0]->name }}</h3>
          <h5 class="widget-user-desc">{{ $menus[0]->category }}</h5>
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-12">
              <div class="description-block">
                <h5 class="description-header">{{ $menus[0]->name }}</h5>
                <span class="description-text">{{ $menus[0]->category }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Ingredients</h3>
        </div>

        <div class="box-body">
          <div class="progress">
            <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
              <span class="sr-only">40% Complete (success)</span>
            </div>
          </div>
        </div>

        <div class="box-header with-border">
          <h3 class="box-title">Instructions</h3>
        </div>
        <div class="box-body">
          <div class="progress">
            <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
              <span class="sr-only">80% Complete</span>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box -->
    </div>

  </div>
@stop

@section('script')
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

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
