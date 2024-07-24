
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
    <div class="hero-wrap hero-bread" style="background-image: url({{ URL::to('public/frontend/images/bg3.png') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">Trái cây</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">

                {{-- Sắp xếp --}}
                {{-- <div class="col-md-9">
                    <div class="row" style="margin-left: 1px">
                        <form>
                            @csrf
                            <span class="btn border">Xếp theo:
                                <select name="client_sort_product" id="client_sort_product" class="border border-light">
                                    <option value="{{Request::url()}}?client_sort_product=new_product">Mới nhất</option>
                                    <option value="{{Request::url()}}?client_sort_product=decrease_price">Giá giảm dần       &nbsp;&nbsp;&nbsp;</option>
                                    <option value="{{Request::url()}}?client_sort_product=increase_price">Giá tăng dần </option>
                                    <option value="{{Request::url()}}?client_sort_product=az_name_product">Tên từ A - Z </option>
                                    <option value="{{Request::url()}}?client_sort_product=za_name_product">Tên từ Z - A </option>
                                </select>
                            </span>
                        </form>
                    </div>
                    {{-- Lọc --
                    <div class="row mt-3 ml-2">
                        <form action="">
                            <div class="display">
                                <span><input type="submit" name="filter_price" class="btn btn-sm border" value="Lọc giá"></span>
                            </div>
                            <div class="row">
                                <input type="text" id="amount_min" class="col-4" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                <input type="text" id="amount_max" class="col-3" readonly style="border:0; color:#f6931f; font-weight:bold; text-align:center; margin-left: 1px">
                            </div>
                            <div id="slider-range" style="width: 238px"></div>
                            <input type="hidden" id="min_amount" name="min_amount">
                            <input type="hidden" id="max_amount" name="max_amount">
                        </form>
                    </div>
                </div>

                Tìm kiếm -- --}}
                <div class="col-md-3">
                    <div class="position-ref full-height">
                        <div class="content">
                            <form class="typeahead search-form" role="search">
                                <div class="form-group">
                                    <input type="search" name="q" class="form-control search-input"
                                        placeholder="Tìm kiếm..." autocomplete="off">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <h5 class="col-md mb-4 mt-2 text-center" style="text-transform: uppercase">DANH SÁCH TRÁI CÂY NHẬP KHẨU</h5>


            <div class="row">
                <div class="col-lg-12 col-md-6 col-12 row">
                    @foreach ($product as $key => $show_product)
                        <div class="col-md-6 col-lg-4">
                            <div class="product">
                                <form>
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $show_product->product_id }}"
                                        class="cart_product_id_{{ $show_product->product_id }}">
                                    <input type="hidden" value="{{ $show_product->product_name }}"
                                        class="cart_product_name_{{ $show_product->product_id }}">
                                    <input type="hidden" value="{{ $show_product->product_image }}"
                                        class="cart_product_image_{{ $show_product->product_id }}">
                                    <input type="hidden" value="{{ $show_product->product_packing }}"
                                        class="cart_product_packing_{{ $show_product->product_id }}">
                                    <input type="hidden" value="{{ $show_product->product_price }}"
                                        class="cart_product_price_{{ $show_product->product_id }}">
                                    <input type="hidden" value="{{ $show_product->product_amount }}"
                                        class="cart_product_amount_{{ $show_product->product_id }}">
                                    <input type="hidden" value="1"
                                        class="cart_product_quantity_{{ $show_product->product_id }}">
                                    <a href="{{ URL::to('client_detail_product/' . $show_product->product_id) }}"
                                        class="img-prod"><img class="img-fluid"
                                            src="{{ URL::to('public/upload/product/' . $show_product->product_image) }}"
                                            alt="Colorlib Template">
                                        {{-- <span class="status">30%</span>
                                        <div class="overlay"></div> --}}
                                    </a>
                                    <div class="text py-3 pb-4 px-3 text-center">
                                        <h3>
                                            <a href="{{ URL::to('client_detail_product/' . $show_product->product_id) }}">
                                                {{ $show_product->product_name }}
                                            </a>
                                        </h3>
                                        <p>
                                            <a href="{{ URL::to('client_detail_product/' . $show_product->product_id) }}">
                                                {{ $show_product->product_tag }}
                                            </a>
                                        </p>
                                        <div class="d-flex">
                                            <div class="pricing">
                                                <p class="price"><span
                                                        class="text-center">{{ number_format($show_product->product_price, 0, '.', '.') }}
                                                        VND</span></p>
                                                {{-- <p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p> --}}
                                            </div>
                                        </div>
                                        <div class="bottom-area d-flex px-3">
                                            <div class="m-auto d-flex">
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
                                                    <a class="buy-now d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-cart"></i></span>
                                                    </a>
                                                </button>
                                                <button class="add_cart" type="button" name="add_cart"
                                                    data-id="{{ $show_product->product_id }}"
                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                    <a class="heart d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-heart"></i></span>
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
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
