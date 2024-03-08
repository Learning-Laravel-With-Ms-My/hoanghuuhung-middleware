@extends('layouts.client')
@section('title')
    {{$title}}
@endsection


@section('content')

<h1>{{$title}}</h1>
<a href="{{route('users.add')}}" class="btn btn-primary">Them user</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%" >Stt</th>
                <th>Tên</th>
                <th>Email</th>
                <th width="15%" >THời gian</th>
                <th width="5%" >Sửa</th>
                <th width="5%" >Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($usersList))
            @foreach ($usersList as $key => $value)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->fullname}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->create_at}}</td>
                <td>
                    <a href="{{route('users.edit',['id'=>$value->id])}}" class="btn btn-warning btn-sm" >Sửa</a>
                </td>
                <td>
                    <a href="#" class="btn btn-danger btn-sm" >Xóa</a>
                </td>
            </tr>
            @endforeach
           
            @endif
        </tbody>
    </table>
    
@endsection
