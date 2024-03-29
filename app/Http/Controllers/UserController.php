<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new Users();
    }

    public function index()
    {
        // $statement = $this->users->statementUser('DELETE FROM users');
        // $statement = $this->users->statementUser('SELECT * FROM users');
        // dd($statement);

        $title = 'Danh sách người dùng';
        $this->users->learnQueryBuilder();
        $users = new Users();
        $userList = $this->users->getAllUsers();
        return view('clients.users.lists', compact('title', 'userList'));
    }

    public function add()
    {
        $title = 'Thêm người dùng';
        return view('clients.users.add', compact('title'));
    }

    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required|min:5',
                'email' => 'required|email|unique:users',
            ],
            [
                'fullname.required' => 'Ho va ten bat buoc phai nhap',
                'fullname.min' => 'Ho va ten phai lon hon 5 ki tu',
                'email.required' => 'Email bat buoc phai nhap',
                'email.email' => 'Email khong dung dinh dang',
                'email.unique' => 'Email da ton tai'
            ]
        );

        $dataInsert = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->addUser($dataInsert);
        return redirect(route('users.index'))->with('msg', 'Them thanh cong');
    }

    public function getEdit(Request $request, $id)
    {
        $title = 'Cap nhat thông tin người dùng';
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail)) {
                $request->session()->put('id', $id);
                $userDetail = $userDetail[0];
            } else {
                return redirect()->route('users.index')->with('msg', 'Nguoi dung khong ton tai');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'Lien ket khong ton tai');
        }
        return view('clients.users.edit', compact('title', 'userDetail'));
    }

    public function postEdit(Request $request)
    {
        $id = $request->session()->get('id');

        if (empty($id)) {
            return back()->with('msg', 'Nguoi dung khong ton tai');
        }

        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users,email,' . $id,
        ], [
            'fullname.required' => 'Ho va ten bat buoc phai nhap',
            'fullname.min' => 'Ho va ten phai lon hon 5 ki tu',
            'email.required' => 'Email bat buoc phai nhap',
            'email.email' => 'Email khong dung dinh dang',
            'email.unique' => 'Email da ton tai'
        ]);

        $dataUpdate = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];

        $this->users->updateUser($dataUpdate, $id);

        return back()->with('msg', 'Cap nhat thanh cong');
    }

    public function delete($id)
    {
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail)) {
                $deleteStatus = $this->users->deleteUser($id);
                if ($deleteStatus) {
                    $msg = 'Xoa thanh cong';
                } else {
                    $msg = 'Ban ko the xoa nguoi dung nay';
                }
            } else {
                $msg = 'Nguoi dung khong ton tai';
            }
        } else {
            $msg = 'Lien ket khong ton tai';
        }
        return redirect()->route('users.index')->with('msg', $msg);
    }
}