<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;
use App\Rules\Uppercase;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public $data = [];

    public function index()
    {
        $this->data['title'] = 'Dao tao lap trinh web';
        $this->data['message'] = 'Dang ky tai khoan thanh cong';

        $users = DB::select('SELECT * FROM users WHERE email = :email', ['email' => 'rady@gmail.com']);   

        dd($users);
    }

    public function products()
    {
        $this->data['title'] = 'San pham';
        return view('clients/products', $this->data);
    }

    public function getAdd()
    {
        $this->data['title'] = 'Them san pham';
        $this->data['error_message'] = 'Kiem tra lai du lieu';
        return view('clients.add', $this->data);
    }

    public function postAdd(ProductRequest $request)
    {
        $rule = [
            'product_name' => ['required', 'min:5', 'max:100'],
            'product_price' => ['required', 'integer'],
            // 'product_name' => 'required|min:5|max:100'.(new Uppercase),
        ];

        $message = [
            'required' => 'Truong :attribute bat buoc phai nhap',
            'min' => 'Truong :attribute phai co do dai tu :min den :max ki tu',
            'integer' => 'Truong :attribute phai la so nguyen',
        ];
        $attributes = [
            'product_name' => 'Ten san pham',
            'product_price' => 'Gia san pham',
        ];

        // $validatior = Validator::make($request->all(), $rule, $message);
        // $validatior->validate();
        $request->validate($rule, $message, $attributes);
        return response()->json(['status' => 'success']);
        // if ($validatior->fails()) {
        //     $validatior->errors()->add('msg', 'Vui long kiem tra lai du lieu');
            // return 'Validate that bai';
        // } else {
             // return 'Validate thanh cong';
        //     return redirect()->route('product')->with('msg', 'Validate thanh cong');
        // }

        // return back()->withErrors($validatior)->withInput();
    }

    public function putAdd(Request $request)
    {
        return 'Phuong thuc PUT';
        dd($request);
    }

    public function getArr()
    {
        $contentArr = [
            'name' => 'Laravel-10x',
            'lesson' => 'Khoa hoc lap trinh Laravel',
            'academy' => 'Unicode'
        ];
        return $contentArr;
    }

    public function downloadImage(Request $request)
    {
        if (!empty($request->image)) {
            $image = trim($request->image);
            $fileName = 'image_' . uniqid() . '.jpg';
            // $fileName = basename($image);
            // echo $fileName;
            // return response()->streamDownload(function() use ($image){
            //     $imageContent = file_get_contents($image);
            //     echo $imageContent;
            // },'image.jpg');
            return response()->download($image, $fileName);
        }
    }

    public function downloadDoc(Request $request)
    {
        if (!empty($request->image)) {
            $file = trim($request->file);
            $fileName = 'tai_lieu_' . uniqid() . '.pdf';
            $header = ['Content-Type' => 'application/pdf'];
            return response()->download($file, $fileName, $header);
        }
    }
}