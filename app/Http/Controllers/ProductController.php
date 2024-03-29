<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\GalleryModel;
use App\Models\Product;
use Cart;
use File;
session_start();

class ProductController extends Controller
{
      
    public function showProduct(Request $request)
    {
        $sort_by = $request->sort_by;
        
        if($sort_by == 'giam_dan'){
            $sort_field = 'product_price';
            $sort_order = 'DESC';
        }elseif($sort_by=='tang_dan'){
            $sort_field = 'product_price';
            $sort_order = 'ASC';               
        }elseif($sort_by=='kytu_za'){
            $sort_field = 'product_name';
            $sort_order = 'DESC';        
        }elseif($sort_by=='kytu_az'){
            $sort_field = 'product_name';
            $sort_order = 'ASC';                
        }else{
            $sort_field = 'product_id';
            $sort_order = 'ASC';
        }

       $all_product = DB::table('tbl_product')
       ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
       ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
       ->join('tbl_supplier','tbl_supplier.supplier_id','=','tbl_product.supplier_id')
       ->orderby($sort_field, $sort_order)->paginate(5)->appends(request()->query());
    //    $manage_product = view('product_admin.all_product')->with('all_product',$all_product);
        return view('product_admin.show_product_admin')->with(compact('all_product', $all_product));
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_by = $request->sort_by;
        
        if($sort_by == 'giam_dan'){
            $sort_field = 'product_price';
            $sort_order = 'DESC';
        }elseif($sort_by=='tang_dan'){
            $sort_field = 'product_price';
            $sort_order = 'ASC';               
        }elseif($sort_by=='kytu_za'){
            $sort_field = 'product_name';
            $sort_order = 'DESC';        
        }elseif($sort_by=='kytu_az'){
            $sort_field = 'product_name';
            $sort_order = 'ASC';                
        }else{
            $sort_field = 'product_id';
            $sort_order = 'ASC';
        }

        
        $all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->join('tbl_supplier','tbl_supplier.supplier_id', '=', 'tbl_product.supplier_id')
        ->orderBy($sort_field, $sort_order)->get();
        return view('product_admin.show_product_admin') ->with(compact('all_product', $all_product));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmuc = DB::table('tbl_category_product')->orderBy('category_id','DESC')->get();
        $nhanhieu = DB::table('tbl_brand')->orderBy('brand_id', 'DESC')->get();
        $nhacungcap = DB::table('tbl_supplier')->orderBy('supplier_id', 'DESC')->get();
        return view('product_admin.add_product_admin')->with(compact('danhmuc','nhanhieu', 'nhacungcap'));
    }

    public function saveImage($image){
        $path = 'public/backEnd/images';
        $image_name = $image->getClientOriginalName();
        $image_name = current(explode('.', $image_name));
        $new_image_name = $image_name.rand(0,99).'.'.$image->getClientOriginalExtension();
        $image->move($path, $new_image_name);
        return $new_image_name;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_quanity'] = $request->product_quanity;
        $data['product_status'] = $request->product_status;
        $data['product_state'] = $request->product_state;
        $data['product_expire'] = $request->product_expire;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['supplier_id'] = $request->supplier_id;
        //Thêm ảnh
        $path_gallery = 'public/backEnd/images/gallery/';
        $path = 'public/backEnd/images/';
        $image = $request->file('product_image');
        $image_name = $image->getClientOriginalName();
        $image_name = current(explode('.', $image_name));
        $new_image_name = $image_name.rand(0,99).'.'.$image->getClientOriginalExtension();
        $image->move($path, $new_image_name);
        File::copy($path.$new_image_name, $path_gallery.$new_image_name);
        $data['product_img'] = $new_image_name;
        
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new GalleryModel();
        $gallery->gallery_img = $new_image_name;
        $gallery->gallery_name = $new_image_name;
        $gallery->product_id = $pro_id;
        $gallery->save();

        Session::put('message','Thêm sản phẩm thành công');
        return redirect('/add-product-admin');        
    }
     
    public function unStatusProduct($id)
    {
        DB::table('tbl_product')->where('product_id', $id)->update(['product_status'=>0]);
        Session::put('message','Sản phẩm hết hàng');
        return redirect('/show-product-admin');
    }

    public function statusProduct($id)
    {
        DB::table('tbl_product')->where('product_id', $id)->update(['product_status'=>1]);
        Session::put('message','Sản phẩm còn hàng');
        return redirect('/show-product-admin');
    }

    public function unStateProduct($id)
    {
        DB::table('tbl_product')->where('product_id', $id)->update(['product_state'=>0]);
        Session::put('message','Bạn đã ẩn danh mục thành công');
        return redirect('/show-product-admin');
    }

