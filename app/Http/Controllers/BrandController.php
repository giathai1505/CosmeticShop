<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandController extends Controller
{
    public function showBrand()
    {
       $all_brand = DB::table('tbl_brand')->paginate(5)->appends(request()->query());
        return view('brand.show_brand')->with('all_brand', $all_brand);
    }

    public function addBrand()
    {
        return view('brand.add_brand');
    }

    public function saveBrand(Request $request)
    {
       $data = array();
       $data['brand_name'] = $request->brand_name;
       $data['brand_desc'] = $request->brand_desc;
       $data['brand_status'] = $request->brand_status;

       DB::table('tbl_brand')->insert($data);
       Session::put('message','Thêm nhãn hiệu phẩm thành công');
       return redirect('/add-brand');

    }

    public function unDisplayBrand($id)
    {
        DB::table('tbl_brand')->where('brand_id', $id)->update(['brand_status'=>0]);
        Session::put('message','Bạn đã ẩn nhãn hiệu thành công');
        return redirect('/show-brand');
    }

    public function displayBrand($id)
    {
        DB::table('tbl_brand')->where('brand_id', $id)->update(['brand_status'=>1]);
        Session::put('message','Bạn đã kích hoạt nhãn hiệu thành công');
        return redirect('/show-brand');
    }

    public function editBrand($id)
    {
        $edit_brand = DB::table('tbl_brand')->where('brand_id', $id)->get();
        $magage_brand = view('brand.edit_brand')->with('edit_brand', $edit_brand);
        return view('admin_layout')->with('brand.edit_brand', $magage_brand);
       
        // return view('category.edit_category');
    }

    public function deleteBrand($id)
    {
        $edit_brand = DB::table('tbl_brand')->where('brand_id', $id)->delete();
        Session::put('message','Xóa nhãn hiệu sản phẩm thành công');
       return redirect('/show-brand');
    }
}
