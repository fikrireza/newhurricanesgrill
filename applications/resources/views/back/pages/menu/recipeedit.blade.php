@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
@endsection

@section('breadcrumb')
  <h1>
      Menu Management <small>Menu Recipe</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="{{ route('menu.category') }}">Menu Category</a></li>
    <li><a href="{{ route('menu.menus') }}">Menu</a></li>
    <li class="active">Edit Menu Recipe</li>
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

    <div class="modal fade" id="myModalEdit" role="dialog">
      <div class="modal-dialog" style="width:500px;">
        <form class="form-horizontal" action="{{ route('menu.recipeChange') }}" method="post">
          {!! csrf_field() !!}
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Ingredient</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="user_id" class="form-control" id="editUser" value="{{ Auth::user()->id }}">
              <input type="hidden" name="menu_id" id="editMenu_id" value="{{ $menus->id }}" />
              <input type="hidden" name="editId" id="editId" />
              <div class="form-group">
                <div class="{{ $errors->has('editIngredients_id') ? 'has-error' : '' }}">
                  <label class="col-sm-2 control-label">Ingredient</label>
                </div>
                <div class="col-sm-10 {{ $errors->has('editIngredients_id') ? 'has-error' : '' }}">
                  <select name="editIngredients_id" class="form-control" style="width:100%">
                    <option value="">-- Choose --</option>
                    @foreach ($ingredients as $key)
                      <option value="{{ $key->id }}" id="editIngredients_id{{$key->id}}" {{ old('editIngredients_id')== $key->id ? 'selected' : '' }} >{{ $key->name }}&nbsp;&nbsp;-&nbsp;&nbsp;({{ $key->unit }})</option>
                    @endforeach
                  </select>
                  @if($errors->has('editIngredients_id'))
                    <span class="help-block">
                      <i>* {{$errors->first('editIngredients_id')}}</i>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="{{ $errors->has('editSize') ? 'has-error' : '' }}">
                  <label class="col-sm-2 control-label">Size</label>
                <div class="col-sm-4 {{ $errors->has('editSize') ? 'has-error' : '' }}">
                  <input type="text" name="editSize" id="editSize" class="form-control" placeholder="Size" value="{{ old('editSize') }}" onkeypress="return isNumber(event)">
                  @if($errors->has('editSize'))
                    <span class="help-block">
                      <i>* {{$errors->first('editSize')}}</i>
                    </span>
                  @endif
                </div>
              </div>
              </div>
              <div class="form-group">
                <div class="{{ $errors->has('editNotes') ? 'has-error' : '' }}">
                  <label class="col-sm-2 control-label">Notes</label>
                </div>
                <div class="col-sm-10 {{ $errors->has('editNotes') ? 'has-error' : '' }}">
                  <input type="text" name="editNotes" id="editNotes" class="form-control" placeholder="Notes" value="{{ old('editNotes') }}" />
                  @if($errors->has('editNotes'))
                    <span class="help-block">
                      <i>* {{$errors->first('editNotes')}}</i>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary bg-orange">Change Ingredient</button>
            </div>
          </div>
      </form>
      </div>
    </div>

    <div class="modal fade" id="myModalAdd" role="dialog">
      <div class="modal-dialog" style="width:500px;">
        <form class="form-horizontal" action="{{ route('menu.recipeAdd') }}" method="post">
          {!! csrf_field() !!}
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add Ingredient</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" name="user_id" class="form-control" id="editUser" value="{{ Auth::user()->id }}">
              <input type="hidden" name="menu_id" value="{{ $menus->id }}" />
              <div class="form-group">
                <div class="{{ $errors->has('ingredients') ? 'has-error' : '' }}">
                  <label class="col-sm-2 control-label">Ingredient</label>
                </div>
                <div class="col-sm-10 {{ $errors->has('ingredients') ? 'has-error' : '' }}">
                  <select name="ingredients" class="form-control select2" style="width:100%">
                    <option value="">-- Choose --</option>
                    @foreach ($ingredients as $key)
                      <option value="{{ $key->id }}">{{ $key->name }}&nbsp;&nbsp;-&nbsp;&nbsp;({{ $key->unit }})</option>
                    @endforeach
                  </select>
                  @if($errors->has('ingredients'))
                    <span class="help-block">
                      <i>* {{$errors->first('ingredients')}}</i>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="{{ $errors->has('size') ? 'has-error' : '' }}">
                  <label class="col-sm-2 control-label">Size</label>
                <div class="col-sm-4 {{ $errors->has('size') ? 'has-error' : '' }}">
                  <input type="text" name="size" class="form-control" placeholder="Size" value="{{ old('size') }}" onkeypress="return isNumber(event)">
                  @if($errors->has('size'))
                    <span class="help-block">
                      <i>* {{$errors->first('size')}}</i>
                    </span>
                  @endif
                </div>
              </div>
              </div>
              <div class="form-group">
                <div class="{{ $errors->has('notes') ? 'has-error' : '' }}">
                  <label class="col-sm-2 control-label">Notes</label>
                </div>
                <div class="col-sm-10 {{ $errors->has('notes') ? 'has-error' : '' }}">
                  <input type="text" name="notes" class="form-control" placeholder="Notes" value="{{ old('notes') }}" />
                  @if($errors->has('notes'))
                    <span class="help-block">
                      <i>* {{$errors->first('notes')}}</i>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary bg-orange">Add Ingredients</button>
            </div>
          </div>
      </form>
      </div>
    </div>

    <div class="col-md-8">
      <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $menus->name }} - Edit Recipe</h3>
        </div>
        <div class="box-body">
          <input type="hidden" name="menu_id" value="{{ $menus->id }}" />
          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th width="400px">Ingredients</th>
                <th width="70px">Size</th>
                <th width="200px">Notes</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($recipes as $recipe)
            <tr>
              <td><input type="checkbox" name="chk"/></td>
              <td>{{ $recipe->name}}</td>
              <td>{{ $recipe->size }}</td>
              <td>@if($recipe->notes != null){{ $recipe->notes }}@else - @endif</td>
              <td><span data-toggle="tooltip" title="Edit Ingredient">
                    <a href="" class="btn btn-warning btn-flat btn-xs edit" data-toggle="modal" data-target="#myModalEdit" data-value="{{ $recipe->id }}"><i class="fa fa-edit"></i> Edit</a>
                  </span>
              </td>
              <td><span data-toggle="tooltip" title="Delete Ingredient">
                  <a href="" class="btn bg-red btn-flat btn-xs delete" data-value="{{ $recipe->id }}"><i class="fa fa-ban"></i> Delete</a>
                </span>
              </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div class="box-footer">
          <div class="col-md-6">
            <span data-toggle="tooltip" title="Add Ingredient">
                  <a href="" class="btn bg-green btn-flat btn-xs add" data-toggle="modal" data-target="#myModalAdd" data-value="{{ $menus->id }}"><i class="fa fa-plus"></i> Add Ingredient</a>
                </span>
          </div>
        </div>
      </div>
    </div>
