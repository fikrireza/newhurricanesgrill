@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('breadcrumb')
  <h1>
      Menu Management <small>Menu Category List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Menu Management</li>
  </ol>
@stop

@section('content')
  <div class="modal fade" id="myModalDeleteCategory" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Remove Category</h4>
        </div>
        <div class="modal-body">
          <p>Are You Sure to Remove This Category ?</p>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">No</button>
          <a class="btn btn-danger btn-flat" id="deleteCategory">Yes, I'm Sure</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModalEditCategory" role="dialog">
    <div class="modal-dialog" style="width:500px;">
      <form class="form-horizontal" action="{{ route('menu.categoryUpdate') }}" method="post">
        {!! csrf_field() !!}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Category Menu</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="{{ $errors->has('editName') ? 'has-error' : '' }}">
                <label class="col-sm-4 control-label">Category Name</label>
              </div>
              <div class="col-sm-8 {{ $errors->has('editName') ? 'has-error' : '' }}">
                <input type="text" name="editName" class="form-control" placeholder="Category Menu" id="editName" value="{{ old('editName') }}">
                @if($errors->has('editName'))
                  <span class="help-block">
                    <i>* {{$errors->first('editName')}}</i>
                  </span>
                @endif
                <input type="hidden" name="editId" id="editId" value="">
                <input type="hidden" name="editUser_id" value="{{ Auth::user()->id }}">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary bg-orange">Update Category</button>
          </div>
        </div>
    </form>
    </div>
  </div>

  <div class="modal fade" id="myModalCreateCategory" role="dialog">
    <div class="modal-dialog" style="width:500px;">
      <form class="form-horizontal" action="{{ route('menu.categoryCreate') }}" method="post">
        {!! csrf_field() !!}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create Category Menu</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
                <label class="col-sm-4 control-label">Category Name</label>
              </div>
              <div class="col-sm-8 {{ $errors->has('name') ? 'has-error' : '' }}">
                <input type="text" name="name" class="form-control" placeholder="Category Menu" value="{{ old('name') }}">
                @if($errors->has('name'))
                  <span class="help-block">
                    <i>* {{$errors->first('name')}}</i>
                  </span>
                @endif
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary bg-orange">Create Category</button>
          </div>
        </div>
    </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <a href="" data-toggle="modal" data-target="#myModalCreateCategory" class="btn btn-flat bg-red">New Category</a>
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
    @foreach ($categoryMenus as $category)
    <div class="col-md-3">
      <div class="box box-widget widget-user-2">
        <div class="widget-user-header bg-white">
          <h5 class="widget-user-desc">
            <span data-toggle="tooltip" title="Edit Category">
              <a href="" class="btn btn-warning btn-flat btn-xs edit" data-toggle="modal" data-target="#myModalEditCategory" data-value="{{ $category->id }}"><i class="fa fa-edit"> Edit</i></a>
            </span>
            <span data-toggle="tooltip" title="Delete Category">
              <a href="" class="btn btn-default btn-flat btn-xs trash" data-toggle="modal" data-target="#myModalDeleteCategory" data-value="{{ $category->id }}"><i class="fa fa-trash"> Trash</i></a>
            </span>
          </h5>
          <h3 class="widget-user-username">{{ $category->name }}</h3>
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
            @foreach ($menus as $menu)
            @if($category->id == $menu->menucategory_id)
            <li><a href="{{ $menu->id }}">{{ $menu->name }}</a></li>
            @endif
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    @endforeach

  </div>
@stop

@section('script')
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script type="text/javascript">
@if (count($errors) > 0)
  $('#myModalCreateCategory').modal('show');
@endif
</script>

<script>
  $('a.trash').click(function(){
    var a = $(this).data('value');
    $('#deleteCategory').attr('href', "{{ url('/') }}/hurricanesmenu/menu-categorytrash/"+a);
  });

  $('a.edit').click(function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{ url('/') }}/hurricanesmenu/menu-categorybind/"+a,
      dataType: 'json',
      success: function(data){
        //get
        var id = data.id;
        var name = data.name;
        var user_id = data.user_id;

        // set
        $('#editId').attr('value', id);
        $('#editName').attr('value', name);
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
