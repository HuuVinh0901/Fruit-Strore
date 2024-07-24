@extends('client_layout')
@section('content')
    <style>
        li.active {
            border: 1px solid rgb(202, 252, 202);
        }

        li.detail {
            width: 508px;
            height: 508px;
            margin-right: 0px;
            justify-content: center;
            display: flex;
        }

        li>a {
            justify-content: center;
            display: flex;
        }

        /* $breadcrumb-divider: quote(">"); */
    </style>
    @foreach ($detail_product as $key => $show_detail_product)
        {{-- TRƯỜNG HỢP KHÔNG KHUYẾN MÃI --}}
            <form>
                {{ csrf_field() }}
                <input type="hidden" value="{{ $show_detail_product->product_id }}"
                    class="cart_product_id_{{ $show_detail_product->product_id }}">
                <input type="hidden" value="{{ $show_detail_product->product_name }}"
                    class="cart_product_name_{{ $show_detail_product->product_id }}">
                <input type="hidden" value="{{ $show_detail_product->product_image }}"
                    class="cart_product_image_{{ $show_detail_product->product_id }}">
                <input type="hidden" value="{{ $show_detail_product->product_packing }}"
                    class="cart_product_packing_{{ $show_detail_product->product_id }}">
                @if ($show_detail_product->product_sale == NULL)
                    <input type="hidden" value="{{$show_detail_product->product_price}}"
                        class="cart_product_price_{{$show_detail_product->product_id}}">
                @else
                    <input type="hidden" value="{{$show_detail_product->product_sale}}"
                        class="cart_product_price_{{$show_detail_product->product_id}}">
                @endif
                <input type="hidden" value="{{ $show_detail_product->product_amount }}"
                    class="cart_product_amount_{{ $show_detail_product->product_id }}">

                <input type="hidden" value="{{ $show_detail_product->product_id }}"
                    class="like_product_id_{{ $show_detail_product->product_id }}">
                <input type="hidden" value="{{ $show_detail_product->product_name }}"
                    class="like_product_name_{{ $show_detail_product->product_id }}">
                <input type="hidden" value="{{ $show_detail_product->product_image }}"
                    class="like_product_image_{{ $show_detail_product->product_id }}">
                <input type="hidden" value="{{ $show_detail_product->product_packing }}"
                    class="like_product_packing_{{ $show_detail_product->product_id }}">
                @if ($show_detail_product->product_sale == NULL)
                    <input type="hidden" value="{{$show_detail_product->product_price}}"
                        class="like_product_price_{{$show_detail_product->product_id}}">
                @else
                    <input type="hidden" value="{{$show_detail_product->product_sale}}"
                        class="like_product_price_{{$show_detail_product->product_id}}">
                @endif
                <input type="hidden" value="{{ $show_detail_product->product_amount }}"
                    class="like_product_amount_{{ $show_detail_product->product_id }}">
                <input type="hidden" value="1"
                    class="like_product_quantity_{{ $show_detail_product->product_id }}">

                <section class="ftco-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 mb-5 ftco-animate">
                                {{-- <a href="#" class="image-popup"><img src="{{URL::to('public/upload/product/'.$show_detail_product->product_image)}}" class="img-fluid"
                                        alt="Colorlib Template"></a> --}}
                                <ul id="imageGallery">
                                    @foreach ($gallery as $key => $show_gallery)
                                        <li data-thumb="{{ asset('public/upload/gallery/' . $show_gallery->gallery_image) }}"
                                            data-src="{{ asset('public/upload/gallery/' . $show_gallery->gallery_image) }}"
                                            class="detail"> {{-- data-thumb="img/thumb/cS-1.jpg hình nhỏ --}}
                                            <img src="{{ asset('public/upload/gallery/' . $show_gallery->gallery_image) }}"
                                                alt="{{ $show_gallery->gallery_image }}" />{{-- cái lớn đang thấy --}}
                                            {{-- data-src="img/largeImage.jpg" nhấp vô bự ra --}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                                <h3 class=" text-primary">{{ $show_detail_product->product_name }} - {{ $show_detail_product->product_packing }}
                                </h3>
                                <div class="rating d-flex">
                                    {{-- <p class="text-left mr-4">
                                        <a href="#" class="mr-2">5.0</a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p> --}}
                                    <p class="text-left mr-4 mt-2">
                                        <a class="mr-2" style="color: #000;">
                                            <span style="color: #bbb;">Còn lại</span>
                                            {{ $show_detail_product->product_amount }}
                                        </a>
                                    </p>
                                    <p class="text-left mt-2">
                                        <a class="mr-2" style="color: #000;">
                                            <span style="color: #bbb;">Đã bán</span> {{ $show_detail_product->product_sold }}
                                        </a>
                                    </p>
                                        <div style="margin-left: 100px; margin-top: 2px" class="fb-share-button" data-href="http://importedfruit.com/imported_fruit/client_detail_product/{{$show_detail_product->product_id}}" data-layout="" data-size="">
                                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                                                Chia sẻ
                                            </a>
                                        </div>
                                </div>
                                @if ($show_detail_product->product_sale == NULL)
                                    <p class="price"><span style="color: red">{{ number_format($show_detail_product->product_price, 0, '.', '.') }} VND</span></p>
                                @else
                                    <p class="price">
                                        <span style="text-decoration: line-through; color: gray; font-size: 18px">{{number_format($show_detail_product->product_price,0,'.','.')}} VND</span><br>
                                        <span style="color: red">{{ number_format($show_detail_product->product_sale, 0, '.', '.') }} VND</span>
                                    </p>
                                @endif
                                <p>Nguồn gốc xuất xứ: {{ $show_detail_product->origin->origin_name }}</p>
                                <p>
                                    {!! $show_detail_product->product_summary !!}
                                </p>
                                @php
                                    $tag = $show_detail_product->product_tag; //chữ bth thường
                                    $tag = explode(',', $tag); //cắt dấu phẩy (tìm trong chuỗi $tag vị trí có dấu phẩy thì xóa đi)
                                    //echo $tag[0];                               //in ra chuỗi đầu trước dấu phẩy
                                @endphp
                                <div class="tagcloud">
                                    @foreach ($tag as $show_tag)
                                        <a href="{{ URL::to('client_tag_product/' . Str::slug($show_tag)) }}"
                                            class="tag-cloud-link">{{ $show_tag }}</a> {{-- Str::slug đổi đường dẫn: xóa đấu sắc huyền rồi thêm - giữa :)) --}}
                                    @endforeach
                                </div>

                                <div class="row mt-4">
                                    <div class="w-100"></div>
                                    <div class="input-group col-md-6 d-flex mb-3">
                                        <input type="number" name="quantity_detail" value="1" min="1"
                                            class="cart_product_quantity_{{ $show_detail_product->product_id }} btn input-number"
                                            style="border: 1.5px solid rgba(0, 0, 0, 0.1); width: 205px;">
                                        <input type="hidden" id="quantity" name="product_id_detail"
                                            value="{{ $show_detail_product->product_id }}">
                                    </div>
                                    <div class="w-100"></div>
                                </div>


                                <div class="row">
                                    <input data-id="{{ $show_detail_product->product_id }}"
                                            class="add_cart btn btn-primary mr-3 mb-2" type="button"
                                            value="Thêm vào giỏ hàng" style="width: 240px; height: 60px">
                                    <input data-id="{{ $show_detail_product->product_id }}"
                                            class="like_product btn btn-primary" type="button"
                                            value="Thêm vào yêu thích" style="width: 240px; height: 60px">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>

    @endforeach
    {{-- <form action="{{URL::to('client_add_cart')}}" method="post">
        @csrf
        <div class="row">
            <button type="submit"  style="border: 0px solid rgba(0, 0, 0, 0); color: #fff">
                <a class="btn btn-black py-3 px-5 ml-2">
                    Thêm vào giỏ
                </a>
            </button>
        </div>
    </form> --}}
    <div class="container mt-5">
        <ul class="nav nav-tabs row text-center" id="example-tabs" role="tablist">
            <li class="nav-item col-md-4">
                <a id="tab1" class="nav-link active" data-toggle="tab" role="tab" href="#pane-tab-1">
                    <b>THÔNG TIN SẢN PHẨM</b>
                </a>
            </li>
            <li class="nav-item col-md-4">
                <a id="tab2" class="nav-link" data-toggle="tab" role="tab" href="#pane-tab-2">
                    <b>BÌNH LUẬN SẢN PHẨM</b>
                </a>
            </li>
            <li class="nav-item col-md-4">
                <a id="tab3" class="nav-link" data-toggle="tab" role="tab" href="#pane-tab-3">
                    <b>SẢN PHẨM TƯƠNG TỰ</b>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            {{-- NỘI DUNG THÔNG TIN SẢN PHẨM --}}
            <div class="tab-pane fade show active" id="pane-tab-1" role="tabpanel" aria-labelledby="tab1">
                <section class="ftco-section">
                    <div class="container">
                        <div class="row justify-content-center mb-3 pb-3">
                            <div class="col-md-12 heading-section text-center ftco-animate">
                                <h2 class=" mt-3">Thông tin sản phẩm</h2>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        @foreach ($detail_product as $key => $show_detail_product)
                            <div class="row">
                                {!! $show_detail_product->product_detail !!}
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            {{-- NỘI DUNG BÌNH LUẬN --}}
            <div class="tab-pane fade" id="pane-tab-2" role="tabpanel" aria-labelledby="tab2">
                <div class="container my-3 py-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body p-4">
                                    {{-- <h4 class="text-center mb-4 pb-2">Nested comments section</h4> --}}
                                    <form>
                                        {{ csrf_field() }}
                                        <input type="hidden" class="comment_product_id" name="product_id" value="{{ $show_detail_product->product_id }}">
                                        <div id="show_comment_product"></div>
                                    </form>
                                    <div id="message_comment_product"></div>
                                    <?php
                                    $client_id = Session::get('client_id');
                                    if($client_id!=NULL){
                                    ?>
                                    <form>
                                        {{ csrf_field() }}
                                        <input type="hidden" class="comment_product_id" name="comment_product_id" value="{{ $show_detail_product->product_id }}">
                                        <div class="d-flex flex-start w-100">
                                            <img class="rounded-circle shadow-1-strong mr-3"
                                                src="{{URL::to('public/frontend/images/avatar.png')}}"
                                                alt="avatar" width="50" height="50" />
                                            <div class="form-outline w-100">
                                                <label class="form-label" for="textAreaExample">Viết bình luận của bạn</label>
                                                <textarea class="com_detail form-control" id="textAreaExample" rows="4" style="background: #fff; font-size: 14px"></textarea>
                                            </div>
                                        </div>
                                        <div class="float-end mt-2 pt-1">
                                            <input type="button" name="submit_comment_product"
                                                  class="submit_comment_product btn btn-primary" value="Bình luận"
                                                  style="font-size: 14px; width: 120px; height: 45px">
                                            <input type="reset" name="" class=" btn btn-primary" value="Hủy"
                                                  style="font-size: 14px; width: 120px; height: 45px">
                                        </div>
                                    </form>
                                    <?php
                                    }else{
                                    ?>
                                        <div class="d-flex flex-start w-100">
                                            <div class="form-outline w-100">
                                                <b><a href="{{ URL::to('client_login_client') }}">
                                                    Đăng nhập
                                                </a></b>
                                                <label class="form-label" for="textAreaExample">và để lại bình luận</label>
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
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- NỘI DUNG SẢN PHẨM TƯƠNG TỰ --}}
            <div class="tab-pane fade" id="pane-tab-3" role="tabpanel" aria-labelledby="tab3">
                <section class="ftco-section">
                    <div class="container">
                        <div class="row justify-content-center mb-3 pb-3">
                            <div class="col-md-12 heading-section text-center ftco-animate">
                                <h2 class="mb-4 mt-3">Sản phẩm tương tự</h2>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            @foreach ($related_product as $key => $show_product)
                                <div class="col-md-6 col-lg-3 ftco-animate">
                                    <div class="product">
                                        <form>
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $show_product->product_id }}" class="cart_product_id_{{ $show_product->product_id }}">
                                            <input type="hidden" value="{{ $show_product->product_name }}" class="cart_product_name_{{ $show_product->product_id }}">
                                            <input type="hidden" value="{{ $show_product->product_image }}" class="cart_product_image_{{ $show_product->product_id }}">
                                            <input type="hidden" value="{{ $show_product->product_packing }}" class="cart_product_packing_{{ $show_product->product_id }}">
                                            <input type="hidden" value="{{ $show_product->product_price }}" class="cart_product_price_{{ $show_product->product_id }}">
                                            <input type="hidden" value="{{ $show_product->product_amount }}" class="cart_product_amount_{{ $show_product->product_id }}">
                                            <input type="hidden" value="1" class="cart_product_quantity_{{ $show_product->product_id }}">


                                            {{-- thêm vào yêu thích --}}
                                            <input type="hidden" value="{{ $show_product->product_id }}"
                                                class="like_product_id_{{ $show_product->product_id }}">
                                            <input type="hidden" value="{{ $show_product->product_name }}"
                                                class="like_product_name_{{ $show_product->product_id }}">
                                            <input type="hidden" value="{{ $show_product->product_image }}"
                                                class="like_product_image_{{ $show_product->product_id }}">
                                            <input type="hidden" value="{{ $show_product->product_packing }}"
                                                class="like_product_packing_{{ $show_product->product_id }}">
                                            <input type="hidden" value="{{ $show_product->product_price }}"
                                                class="like_product_price_{{ $show_product->product_id }}">
                                            <input type="hidden" value="{{ $show_product->product_amount }}"
                                                class="like_product_amount_{{ $show_product->product_id }}">
                                            <input type="hidden" value="1"
                                                class="like_product_quantity_{{ $show_product->product_id }}">


                                            <a href="{{ URL::to('client_detail_product/' . $show_product->product_id) }}"
                                                class="img-prod">
                                                <img class="img-fluid"
                                                    src="{{ URL::to('public/upload/product/' . $show_product->product_image) }}"
                                                    alt="Colorlib Template">
                                                {{-- <span class="status">30%</span>
                                    <div class="overlay"></div> --}}
                                            </a>
                                            <div class="text py-3 pb-4 px-3 text-center">
                                                <h3><a
                                                        href="{{ URL::to('client_detail_product/' . $show_product->product_id) }}">
                                                        {{ $show_product->product_name }}<br>
                                                        {{ $show_product->product_packing }}
                                                    </a></h3>
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
                        <div class="modal fade" id="viewnow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            </div>
        </div>
    </div>
@endsection
