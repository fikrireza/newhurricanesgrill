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
    <li class="active">Create Menu Recipe</li>
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
      <div class="col-md-8">
        <div class="box box-danger">
          <div class="box-header with-border">
              <h3 class="box-title">{{ $menus->name }} - Add New Recipe</h3>
          </div>
          <form method="post" action="{{ route('menu.recipeStore') }}">
            {{ csrf_field() }}
          <div class="box-body">
            <input type="hidden" name="menu_id" value="{{ $menus->id }}" />
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
            <table class="table" id="dIngredient">
              <tbody>
                <tr>
                  <th></th>
                  <th width="400px">Ingredients</th>
                  <th width="70px">Size</th>
                  <th width="200px">Notes</th>
                </tr>
                <tr>
                  <td><input type="checkbox" name="chk"/></td>
                  <td>
                    <div class="form-group {{ $errors->has('ingredients[1][ingredient]') ? 'has-error' : '' }}">
                      <select name="ingredients[1][ingredient]" class="form-control select2" style="width: 100%;">
                        <option value="">-- Choose --</option>
                        @foreach($ingredients as $key)
                          <option value="{{ $key->id }}">{{ $key->name }}&nbsp;&nbsp;-&nbsp;&nbsp;({{ $key->unit }})</option>
                        @endforeach
                      </select>
                      @if($errors->has('ingredients[1][ingredient]'))
                      <span class="help-block">
                        <i>* {{$errors->first('ingredients[1][ingredient]')}}</i>
                      </span>
                      @endif
                    </div>
                  </td>
                  <td>
                    <div class="{{ $errors->has('size') ? 'has-error' : '' }}">
                      <input type="text" name="ingredients[1][size]" class="form-control" value="" />
                    </div>
                  </td>
                  <td>
                    <div class="{{ $errors->has('notes') ? 'has-error' : '' }}">
                      <input type="text" name="ingredients[1][notes]" class="form-control" value="" />
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="box-footer clearfix">
            <div class="col-md-6">
              <label class="btn btn-sm btn-flat bg-green" onclick="addIngredient('dIngredient')">Add Ingredient</label>&nbsp;<label class="btn btn-sm btn-flat bg-red" onclick="delIngredient('dIngredient')">Remove Ingredient</label>
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn bg-orange pull-right btn-sm btn-flat">Create Recipe</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- END FORM-->
@endsection


@section('script')
<script src="{{ asset('plugins/select2/select2.full.min.js')}}"></script>
<script language="javascript">
  $(document).ready(function(){
    $(".select2").select2();
  });

  var numA=1;
  function addIngredient(tableID) {
      numA++;
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);
      var cell1 = row.insertCell(0);
      cell1.innerHTML = '<input type="checkbox" name="chk[]"/>';
      var cell2 = row.insertCell(1);
      cell2.innerHTML = '<select name="ingredients['+numA+'][ingredient]" class="form-control select2"><option value="">-- Choose --</option>@foreach($ingredients as $key)<option value="{{ $key->id }}">{{ $key->name }}&nbsp;&nbsp;-&nbsp;&nbsp;({{ $key->unit}})</option>@endforeach</select>@if($errors->has("ingredients['+numA+'][ingredient]"))<span class="help-block"><i>* {{$errors->first("ingredients['+numA+'][ingredient]")}}</i></span>@endif';
      var cell3 = row.insertCell(2);
      cell3.innerHTML = '<input type="text" name="ingredients['+numA+'][size]" class="form-control" value="" />';
      var cell4 = row.insertCell(3);
      cell4.innerHTML = '<input type="text" name="ingredients['+numA+'][notes]" class="form-control" value="" />';
      $(".select2").select2();
  }

  function delIngredient(tableID) {
      try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;
      for(var i=0; i<rowCount; i++) {
          var row = table.rows[i];
          var chkbox = row.cells[0].childNodes[0];
          if(null != chkbox && true == chkbox.checked) {
              table.deleteRow(i);
              rowCount--;
              i--;
              numA--;
          }
      }
      }catch(e) {
          alert(e);
      }
  }
</script>
@endsection
