@extends('layouts.client')

@section('title')
    Trang chủ
@endsection

@section('sidebar')
    @parent 
    <h5>Sidebar childrent</h5>
@endsection
    @section('content')
        <h1>Đây là trang home của clients</h1>
        <button type="button" class="show">Show</button>
    @endsection
@section('css')
    <style>
        header{
            background: blue;
            color : white;
        }
    </style>
@endsection

@section('js')
    <script>
        document.querySelector('.show').onclick= function(){
            alert('Thành công');
        }
    </script>
@endsection