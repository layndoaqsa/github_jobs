@extends('layout.app')
@section('titlepage','Pengguna')
@section('subtitlepage','Tambah')
@section('user','active')
@section('title')
    <h4>
        <a href="{{route('user.index')}}"><i class="text-default icon-arrow-left52 mr-2"></a></i>
        <span class="font-weight-semibold">Master</span> - @yield('subtitlepage') @yield('titlepage')
    </h4>
@endsection

@section('breadcrumb')
    <a class="breadcrumb-item"><i class="icon-database mr-2"></i> Master</a>
    <span class="breadcrumb-item"><a href="{{route('user.index')}}" class="text-default"> @yield('titlepage') </a></span>
    <span class="breadcrumb-item active">@yield('subtitlepage')</span>
@endsection
@section('content')
    <!-- Form inputs -->
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal" action="{{route('user.store')}}" method="post" enctype="multipart/form-data" files=true id="form-validate">
                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold"> @yield('subtitlepage') @yield('titlepage')</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Username: <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>                    

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Email: <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label class="col-form-label col-lg-2">Phone Number:</label>
                        <div class="col-lg-10">
                            <input type="text" name="phone_number" id="phone_number" class="form-control phone_number" value="{{ old('phone_number') }}">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Password: <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Password konfirmasi: <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        </div>
                    </div>
                </fieldset>

                <div class="text-right">
                    <a href="{{route('user.index')}}" data-dismiss="modal" class="btn bg-grey-400">Batal</a>
					<button type="submit" class="btn bg-purple">Simpan <i class="icon-floppy-disk ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- /form inputs -->
@endsection 

@push('after_script')
<script>
    $(document).ready(function () {
        $('#form-validate').on('submit', function (e) {
            e.preventDefault();
            swallLoading()
            $.ajax({
                'type': 'POST',
                'url' : $(this).attr('action'),
                'data': new FormData(this),
                'processData': false,
                'contentType': false,
                'dataType': 'JSON',
                'success': function(data){
                    swal(data.success, {
                        icon: "success",
                    });
                    location.href = "{{ route('user.index') }}"
                },
                'statusCode': {
                    500: function() {
                        swal('Server Error', {
                                icon: "error",
                        });
                    },
                    422: function(data) {
                        $(".span-error").remove()
                        swal('Data yang dimasukkan tidak sesuai', {
                                icon: "error",
                        })
                        $.each(data.responseJSON.errors, function (key, value) {
                            var input = $('#'+key+'');
                            error = `<span class="form-text text-danger span-error"><i class="icon-cancel-circle2 mr-0"></i> ${value}`
                            input.parent().append(error)
                        });  
                    }
                },
            });
        });
    });
</script>
@endpush
