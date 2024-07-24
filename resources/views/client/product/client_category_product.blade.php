@extends('client_layout')
@section('content')
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
                {{-- Sắp xếp --}}
                <div class="col-md-3 mt-3">
                    <div class="row" style="margin-left: 1px">
                        <form>
                            @csrf
                            <div class="sidebar ftco-animate">
                                <div style="font-size: 15px; background-color: #82AE46; color:#fff" class="card-header">
                                    <span>Xếp theo:</span>
                                    <select name="client_sort_product" id="client_sort_product" style="width: 142px; background-color: #82AE46; color:#fff; border:#82AE46">
                                        <option value="" style="background-color: #fff; color: #000">Thứ tự</option>
                                        <option value="{{Request::url()}}?client_sort_product=decrease_price" style="background-color: #fff; color: #000">Giá giảm dần</option>
                                        <option value="{{Request::url()}}?client_sort_product=increase_price" style="background-color: #fff; color: #000">Giá tăng dần </option>
                                        <option value="{{Request::url()}}?client_sort_product=az_name_product" style="background-color: #fff; color: #000">Tên từ A - Z </option>
                                        <option value="{{Request::url()}}?client_sort_product=za_name_product" style="background-color: #fff; color: #000">Tên từ Z - A </option>
                                        <option value="{{Request::url()}}?client_sort_product=new_name_product" style="background-color: #fff; color: #000">Trái cây mới nhất </option>
                                        <option value="{{Request::url()}}?client_sort_product=old_name_product" style="background-color: #fff; color: #000">Trái cây cũ nhất </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- Lọc --}}
                    <div class="row" style="margin-top: 25px; margin-bottom: 30px">
                        <form action="">
                            <div class="display">
                                <span><input type="submit" name="filter_price" class="ml-3 mt-1 py-1 px-3" style="background-color: #82AE46; color:#fff; border:#82AE46; border-top-left-radius: 3px; border-top-right-radius: 3px" value="Lọc giá"></span>
                            </div>
                            <div class="row">
                                <input type="text" id="amount_min_category" class="col-4 ml-3" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                <input type="text" id="amount_max_category" class="col-4" readonly style="border:0; color:#f6931f; font-weight: bold; text-align:center; margin-left: 82px">
                            </div>
                            <div id="slider-range-category" style="width: 238px" class="ml-4"></div>
                            <input type="hidden" id="min_amount_category" name="min_amount_category">
                            <input type="hidden" id="max_amount_category" name="max_amount_category">
                        </form>
                    </div>
                </div>




                <div class="col-md-9 mt-2">
                    <div class="position-ref full-height float-right">
                        <div class="content">
                            <form class="search-form" role="search">
                                <div class="form-group">
                                    <input type="search" name="q" class="form-control search-input" placeholder="&#9885;  Tìm kiếm..." autocomplete="off">
                                </div>
                            </form>
                        </div>
                    </div><br><br><br>

                    @foreach ($name_category_product as $key => $show_name)
                        <h5 class="col-md mb-4 mt-2 text-center" style="text-transform: uppercase" ><b>DANH SÁCH {{ $show_name->category_product_name }} NHẬP KHẨU</b> </h5>
                    @endforeach

                </div>
            </div>


            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 sidebar ftco-animate">
                    <div class="mb-2" style="border: 1px solid #f0f0f0;">
                        <h5 style="font-size: 15px; background-color: #82AE46; color:#fff" class="card-header">Xuất xứ</h5>
                        <div class="sidebar-box ftco-animate">
                            @foreach ($origin as $key => $show_origin)
                                <li><a href="{{ URL::to('client_origin_product/' . $show_origin->origin_id) }}">{{ $show_origin->origin_name }}</a></li>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-2" style="border: 1px solid #f0f0f0;">
                        <h5 style="font-size: 15px; background-color: #82AE46; color:#fff" class="card-header">Sản phẩm bán chạy</h5>
                        <div class="sidebar-box ftco-animate">
                            @foreach ($product_max as $key => $show_product_max)
                                <div class="block-21 mb-1 d-flex">
                                    <a  href="{{URL::to('client_detail_product/'.$show_product_max->product_id)}}"
                                        class="blog-img mr-4" style="background-image: url('{{URL::to("public/upload/product/".$show_product_max->product_image)}}');"></a>
                                    <div class="text mt-3">
                                        <a href="{{URL::to('client_detail_product/'.$show_product_max->product_id)}}">
                                            <div style="font-size: 14px">{{$show_product_max->product_name}}</div>
                                            @if ($show_product_max->product_sale == NULL)
                                                <div style="font-size: 14px">{{number_format($show_product_max->product_price,0,'.','.')}}</div>
                                            @else
                                                <div style="font-size: 14px">
                                                    <span style="text-decoration: line-through; color: #b3b3b3">{{number_format($show_product_max->product_price,0,'.','.')}}</span>
                                                    <span> {{number_format($show_product_max->product_sale,0,'.','.')}}</span>
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="" style="border: 1px solid #f0f0f0;">
                        <h5 style="font-size: 15px; background-color: #82AE46; color:#fff" class="card-header">Sản phẩm mới nhất</h5>
                        <div class="sidebar-box ftco-animate">
                            @foreach ($product_news as $key => $show_product_news)
                                <div class="block-21 mb-1 d-flex">
                                    <a  href="{{URL::to('client_detail_product/'.$show_product_news->product_id)}}"
                                        class="blog-img mr-4" style="background-image: url('{{URL::to("public/upload/product/".$show_product_news->product_image)}}');"></a>
                                    <div class="text mt-3">
                                        <a href="{{URL::to('client_detail_product/'.$show_product_news->product_id)}}">
                                            <div style="font-size: 14px">{{$show_product_news->product_name}}</div>
                                            @if ($show_product_news->product_sale == NULL)
                                                <div style="font-size: 14px">{{number_format($show_product_news->product_price,0,'.','.')}}</div>
                                            @else
                                                <div style="font-size: 14px">
                                                    <span style="text-decoration: line-through; color: #b3b3b3">{{number_format($show_product_news->product_price,0,'.','.')}}</span>
                                                    <span> {{number_format($show_product_news->product_sale,0,'.','.')}}</span>
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6 col-12 row">
                    @foreach ($id_category_product as $key => $show_product)
                        <div class="col-md-6 col-lg-4 ftco-animate">
                            <div class="product">
                                <form>
                                    {{ csrf_field() }}
                                    {{-- thêm vào giỏ hàng --}}
                                    <input type="hidden" value="{{ $show_product->product_id }}"
                                        class="cart_product_id_{{ $show_product->product_id }}">
                                    <input type="hidden" value="{{ $show_product->product_name }}"
                                        class="cart_product_name_{{ $show_product->product_id }}">
                                    <input type="hidden" value="{{ $show_product->product_image }}"
                                        class="cart_product_image_{{ $show_product->product_id }}">
                                    <input type="hidden" value="{{ $show_product->product_packing }}"
                                        class="cart_product_packing_{{ $show_product->product_id }}">
                                    @if ($show_product->product_sale == NULL)
                                        <input type="hidden" value="{{$show_product->product_price}}"
                                            class="cart_product_price_{{$show_product->product_id}}">
                                    @else
                                        <input type="hidden" value="{{$show_product->product_sale}}"
                                            class="cart_product_price_{{$show_product->product_id}}">
                                    @endif
                                    <input type="hidden" value="{{ $show_product->product_amount }}"
                                        class="cart_product_amount_{{ $show_product->product_id }}">
                                    <input type="hidden" value="1"
                                        class="cart_product_quantity_{{ $show_product->product_id }}">

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


                                    <a href="{{ URL::to('client_detail_product/' . $show_product->product_id) }}"
                                        class="img-prod"><img class="img-fluid"
                                            src="{{ URL::to('public/upload/product/' . $show_product->product_image) }}"
                                            alt="Colorlib Template">
                                        @if ($show_product->product_sale == NULL)
                                        @else
                                            <span class="status">Khuyến mãi</span>
                                        @endif
                                    </a>
                                    <div class="text py-3 pb-4 px-3 text-center">
                                        <h3>
                                            <a href="{{ URL::to('client_detail_product/' . $show_product->product_id) }}">
                                                {{ $show_product->product_name }}<br>
                                                {{ $show_product->product_packing }}
                                            </a>
                                        </h3>
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
                    <span style="margin-left: 12px;">
                        {{ $id_category_product->links('pagination::bootstrap-4') }}
                    </span>
                </div>
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
@endsection
