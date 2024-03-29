<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class SupplierController extends Controller
{
    public function showSupplier()
    {
       $all_supplier = DB::table('tbl_supplier')->paginate(5)->appends(request()->query());
        return view('supplier.show_supplier')->with('all_supplier', $all_supplier);
    }

    public function addSupplier()
    {
        return view('supplier.add_supplier');
    }

    public function saveSupplier(Request $request)
    {
       $data = array();
       $data['supplier_name'] = $request->supplier_name;
       $data['supplier_desc'] = $request->supplier_desc;
       $data['supplier_country'] = $request->supplier_country;
       $data['supplier_status'] = $request->supplier_status;
       
       DB::table('tbl_supplier')->insert($data);
       Session::put('message','Thêm nhà cung cấp thành công');
       return redirect('/add-supplier');

    }

    public function unDisplaySupplier($id)
    {
        DB::table('tbl_supplier')->where('supplier_id', $id)->update(['supplier_status'=>0]);
        Session::put('message','Bạn đã ẩn nhà cung cấp thành công');
        return redirect('/show-supplier');
    }

    public function displaySupplier($id)
    {
        DB::table('tbl_supplier')->where('supplier_id', $id)->update(['supplier_status'=>1]);
        Session::put('message','Bạn đã kích hoạt nhà cung cấp thành công');
        return redirect('/show-supplier');
    }

    public function editSupplier($id)
    {
        $edit_supplier = DB::table('tbl_supplier')->where('supplier_id', $id)->first();
        $magage_supplier = view('supplier.edit_supplier')->with('edit_supplier', $edit_supplier);
        return view('admin_layout')->with('supplier.edit_supplier', $magage_supplier);
    }

    public function updateSupplier(Request $request, $id)
    {
        $supplier = array();
        //$brand['brand_id'] = $id;
        $supplier['supplier_name'] = $request->supplier_name;
        $supplier['supplier_desc'] = $request->supplier_desc;
        $supplier['supplier_country'] = $request->supplier_country;
        //$brand->save();
        DB::table('tbl_supplier')->where('supplier_id', $id)->update($supplier);
        Session::put('message','Cập nhật nhà cung cấp thành công');
        return redirect('/show-supplier');
    }
    public function deleteSupplier($id)
    {
        $edit_supplier = DB::table('tbl_supplier')->where('supplier_id', $id)->delete();
        Session::put('message','Xóa nhà cung cấp thành công');
       return redirect('/show-supplier');
    }
}
