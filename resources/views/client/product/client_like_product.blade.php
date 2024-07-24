@extends('client_layout')
@section('content')
    {{-- <nav class="mt-4" aria-label="Page navigation sample">
  <ul class="pagination">
    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>

	</main>
	</div>
</div> --}}
    <div class="hero-wrap hero-bread" style="background-image: url({{ URL::to('public/frontend/images/hihihi.png') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread" style="font-family: 'Times New Roman', Times, serif;">Trái cây</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">

            <div class="row">
                <div class="col-lg-3 col-md-0"></div>
                <div class="col-lg-9 col-md-12">
                    <h5 class="col-md mb-2 mt-2 text-center" style="text-transform: uppercase"><b>DANH SÁCH TRÁI CÂY YÊU THÍCH</b></h5>
                    <div class="text-center mb-2">
                        <b class="text-danger">
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo $message;
                            Session::put('message', null);
                        }
                        ?>
                        </b>
                    </div>
                    <a href="{{URL::to('client_delete_all_like_product')}}"></a>{{--  xóa hết session --}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 sidebar ftco-animate">


                    <div class="" style="border: 1px solid #f0f0f0;">
                        <h5 style="font-size: 15px; background-color: #82AE46; color:#fff" class="card-header">Sản phẩm mới
                            nhất</h5>
                        <div class="sidebar-box ftco-animate">
                            @foreach ($product_news as $key => $show_product_news)
                                <div class="block-21 mb-1 d-flex">
                                    <a href="{{ URL::to('client_detail_product/' . $show_product_news->product_id) }}"
                                        class="blog-img mr-4"
                                        style="background-image: url('{{ URL::to('public/upload/product/' . $show_product_news->product_image) }}');"></a>
                                    <div class="text mt-3">
                                        <a href="{{ URL::to('client_detail_product/' . $show_product_news->product_id) }}">
                                            <div style="font-size: 14px">{{ $show_product_news->product_name }}</div>
                                            <div style="font-size: 14px">
                                                {{ number_format($show_product_news->product_price, 0, '.', '.') }}</div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-2" style="border: 1px solid #f0f0f0;">
                        <h5 style="font-size: 15px; background-color: #82AE46; color:#fff" class="card-header">Danh mục</h5>
                        <div class="sidebar-box ftco-animate">
                            @foreach ($category_product as $key => $show_category_product)
                                <li><a
                                        href="{{ URL::to('client_category_product/' . $show_category_product->category_product_id) }}">{{ $show_category_product->category_product_name }}</a>
                                </li>
                            @endforeach
                        </div>
                    </div>

                </div>
                @if (Session::get('client_id')==true)
                    @if (Session::get('like')==true)
                        <div class="col-lg-9 col-md-6 col-12 row">
                            @foreach (Session::get('like') as $key => $show_product)
                                <div class="col-md-6 col-lg-4 ftco-animate">
                                    <div class="product">
                                        <form>
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $show_product['product_id'] }}"
                                                class="cart_product_id_{{ $show_product['product_id'] }}">
                                            <input type="hidden" value="{{ $show_product['product_name'] }}"
                                                class="cart_product_name_{{ $show_product['product_id'] }}">
                                            <input type="hidden" value="{{ $show_product['product_image'] }}"
                                                class="cart_product_image_{{ $show_product['product_id'] }}">
                                            <input type="hidden" value="{{ $show_product['product_packing'] }}"
                                                class="cart_product_packing_{{ $show_product['product_id'] }}">
                                            <input type="hidden" value="{{ $show_product['product_price'] }}"
                                                class="cart_product_price_{{ $show_product['product_id'] }}">
                                            <input type="hidden" value="{{ $show_product['product_amount'] }}"
                                                class="cart_product_amount_{{ $show_product['product_id'] }}">
                                            <input type="hidden" value="1"
                                                class="cart_product_quantity_{{ $show_product['product_id'] }}">
                                            <a href="{{ URL::to('client_detail_product/' . $show_product['product_id']) }}"
                                                class="img-prod"><img class="img-fluid"
                                                    src="{{ URL::to('public/upload/product/' . $show_product['product_image']) }}"
                                                    alt="Colorlib Template">
                                                {{-- <span class="status">30%</span>
                                                <div class="overlay"></div> --}}
                                            </a>
                                            <div class="text py-3 pb-4 px-3 text-center">
                                                <h3>
                                                    <a
                                                        href="{{ URL::to('client_detail_product/' . $show_product['product_id']) }}">
                                                        {{ $show_product['product_name'] }}<br>
                                                        {{ $show_product['product_packing'] }}
                                                    </a>
                                                </h3>
                                                <div class="d-flex">
                                                    <div class="pricing">
                                                        <p class="price"><span
                                                                class="text-center">{{ number_format($show_product['product_price'], 0, '.', '.') }}
                                                                VND</span></p>
                                                        {{-- <p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p> --}}
                                                    </div>
                                                </div>
                                                <div class="bottom-area d-flex px-3">
                                                    <div class="m-auto d-flex">
                                                        <button class="view_now" type="button" name="view_now"
                                                            data-id_product="{{ $show_product['product_id'] }}" data-toggle="modal"
                                                            data-target="#viewnow"
                                                            style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                            <a class="buy-now d-flex justify-content-center align-items-center">
                                                                <span><i class="ion-ios-menu"></i></span>
                                                            </a>
                                                        </button>
                                                        <button class="add_cart" type="button" name="add_cart"
                                                            data-id="{{ $show_product['product_id'] }}"
                                                            style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                            <a class="buy-now d-flex justify-content-center align-items-center">
                                                                <span><i class="ion-ios-cart"></i></span>
                                                            </a>
                                                        </button>
                                                        <a href="{{ URL::to('client_delete_like_product/' . $show_product['session_id']) }}" class="heart d-flex justify-content-center align-items-center" style="margin-left: 6px">
                                                            <span><i class="ion-ios-heart-dislike bg-primary text-light"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <span style="margin-left: 12px;">
                                {{ $product->links('pagination::bootstrap-4') }}
                            </span> --}}
                        </div>
                    @else
                        <div class="col-lg-9 col-md-6 col-12 row">
                            <div class="col-md-6 col-lg-12 ftco-animate text-center">
                                <b style="text-align: center">
                                    Danh sách trái cây yêu thích đang trống vui lòng xem tiếp trái cây <a href="{{URL::to('client_list_product')}}">tại đây</a>
                                </b>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="col-lg-9 col-md-6 col-12 row">
                        <div class="col-md-6 col-lg-12 ftco-animate">
                            <div class="d-flex flex-start w-100">
                                <div class="form-outline w-100">
                                    <b><a href="{{ URL::to('client_login_client') }}">
                                        Đăng nhập
                                    </a></b>
                                    <label class="form-label" for="textAreaExample">để xem danh sách trái cây yêu thích</label>
                                </div>
                            </div>
                            <div class="d-flex flex-start w-100">
                                <div class="form-outline w-100">
                                    <label class="form-label" for="textAreaExample">Bạn chưa có tài khoản ?</label>
                                    <b><a href="{{ URL::to('client_register_client') }}">
                                        Đăng ký
                                    </a></b>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="modal fade" id="viewnow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title product_viewnow_name" id="">
                                <span id="product_viewnow_name"></span> - <span id="product_viewnow_packing"></span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            <style type="text/css">
                                @media screen and (min-width: 992px) {

                                    /* ipad trở lên màn hình máy tính */
                                    .modal-lg {
                                        width: 950px;
                                    }
                                }

                                @media screen and (min-width: 992px) {

                                    /* điện thoại */
                                    .modal-dialog {
                                        width: 700px;
                                    }

                                    .modal-sm {
                                        width: 350px;
                                    }
                                }

                                /* span#product_viewnow_detail img{ hình ở thông tin sản phẩm co gián theo cột
                                                            width: 100px;
                                                        } */
                            </style>
                            <div class="col-md-5">
                                <span id="product_viewnow_image"></span>
                            </div>
                            <div class="col-md-7">
                                <form>
                                    @csrf
                                    <div id="product_viewnow_value"></div>
                                    <div class="row">
                                        <p class="text-left mr-4">
                                            <a class="mr-2 ml-3" style="color: #000;">
                                                <span style="color: #bbb;">Còn lại</span>
                                                <span id="product_viewnow_amount"></span>
                                            </a>
                                        </p>
                                        <p class="text-left">
                                            <a class="mr-2" style="color: #000;">
                                                <span style="color: #bbb;">Đã bán</span>
                                                <span id="product_viewnow_sold"></span>
                                            </a>
                                        </p>
                                    </div>
                                    <p class="price">
                                        Giá: <b><span class="text-primary" id="product_viewnow_price"></span></b>
                                    </p>
                                    {{-- <div class="row mt-4">
                                        <div class="col-md-6 d-flex mb-3 input-group">
                                            <input type="number" name="quantity_detail" value="1" min="1"
                                                class="cart_product_quantity_ w-100 input-number"
                                                style="border: 1.5px solid rgba(0, 0, 0, 0.1); border-radius: 20px; text-align:center">
                                            <input type="hidden" id="quantity" name="product_id_detail"
                                                value="">
                                        </div>
                                    </div> --}}
                                    <div class="w-50 d-flex mb-3 input-group" id="product_viewnow_button_add"></div>
                                    <div id="beforesend_viewnow"></div>
                                    <b>Thành phần dinh dưỡng: </b>
                                    <span id="product_viewnow_summary"></span>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-primary w-25">Chi tiết sản phẩm</button> --}}
                            <span id="product_viewnow_detail"></span>
                            <button type="button" class="btn btn-primary redirect_list_cart w-25 ">Đi tới giỏ
                                hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
