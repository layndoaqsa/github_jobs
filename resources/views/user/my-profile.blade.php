@extends('layout.app')
@section('titlepage','Akun Saya')

@section('title')
    <h4><span class="font-weight-semibold">Home</span> - Akun Saya</h4>

@endsection

@section('breadcrumb')
    <a href="{{route('home')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
    <span class="breadcrumb-item active">Akun Saya</span>
@endsection

@section('content')
<!-- Profile info -->
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Informasi Akun</h5>
	</div>

	<div class="card-body">
    <form action="{{route('profile.update-profil')}}" method="post" enctype="multipart/form-data" files=true>
      @method('PUT')
      @csrf
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="d-block">Username:</label>
                        <span class="font-weight-semibold ml-3" id="">{{$data->name}}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="d-block">Email:</label>
                        <span class="font-weight-semibold ml-3" id="">{{$data->email}}</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
	</div>
</div>
<!-- /profile info -->
<!-- Account settings -->
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Pengaturan Akun</h5>
	</div>

	<div class="card-body">
    <form action="{{route('profile.update-password')}}" method="post">
      @method('PUT')
      @csrf
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Password sekarang: <span class="text-danger">*</span></label>
                        <input type="password" readonly="readonly" name="password_sekarang" placeholder="" value="password" class="form-control">
                        @if ($errors->has('password_sekarang'))
                        <label style="padding-top:7px;color:#F44336;" class="error-validation">
                        <strong><i class="fa fa-times-circle"></i> {{ $errors->first('password_sekarang') }}</strong>
                        </label>
                        @endif
                        @if (session('errorPassword'))
                        <label style="padding-top:7px;color:#F44336;" class="error-validation">
                        <strong><i class="fa fa-times-circle"></i> {{session('errorPassword')}}</strong>
                        </label>
                        @endif
                        @if ($errors->has('password'))
                        <label style="padding-top:7px;color:#F44336;" class="error-validation">
                        <strong><i class="fa fa-times-circle"></i> {{ $errors->first('password') }}</strong>
                        </label>
                        @endif
                        @if ($errors->has('password_confirmation'))
                        <label style="padding-top:7px;color:#F44336;" class="error-validation">
                        <strong><i class="fa fa-times-circle"></i> {{ $errors->first('password_confirmation') }}</strong>
                        </label>
                        @endif
					</div>
				</div>
			</div>

			<div class="form-group" style="display:none" id="div-ganti-password">
				<div class="row">
					<div class="col-md-6">
						<label>Password baru: <span class="text-danger">*</span></label>
                        <input type="password" readonly="readonly" name="password" placeholder="" class="form-control">
					</div>

					<div class="col-md-6">
						<label>Konfirmasi password baru: <span class="text-danger">*</span></label>
                        <input type="password" readonly="readonly" name="password_confirmation" placeholder="" class="form-control">
					</div>
				</div>
			</div>
      <div class="text-right">
          <button id="back-password" style="display:none" onclick="backPassword(); return false;" class="btn bg-grey-400"> Batal</button>
          <button id="save-password" style="display:none" type="submit" class="btn bg-purple btn-labeled btn-labeled-left"><b><i class="icon-floppy-disk position-right"></i></b> Simpan</button>
      </div>
    </form>
    <div class="text-right">
        <button id="edit-password" onclick="editPassword()" class="btn bg-purple btn-labeled btn-labeled-left"><b><i class="icon-arrow-right14 position-right"></i></b> Ubah</button>
    </div>
	</div>
</div>
<!-- /account settings -->
@endsection @push('after_script')
@push('after_script')
<script>
    function editProfile() {
        $('#save-profil').fadeIn();
        $('#back-profil').fadeIn();
        $("input[name='nama']").prop('readonly', false);;
        $("input[name='email']").prop('readonly', false);
        $('#edit-profil').hide();
    }
    function backProfile() {
        $('#save-profil').hide();
        $('#back-profil').hide();
        $("input[name='nama']").prop('readonly', true);
        $("input[name='email']").prop('readonly', true);
        $('#edit-profil').fadeIn();
    }
    function editPassword() {
        $('#save-password').fadeIn();
        $('#back-password').fadeIn();
        $('.error-validation').hide();
        $('#div-ganti-password').slideDown('fast');
        $("input[name='password_sekarang']").prop('readonly', false).val('');
        $("input[name='password']").prop('readonly', false);
        $("input[name='password_confirmation']").prop('readonly', false);
        $('#edit-password').hide();
    }
    function backPassword() {
        $('#save-password').hide();
        $('#back-password').hide();
        $('#div-ganti-password').slideUp('fast');
        $("input[name='password_sekarang']").prop('readonly', true).val('********');
        $("input[name='password']").prop('readonly', true);
        $("input[name='password_confirmation']").prop('readonly', true);
        $('#edit-password').fadeIn();
    }
</script>
@endpush
