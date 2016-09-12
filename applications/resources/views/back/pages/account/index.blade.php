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

    <form class="form-horizontal" method="post" action="{{ route('account.create') }}">
      {{ csrf_field() }}
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Account</h3>
            </div>
            <div class="box-body">
              <div class="col-md-14 {{ $errors->has('level') ? 'has-error' : '' }}">
                <label class="control-label">Level</label>
                <select class="form-control" name="level">
                  <option value="-- Pilih --">-- Pilih --</option>
                  <option value="0" {{ old('level')=="0" ? 'selected' : '' }} >Administrator</option>
                  <option value="1" {{ old('level')=="1" ? 'selected' : '' }} >Manager</option>
                  <option value="2" {{ old('level')=="2" ? 'selected' : '' }} >Reservation</option>
                  <option value="3" {{ old('level')=="3" ? 'selected' : '' }} >Reservation Admin</option>
                  <option value="4" {{ old('level')=="4" ? 'selected' : '' }} >Kitchen</option>
                </select>
                @if($errors->has('level'))
                  <span class="help-block">
                    <i>* {{$errors->first('level')}}</i>
                  </span>
                @endif
              </div>
              <div id="skpdoption" class="col-md-14 {{ $errors->has('id_skpd') ? 'has-error' : '' }}">
                <label class="control-label">Branch</label>
                <select class="form-control" name="id_skpd">
                  <option value="-- Pilih --">-- Pilih --</option>
                  @foreach($getBranch as $key)
                    <option value="{{ $key->id }}" {{ old('branch_id') ? 'selected' : '' }}>{{ $key->name }}</option>
                  @endforeach
                </select>
                @if($errors->has('id_skpd'))
                  <span class="help-block">
                    <i>* {{$errors->first('id_skpd')}}</i>
                  </span>
                @endif
              </div>
              <div class="col-md-14 {{ $errors->has('email') ? 'has-error' : '' }}">
                <label class="control-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email"
                @if($errors->has('email'))
                  value="{{ old('email') }}"
                @endif
                >
                @if($errors->has('email'))
                  <span class="help-block">
                    <i>* {{$errors->first('email')}}</i>
                  </span>
                @endif
              </div>
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-default btn-sm btn-flat">Reset Formulir</button>
              <button type="submit" class="btn btn-success pull-right btn-sm btn-flat">Send Email</button>
            </div>
          </div>
        </div>
    </form>

    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="box-title">
            All Account Data
          </div>
          <div class='box-tools'>
            <div class="btn-group">
              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                Download <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ URL::to('admin/managementakun/pdf') }}">PDF</a></li>
                <li><a href="{{ URL::to('admin/managementakun/xlsx') }}">Excel</a></li>
              </ul>
            </div>
          </div><!-- /.box-tools -->
        </div>
        <div class="box-body no-padding">
          <table class="table table-hover">
            <tr class="bg-yellow">
              <th style="width:10px;">No</th>
              <th>Email</th>
              <th>Level</th>
              <th>Nama SKPD</th>
              <th>Aktifasi</th>
              <th>Status Akun</th>
              <th>Aksi</th>
            </tr>
            @if($getUser->isEmpty())
              <tr>
                <td colspan="7" class="text-muted" style="text-align:center;">Akun SKPD belum tersedia.</td>
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
                    <td>{{ $key->email }}</td>
                    <td>
                      @if($key->level==0)
                        {{ 'Administrator' }}
                      @elseif($key->level==2)
                        {{ 'User SKPD' }}
                      @endif
                    </td>
                    <td>
                      @if($key->id_skpd=="")
                        {{ '-' }}
                      @else
                        {{ $key->masterskpd->nama_skpd }}
                      @endif
                    </td>
                    <td>
                      @if($key->activated==0)
                        <span class="pull-center badge">Belum Aktifasi</span>
                      @elseif($key->activated==1)
                        <span class="pull-center badge bg-green">Sudah Aktifasi</span>
                      @endif
                    </td>
                    <td>
                      @if($key->flag_user!=0)
                        <span class="pull-center badge bg-blue">Aktif</span>
                      @else
                        <span class="pull-center badge">Tidak Aktif</span>
                      @endif
                    </td>
                    <td>
                      @if($key->flag_user!=0)
                        <span data-toggle="tooltip" title="Tidak Aktifkan Akun">
                          <a href="" class="btn btn-default btn-flat btn-xs nonaktif" data-toggle="modal" data-target="#myModalNonAktif" data-value="{{ $key->id }}"><i class="fa fa-ban"></i></a>
                        </span>
                      @else
                        <span data-toggle="tooltip" title="Aktifkan Akun">
                          <a href="" class="btn btn-primary btn-flat btn-xs aktif" data-toggle="modal" data-target="#myModalAktif" data-value="{{ $key->id }}"><i class="fa fa-check"></i></a>
                        </span>
                      @endif
                      <span data-toggle="tooltip" title="Ubah Akun">
                        <a href="" class="btn btn-warning btn-flat btn-xs edit" data-toggle="modal" data-target="#myModalEdit" data-value="{{ $key->id }}"><i class="fa fa-edit"></i></a>
                      </span>
                      <span data-toggle="tooltip" title="Delete Akun">
                        <a href="" class="btn btn-danger btn-flat btn-xs hapus" data-toggle="modal" data-target="#myModalHapus" data-value="{{ $key->id }}"><i class="fa fa-remove"></i></a>
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
