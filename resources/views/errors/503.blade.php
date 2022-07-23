@extends('errors.layout')
@section('subtitlepage','503 Service Unavailable')
@section('content')
@section('message', __($exception->getMessage() ?: ''))
<div class="text-center mb-3">
    <h1 class="error-title">503</h1>
    <h5>Oops, an error has occurred. Service Unavailable!</h5>
</div>
@endsection