    public function stateProduct($id)
    {
       $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
       $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
       $supplier_product = DB::table('tbl_supplier')->orderby('supplier_id','desc')->get();
       Session::put('message','Thêm sản phẩm thành công');
       return view('product_admin.add_product_admin')->with('cate_product', $cate_product)->with('brand_product',$brand_product)->with('supplier_product', $supplier_product);

    }
    public function saveProduct(Request $request)
    {
       $data = array();
       $data['product_name'] = $request->product_name;
       $data['product_price'] = $request->product_price;
       $data['product_quanity'] = $request->product_quanity;
       $data['product_desc'] = $request->product_desc;
       $data['category_id'] = $request->produce_cate;
       $data['brand_id'] = $request->produce_brand;
       $data['supplier_id'] = $request->produce_supplier;
       $data['discount_id'] = $request->product_discount;
       $data['product_status'] = $request->product_status;
       $data['product_expire'] = $request->product_expire;
       $get_image = $request->file('product_img');
       if ($get_image) {
           $get_name_image = $get_image->getClientOriginalName();
           $name_image = current(explode('.',$get_name_image));
           $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('public/backEnd/images', $new_image);
           $data['product_img'] = $new_image;
           DB::table('tbl_product')->insert($data);
           Session::put('message','Thêm sản phẩm thành công');
           return redirect('/add-product-admin');
       }
    
    }

    public function unDisplayProduct($id)
    {
        DB::table('tbl_product')->where('product_id', $id)->update(['product_status'=>0]);
        Session::put('message','Bạn đã ẩn sản phẩm thành công');
        return redirect('/show-product-admin');
    }

    public function displayProduct($id)
    {
        DB::table('tbl_product')->where('product_id', $id)->update(['product_status'=>1]);
        Session::put('message','Bạn đã kích hoạt sản phẩm thành công');
        return redirect('/show-product-admin');
    }

