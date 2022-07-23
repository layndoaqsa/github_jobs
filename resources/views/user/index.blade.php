@extends('layout.app')
@section('titlepage','Pengguna')
@section('user','active')
@section('title')
    <h4><span class="font-weight-semibold">Master</span> - @yield('subtitlepage') @yield('titlepage')</h4>
@endsection

@section('breadcrumb')
    <a class="breadcrumb-item"><i class="icon-database mr-2"></i> Master</a>
    <span class="breadcrumb-item active">@yield('subtitlepage') @yield('titlepage')</span>
@endsection
@section('content')
<div class="card">
    <div class="row col-md-12" style="padding-top:10px">
        <div class="col-md-8">
            <a href="{{route('user.create')}}" type="button" class="btn bg-primary btn-labeled btn-labeled-left">
                <b><i class="icon-add"></i></b> Tambah Pengguna
            </a>
            <!-- <button type="button" id="btn-import" class="btn bg-warning btn-labeled btn-labeled-left"><b><i class="icon-import"></i></b> Import @yield('titlepage')</button> -->
        </div>
    </div>
    <table class="table" id="table-user" style="">
        <thead>
            <tr class="bg-purple-400">
                <th>ID</th>
                <th style="width:1px">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- /basic responsive configuration -->
@include('user.modal-import')
@endsection @push('after_script')
<script>
    var tableData, saveMethod, id;
    $(document).ready(function () {
        $('#filter_role').select2();

        tableData = $("#table-user").DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            language: {
                processing: "Memuat data. Silahkan tunggu ....",
                search: '_INPUT_',
                searchPlaceholder: 'Masukkan kata kunci',
                lengthMenu: '<span>Tampilkan:</span> _MENU_',
                emptyTable: "Tidak ada data",
                zeroRecords: "Tidak ada data yang sesuai",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data yang ditemukan",
                infoFiltered: "(Disaring dari _MAX_ total data)",
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
            },
            ajax: {
                url: "{{ url('table/data-user') }}",
                type: "GET",
                data: function (d) {
                    d.filter_role = $('#filter_role').find(":selected").val()
                }
            },

            columns: [
                {
                    data: "id",
                    name: "id",
                    visible: false
                },
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    visible: true
                },
                {
                    data: "name",
                    name: "name",
                    visible: true
                },
                {
                    data: "email",
                    name: "email",
                    visible: true
                },
                {
                    data: "action",
                    name: "action",
                    visible: true
                }
            ]
        });


        /* delete data */
        $("#table-user tbody").on("click", "#btn-delete", function () {
            var data = tableData.row($(this).parents("tr")).data();
            swal({
                text: "Yakin untuk menghapus data?",
                icon: "warning",
                confirm: "Ya",
                buttons: {
                    cancel: 'Batal',
                    confirm: "Ya",
                },
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                swallLoading()
                $.ajax({
                url: "{{ url('delete/data-user') }}"+"/"+data['id'],
                method: 'get',
                success: function(result){
                    if (result.status == 'success') {
                    tableData.ajax.reload();
                    swal("Successfully deleted data!", {
                        icon: "success",
                    });
                    } else {
                    swal(result.message, {
                        icon: "error",
                    });
                    }
                }
                });
            } else {
                swal("Data is not deleted!");
            }
            });
        });

        /* trigger change filter wo number for datatable*/
        $('#filter_role').change(function() {
            filter_role = $('#filter_role').find(":selected").val()
            tableData.ajax.reload()
        });

        /* modal show import*/
        $("#btn-import").on('click', function(){
            $(".span-error").remove()
            $("#modal-form :input").val('');
            $('#modal-import').modal({backdrop: 'static', keyboard: false}).modal('show');
            $('#modal-title').html('<i class="icon-import mr-2"></i>Import');
        });

    });
</script>
@endpush
