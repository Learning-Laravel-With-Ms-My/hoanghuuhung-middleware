@extends('layouts.client')
@section('title')
    {{$title}}
@endsection


@section('content')

<h1>{{$title}}</h1>
@if ($errors->any())
    <div class="alert alert-danger">Dữ liệu không hợp lệ vui lòng nhập lại</div>
@endif
<form method="post" action="">
    @csrf
    <div class="mb-3">
        <label for="">Họ Và Tên</label>
        <input type="text" class="form-control" name="fullname" placeholder="Họ và tên" value="{{old('fullname')}}" >
        @error('fullname')
            <span style="color:red" >{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Email</label>
        <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}" >
        @error('email')
        <span style="color:red" >{{$message}}</span>
    @enderror
    </div>
    <div class="mb-3">
        <label for="">Nhoms</label>
        <select name="group_id" class="form-control" id="">
            <option value="0">Chon nhom</option>
            @if (!empty($groups))
                @foreach($groups as $group)
                <option value="{{$group->id}} {{old('group_id')==$group->id?'selected':false}}">{{$group->name}}</option>
                @endforeach
            @endif
        </select>
        @error('group_id')
        <span style="color:red" >{{$message}}</span>
    @enderror
    </div>

    <div class="mb-3">
        <label for="">Trang thai</label>
        <select name="status" class="form-control" id="">
            <option value="0"  {{old('status')==0?'selected':false}}>Chua kich hoat</option>
            <option value="1"  {{old('status')==1?'selected':false}}>Da kich hoat</option>

        </select>
      
    </div>
    <button type="submit" class="btn btn-primary">Thêm mới người dùng</button>
    <a href="{{route('users.index')}}" class="btn btn-warning">Close</a>
</form>
    
@endsection