@endsection


@section('script')
<script src="{{ asset('plugins/select2/select2.full.min.js')}}"></script>
<script language="javascript">
  $(document).ready(function(){
    $(".select2").select2();
  });

  function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
  }

  $('a.edit').click(function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{ url('/') }}/hurricanesmenu/menu-recipebind/"+a,
      dataType: 'json',
      success: function(data){
        //get
        var id = data.id;
        var ingredients_id = data.ingredients_id;
        var size = data.size;
        var menu_id = data.menu_id;
        var notes   = data.notes;
        var user_id = data.user_id;

        // set
        $('#editId').attr('value', id);
        $('#editIngredients_id'+ingredients_id).attr('selected', true);
        $('#editSize').attr('value', size);
        $('#editMenu_id').attr('value', menu_id);
        $('#editNotes').attr('value', notes);
      }
    });
  });

  $('a.delete').click(function(){
    var id = $(this).data('value');
    $.ajax({
      url: "{{ url('/') }}/hurricanesmenu/menu-menus/recipe-delete/"+id,
      dataType: 'json',
      success: function()
      {
        setInterval(function() {
            window.location.reload();
        }, 5900);
      }
    });
  });
</script>
<script type="text/javascript">
@if ($errors->has('size') || $errors->has('ingredients'))
  $('#myModalAdd').modal('show');
@endif
@if ($errors->has('editSize') || $errors->has('editIngredients_id'))
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
