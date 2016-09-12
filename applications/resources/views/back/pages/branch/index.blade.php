@extends('back.layout.master')

@section('breadcrumb')
  <h1>
      Branch Management <small>Branch List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Branch Management</li>
  </ol>
@stop

@section('content')
  <div class="row">

    <div class="col-md-12">
      @if(Session::has('message'))
        <div class="alert alert-success panjang">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
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

    <div class="modal fade" id="myModalEdit" role="dialog">
      <div class="modal-dialog" style="width:500px;">
        <form class="form-horizontal" action="{{ route('branch.update') }}" method="post">
          {!! csrf_field() !!}
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Branch Data</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
                  <label class="col-sm-2 control-label">Name</label>
                </div>
                <div class="col-sm-10 {{ $errors->has('name') ? 'has-error' : '' }}">
                  <input type="text" name="name" class="form-control" id="editName" placeholder="Name">
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
                  <input type="text" name="address" class="form-control" id="editAddress" placeholder="Address"
                  @if($errors->has('address'))
                    value="{{ old('address') }}"
                  @endif
                  >
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
                  <textarea class="textarea form-control" name="description" placeholder="Description Open Hours" style="width: 100%; height: 200px; font-size: 14px; border: 1px solid #dddddd; padding: 10px;">@if($errors->has('description')){{ old('description') }}@endif</textarea>
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
                  <input type="text" name="phone" class="form-control" placeholder="Phone"
                  @if($errors->has('phone'))
                    value="{{ old('phone') }}"
                  @endif
                  >
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
                  <input type="text" name="hotline" class="form-control" placeholder="Hotline"
                  @if($errors->has('hotline'))
                    value="{{ old('hotline') }}"
                  @endif
                  >
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
                  <input type="text" name="maps" class="form-control" placeholder="Maps"
                  @if($errors->has('maps'))
                    value="{{ old('maps') }}"
                  @endif
                  >
                  @if($errors->has('maps'))
                    <span class="help-block">
                      <i>* {{$errors->first('maps')}}</i>
                    </span>
                  @endif
                  <input type="hidden" name="user_id" value="0">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary btn-flat">Simpan Perubahan</button>
            </div>
          </div>
      </form>
      </div>
    </div>

    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <div class="box-title">
            <a href="{{ url('hurricanesmenu/branch-create') }}"><button class="btn btn-block bg-orange">Create New Branch</button></a>
          </div>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-hover">
            <tr class="bg-red">
              <th style="width:10px;">No</th>
              <th>Name</th>
              <th>Address</th>
              <th>Description</th>
              <th>Phone</th>
              <th>Hotline</th>
              {{-- <th style="width:50px;">Maps</th> --}}
              <th>Creator</th>
              <th>Action</th>
            </tr>
            @if($getBranch->isEmpty())
              <tr>
                <td colspan="8" align="center">Empty Data</td>
              </tr>
            @else
              @foreach($getBranch as $key)
              <tr>
                <td>{{ $key->id }}</td>
                <td>{{ $key->name  }}</td>
                <td>{!! $key->address  !!}</td>
                <td>{!! $key->description  !!}</td>
                <td>{{ $key->phone  }}</td>
                <td>{{ $key->hotline  }}</td>
                {{-- <td>{!! $key->maps  !!}</td> --}}
                <td>{{ $key->user_id }}</td>
                <td>@if($key->flag_active!=0)
                        <span data-toggle="tooltip" title="Deactivated Branch">
                          <a href="" class="btn btn-default btn-flat btn-xs nonactive" data-toggle="modal" data-target="#myModalNonAktif" data-value="{{ $key->id }}"><i class="fa fa-ban"></i></a>
                        </span>
                      @else
                        <span data-toggle="tooltip" title="Activated Branch">
                          <a href="" class="btn btn-primary btn-flat btn-xs active" data-toggle="modal" data-target="#myModalAktif" data-value="{{ $key->id }}"><i class="fa fa-check"></i></a>
                        </span>
                      @endif
                      <span data-toggle="tooltip" title="Edit Branch">
                        <a href="" class="btn btn-warning btn-flat btn-xs edit" data-toggle="modal" data-target="#myModalEdit" data-value="{{ $key->id }}"><i class="fa fa-edit"></i></a>
                      </span>
                </td>
              </tr>
              @endforeach
            @endif
          </table>
        </div>
        <div class="box-footer">
          <div class="pagination pagination-sm no-margin pull-right">

          </div>
        </div>
      </div>
    </div>

  </div>
@stop

<script type="text/javascript">
  $(function(){
    $('a.nonaktif').click(function(){
      var a = $(this).data('value');
      $('#setnonactive').attr('href', "{{ url('/') }}/hurricanesmenu/branch-nonactive/"+a);
    });

    $('a.aktif').click(function(){
      var a = $(this).data('value');
      $('#setactive').attr('href', "{{ url('/') }}/hurricanesmenu/branch-active/"+a);
    });

    $('a.edit').click(function(){
      var a = $(this).data('value');
      $.ajax({
        url: "{{ url('/') }}/hurricanesmenu/branch-bind/"+a,
        dataType: 'json',
        success: function(data){
          //get
          var id = data.id;
          var name = data.name;
          var address = data.address;
          var description = data.description;
          var phone = data.phone;
          var hotline = data.hotline;
          var maps = data.maps;

          // set
          $('#editId').attr('value', id);
          $('#editName').attr('value', name);
          $('#editAddress').attr('value', address);
          $('#editDescription').attr('value', description);
          $('#editPhone').attr('value', phone);
          $('#editHotline').attr('value', hotline);
          $('#editMaps').attr('value', maps);
        }
      });
    });

  });
</script>

<script type="text/javascript">
@if (count($errors) > 0)
    $('#myModalEdit').modal('show');
@endif
</script>
