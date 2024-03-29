@extends('layouts.client')
@section('title')
    {{$title}}
@endsection


@section('content')

<h1>{{$title}}</h1>
@if ($errors->any())
    <div class="alert alert-danger">Dữ liệu không hợp lệ vui lòng nhập lại</div>
@endif
<form method="post" action="{{route('users.post-edit')}}">
    @csrf
    <div class="mb-3">
        <label for="">Họ Và Tên</label>
        <input type="text" class="form-control" name="fullname" placeholder="Họ và tên" value="{{old('fullname') ?? $userDetail->fullname}}" >
        @error('fullname')
            <span style="color:red" >{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="">Email</label>
        <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email') ?? $userDetail->email}}" >
        @error('email')
        <span style="color:red" >{{$message}}</span>
    @enderror
    </div>
    <div class="mb-3">
        <label for="group_id" class="form-label">Group</label>
        <select name="group_id" id="group_id" class="form-control">
            <option value="0">Chon group</option>
            @if (!empty($groups))
                @foreach ($groups as $item)
                    <option value="{{ $item->id }}"
                        {{ old('group_id') == $item->id || $userDetail->group_id == $item->id ? 'selected' : false }}>
                        {{ $item->name }}</option>
                @endforeach
            @endif
        </select>
        @error('group_id')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Trang thai</label>
        <select name="status" id="status" class="form-control">
            <option value="0" {{ old('status') == 0 || $userDetail->status == 0 ? 'selected' : false }}>Chua kich
                hoat</option>
            <option value="1" {{ old('status') == 1 || $userDetail->status == 1 ? 'selected' : false }}>Kich hoat</option>
        </select>
        @error('status')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{route('users.index')}}" class="btn btn-warning">Close</a>
</form>
    
@endsection
