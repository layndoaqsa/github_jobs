@extends('layout.app')
@section('titlepage','Dashboard')
@section('dashboard','active')

@section('title')
    <h4><span class="font-weight-semibold">Home</span> - Job</h4>
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Jobs</span>
@endsection

@section('content')
<div class="card">
    <div class="row col-md-12" style="padding-top:10px">            
        <div class="col-md-4 mb-3">
            <label class="d-block">Description:</label>
            <input type="text" class="form-control" name="filter_description" id="filter_description" placeholder="Filter by title, benefits, companies, expertise">
        </div>
        <div class="col-md-4 mb-3">
            <label class="d-block">Location:</label>
            <input type="text" class="form-control" name="filter_location" id="filter_location" placeholder="Filter by city, state, zip code, or country">
        </div>
        <div class="col-md-2 mb-3">
            <br>
            <label class="d-block"></label>
            <div class="form-check">
                <label class="form-check-label">
                    <input name="filter_fulltime_cb" id="filter_fulltime_cb" type="checkbox" class="form-check-input-styled" data-fouc>
                    Full time only
                </label>
            </div>
            <input type="hidden" class="form-control" name="filter_fulltime" id="filter_fulltime" data-placeholder="Description">
        </div>
        <div class="col-md-2 mb-3">
            <br>
            <label class="d-block"></label>
            <div class="text-right">
                <button type="button" id="btn-search" class="btn btn-primary btn-sm">Search </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table" id="table-data">
            <thead>
                <tr class="bg-purple-400">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>When</th>
                    <th>JOB LIST</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('after_style')
@endpush

@push('after_script')
<script>
    var tableData;
    $(document).ready(function () {
        /* datatable data */
        tableData = $("#table-data").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            // stateSave: true,
            ajax: {
                url: "{{ url('table/data-home') }}",
                type: "GET",
                 data: function (d) {
                    d.filter_description = $('#filter_description').val(),
                    d.filter_location = $('#filter_location').val()
                    d.filter_fulltime = $('#filter_fulltime').val()
                }
            },

            columns: [
                {data: "id", name: "id", visible: false},
                {data: "title",name: "title",visible: false},
                {data: "company",name: "company",visible: false},
                {data: "type",name: "type",visible: false},
                {data: "location",name: "location",visible: false },
                {data: "created_at",name: "created_at",visible: false },
                {data: "information",name: "information",visible: true }
            ]
        });
        
        $('#filter_fulltime_cb').change(function() {
            $("#filter_fulltime").val(0)
            if(this.checked) {
                $("#filter_fulltime").val(1)
            }
        });

        $("#btn-search").click(function() {
            tableData.ajax.reload()
        });
    });
</script>
@endpush
