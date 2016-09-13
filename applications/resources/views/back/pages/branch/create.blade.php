@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('breadcrumb')
  <h1>
      Branch Management <small>Create New Branch</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="{{ route('branch') }}">Branch Management</a></li>
    <li class="active">New Branch</li>
  </ol>
@stop

@section('content')
  <div class="row">
    <!-- START MESSAGE -->
    <div class="col-md-12">
      @if(Session::has('message'))
      <div class="alert alert-success panjang">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Succeed!</h4>
        <p>{{ Session::get('message') }}</p>
      </div>
      @endif
    </div>
    <!-- START FORM-->
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
              <h3 class="box-title">Add New Branch</h3>
          </div>
          <form class="form-horizontal" method="post" action="{{ route('branch.create') }}">
            {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Name</label>
              </div>
              <div class="col-sm-10 {{ $errors->has('name') ? 'has-error' : '' }}">
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                @if($errors->has('name'))
                  <span class="help-block">
                    <i>* {{$errors->first('name')}}</i>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="{{ $errors->has('address') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Address</label>
              <div class="col-sm-10 {{ $errors->has('address') ? 'has-error' : '' }}">
                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ old('address') }}">
                @if($errors->has('address'))
                  <span class="help-block">
                    <i>* {{$errors->first('address')}}</i>
                  </span>
                @endif
              </div>
            </div>
            </div>
            <div class="form-group">
              <div class="{{ $errors->has('description') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Description</label>
              </div>
              <div class="col-sm-10 {{ $errors->has('description') ? 'has-error' : '' }}">
                <textarea class="textarea form-control" name="description" placeholder="Description Open Hours" style="width: 100%; height: 200px; font-size: 14px; border: 1px solid #dddddd; padding: 10px;">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                  <span class="help-block">
                    <i>* {{$errors->first('description')}}</i>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="{{ $errors->has('phone') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Phone</label>
              </div>
              <div class="col-sm-10 {{ $errors->has('phone') ? 'has-error' : '' }}">
                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}">
                @if($errors->has('phone'))
                  <span class="help-block">
                    <i>* {{$errors->first('phone')}}</i>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="{{ $errors->has('hotline') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Hotline</label>
              </div>
              <div class="col-sm-10 {{ $errors->has('hotline') ? 'has-error' : '' }}">
                <input type="text" name="hotline" class="form-control" placeholder="Hotline" value="{{ old('hotline') }}">
                @if($errors->has('hotline'))
                  <span class="help-block">
                    <i>* {{$errors->first('hotline')}}</i>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="{{ $errors->has('maps') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Maps</label>
              </div>
              <div class="col-sm-10 {{ $errors->has('maps') ? 'has-error' : '' }}">
                <input type="text" name="maps" class="form-control" placeholder="Maps" value="{{ old('maps') }}">
                @if($errors->has('maps'))
                  <span class="help-block">
                    <i>* {{$errors->first('maps')}}</i>
                  </span>
                @endif
                <input type="hidden" name="user_id" value="0">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn bg-orange pull-right btn-sm btn-flat">Create Branch</button>
          </div>
        </div>
      </div>
    </form>
    <!-- END FORM-->
@endsection


@section('script')
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
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
@endsection
