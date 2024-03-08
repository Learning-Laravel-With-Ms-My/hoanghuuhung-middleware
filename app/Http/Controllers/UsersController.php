<?php

namespace App\Http\Controllers;
use App\Models\Users;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $users;
    public function __construct(){
        $this->users = new Users();
    }
    public function index(){
        $title = "danh sách người dùng";
        
        $usersList = $this->users->getAllUsers();

        return view('users.lists', compact('title','usersList'));
    }
    public function add(){
        $title = "Thêm User mới";
        return view('users.add', compact('title'));
        
    }
    public function postAdd(Request $request){
        $request->validate(
            [
                'fullname' =>'required|min:5',
                'email' =>'required|email|unique:users',
            ],[
                'fullname.required' =>'Họ tên bắt buộc phải nhập',
                'fullname.min' =>'Họ tên phải lớn hơn :min kí tự',
                'email.required' =>'Email bắt buộc nhập',
                'email.email' =>'Email không đúng định dạng',
                'email.unique'=>'Email đã tồn tại trên hệ thống'
            ]
        );
        $dataInsert=[
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->addUser($dataInsert);
        return redirect()->route('users.index')->with('msg',' Them ngươi dùng thành công');
    }
}
