
@extends('frontLayout')
@section('frontEndContent')
  <!-- start slide and sub image -->
    <div class="row slide">
        <div class="col-sm-3 sub_image">
            <div class="sub_image1">
                <img src="{{('public/frontEnd/images/subimage1.jpg')}}" alt="">
                <h4>New products</h4>
            </div>

            <div class="sub_image2">
                <img src="{{('public/frontEnd/images/subimage2.jpg')}}" alt="">
                <h4>Black Fridays</h4>
            </div>

        </div>
        <div class="col-sm-9 main_slide">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{('public/frontEnd/images/slide_1.png')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{('public/frontEnd/images/slider_2.png')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{('public/frontEnd/images/slider_3.png')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <!-- end slide and sub image -->
    <!-- start main product -->

<div class="row product">
    <!-- start left sidebar include: category, wishlist, popular tag, newsletter -->
    <div class="col-sm-3 sidebar">
        <!--category -->
        <div class="category">
            <h3 class="category_heading">
                DANH MỤC SẢN PHẨM
            </h3>
            <ul class="category_list">
                @foreach($category as $key => $muc)
                <li><a href="{{URL::to('/chi-tiet-danh-muc/'.$muc->category_id)}}"><i class="fas fa-angle-right"></i>{{$muc->category_name}} <span>+</span></a></li>
                @endforeach
            </ul>
        </div>
        <!-- category -->
        <!-- start wishtlist -->
        <div class="wishlist">
            <h3>WISHLIST</h3>
            <div class="wishlist_item">
                <img src="{{('public/frontEnd/images/pr2.png')}}" alt="">
                <div class="wishlist_content">
                    <h4>Kem trị mụn</h4>
                    <p class="wishlist_price">100.000 vnd</p>
                    <p class="wishlist_qty">Quanity: 1</p>
                </div>
                <i class="fas fa-times"></i>
            </div>
            <div class="wishlist_item">
                <img src="{{('public/frontEnd/images/pr3.png')}}" alt="">
                <div class="wishlist_content">
                    <h4>Tẩy tế bào chết</h4>
                    <p class="wishlist_price">200.000 vnd</p>
                    <p class="wishlist_qty">Quanity: 2</p>
                </div>
                <i class="fas fa-times"></i>
            </div>
            <div class="wishlist_qtyitem">
                2 items
            </div>
        </div>
        <!-- end wishlist -->
        <!-- start popular tag -->
        <div class="popular_tag">
            <h3>POPULAR TAGS</h3>
            <ul class="popular_list">
                <li><a href="">Trị mụn</a></li>
                <li><a href="">Bông tẩy trang</a></li>
                <li><a href="">Son môi</a></li>
                <li><a href="">Dưỡng ẩm</a></li>
                <li><a href="">Liền sẹo</a></li>
                <li><a href="">Mặt nạ</a></li>
                <li><a href="">Lột mụn</a></li>
                <li><a href="">Oxy</a></li>
                <li><a href="">Trắng da</a></li>
            </ul>
        </div>
        <!-- end popular tag -->
        <!-- start newsletter -->
        <div class="newsletter">
            <h3>NEWLETTERS</h3>
            <div class="content">
                <p>sign up for your newsletter</p>
                <input type="text" placeholder="Your email here">
                <button>Subcribe</button>
            </div>
            <div class="image">
                <img src="{{('public/frontEnd/images/newletter.jpg')}}" alt="">
            </div>
        </div>
    </div>
    <!-- end newsletter -->
    <!-- end left side bar -->


    <!-- start list product -->


<div class="col-sm-9 main_product">
        <div class="container">
        
            <div class="row heading">
                <p>Kết quả tìm kiếm<p>
                <h6>Bạn tìm kiếm với từ khóa là: {{$search_keyword}}</h6>
            </div>
            @php
                $count = count($search_product);
            @endphp
            @if($count == 0)
                <div>
                    Không tìm thấy sản phẩm phù hợp
                </div>
            @else
            <div class="row">
                <label for="amount"> Sắp xếp theo</label>
                <form id="form-sort" method="GET">
                    {{ csrf_field() }}
                    <input type="hidden" name="tukhoa" value="{{$search_keyword}}">
                    <select name="sort_by" id="sort" class="form-control" form="form-sort">
                        <option value="none">--Lọc--</option>
                        <option value="tang_dan">--Giá tăng dần--</option>
                        <option value="giam_dan">--Giá giảm dần--</option>
                        <option value="kytu_az">Lọc theo tên A đến Z</option>
                        <option value="kytu_za">Lọc theo tên Z đến A</option>
                    </select>
                </form>
            </div>
            <div class ="row">
            @foreach($search_product as $key => $sp)
                <br />
                <?php
                $message = Session::get('message');
                if ($message)
                {
                ?>
                    <div class="alert alert-success" role="alert">
                        Sản phẩm {{$sp->product_name}} đã được thêm vào giỏi hàng.<a href="{{URL::to('/cart')}}">Xem giỏ hàng</a>
                    </div>
                <?php
                Session::put('message','');
                }
                ?>
                <div class="col-sm-4 product_wrap">
                <a href="{{URL::to('/chi-tiet-san-pham/'.$sp->product_id)}}">
                    <div class="home-product-item">
                        <div class="product_image">
                            <img src="{{URL::to('public/backEnd/images/'.$sp->product_img)}}" alt="">
                            <div class="overlay"></div>
                            <form action="{{URL::to('/add-product-search-to-cart')}}" method="POST">
                            {{ csrf_field() }}
                                <input type="hidden" name="productid_hidden" value="{{$sp->product_id}}" />
                                <input type="hidden" name="product_cart_name" value="{{$sp->product_name}}" />
                                <input type="hidden" name="product_cart_price" value="{{$sp->product_price}}" />
                                <input type="hidden" name="product_cart_image" value="{{$sp->product_img}}" />
                                <input type="hidden" name="qty_cart" value="1" min="1"> 
                                <button type="submit" class="add_cart" ><i class="fas fa-cart-plus"></i>Add to cart</button> 
                            </form> 
                            <!-- <div class="add_cart"><i class="fas fa-cart-plus"></i>Add to cart</div> -->
                        </div>

                        <div class="product_content">
                            <h3 class="name">{{$sp->product_name}}</h3>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </p>
                            <p class="price">
                                {{number_format($sp->product_price).' VNĐ'}}
                            </p>
                            <div class="add_to">
                                <button>Add to wishlist</button>
                                <button>View detail</button>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
            @endforeach
            @endif
                
            </div>
            
            <div class="row">
                <div class="col l-12 m-12 c-12 pagination_wrap">
                <div class="pagination">
                    <li style="display:inline;{{ ($search_product->currentPage() == 1) ? 'none;' : '' }}">
                        <a href="{{ $search_product->url(1) }}">&laquo;</a>
                    </li>
                    @for ($i = 1; $i <= $search_product->lastPage(); $i++)
                        <?php
                        $link_limit = 7;
                        $half_total_links = floor($link_limit / 2);
                        $from = $search_product->currentPage() - $half_total_links;
                        $to = $search_product->currentPage() + $half_total_links;
                        if ($search_product->currentPage() < $half_total_links) {
                        $to += $half_total_links - $search_product->currentPage();
                        }
                        if ($search_product->lastPage() - $search_product->currentPage() < $half_total_links) {
                            $from -= $half_total_links - ($search_product->lastPage() - $search_product->currentPage()) - 1;
                        }
                        ?>
                        @if ($from < $i && $i < $to)
                            <li style="display:inline;" class="{{ ($search_product->currentPage() == $i) ? ' active' : '' }}">
                                <a href="{{ $search_product->url($i) }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor
                    <li style="display:inline;{{ ($search_product->currentPage() == $search_product->lastPage()) ? 'none;' : '' }}">
                        <a href="{{ $search_product->url($search_product->lastPage()) }}">&raquo;</a>
                    </li>
                </div>

            </div>
            <div class="row sales">
                <div class="col l-6 m-6 c-12 single_sale">
                    <div class="single_sale_imgae">
                        <img src="{{('public/frontEnd/images/single_sale1.jpg')}}" alt="">
                        <div class="sale_overlay"></div>
                        <div class="sale_discount">Up to 40% off</div>
                    </div>
                </div>
                <div class="col l-6 m-6 c-12 single_sale">
                    <div class="single_sale_imgae">
                        <img src="{{('public/frontEnd/images/single_sale2.jpg')}}" alt="">
                        <div class="sale_overlay"></div>
                        <div class="sale_discount">Sale off 30%</div>
                    </div>
                </div>
            </div>
            <div class="row brands">
                <h3>BRANDS</h3>
                <ul class="col l-12 m-12 c-12 brand_list">
                    <li>
                        <img src="{{('public/frontEnd/images/brand1.jpg')}}" alt="">
                    </li>
                    <li>
                        <img src="{{('public/frontEnd/images/brand2.jpg')}}" alt="">
                    </li>
                    <li>
                        <img src="{{('public/frontEnd/images/brand3.jpg')}}" alt="">
                    </li>
                    <li>
                        <img src="{{('public/frontEnd/images/brand4.jpg')}}" alt="">
                    </li>
                    <li>
                        <img src="{{('public/frontEnd/images/brand5.jpg')}}" alt="">
                    </li>
                    <li>
                        <img src="{{('public/frontEnd/images/brand6.jpg')}}" alt="">
                    </li>
                </ul>
            </div>
        </div>
    </div>
           
            
    <!-- end list product -->
</div>

@endsection