@extends('admin_layout')
@section('admin_content')
<div class="x_panel">
    <div class="x_title">
        <h2>Thêm sản phẩm mới </h2>
        <ul class="nav navbar-right panel_toolbox" style="margin-left:100px">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br />
        <?php

            $message = Session::get('message');
            if ($message) {
                ?>
                    <div class="alert alert-success" role="alert">
                        Thêm sản phẩm thành công
                    </div>
                <?php
                Session::put('message','');
            }
        ?>
    </div>
    <div class="x_content">
        <br />
    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tên sản phẩm <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">

                    <input type="text" id="first-name" required="required" class="form-control " name="product_name">

                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hình ảnh sản phẩm <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">

                    <input type="file" id="first-name" required="required" class="form-control " name="product_img">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Giá sản phẩm <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="last-name" required="required" class="form-control" name="product_price">

                </div>
            </div>
            <div class="item form-group">
                <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Số  lượng </label>
                <div class="col-md-6 col-sm-6 ">
                    <input id="middle-name" class="form-control" type="text" name="product_quanity">
                </div>
            </div>
            <div class=" item form-group">
                <label class="col-form-label col-md-3 col-sm-3  label-align">Mô tả sản phẩm<span class="required">*</span></label>
                <div class="col-md-9 col-sm-9">
                    <textarea required="required" cols="30" rows="5" name="product_desc"></textarea></div>
            </div>
            <div class="form-group item">
                <label class="control-form-label col-md-3 col-sm-3 label-align" >Danh mục</label>
                <div class="col-md-6 col-sm-6 ">
                    <select name="produce_cate" class="form-control">
                        @foreach($cate_product as $key => $cate)
                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group item">
                <label class="control-form-label col-md-3 col-sm-3 label-align" >Nhãn hiệu</label>
                <div class="col-md-6 col-sm-6 ">
                    <select name="produce_brand" class="form-control">
                        @foreach($brand_product as $key => $brand)
                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group item">
                <label class="control-form-label col-md-3 col-sm-3 label-align" >Nhà cung cấp</label>
                <div class="col-md-6 col-sm-6 ">

                    <select name="produce_supplier" class="form-control">
                        @foreach($supplier_product as $key => $supplier)
                        <option value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="item form-group">

                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Giảm giá</label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="last-name" required="required" class="form-control" name="product_discount">
=======
                <label class="col-form-label col-md-3 col-sm-3 label-align">Tình trạng sản phẩm</label>
                <div class="col-md-6 col-sm-6 ">
                    <div id="gender" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="product_status" value="0" class="join-btn"> &nbsp; Hết hàng &nbsp;
                        </label>
                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="product_status" value="1" class="join-btn"> Còn hàng
                        </label>
                    </div>

                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Tình trạng</label>
                <div class="col-md-6 col-sm-6 ">
                    <div id="gender" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">

                            <input type="radio" name="product_status" value="1" class="join-btn"> &nbsp; Còn hàng &nbsp;
                        </label>
                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="product_status" value="0" class="join-btn"> Hết hàng
=======
                            <input type="radio" name="product_state" value="0" class="join-btn"> &nbsp; Ẩn &nbsp;
                        </label>
                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="product_state" value="1" class="join-btn"> Hiện

                        </label>
                    </div>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Ngày hết hạn <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input id="birthday" class="date-picker form-control" name="product_expire" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">

                    <script>
                        function timeFunctionLong(input) {
                            setTimeout(function() {
                                input.type = 'text';
                            }, 60000);
                        }
                    </script>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button class="btn btn-primary" type="submit">Thêm</button>
                    <button class="btn btn-primary" type="reset">Reset</button>
                   <a href="{{URL::to('/show-product-admin')}}" class="btn btn-success">Danh sách sản phẩm</a>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection