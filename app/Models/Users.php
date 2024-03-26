<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public function getAllUsers()
    {
        $users = DB::select('SELECT * FROM users WHERE id');
        return $users;
    }
    public function addUser($data)
    {
        DB::insert('INSERT INTO users (fullname, email, create_at) values (?, ?,?)', $data);

    }
    public function getDetail($id)
    {
        return DB::select('SELECT * FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }
    public function updateUser($data, $id)
    {
        $data[] = $id;
        return DB::update('UPDATE ' . $this->table . ' SET fullname=?, email=?, update_at=? WHERE id = ?', $data);
    }
    public function deleteUser($id)
    {
        return DB::delete('DELETE FROM ' . $this->table . ' WHERE id=?', [$id]);
    }
    public function statementUser($sql)
    {
        return DB::statement($sql);
    }
    public function learningQueryBuilder()
    {
        DB::enableQueryLog();
        // lấy tất cả bản ghi
        $id = 2;
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
        // $list =DB::table('users')
        // ->select('users.*', 'groups.name')
        // ->rightJoin('groups', 'users.group_id', '=', 'groups_id')
        // ->orderBy('id','desc')
        // ->orderBy('created_at','asc')
        // ->inRandomOrder()
        // ->select(DB::raw('count(id) as email_count'),'email','fullname')
        // ->groupBy('email')
        // ->groupBy('fullname')
        // ->having('email_count','>=',2)
        // ->limit(1)
        // ->offset(1)
        // ->take(2)
        // ->skip(2)
        //     ->get();

        // lấy bản ghi đầu tiên
        // $list = DB::table($this->table)->first();

        $status = DB::table('users')->insert([
            'fullname' => "Hoang huuhung",
            'email' => "hoang@example",
            'group_id' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // dd($status);
        // $lastId = DB::getPdo()->lastInsertId();

        // $lastId = DB::table('users')->insertGetId([
        //     'fullname' =>"Hoang huuhung",
        //     'email' =>"hoang@example",
        //     'group_id'=>1,
        //     'created_at'=>date('Y-m-d H:i:s')
        // ]);
        // dd($lastId);
        // $status = DB::table('users')
        //     ->where('id', 2)
        //     ->update([
        //         'fullname' => "Hoang huuhung",
        //         'email' => "hoang@example",
        //         'group_id' => 1,
        //         'created_at' => date('Y-m-d H:i:s')
        //     ]);


        // $status = DB::table('users')
        // ->where('id', 2)
        // ->delete();
        // dd($status);

        // $count = DB::table('users')->wheres('id','>',20)->count();
        // dd($count);
        $list = DB::table('users')
        // ->selectRaw('email,  fullname count(id) as email_count')
        // ->groupBy('fullname')
        // ->where(DB::raw('id>2'))
        // ->where('id','>',2)
        // ->orWhereRaw('id>20')
        // ->orderByRaw('email,fullname')
        // ->having('email_count' , '>=',2)
        // ->havingRaw('email_count >?',[2])
        // ->where(
        //     'group_id',
        //     '=',
        //     function ($query){
        //         $query->select('id')
        //         ->from('groups')
        //         ->where('name', '=','Administrator');
        //     }
        // )
        // ->select('email',DB::raw('(SELECT count(id) FROM `groups`) as group_count') )
        // ->selectRaw('SELECT count(id) FROM `groups`) as group_count')

        ->get();
        $sql = DB::getQueryLog();
        dd($sql);
    }


}
