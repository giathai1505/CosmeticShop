@extends('admin_layout')
@section('admin_content')
<div class="x_panel">
    <div class="x_title">
        <h2 class="admin_part_heading">Thêm thư viện ảnh </h2>
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
             <?php echo $message; ?>
              </div>
          <?php
          Session::put('message','');
        }
      ?>
      <form action="{{URL::to('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
          <div class="col-md-3" aglin="right">

          </div>
          <div class="col-md-6">
            <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
            <span id="error_gallery"></span>
          </div>
          <div class="col-md-3" aglin="right">
            <input type="submit" name="upload" name="taianh" value="Tải ảnh" class="btn-btn-success btn-xs">
        </div>

      </div>
      </form>
       <div class="panel-body">
           <input type="hidden" value="{{$pro_id}}" name = "pro_id" class = "pro_id">
            <form action="">
                {{ csrf_field() }}
                    <div class="gallery_load">
                        
                    </div>
            </form>
       </div>
</div>
@endsection