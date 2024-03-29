@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1>{{ $title }}</h1>
    <a href="{{ route('users.add') }}" class="btn btn-primary">Them nguoi dung</a>
    <hr>
    <form action="" method="get">
        <div class="row pb-3">
            <div class="col-3">
                <select class="form-control" name="status">
                    <option value="0">Tất cả trạng thái</option>
                    <option value="active" {{ request()->status == 'active' ? 'selected' : false }}>Kích hoạt</option>
                    <option value="inactive" {{ request()->status == 'inactive' ? 'selected' : false }}>Chưa kích hoạt</option>
                </select>
            </div>

            <div class="col-3">
                <select class="form-control" name="group_id">
                    <option value="0">Chọn nhóm</option>
                  @if (!empty($groups))
                        @foreach ($groups as $item)
                            <option value="{{ $item->id }}" {{ request()->group_id == $item->id ? 'selected' : false }}>{{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-4">
                <input type="search" name="keywords" class="form-control" placeholder="Nhập từ khóa tìm kiếm"
                    value="{{ request()->keywords }}">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th><a href="?sortBy=fullname&sort-type={{$sortType}}">Name</a></th>
                <th><a href="?sortBy=email&sort-type={{$sortType}}">Email</a></th>
                <th>Nhóm</th>
                <th>Trạng thái</th>
                <th><a href="?sortBy=create_at&sort-type={{$sortType}}">Time</a></th>
                <th class="width:5%;">Edit</th>
                <th class="width:5%;">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($userList))
                @foreach ($userList as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{$item->group_name}}</td>
                        <td>{!!$item->status == 0?'<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>':'<button class="btn btn-success btn-sm">Đã kích hoạt</button>'!!}</td>
                        <td>{{ $item->create_at }}</td>
                        <td><a href="{{ route('users.edit', $item->id) }}" class="btn btn-primary">Edit</a></td>
                        <td><a onclick="return comfirm('Ban co chac ko')" href="{{ route('users.delete', $item->id) }}"
                                class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">No user</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{$userList->links()}}
@endsection
