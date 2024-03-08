@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('sidebar')
    @parent 
    <h5>Product sidebar</h5>
@endsection

@section('content')
    <h1>Đây là trang products</h1>
@endsection


@section('css')
@endsection
{{-- <x-package-alert/> --}}