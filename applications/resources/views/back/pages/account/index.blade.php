@extends('back.layout.master')

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

    <div class="modal fade" id="myModalResend" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Resend Email Activation</h4>
          </div>
          <div class="modal-body">
            <p>Are You Sure to Resend Activation Email ?</p>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">No</button>
            <a class="btn btn-danger btn-flat" id="setresend">Yes, I'm Sure</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="myModalActive" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Activated Account</h4>
          </div>
          <div class="modal-body">
            <p>Are You Sure to Activated This Account ?</p>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">No</button>
            <a class="btn btn-danger btn-flat" id="setactive">Yes, I'm Sure</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="myModalDisable" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Disable Account</h4>
          </div>
          <div class="modal-body">
            <p>Are You Sure to DeActivated This Account ?</p>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">No</button>
            <a class="btn btn-danger btn-flat" id="setdisable">Yes, I'm Sure</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="myModalEdit" role="dialog">
      <div class="modal-dialog" style="width:500px;">
        <form class="form-horizontal" action="{{ route('account.update') }}" method="post">
          {!! csrf_field() !!}
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Account Data</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="{{ $errors->has('editLevel') ? 'has-error' : '' }}">
                  <label class="col-sm-2 control-label">Level</label>
                </div>
                <div class="col-sm-10 {{ $errors->has('editLevel') ? 'has-error' : '' }}">
                  <input type="hidden" name="id" class="form-control" id="editId" value="{{ old('id') }}">
                  <select class="form-control" name="editLevel" id="editLevel">
                    <option value="">-- Choose --</option>
                    <option value="2" {{ old('level')=="2" ? 'selected' : '' }} >Manager</option>
                    <option value="3" {{ old('level')=="3" ? 'selected' : '' }} >Reservation</option>
                    <option value="4" {{ old('level')=="4" ? 'selected' : '' }} >Reservation Admin</option>
                    <option value="5" {{ old('level')=="5" ? 'selected' : '' }} >Kitchen</option>
                  </select>
                  @if($errors->has('editLevel'))
                    <span class="help-block">
                      <i>* {{$errors->first('editLevel')}}</i>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="{{ $errors->has('editBranch_id') ? 'has-error' : ''}}">
                  <label class="col-sm-2 control-label">Branch</label>
                </div>
                <div class="col-sm-10 {{ $errors->has('editBranch_id') ? 'has-error' : ''}}">
                  <select name="editBranch_id" id="editBranch" class="form-control">
                    <option value="">-- Choose --</option>
                    @foreach($getBranch as $key)
                      <option value="{{ $key->id }}" {{ old('editBranch_id') ? 'selected' : '' }}>{{ $key->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('editBranch_id'))
                    <span class="help-block">
                      <i>* {{$errors->first('editBranch_id')}}</i>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary bg-orange">Update Data</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <form class="form-horizontal" method="post" action="{{ route('account.create') }}">
      {{ csrf_field() }}
        <div class="col-md-4">
          <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Add Account</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <div class="col-sm-2 {{ $errors->has('level') ? 'has-error' : '' }}">
                  <label class="control-label">Level</label>
                </div>
                <div class="col-sm-10 {{ $errors->has('level') ? 'has-error' : ''}}">
                  <select class="form-control" name="level" id="leveluser">
                    <option value="">-- Choose --</option>
                    <option value="1" {{ old('level')=="1" ? 'selected' : '' }} >Administrator</option>
                    <option value="2" {{ old('level')=="2" ? 'selected' : '' }} >Manager</option>
                    <option value="3" {{ old('level')=="3" ? 'selected' : '' }} >Reservation</option>
                    <option value="4" {{ old('level')=="4" ? 'selected' : '' }} >Reservation Admin</option>
                    <option value="5" {{ old('level')=="5" ? 'selected' : '' }} >Kitchen</option>
                  </select>
                  @if($errors->has('level'))
                    <span class="help-block">
                      <i>* {{$errors->first('level')}}</i>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group" id="branchoption">
                <div class="col-sm-2 {{ $errors->has('branch_id') ? 'has-error' : '' }}">
                  <label class="control-label">Branch</label>
                </div>
                <div class="col-sm-10 {{ $errors->has('branch_id') ? 'has-error' : ''}}">
                  <select class="form-control" name="branch_id">
                    <option value="">-- Choose --</option>
                    @foreach($getBranch as $key)
                      <option value="{{ $key->id }}" {{ old('branch_id') ? 'selected' : '' }}>{{ $key->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('branch_id'))
                    <span class="help-block">
                      <i>* {{$errors->first('branch_id')}}</i>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2 {{ $errors->has('email') ? 'has-error' : '' }}">
                  <label class="control-label">Email</label>
                </div>
                <div class="col-sm-10 {{ $errors->has('email') ? 'has-error' : ''}}">
                  <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                  @if($errors->has('email'))
                    <span class="help-block">
                      <i>* {{$errors->first('email')}}</i>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-default btn-sm btn-flat">Reset Form</button>
              <button type="submit" class="btn btn-success pull-right btn-sm btn-flat">Create Account</button>
            </div>
          </div>
        </div>
    </form>

    <div class="col-md-8">
      <div class="box box-danger">
        <div class="box-header with-border">
          <div class="box-title">
            All Account Data
          </div>
        </div>
        <div class="box-body">
          <table class="table table-hover">
            <tr class="bg-red">
              <th style="width:10px;">No</th>
              <th>Name</th>
              <th>Email</th>
              <th>Level</th>
              <th>Branch</th>
              <th>Activation</th>
              <th>Account Status</th>
              <th colspan="2">Action</th>
            </tr>
            @if($getUser->isEmpty())
              <tr>
                <td colspan="8" class="text-muted" style="text-align:center;">Empty Data</td>
              </tr>
            @else
              <?php
                $no;
                if($getUser->currentPage()==1)
                  $no = 1;
                else
                  $no = (($getUser->currentPage() - 1) * $getUser->perPage())+1;
              ?>
              @foreach($getUser as $key)
                @if($key->email!=Auth::user()->email)
                  <tr>
                    <td>{{ $no }}.</td>
                    <td>@if($key->name == "")
                      Not Set
                        @else
                      {{ $key->name }}
                    @endif</td>
                    <td>{{ $key->email }}</td>
                    <td>
                      @if($key->level == 1)
                        {{ 'Administrator' }}
                      @elseif($key->level == 2)
                        {{ 'Manager' }}
                      @elseif($key->level == 3)
                        {{ 'Reservation' }}
                      @elseif($key->level == 4)
                        {{ 'Reservation Admin' }}
                      @elseif($key->level == 5)
                        {{ 'Kitchen' }}
                      @endif
                    </td>
                    <td>{{ $key->branch_name }}</td>
                    <td>
                      @if($key->activation_code == null)
                        <span class="pull-center badge bg-green">Already Activation</span>
                      @else
                        <span class="pull-center badge">Yet The Activation</span>
                      @endif
                    </td>
                    <td>
                      @if($key->flag_active!=0)
                        <span class="pull-center badge bg-blue">Active</span>
                      @else
                        <span class="pull-center badge">Not Active</span>
                      @endif
                    </td>
                    <td>
                      @if($key->activation_code == null)
                      @if($key->flag_active!=0)
                        <span data-toggle="tooltip" title="Disable Account">
                          <a href="" class="btn btn-default btn-flat btn-xs disable" data-toggle="modal" data-target="#myModalDisable" data-value="{{ $key->id }}"><i class="fa fa-ban"></i></a>
                        </span>
                      @else
                        <span data-toggle="tooltip" title="Activate Account">
                          <a href="" class="btn btn-primary btn-flat btn-xs active" data-toggle="modal" data-target="#myModalActive" data-value="{{ $key->id }}"><i class="fa fa-check"></i></a>
                        </span>
                      @endif
                      @else
                        <span data-toggle="tooltip" title="Resend Email Verify">
                          <a href="" class="btn btn-primary btn-flat btn-xs resend" data-toggle="modal" data-target="#myModalResend" data-value="{{ $key->id }}"><i class="fa fa-refresh"></i></a>
                        </span>
                      @endif
                    </td>
                    <td>
                      <span data-toggle="tooltip" title="Edit Account">
                        <a href="" class="btn btn-warning btn-flat btn-xs edit" data-toggle="modal" data-target="#myModalEdit" data-value="{{ $key->id }}"><i class="fa fa-edit"></i></a>
                      </span>
                    </td>
                  </tr>
                  <?php $no++; ?>
                @endif
              @endforeach
            @endif
          </table>
        </div>
        <div class="box-footer">
          <div class="pagination pagination-sm no-margin pull-right">
            {{ $getUser->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
<script type="text/javascript">
  $('a.resend').click(function(){
    var a = $(this).data('value');
    $('#setresend').attr('href', "{{ url('/') }}/hurricanesmenu/account-resend/"+a);
  });

  $('a.disable').click(function(){
    var a = $(this).data('value');
    $('#setdisable').attr('href', "{{ url('/') }}/hurricanesmenu/account-disable/"+a);
  });

  $('a.active').click(function(){
    var a = $(this).data('value');
    $('#setactive').attr('href', "{{ url('/') }}/hurricanesmenu/account-active/"+a);
  });

  var leveluser = $('#leveluser').val();
  if(leveluser != 2) {
    $('#branchoption').hide();
  }

  $('a.edit').click(function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{ url('/') }}/hurricanesmenu/account-bind/"+a,
      dataType: 'json',
      success: function(data){
        //get
        var id = data.id;
        var level = data.level;
        var branch_id = data.branch_id;

        // set
        $('#editId').attr('value', id);
        $('#editLevel').attr('value', level);
        $('#editBranch').attr('value', branch_id);
      }
    });
  });

  $('#leveluser').change(function(){
    if($(this).val() == '2') {
      $('#branchoption').show();
    }
    else if($(this).val() == '3') {
      $('#branchoption').show();
    }
    else if($(this).val() == '4') {
      $('#branchoption').show();
    }
    else if($(this).val() == '5') {
      $('#branchoption').show();
    }
    else {
      $('#branchoption').hide();
    }
  });
</script>

<script type="text/javascript">
@if ($errors->first('editLevel') || $errors->first('editBranch_id'))
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
