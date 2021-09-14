@extends('layouts.app2')
@section('page') Dashboard @endsection
@section('content')
<div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
    <span class="font-weight-semibold">Well done!</span> {{ __('You are logged in!') }}.
</div>
@endsection
