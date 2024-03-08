@extends('layouts.client')
@section('title')
    {{$title}}
@endsection


@section('content')

<h1>{{$title}}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%" >Stt</th>
                <th>Tên</th>
                <th>Email</th>
                <th width="15%" >THời gian</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($user))
            @foreach ($user as $key => $value)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->fullname}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->create_at}}</td>
            </tr>
            @endforeach
           
            @endif
        </tbody>
    </table>
    
@endsection
