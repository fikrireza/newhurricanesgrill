@extends('back.layout.master')

@section('headscript')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('breadcrumb')
  <h1>
      Menu Management <small>Menu Directions</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="{{ route('menu.category') }}">Menu Category</a></li>
    <li><a href="{{ route('menu.menus') }}">Menu</a></li>
    <li class="active">Create Menu Directions</li>
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
              <h3 class="box-title">{{ $menus->name }} - Add New Directions</h3>
          </div>
          <form method="post" action="{{ route('menu.directionsStore') }}">
            {{ csrf_field() }}
          <div class="box-body">
            <input type="hidden" name="menu_id" value="{{ $menus->id }}" />
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
            <table class="table">
              <tbody>
                <tr>
                  <th width="200px">Directions</th>
                </tr>
                <tr>
                  <td>
                    <div class="form-group {{ $errors->has('directions') ? 'has-error' : '' }}">
                      <textarea class="textarea form-control" name="directions" placeholder="Directions" style="width: 100%; height: 250px; font-size: 12px; border: 1px solid #dddddd; padding: 10px;">{{ old('directions') }}</textarea>
                      @if($errors->has('directions'))
                        <span class="help-block">
                          <i>* {{$errors->first('directions')}}</i>
                        </span>
                      @endif
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="box-footer clearfix">
            <button type="submit" class="btn bg-orange pull-right btn-sm btn-flat">Create Directions</button>
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
          "emphasis": true, //Italics, bold, etc.
          "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers.
          "html": false, //Button which allows you to edit the generated HTML.
          "link": false, //Button to insert a link.
          "image": false, //Button to insert an image.
          "color": false, //Button to change color of font
          "blockquote": false
        }
    });
  });
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
