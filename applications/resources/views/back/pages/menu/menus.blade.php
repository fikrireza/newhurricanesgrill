@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('breadcrumb')
  <h1>
      Menu Management <small>Menu List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="{{ route('menu.category') }}">Menu Category</a></li>
    <li class="active">Menu List</li>
  </ol>
@stop

@section('content')

  <div class="modal fade" id="myModalCreateMenu" role="dialog">
    <div class="modal-dialog" style="width:500px;">
      <form class="form-horizontal" action="{{ route('menu.menuCreate') }}" method="post">
        {!! csrf_field() !!}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create Ingredient</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
                <label class="col-sm-4 control-label">Menu Name</label>
              </div>
              <div class="col-sm-8 {{ $errors->has('name') ? 'has-error' : '' }}">
                <input type="text" name="name" class="form-control" placeholder="Ingredient Name" value="{{ old('name') }}">
                @if($errors->has('name'))
                  <span class="help-block">
                    <i>* {{$errors->first('name')}}</i>
                  </span>
                @endif
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              </div>
            </div>
            <div class="form-group">
              <div class="{{ $errors->has('menucategory_id') ? 'has-error' : '' }}">
                <label class="col-sm-4 control-label">Category Menu</label>
              </div>
              <div class="col-sm-8 {{ $errors->has('menucategory_id') ? 'has-error' : '' }}">
                <select name="menucategory_id" class="form-control">
                  <option value="-- Choose --">-- Choose --</option>
                  @foreach ($categoryMenus as $key)
                    <option value="{{ $key->id }}" {{ old('menucategory_id') == $key->id ? 'selected' : '' }}>{{ $key->name }}</option>
                  @endforeach
                </select>
                @if($errors->has('menucategory_id'))
                  <span class="help-block">
                    <i>* {{$errors->first('menucategory_id')}}</i>
                  </span>
                @endif
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary bg-orange">Create Menu</button>
          </div>
        </div>
    </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <a href="" data-toggle="modal" data-target="#myModalCreateMenu" class="btn btn-flat bg-red">New Menu</a>
    </div>
  </div>

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

    <div class="col-md-6">
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">Master Menu</h3>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Menu Name</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($menus as $key)
              <tr>
                <td>{{ $key->name }}</td>
                <td>{{ $key->categoryName }}</td>
                <td><span data-toggle="tooltip" title="See Recipe">
                      <a href="{{ url('hurricanesmenu/menu-menus/show/') }}{{ '/'.$key->id}}" class="btn btn-success btn-flat btn-xs edit"><i class="fa fa-file-text-o"> See Recipe</i></a>
                    </span>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>Menu Name</th>
              <th>Category</th>
              <th></th>
            </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

  </div>
@stop

@section('script')
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script type="text/javascript">
@if (count($errors) > 0)
  $('#myModalCreateMenu').modal('show');
@endif
</script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
<script>

  $('a.edit').click(function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{ url('/') }}/hurricanesmenu/menu-ingredientsbind/"+a,
      dataType: 'json',
      success: function(data){
        //get
        var id = data.id;
        var name = data.name;
        var unit = data.unit;
        var user_id = data.user_id;

        // set
        $('#editId').attr('value', id);
        $('#editName').attr('value', name);
        $('#editUnit').attr('value', unit);
        $('#editUser').attr('value', user_id);
      }
    });
  });

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
