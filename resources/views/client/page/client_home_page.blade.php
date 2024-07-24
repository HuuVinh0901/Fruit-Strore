@extends('client_layout')
@section('content')
    <section id="home-section" class="hero">
        <div class="home-slider owl-carousel">
            @foreach ($advertise as $key => $show_advertise)
                <div class="slider-item" style="background-image: url('public/upload/advertise/{{$show_advertise->advertise_image}}');">
                    {{-- <img class="slider-item" src="{{URL::to('public/upload/advertise/'.$show_advertise->advertise_image)}}"> --}}
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                            <div class="col-md-12 ftco-animate text-center">
                                <h1 class="mb-2">{{$show_advertise->advertise_name}}</h1>
                                <h2 class="subheading mb-4">{!! $show_advertise->advertise_detail !!}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{--
                <div class="slider-item" style="background-image: url(./public/frontend/images/bg_1.jpg);">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                            <div class="col-md-12 ftco-animate text-center">
                                <h1 class="mb-2">Trái cây tươi chất lượng &amp; an toàn</h1>
                                <h2 class="subheading mb-4">Chúng tôi cam kết trái cây được nhập khẩu 100%</h2>
                                <p><a href="#" class="btn btn-primary">Xem thêm</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-item" style="background-image: url(./public/frontend/images/bg_2.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                        <div class="col-sm-12 ftco-animate text-center">
                            <h1 class="mb-2">Trái cây là nguồn cung cấp nhiều chất dinh dưỡng thiết yếu</h1>
                            <h2 class="subheading mb-4">Tận dụng tối đa lợi ích dinh dưỡng trong trái cây để có một thể trạng sức khỏe tốt nhất</h2>
                            <p><a href="#" class="btn btn-primary">Xem thêm</a></p>
                        </div>

                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row no-gutters ftco-services">
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-shipped"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Miễn phí vận chuyển</h3>
                            <span>Đơn hàng từ 300.0000</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-diet"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Luôn luôn tươi</h3>
                            <span>Cung cấp dinh dưỡng</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-award"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Chất lượng cao</h3>
                            <span>Nhập khẩu trực tiếp</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-customer-service"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Hỗ trợ</h3>
                            <span>24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	{{-- <span class="subheading">Featured Products</span> --}}
            <h2 class="mb-4">Sản phẩm khuyến mãi</h2>
            {{-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> --}}
          </div>
        </div>
    	</div>
    	<div class="container">
    		<div class="row">
                @foreach ($product_sale as $key => $show_product)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <form>
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$show_product->product_id}}"
                                    class="cart_product_id_{{$show_product->product_id}}">
                                <input type="hidden" value="{{$show_product->product_name}}"
                                    class="cart_product_name_{{$show_product->product_id}}">
                                <input type="hidden" value="{{$show_product->product_image}}"
                                    class="cart_product_image_{{$show_product->product_id}}">
                                <input type="hidden" value="{{$show_product->product_packing}}"
                                    class="cart_product_packing_{{$show_product->product_id}}">

                                @if ($show_product->product_sale == NULL)
                                    <input type="hidden" value="{{$show_product->product_price}}"
                                        class="cart_product_price_{{$show_product->product_id}}">
                                @else
                                    <input type="hidden" value="{{$show_product->product_sale}}"
                                        class="cart_product_price_{{$show_product->product_id}}">
                                @endif

                                <input type="hidden" value="{{$show_product->product_amount}}"
                                    class="cart_product_amount_{{$show_product->product_id}}">
                                <input type="hidden" value="1"
                                    class="cart_product_quantity_{{$show_product->product_id}}">

                                {{-- thêm vào yêu thích --}}
                                <input type="hidden" value="{{ $show_product->product_id }}"
                                    class="like_product_id_{{ $show_product->product_id }}">
                                <input type="hidden" value="{{ $show_product->product_name }}"
                                    class="like_product_name_{{ $show_product->product_id }}">
                                <input type="hidden" value="{{ $show_product->product_image }}"
                                    class="like_product_image_{{ $show_product->product_id }}">
                                <input type="hidden" value="{{ $show_product->product_packing }}"
                                    class="like_product_packing_{{ $show_product->product_id }}">

                                @if ($show_product->product_sale == NULL)
                                    <input type="hidden" value="{{$show_product->product_price}}"
                                        class="like_product_price_{{$show_product->product_id}}">
                                @else
                                    <input type="hidden" value="{{$show_product->product_sale}}"
                                        class="like_product_price_{{$show_product->product_id}}">
                                @endif

                                <input type="hidden" value="{{ $show_product->product_amount }}"
                                    class="like_product_amount_{{ $show_product->product_id }}">
                                <input type="hidden" value="1"
                                    class="like_product_quantity_{{ $show_product->product_id }}">



                                <a href="{{URL::to('client_detail_product/'.$show_product->product_id)}}" class="img-prod">
                                    <img class="img-fluid" src="{{URL::to('public/upload/product/'.$show_product->product_image)}}" alt="Colorlib Template">
                                    <span class="status">Khuyến mãi</span>
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a href="{{URL::to('client_detail_product/'.$show_product->product_id)}}">
                                        {{$show_product->product_name}}<br>
                                        {{$show_product->product_packing}}
                                    </a></h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price">
                                                <span class="mr-2 price-dc">{{number_format($show_product->product_price,0,'.','.')}} VND</span>
                                                <span class="price-sale">{{number_format($show_product->product_sale,0,'.','.')}} VND</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="bottom-area d-flex px-3">
                                        <div class="m-auto d-flex">
                                            @if (Session::get('client_id'))
                                                <button class="view_now" type="button" name="view_now"
                                                    data-id_product="{{ $show_product->product_id }}" data-toggle="modal"
                                                    data-target="#viewnow"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="buy-now d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-menu"></i></span>
                                                    </a>
                                                </button>
                                                <button class="add_cart" type="button" name="add_cart"
                                                    data-id="{{ $show_product->product_id }}"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-cart"></i></span>
                                                    </a>
                                                </button>

                                                <button class="like_product" type="button" name="like_product"
                                                    data-id="{{ $show_product->product_id }}"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="heart d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-heart"></i></span>
                                                    </a>
                                                </button>
                                            @else
                                                <button class="view_now" type="button" name="view_now"
                                                    data-id_product="{{ $show_product->product_id }}" data-toggle="modal"
                                                    data-target="#viewnow"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="buy-now d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-menu"></i></span>
                                                    </a>
                                                </button>
                                                <button class="add_cart" type="button" name="add_cart"
                                                    data-id="{{ $show_product->product_id }}"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-cart"></i></span>
                                                    </a>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
    		</div>
            {{-- viewnow --}}
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
                                @media screen and (min-width: 992px){ /* ipad trở lên màn hình máy tính */
                                    .modal-lg {
                                        width: 950px;
                                    }
                                }

                                @media screen and (min-width: 992px){ /* điện thoại */
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
                            <button type="button" class="btn btn-primary redirect_list_cart w-25 ">Đi tới giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </section>



    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	{{-- <span class="subheading">Featured Products</span> --}}
            <h2 class="mb-4">Sản phẩm mới nhất</h2>
            {{-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> --}}
          </div>
        </div>
    	</div>
    	<div class="container">
    		<div class="row">
                @foreach ($product_new as $key => $show_product)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <form>
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$show_product->product_id}}"
                                    class="cart_product_id_{{$show_product->product_id}}">
                                <input type="hidden" value="{{$show_product->product_name}}"
                                    class="cart_product_name_{{$show_product->product_id}}">
                                <input type="hidden" value="{{$show_product->product_image}}"
                                    class="cart_product_image_{{$show_product->product_id}}">
                                <input type="hidden" value="{{$show_product->product_packing}}"
                                    class="cart_product_packing_{{$show_product->product_id}}">

                                @if ($show_product->product_sale == NULL)
                                    <input type="hidden" value="{{$show_product->product_price}}"
                                        class="cart_product_price_{{$show_product->product_id}}">
                                @else
                                    <input type="hidden" value="{{$show_product->product_sale}}"
                                        class="cart_product_price_{{$show_product->product_id}}">
                                @endif

                                <input type="hidden" value="{{$show_product->product_amount}}"
                                    class="cart_product_amount_{{$show_product->product_id}}">
                                <input type="hidden" value="1"
                                    class="cart_product_quantity_{{$show_product->product_id}}">

                                {{-- thêm vào yêu thích --}}
                                <input type="hidden" value="{{ $show_product->product_id }}"
                                    class="like_product_id_{{ $show_product->product_id }}">
                                <input type="hidden" value="{{ $show_product->product_name }}"
                                    class="like_product_name_{{ $show_product->product_id }}">
                                <input type="hidden" value="{{ $show_product->product_image }}"
                                    class="like_product_image_{{ $show_product->product_id }}">
                                <input type="hidden" value="{{ $show_product->product_packing }}"
                                    class="like_product_packing_{{ $show_product->product_id }}">

                                @if ($show_product->product_sale == NULL)
                                    <input type="hidden" value="{{$show_product->product_price}}"
                                        class="like_product_price_{{$show_product->product_id}}">
                                @else
                                    <input type="hidden" value="{{$show_product->product_sale}}"
                                        class="like_product_price_{{$show_product->product_id}}">
                                @endif

                                <input type="hidden" value="{{ $show_product->product_amount }}"
                                    class="like_product_amount_{{ $show_product->product_id }}">
                                <input type="hidden" value="1"
                                    class="like_product_quantity_{{ $show_product->product_id }}">



                                <a href="{{URL::to('client_detail_product/'.$show_product->product_id)}}" class="img-prod">
                                    <img class="img-fluid" src="{{URL::to('public/upload/product/'.$show_product->product_image)}}" alt="Colorlib Template">
                                    @if ($show_product->product_sale == NULL)
                                    @else
                                        <span class="status">Khuyến mãi</span>
                                    @endif
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a href="{{URL::to('client_detail_product/'.$show_product->product_id)}}">
                                        {{$show_product->product_name}}<br>
                                        {{$show_product->product_packing}}
                                    </a></h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            @if ($show_product->product_sale == NULL)
                                                <p class="price">
                                                    <span class="mr-2">
                                                        {{ number_format($show_product->product_price, 0, '.', '.') }} VND
                                                    </span>
                                                </p>
                                            @else
                                                <p class="price">
                                                    <span class="mr-2 price-dc">{{ number_format($show_product->product_price, 0, '.', '.') }} VND</span>
                                                    <span class="price-sale">{{ number_format($show_product->product_sale, 0, '.', '.') }} VND</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="bottom-area d-flex px-3">
                                        <div class="m-auto d-flex">
                                            @if (Session::get('client_id'))
                                                <button class="view_now" type="button" name="view_now"
                                                    data-id_product="{{ $show_product->product_id }}" data-toggle="modal"
                                                    data-target="#viewnow"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="buy-now d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-menu"></i></span>
                                                    </a>
                                                </button>
                                                <button class="add_cart" type="button" name="add_cart"
                                                    data-id="{{ $show_product->product_id }}"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-cart"></i></span>
                                                    </a>
                                                </button>

                                                <button class="like_product" type="button" name="like_product"
                                                    data-id="{{ $show_product->product_id }}"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="heart d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-heart"></i></span>
                                                    </a>
                                                </button>
                                            @else
                                                <button class="view_now" type="button" name="view_now"
                                                    data-id_product="{{ $show_product->product_id }}" data-toggle="modal"
                                                    data-target="#viewnow"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="buy-now d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-menu"></i></span>
                                                    </a>
                                                </button>
                                                <button class="add_cart" type="button" name="add_cart"
                                                    data-id="{{ $show_product->product_id }}"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-cart"></i></span>
                                                    </a>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
    		</div>
            {{-- viewnow --}}
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
                                @media screen and (min-width: 992px){ /* ipad trở lên màn hình máy tính */
                                    .modal-lg {
                                        width: 950px;
                                    }
                                }

                                @media screen and (min-width: 992px){ /* điện thoại */
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
                            <button type="button" class="btn btn-primary redirect_list_cart w-25 ">Đi tới giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </section>


    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	{{-- <span class="subheading">Featured Products</span> --}}
            <h2 class="mb-4">Sản phẩm bán chạy</h2>
            {{-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> --}}
          </div>
        </div>
    	</div>
    	<div class="container">
    		<div class="row">
                @foreach ($product_max as $key => $show_product)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <form>
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$show_product->product_id}}"
                                    class="cart_product_id_{{$show_product->product_id}}">
                                <input type="hidden" value="{{$show_product->product_name}}"
                                    class="cart_product_name_{{$show_product->product_id}}">
                                <input type="hidden" value="{{$show_product->product_image}}"
                                    class="cart_product_image_{{$show_product->product_id}}">
                                <input type="hidden" value="{{$show_product->product_packing}}"
                                    class="cart_product_packing_{{$show_product->product_id}}">

                                @if ($show_product->product_sale == NULL)
                                    <input type="hidden" value="{{$show_product->product_price}}"
                                        class="cart_product_price_{{$show_product->product_id}}">
                                @else
                                    <input type="hidden" value="{{$show_product->product_sale}}"
                                        class="cart_product_price_{{$show_product->product_id}}">
                                @endif

                                <input type="hidden" value="{{$show_product->product_amount}}"
                                    class="cart_product_amount_{{$show_product->product_id}}">
                                <input type="hidden" value="1"
                                    class="cart_product_quantity_{{$show_product->product_id}}">

                                {{-- thêm vào yêu thích --}}
                                <input type="hidden" value="{{ $show_product->product_id }}"
                                    class="like_product_id_{{ $show_product->product_id }}">
                                <input type="hidden" value="{{ $show_product->product_name }}"
                                    class="like_product_name_{{ $show_product->product_id }}">
                                <input type="hidden" value="{{ $show_product->product_image }}"
                                    class="like_product_image_{{ $show_product->product_id }}">
                                <input type="hidden" value="{{ $show_product->product_packing }}"
                                    class="like_product_packing_{{ $show_product->product_id }}">

                                @if ($show_product->product_sale == NULL)
                                    <input type="hidden" value="{{$show_product->product_price}}"
                                        class="like_product_price_{{$show_product->product_id}}">
                                @else
                                    <input type="hidden" value="{{$show_product->product_sale}}"
                                        class="like_product_price_{{$show_product->product_id}}">
                                @endif

                                <input type="hidden" value="{{ $show_product->product_amount }}"
                                    class="like_product_amount_{{ $show_product->product_id }}">
                                <input type="hidden" value="1"
                                    class="like_product_quantity_{{ $show_product->product_id }}">



                                <a href="{{URL::to('client_detail_product/'.$show_product->product_id)}}" class="img-prod">
                                    <img class="img-fluid" src="{{URL::to('public/upload/product/'.$show_product->product_image)}}" alt="Colorlib Template">
                                    @if ($show_product->product_sale == NULL)
                                    @else
                                        <span class="status">Khuyến mãi</span>
                                    @endif
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a href="{{URL::to('client_detail_product/'.$show_product->product_id)}}">
                                        {{$show_product->product_name}}<br>
                                        {{$show_product->product_packing}}
                                    </a></h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            @if ($show_product->product_sale == NULL)
                                                <p class="price">
                                                    <span class="mr-2">
                                                        {{ number_format($show_product->product_price, 0, '.', '.') }} VND
                                                    </span>
                                                </p>
                                            @else
                                                <p class="price">
                                                    <span class="mr-2 price-dc">{{ number_format($show_product->product_price, 0, '.', '.') }} VND</span>
                                                    <span class="price-sale">{{ number_format($show_product->product_sale, 0, '.', '.') }} VND</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="bottom-area d-flex px-3">
                                        <div class="m-auto d-flex">
                                            @if (Session::get('client_id'))
                                                <button class="view_now" type="button" name="view_now"
                                                    data-id_product="{{ $show_product->product_id }}" data-toggle="modal"
                                                    data-target="#viewnow"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="buy-now d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-menu"></i></span>
                                                    </a>
                                                </button>
                                                <button class="add_cart" type="button" name="add_cart"
                                                    data-id="{{ $show_product->product_id }}"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-cart"></i></span>
                                                    </a>
                                                </button>

                                                <button class="like_product" type="button" name="like_product"
                                                    data-id="{{ $show_product->product_id }}"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="heart d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-heart"></i></span>
                                                    </a>
                                                </button>
                                            @else
                                                <button class="view_now" type="button" name="view_now"
                                                    data-id_product="{{ $show_product->product_id }}" data-toggle="modal"
                                                    data-target="#viewnow"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="buy-now d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-menu"></i></span>
                                                    </a>
                                                </button>
                                                <button class="add_cart" type="button" name="add_cart"
                                                    data-id="{{ $show_product->product_id }}"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-cart"></i></span>
                                                    </a>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
    		</div>
            {{-- viewnow --}}
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
                                @media screen and (min-width: 992px){ /* ipad trở lên màn hình máy tính */
                                    .modal-lg {
                                        width: 950px;
                                    }
                                }

                                @media screen and (min-width: 992px){ /* điện thoại */
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
                            <span id="product_viewnow_detail"></span>
                            <button type="button" class="btn btn-primary redirect_list_cart w-25 ">Đi tới giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </section>
<br><br>
@endsection
