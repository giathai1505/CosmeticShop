@extends('admin_layout')
@section('admin_content')
<div class="x_panel">
    <div class="x_title">
        <h2 class="admin_part_heading abc">Thêm danh mục sản phẩm mới </h2>
        <ul class="nav navbar-right panel_toolbox">
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
        if ($message)
        {
          ?>
              <div class="alert alert-success" role="alert">
                Thêm danh mục sản phẩm thành công
              </div>
          <?php
          Session::put('message','');
        }
      ?>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{URL::to('/save-category-product')}}">
                {{ csrf_field() }}
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="category_product_name">Tên danh mục <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" id="first-name" required="required" class="form-control " name="category_product_name">
                </div>
            </div>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Mô tả danh mục <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <textarea id="first-name" required="required" class="form-control " cols="30" rows="5" name="category_product_desc"></textarea>
                </div>
            </div>
          
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Tình trạng</label>
                <div class="col-md-6 col-sm-6 ">
                    <div id="gender" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="category_product_status" value="0" class="join-btn" checked >  &nbsp; Ẩn &nbsp;
                        </label>
                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="category_product_status" value="1" class="join-btn" > Hiện
                        </label>
                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success">Thêm</button>
                    <a class="btn btn-primary" href="{{URL::to('/show-category')}}" type="button">Danh sách danh mục</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection