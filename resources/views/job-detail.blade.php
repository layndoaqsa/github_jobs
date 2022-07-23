@extends('layout.app')
@section('titlepage','Dashboard')
@section('dashboard','active')

@section('title')
    <h4><span class="font-weight-semibold">Home</span> - Job Detail</h4>
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item"><a href="{{route('home')}}" class="text-default text-dark">Job</a></span>
    <span class="breadcrumb-item active">Detail</span>
@endsection

@section('content')
<div class="mt-0">
    <h4><a href="{{url()->previous()}}" class="text-default text-dark"><i class="icon-arrow-left52 mt-0 mr-1"></i> Back </a></h4>
</div>
<div class="card">
    <div class="card-header">
        <span class="text-secondary">{!! $data->created_at !!}  </span>
        <h4 class="font-weight-semibold mb-1">
            {!! $data->title !!} - {!! $data->company !!}
        </h4>
        <span class="font-weight-normal text-dark">{!! $data->location !!} - </span>
        <span class="font-weight-normal text-success">{!! $data->type !!}  </span>
    </div>
    <hr>
    <div class="card-body">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9 text-justify" >
                    {!! $data->description !!}
                </div>
                <div class="col-md-3">
                    <div class="mb-3 text-left">
                        <a href="{!! $data->company_url !!}" class="d-inline-block">
                            <img src="{{$data->company_logo}}" class="img-fluid" alt="">
                            {!! $data->company_url !!}
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-header header-elements-md-inline">
                            <h4 class="font-weight-semibold mb-1">
                                How to apply
                            </h4>
                        </div>
                        <div class="card-body">
                            {!! $data->how_to_apply !!}
                            <a href="{!! $data->url !!}">{!! $data->url !!}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after_style')
@endpush

@push('after_script')

@endpush
