<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Groups;
use App\Helper\Functions;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private $users;
    private $groups;
    const _PER_PAGE = 2;
    public function __construct()
    {
        $this->users = new Users();
        $this->groups = new Groups();
    }

    public function index(Request $request)
    {
        // $statement = $this->users->statementUser('DELETE FROM users');
        // $statement = $this->users->statementUser('SELECT * FROM users');
        // dd($statement);

        $title = 'Danh sách người dùng';
        // $this->users->learnQueryBuilder();
        $users = new Users();
        $filters =[];
        $keywords =null;
        $sortBy =$request->input('sort-type');
        if(!empty($request->status)){
            $status = $request->status;
            if($status == 'active'){
                $status = 1;
            }else{
                $status =0;
            }
            $filters[] =['users.status','=',$status];
        }
        if(!empty($request->group_id)){
            $groupId = $request->group_id;
            $filters[] =['users.group_id','=',$groupId];
        }
        if(!empty($request->keywords)){
            $keywords = $request->keywords;
            
        }

        //xurw ly sap xep
        $sortType = $request->input('sort-type');
        $allowSort =['asc','desc'];
        if(!empty($sortType) && in_array($sortType,$allowSort)){
            if($sortType=='desc'){
                $sortType= 'asc';
            }else{
                $sortType='desc';
            }
        }else{
            $sortType ='asc';
        }
        $sortArr =[
            'sortBy' => $sortBy,
            'sort-type'=>$sortType
        ];
        $userList = $this->users->getAllUsers($filters,$keywords,$sortArr,self::_PER_PAGE);
        $groups = $this->groups->getAll();
        // dd($groups);
        return view('clients.users.lists', compact('title', 'userList','groups','sortType'));
    }

    public function add()
    {
        $groups = $this->groups->getAll();
        $title = 'Thêm người dùng';
        return view('clients.users.add', compact('title','groups'));
    }

    public function postAdd(UserRequest $request)
    {
        

        $dataInsert = [
            'fullname'=> $request->fullname,
            'email'=>$request->email,
            'group_id'=>$request->group_id,
            'status'=>$request->status,
            'create_at' => date('Y-m-d H:i:s'),
        ];
        $this->users->addUser($dataInsert);
        return redirect(route('users.index'))->with('msg', 'Them thanh cong');
    }

    public function getEdit(Request $request, $id)
    {
        $title = 'Cap nhat thông tin người dùng';
        $groups = $this->groups->getAll();
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
        return view('clients.users.edit', compact('title', 'userDetail','groups'));
    }

    public function postEdit(UserRequest $request)
    {
        $id = $request->session()->get('id');

        if (empty($id)) {
            return back()->with('msg', 'Nguoi dung khong ton tai');
        }

       

        $dataUpdate = [
            'fullname'=> $request->fullname,
            'email'=>$request->email,
            'group_id'=>$request->group_id,
            'status'=>$request->status,
            'update_at' => date('Y-m-d H:i:s'),
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