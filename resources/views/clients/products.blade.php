@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('sidebar')
    @parent 
    <h5>Sidebar childrent</h5>
@endsection
    @section('content')
        <h1>Đây là trang products</h1>
    @endsection
@section('css')
    <style>
        header{
            background: #111111;
            color : white;
        }
    </style>
@endsection