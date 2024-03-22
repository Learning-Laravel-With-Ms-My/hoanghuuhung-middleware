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
        $statement = $this->users->statementUser('SELECT * FROM users');
        // dd($statement);
        $title = "danh sách người dùng";
        $this->users->learningQueryBuilder();

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
    public function getEdit(Request $request, $id=0){
        $title = "Cập nhât User mới";
        if(!empty($id)){
            $userDetail = $this->users->getDetail($id);
            if(!empty($userDetail[0])){
                $request->session()->put('id',$id);
                $userDetail = $userDetail[0];
            }else{
                return redirect()->route('users.index')->with('msg','Người dùng không tồn tại');

            }
        }else{
            return redirect()->route('users.index')->with('msg','Liên kết không tồn tại');
        }
        return view('users.edit', compact('title','userDetail'));
    }
    public function postEdit(Request $request){
        $id =session('id');
        if(empty($id)){
            return back()->with('msg','Id khoogn tion tai');
        }
        $request->validate(
            [
                'fullname' =>'required|min:5',
                'email' =>'required|email|unique:users,email,'.$id,
            ],[
                'fullname.required' =>'Họ tên bắt buộc phải nhập',
                'fullname.min' =>'Họ tên phải lớn hơn :min kí tự',
                'email.required' =>'Email bắt buộc nhập',
                'email.email' =>'Email không đúng định dạng',
                'email.unique'=>'Email đã tồn tại trên hệ thống'
            ]
        );
        $dataUpdate = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->updateUser($dataUpdate,$id);
        return redirect()->route('users.edit',['id'=>$id])->with('cập nhật người dùng thành công');
    }
    public function delete($id){
        if(!empty($id)){
            $userDetail = $this->users->getDetail($id);
            if(!empty($userDetail[0])){
                $deleteStatus = $this->users->deleteUser($id);
                if($deleteStatus){
                    $msg = "xóa thành công";

                }else{
                    $msg = "bạn không thể xóa";
                }
            }else{
                $msg = 'Người dùng không tồn tại';

            }
        }else{
            $msg = 'Liên kết không tồn tại';
        }
        return redirect()->route('users.index')->with('msg',$msg);
    }

}
