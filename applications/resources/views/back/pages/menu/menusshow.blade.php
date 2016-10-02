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
  <?php
    if($menus[0]->image == null){
        $bg = asset('images/default-menu.png');
    }else{
        $bg = asset('images').'/'.$menus[0]->image;
    }
  ?>
  <div class="modal fade" id="myModalCreateImage" role="dialog">
    <div class="modal-dialog" style="width:500px;">
      <form class="form-horizontal" action="{{ route('menu.menuImage') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Upload Image</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="{{ $errors->has('image') ? 'has-error' : '' }}">
                <label class="col-sm-4 control-label">File Image</label>
              </div>
              <div class="col-sm-8 {{ $errors->has('image') ? 'has-error' : '' }}">
                <input type="file" name="image" class="form-control" accept=".png, .jpg" value="{{ old('image') }}">
                <span><i>{{ $menus[0]->image }}</i></span>
                @if($errors->has('image'))
                <span class="help-block">
                  <i>* {{$errors->first('image')}}</i>
                </span>
                @endif
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                <input type="hidden" name="menu_id" value="{{ $menus[0]->id }}" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary bg-orange">Upload</button>
          </div>
        </div>
    </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-5">
      <div class="box box-widget widget-user">
        <div class="widget-user-header bg-black" style="background: url('{{ $bg }}') center center;min-height:350px;">
          <h3 class="widget-user-username pull-left">{{ $menus[0]->name }}</h3>
          <h3 class="widget-user-username pull-right"><span data-toggle="tooltip" title="Change Image">
            <a href="" data-toggle="modal" data-target="#myModalCreateImage" class="btn bg-orange btn-flat btn-xs edit"><i class="fa fa-file-text-o"> Change</i></a>
          </span></h3>
          <div class="clearfix"></div>
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
          <h2 class="box-title pull-left">Ingredients</h2>
          <h3 class="box-title pull-right">
            @if ($ingredients->isEmpty())
              <span data-toggle="tooltip" title="Create Recipe">
                <a href="{{ url('hurricanesmenu/menu-menus/recipe-create/') }}{{ '/'.$menus[0]->id}}" class="btn bg-red btn-flat btn-xs edit"><i class="fa fa-plus"> Create</i></a>
              </span>
            @else
              <span data-toggle="tooltip" title="Edit Recipe">
                <a href="{{ url('hurricanesmenu/menu-menus/recipe-edit/') }}{{ '/'.$menus[0]->id}}" class="btn bg-orange btn-flat btn-xs edit"><i class="fa fa-edit"> Edit</i></a>
              </span>
            @endif
          </h3>
        </div>

        <div class="box-body">
          <table class="table">
            <thead>
              <th width="100px"></th>
              <th width="45px"></th>
              <th width="55px"></th>
            </thead>
            <tbody>
              @if ($ingredients->isEmpty())
              <tr>
                <td colspan="2">No Data in This Record</td>
              </tr>
              @else
              @foreach ($ingredients as $key)
              <tr>
                <td>{{ $key->name }}</td>
                <td>{{ $key->size }} {{ $key->unit }}</td>
                <td>{{ $key->notes }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="box-header with-border">
          <h2 class="box-title pull-left">Instructions</h2>
          <h3 class="box-title pull-right">
          @if ($menus[0]->directions == null)
          <span data-toggle="tooltip" title="Create Recipe">
            <a href="{{ url('hurricanesmenu/menu-menus/directions-create/') }}{{ '/'.$menus[0]->id}}" class="btn bg-red btn-flat btn-xs edit"><i class="fa fa-plus"> Create</i></a>
          </span>
          @else
          <span data-toggle="tooltip" title="Edit Recipe">
            <a href="{{ url('hurricanesmenu/menu-menus/directions-edit/') }}{{ '/'.$menus[0]->id}}" class="btn bg-orange btn-flat btn-xs edit"><i class="fa fa-edit"> Edit</i></a>
          </span>
          @endif</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <th colspan="2"></th>
            </thead>
            <tbody>
              @if ($menus[0]->directions == null)
              <tr>
                <td colspan="2">No Data in This Record</td>
              </tr>
              @else
              <tr>
                <td>{!! $menus[0]->directions !!}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>

  </div>
@stop

@section('script')
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script type="text/javascript">
@if (count($errors) > 0)
  $('#myModalCreateImage').modal('show');
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
