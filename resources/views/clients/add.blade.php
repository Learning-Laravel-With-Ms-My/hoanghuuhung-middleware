@extends('layouts.client')

@section('title')
    Trang chủ
@endsection


@section('content')
<h1>Them san pham</h1>
   <form action="" method="POST" >
        <input type="text" name="username">
        @csrf
        <button type="submit" >Submit</button>
   </form>
@endsection

@section('css')

@endsection

@section('js')

@endsection