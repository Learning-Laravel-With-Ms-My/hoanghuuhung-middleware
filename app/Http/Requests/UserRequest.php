<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uniqueEmail = 'unique:users';
        if(session('id')){
            $id = session('id');
            $uniqueEmail = 'unique:users,email,'.$id;
        }
        return [
            'fullname' => 'required|min:5',
            'email' => 'required|email|'.$uniqueEmail,
            'group_id' =>['required','integer', function($attribute, $value, $fail ){
                if($value == 0){
                    $fail('Bat buoc chon nhom');
                }
            }],
            'status' =>'required|integer',
        ];
    }
    public function messages(){
        return  [
            'fullname.required' => 'Ho va ten bat buoc phai nhap',
            'fullname.min' => 'Ho va ten phai lon hon 5 ki tu',
            'email.required' => 'Email bat buoc phai nhap',
            'email.email' => 'Email khong dung dinh dang',
            'email.unique' => 'Email da ton tai',
            'group_id.required' => 'Nhom ko duoc de trong',
            'group_id.integer' => 'Nhom ko hop le',
            'status.required' => 'Trang thai bat buoc phai nhap',
            'status.integer' => 'Trang thai ko hop le',
        ];
    }
}
