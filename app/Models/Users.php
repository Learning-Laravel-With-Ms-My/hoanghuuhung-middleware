<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public function getAllUsers(){
        $users = DB::select('SELECT * FROM users WHERE id');
        return $users;
    }
    public function addUser($data){
        DB::insert('INSERT INTO users (fullname, email, create_at) values (?, ?,?)',$data);

    }
    public function getDetail($id){
       return DB::select('SELECT * FROM '. $this->table.' WHERE id = ?',[$id]);
    }
    public function updateUser($data, $id){
        $data[] = $id;
        return DB::update('UPDATE ' . $this->table . ' SET fullname=?, email=?, update_at=? WHERE id = ?', $data);
    }
    public function deleteUser($id){
        return DB::delete('DELETE FROM '. $this->table . ' WHERE id=?',[$id]);
    }
    public function statementUser($sql){
        return DB::statement($sql);
    }
    public function learningQueryBuilder(){
        DB::enableQueryLog();
        // lấy tất cả bản ghi
        $id =2;
        // $lists = DB::table($this->table)
        // dd($list);
        // ->where('id','>=',1)->get();
        // ->where('id','<>',19)->get();
        // ->select('fullname as hoten', 'email', 'id','updated_at','created_at')
        // ->where('id',1)
        // ->where(function($query) use  ($id) {
        //     $query ->where('id','<',$id)->orWhere('id','>',2);
        // })
        // ->where('fullname','like','%hoanghung%')
        // ->whereBetween('id',[1,3])
        // ->whereNotBetween('id',[1,3])
        // ->whereDate('updated_at','2024-3-24')    
        // ->whereMonth('updated_at','03')
        // ->whereDate('updated_at','24')
        // ->whereYear('updated_at','2024')
        // ->whereColumn('updated_at','<>','created_at')
        // ->whereIn('id',[1,3])
        // ->whereNotIn('id',[1,3])
        // ->whereNull('updated_at')
        // ->whereNotNull('updated_at')
        // ->where('id', 1)->orWhere('id',2)
        // // ->get();
        // ->toSql();
        // ->get();


        //join bảng
        $list =DB::table('users')
        ->select('users.*', 'groups.name')
        ->rightJoin('groups', 'users.group_id', '=', 'groups_id')
            ->get();
        $sql = DB::getQueryLog();
        dd($sql);
        // lấy bản ghi đầu tiên
        // $list = DB::table($this->table)->first();
    }

    
}
