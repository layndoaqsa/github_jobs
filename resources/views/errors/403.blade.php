@extends('errors.layout')
@section('subtitlepage','403 Forbidden')
@section('content')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
<div class="text-center mb-3">
    <h1 class="error-title">403</h1>
    <h5>Oops, an error has occurred. Forbidden!</h5>
</div>
@endsection