    public function editProduct($id)
    {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $supplier_product = DB::table('tbl_supplier')->orderby('supplier_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $id)->get();
        $manage_product = view('product_admin.edit_product_admin')->with(compact('edit_product','cate_product','brand_product','supplier_product'));
        
        return view('admin_layout')->with('product_admin.edit_product_admin', $manage_product);
        
    }

    public function deleteProduct($id)
    {
        DB::table('tbl_product')->where('product_id', $id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return redirect('/show-product-admin');
    }

    public function updateProduct(Request $request, $id)
    {     
        $product = array();  
        $product['product_name'] = $request->product_name;
        $product['product_price'] = $request->product_price;
        $product['product_desc'] = $request->product_desc;
        $product['product_quanity'] = $request->product_quanity;
        $product['product_expire'] = $request->product_expire;
        $product['category_id'] = $request->category_id;
        $product['brand_id'] = $request->brand_id;
        $product['supplier_id'] = $request->supplier_id;
        
        // $product['discount_id'] = $request->product_discount;
        $product['product_status'] = $request->product_status;
        $product['product_expire'] = $request->product_expire;        
        $get_image = $request->file('product_img');
        if($get_image){ 
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/backEnd/images', $new_image);
                $product['product_img'] = $new_image;
            }
            DB::table('tbl_product')->where('product_id',$id)->update($product);
            Session::put('message','Cập nhật sản phẩm thành công');
            return redirect('/show-product-admin');   
        }

    }

    public function searchProduct(Request $request) {
         $search = $request->tukhoa;
        
        $all_product = DB::table('tbl_product')
       ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
       ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
       ->join('tbl_supplier','tbl_supplier.supplier_id','=','tbl_product.supplier_id')->where('product_name', 'like', '%'.$search.'%')
       ->paginate(4)->appends(request()->query());

       return view('product_admin.show_product_admin')->with('all_product', $all_product);  
        
    }
    public function index(Request $request)
    {
        $sort_by = $request->sort_by;
        
        if($sort_by == 'giam_dan'){
            $sort_field = 'product_price';
            $sort_order = 'DESC';
        }elseif($sort_by=='tang_dan'){
            $sort_field = 'product_price';
            $sort_order = 'ASC';               
        }elseif($sort_by=='kytu_za'){
            $sort_field = 'product_name';
            $sort_order = 'DESC';        
        }elseif($sort_by=='kytu_az'){
            $sort_field = 'product_name';
            $sort_order = 'ASC';                
        }else{
            $sort_field = 'product_id';
            $sort_order = 'ASC';
        }

        
        $all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->join('tbl_supplier','tbl_supplier.supplier_id', '=', 'tbl_product.supplier_id')
        ->orderBy($sort_field, $sort_order)->get();
        return view('product_admin.show_product_admin') ->with(compact('all_product', $all_product));
    }
    
=======
        DB::table('tbl_product')->where('product_id', $id)->update(['product_state'=>1]);
        Session::put('message','Bạn đã hiện danh mục thành công');
        return redirect('/show-product-admin');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_product = DB::table('tbl_product')->where('product_id', $id)->first();
        $danhmuc = DB::table('tbl_category_product')->orderBy('category_id','DESC')->get();
        $nhanhieu = DB::table('tbl_brand')->orderBy('brand_id', 'DESC')->get();
        $nhacungcap = DB::table('tbl_supplier')->orderBy('supplier_id', 'DESC')->get();
        $magage_product = view('product_admin.edit_product_admin')->with(compact('edit_product','danhmuc','nhanhieu','nhacungcap'));
        return view('admin_layout')->with('product_admin.edit_product_admin', $magage_product);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */   
    public function update(Request $request, $id)
    {     
        $product = array();       
        $image = $request->file('product_image');
        if($image !=NULL){ 
            $new_image_name = $this->saveImage($image);
            $product['product_img'] = $new_image_name;   
        }

        $product['product_name'] = $request->product_name;
        $product['product_price'] = $request->product_price;
        $product['product_desc'] = $request->product_desc;
        $product['product_quanity'] = $request->product_quanity;
        $product['product_expire'] = $request->product_expire;
        $product['category_id'] = $request->category_id;
        $product['brand_id'] = $request->brand_id;
        $product['supplier_id'] = $request->supplier_id;

        DB::table('tbl_product')->where('product_id', $id)->update($product);
        Session::put('message','Cập nhập sản phẩm thành công');
        return redirect('/show-product-admin');   
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('tbl_product')->where('product_id', $id)->first();
        $path = 'public/backEnd/images/'.$product->product_img;
        if(file_exists($path)){
            unlink($path);
        }
        $delete_product = DB::table('tbl_product')->where('product_id', $id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
       return redirect('/show-product-admin');
    }

    // end pages admin
    public function detailProduct($id){
        $thuonghieu = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','DESC')->get();
        $nhacungcap = DB::table('tbl_supplier')->where('supplier_status', '1')->orderBy('supplier_id','DESC')->get();
        
        $detail_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->join('tbl_supplier','tbl_supplier.supplier_id', '=', 'tbl_product.supplier_id')
        ->where('tbl_product.product_id', $id)->get();
        
        foreach($detail_product as $key => $result){
            $category_id = $result->category_id;
            $product_id = $result->product_id;
        }
        //gallery
        $gallery = DB::table('tbl_gallery')->where('product_id', $product_id)->get();
        $relative_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->join('tbl_supplier','tbl_supplier.supplier_id', '=', 'tbl_product.supplier_id')
        ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$id])->paginate(4);
        
        return view('pages.product_detail.show_product_detail')->with('brand', $thuonghieu)->with('supplier', $nhacungcap)
        ->with('product_details', $detail_product)->with('product_relative', $relative_product)->with('gallery', $gallery);
    }  
    
    public function searchProductAdmin(Request $request){
        
        
    }  

    public function AddRelativeProductCart(Request $request){
        $productId= $request->productid_hidden;
        $quantity = $request->qty_cart;
        $name = $request->product_cart_name;
        $price = $request->product_cart_price;
        $product_imgage = $request->product_cart_image;
        $cart_product = DB::table('tbl_product')->where('product_id', $productId)->first(); 
        $data['id'] = $productId;
        $data['qty'] = $quantity;
        $data['name'] = $name;
        $data['price'] = $price;
        $data['weight'] = 1;
        $data['options']['image'] = $product_imgage;
        Cart::add($data);
        $thuonghieu = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','DESC')->get();
        $nhacungcap = DB::table('tbl_supplier')->where('supplier_status', '1')->orderBy('supplier_id','DESC')->get();
        
        $detail_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->join('tbl_supplier','tbl_supplier.supplier_id', '=', 'tbl_product.supplier_id')
        ->where('tbl_product.product_id',  $productId)->get();
        foreach($detail_product as $key => $result){
            $category_id = $result->category_id;
            $product_id = $result->product_id;
        }

        //gallery
        $gallery = DB::table('tbl_gallery')->where('product_id', $product_id)->get();
        $relative_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->join('tbl_supplier','tbl_supplier.supplier_id', '=', 'tbl_product.supplier_id')
        ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$productId])->paginate(4);
        Session::put('message','Thêm sản phẩm thành công');
        return view('pages.product_detail.show_product_detail')->with('brand', $thuonghieu)->with('supplier', $nhacungcap)
        ->with('product_details', $detail_product)->with('product_relative', $relative_product)->with('gallery', $gallery);
    }

  

}
    

