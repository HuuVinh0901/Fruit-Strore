@extends('client_layout')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ URL::to('public/frontend/images/hihihi.png') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread" style="font-family: 'Times New Roman', Times, serif;">GIỎ HÀNG</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="mt-3 mb-5 ftco-cart"> {{-- ftco-section --}}
        <div class="container">
            <form action="{{ URL::to('client_update_ajax_cart') }}" method="POST">
                {{ csrf_field() }}
                <div class="row mb-5">
                    <div class="col-md-12 ftco-animate">
                        <div class="cart-list">
                            <b class="text-danger">
                                <?php
                                $message = Session::get('message');
                                if ($message) {
                                    echo $message;
                                    Session::put('message', null);
                                }
                                ?>
                            </b>
                            <?php
                            $total = 0;
                            /* nếu có sản phẩm trong giỏ hàng */
                            if(session::get('cart')==true){
                            ?>
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>Trái cây</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Session::get('cart') as $key => $list_cart)
                                        <tr class="text-center">
                                            <td class="product-remove">
                                                <a
                                                    href="{{ URL::to('client_delete_ajax_cart/' . $list_cart['session_id']) }}">
                                                    <span class="ion-ios-close"></span>
                                                </a>
                                            </td>
                                            <td>
                                                <img src="{{ URL::to('public/upload/product/' . $list_cart['product_image']) }}"
                                                    alt="" width="100">
                                            </td>

                                            <td class="product-name">
                                                <h3>{{ $list_cart['product_name'] }}</h3>
                                                <p>{{ $list_cart['product_packing'] }}</p>
                                            </td>

                                            <td class="price">
                                                {{ number_format($list_cart['product_price'],0,'.','.') }}
                                            </td>

                                            <td class="quantity">
                                                <div class="row">
                                                    <div class="col-3"></div>
                                                    <input type="number"
                                                        name="cart_quantity[{{ $list_cart['session_id'] }}]"
                                                        class="quantity input-number w-50 text-center"
                                                        style="border: 0.5px solid #DCDCDC; border-radius: 5px;"
                                                        value="{{ $list_cart['product_quantity'] }}" min="1"
                                                        max="100">
                                                </div>
                                            </td>
                                            <td class="total mt-2">
                                                <?php
                                                $subtotal = $list_cart['product_price'] * $list_cart['product_quantity'];
                                                echo number_format($subtotal,0,'.','.');
                                                $total += $subtotal;
                                                ?>
                                            </td>
                                        </tr><!-- END TR-->
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                <input type="submit" name="update_cart" class="btn btn-primary mb-3"
                                    style="font-size: 14px; width: 120px; height: 45px"
                                    value="Cập nhật">{{--  height: 45px --}}

                                <a href="{{ URL::to('client_delete_all_ajax_cart') }}" type="submit"
                                    name="dalete_all_cart" class="btn btn-primary mb-3"
                                    style="font-size: 14px;  width: 120px; height: 45px; padding-top: 11px">Xóa tất cả</a>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <b class="text-danger">
                <?php
                $messages = Session::get('messages');
                if ($messages) {
                    echo $messages;
                    Session::put('messages', null);
                }
                ?>
            </b>

            {{-- nếu có đăng nhập --}}
            @if(Session::get('client_id')!=NULL)
                {{-- nếu có đăng nhập, nếu đơn nhỏ hơn 300k --}}
                @if($total<300000)
                    <div class="row justify-content-end">
                        {{-- giảm giá --}}
                        <div class="col-lg-4 mt-4 cart-wrap ftco-animate">
                            <form action="{{URL::to('client_check_discount')}}" class="info" method="POST">
                                {{ csrf_field() }}
                                <div class="cart-total mb-3">
                                    <h3>GIẢM GIÁ</h3>
                                    <p>Nhập mã phiếu giảm giá của bạn nếu bạn có</p>
                                    <div class="form-group">
                                        <label for="">Nhập mã giảm giá</label>
                                        <input name="discount" type="text" class="form-control text-left px-3" placeholder="">
                                    </div>
                                </div>
                                <input name="submit_discount" type="submit" value="Áp dụng giảm giá" class="btn btn-primary" style="font-size: 14px; width: 170px; height: 45px">
                            </form>
                        </div>

                        {{-- địa chỉ giao hàng, tính phí vận chuyển --}}
                        <div class="col-lg-4 mt-4 cart-wrap ftco-animate">
                            <div class="cart-total mb-3">
                                <h3>ĐỊA CHỈ GIAO HÀNG</h3>
                                @php
                                    $client_id = Session::get('client_id');
                                    $province_name = Session::get('province_name');
                                    $province_id = Session::get('province_id');

                                    $district_name = Session::get('district_name');
                                    $district_id = Session::get('district_id');

                                    $ward_name = Session::get('ward_name');
                                    $ward_id = Session::get('ward_id');

                                    $client_address = Session::get('client_address');
                                @endphp
                                <div class="form-group">
                                    <label for="">Thành phố</label>
                                    <select class="form-control choose province" name="name_province" id="province">
                                        <option value="{{$province_id}}" style="text-align: start">Thành phố {{$province_name}}</option>
                                        @foreach ($province as $key => $show_province)
                                            <option value="{{$show_province->province_id}}" style="text-align: start">{{$show_province->province_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Quận - Huyện</label>
                                    <div class="form-group">
                                        <select class="form-control choose district" name="name_district" id="district">
                                            <option value="{{$district_id}}" style="text-align: start">{{$district_name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Xã - Phường - Thị trấn</label>
                                    <div class="form-group">
                                        <select class="form-control ward" name="name_ward" id="ward">
                                            <option value="{{$ward_id}}" style="text-align: start">{{$ward_name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Tên đường - Số nhà - Tòa nhà</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control info_order_address" value="{{$client_address}}" style="text-align: start">
                                    </div>
                                </div>
                            </div>
                            <input type="button" name="submit_delivery" class="fee_delivery btn btn-primary mb-3"
                                    style="font-size: 14px; width: 170px; height: 45px"
                                    value="Tính phí vận chuyển">
                        </div>

                        {{-- chi phí --}}
                        <div class="col-lg-4 mt-4 cart-wrap ftco-animate">
                            <div class="cart-total mb-3">
                                <div class="row">
                                    <div class="col-6"><h3>ĐƠN HÀNG</h3></div>
                                    <div class="col-6">
                                        @if (Session::get('discount'))
                                            <a href="{{URL::to('client_delete_discount')}}" class="float-right">Xóa mã giảm giá</a>
                                        @endif
                                    </div>
                                </div>

                                <p class="d-flex">
                                    <span>Thành tiền</span>
                                    <span style="text-align: end"><?php echo number_format($total, 0, ',', '.');?> VND</span>
                                </p>

                                <p class="d-flex">
                                    @if (Session::get('discount') == true)
                                    <span>Giảm giá</span>
                                    <span style="text-align: end">
                                        @foreach (Session::get('discount') as $key => $show_discount)
                                            @if($show_discount['discount_category']==1)
                                                -<?php echo number_format($total*$show_discount['discount_be']/100, 0, ',', '.');?> VND
                                                <p>
                                                    @php
                                                    $total_discount = ($total*$show_discount['discount_be'])/100;
                                                    $total_money = $total-$total_discount
                                                    @endphp
                                                </p>
                                            @elseif($show_discount['discount_category']==2)
                                                -{{number_format($show_discount['discount_be'],0,',','.')}} VND
                                                <p>
                                                    @php
                                                    $total_money = $total - $show_discount['discount_be'];
                                                    @endphp
                                                </p>
                                            @endif
                                        @endforeach
                                    </span>
                                    @endif
                                </p>
                                @if(session::get('fee_delivery') == true)
                                    <p class="d-flex">
                                        <span>Phí vận chuyển</span>
                                        <span style="text-align: end">
                                            <?php
                                                $fee_delivery = session::get('fee_delivery');
                                                echo number_format($fee_delivery, 0, ',', '.')
                                            ?> VND
                                        </span>
                                    </p>
                                @endif
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Tổng tiền</span>
                                    <span style="text-align: end">
                                        @if (Session::get('discount') == true && Session::get('fee_delivery') == true)
                                            <?php echo number_format($total_money + $fee_delivery, 0, ',', '.'); ?> VND
                                        @elseif(Session::get('discount') == true && Session::get('fee_delivery') != true)
                                            <?php echo number_format($total_money, 0, ',', '.'); ?> VND
                                        @elseif(Session::get('discount') != true && Session::get('fee_delivery') == true)
                                            <?php echo number_format($total + $fee_delivery, 0, ',', '.'); ?> VND
                                        @elseif(Session::get('discount') != true && Session::get('fee_delivery') !=true)
                                            <?php echo number_format($total, 0, ',', '.'); ?> VND
                                        @endif
                                    </span>
                                </p>
                            </div>
                            <?php
                            $fee_delivery = Session::get('fee_delivery');?>
                            @if($fee_delivery!=null)
                                <a href="{{ URL::to('client_checkout') }}" class="btn btn-primary py-3 px-4">
                                    Tiến hành thanh toán
                                </a>
                            @else
                                <a class="btn btn-primary py-3 px-4 submit_delivery text-light">
                                    Tiến hành thanh toán
                                </a>
                            @endif
                        </div>
                    </div>
                {{-- nếu có đăng nhập, nếu đơn lớn hơn 300k --}}
                @else
                    <div class="row justify-content-end">
                        {{-- giảm giá --}}
                        <div class="col-lg-6 mt-4 cart-wrap ftco-animate">
                            <form action="{{URL::to('client_check_discount')}}" class="info" method="POST">
                                {{ csrf_field() }}
                                <div class="cart-total mb-3">
                                    <h3>GIẢM GIÁ</h3>
                                    <p>Nhập mã phiếu giảm giá của bạn nếu bạn có</p>
                                    <div class="form-group">
                                        <label for="">Nhập mã giảm giá</label>
                                        <input name="discount" type="text" class="form-control text-left px-3" placeholder="">
                                    </div>
                                </div>
                                <input name="submit_discount" type="submit" value="Áp dụng giảm giá" class="btn btn-primary" style="font-size: 14px; width: 170px; height: 45px">
                            </form>
                        </div>

                        {{-- chi phí --}}
                        <div class="col-lg-6 mt-4 cart-wrap ftco-animate">
                            <div class="cart-total mb-3">
                                <div class="row">
                                    <div class="col-6"><h3>ĐƠN HÀNG</h3></div>
                                    <div class="col-6">
                                        @if (Session::get('discount'))
                                            <a href="{{URL::to('client_delete_discount')}}" class="float-right">Xóa mã giảm giá</a>
                                        @endif
                                    </div>
                                </div>

                                <p class="d-flex">
                                    <span>Thành tiền</span>
                                    <span style="text-align: end"><?php echo number_format($total, 0, ',', '.');?> VND</span>
                                </p>

                                <p class="d-flex">
                                    @if (Session::get('discount') == true)
                                    <span>Giảm giá</span>
                                    <span style="text-align: end">
                                        @foreach (Session::get('discount') as $key => $show_discount)
                                            @if($show_discount['discount_category']==1)
                                                -<?php echo number_format($total*$show_discount['discount_be']/100, 0, ',', '.');?> VND
                                                <p>
                                                    @php
                                                    $total_discount = ($total*$show_discount['discount_be'])/100;
                                                    $total_money = $total-$total_discount
                                                    @endphp
                                                </p>
                                            @elseif($show_discount['discount_category']==2)
                                                -{{number_format($show_discount['discount_be'],0,',','.')}} VND
                                                <p>
                                                    @php
                                                    $total_money = $total - $show_discount['discount_be'];
                                                    @endphp
                                                </p>
                                            @endif
                                        @endforeach
                                    </span>
                                    @endif
                                </p>
                                <p class="d-flex">
                                    <span>Phí vận chuyển</span>
                                    <span style="text-align: end">
                                        0 VND
                                    </span>
                                </p>
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Tổng tiền</span>
                                    <span style="text-align: end">
                                        @if (Session::get('discount') == true)
                                            <?php echo number_format($total_money, 0, ',', '.'); ?> VND
                                        @elseif(Session::get('discount') != true)
                                            <?php echo number_format($total, 0, ',', '.'); ?> VND
                                        @endif
                                    </span>
                                </p>
                            </div>
                            <p>
                                <a href="{{ URL::to('client_checkout') }}" class="btn btn-primary py-3 px-4">
                                    Tiến hành thanh toán
                                </a>
                            </p>
                        </div>
                    </div>
                @endif

            {{-- nếu không đăng nhập --}}
            @else
                <div class="row justify-content-end">
                    <div class="col-lg-6 mt-4 cart-wrap ftco-animate">
                        <form action="{{URL::to('client_check_discount')}}" class="info" method="POST">
                            {{ csrf_field() }}
                            <div class="cart-total mb-3">
                                <h3>GIẢM GIÁ</h3>
                                <p>Nhập mã phiếu giảm giá của bạn nếu bạn có</p>
                                <div class="form-group">
                                    <label for="">Nhập mã giảm giá</label>
                                    <input name="discount" type="text" class="form-control text-left px-3" placeholder="">
                                </div>
                            </div>
                            <input name="submit_discount" type="submit" value="Áp dụng giảm giá" class="btn btn-primary" style="font-size: 14px; width: 170px; height: 45px">
                        </form>
                    </div>

                    <div class="col-lg-6 mt-4 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <div class="row">
                                <div class="col-6"><h3>ĐƠN HÀNG</h3></div>
                                <div class="col-6">
                                    @if (Session::get('discount'))
                                        <a href="{{URL::to('client_delete_discount')}}" class="float-right">Xóa mã giảm giá</a>
                                    @endif
                                </div>
                            </div>

                            <p class="d-flex">
                                <span>Thành tiền</span>
                                <span style="text-align: end"><?php echo number_format($total, 0, ',', '.');?> VND</span>
                            </p>

                            <p class="d-flex">
                                @if (Session::get('discount') == true)
                                <span>Giảm giá</span>
                                <span style="text-align: end">
                                    @foreach (Session::get('discount') as $key => $show_discount)
                                        @if($show_discount['discount_category']==1)
                                            -<?php echo number_format($total*$show_discount['discount_be']/100, 0, ',', '.');?> VND
                                            <p>
                                                @php
                                                $total_discount = ($total*$show_discount['discount_be'])/100;
                                                $total_money = $total-$total_discount
                                                @endphp
                                            </p>
                                        @elseif($show_discount['discount_category']==2)
                                            -{{number_format($show_discount['discount_be'],0,',','.')}} VND
                                            <p>
                                                @php
                                                $total_money = $total - $show_discount['discount_be'];
                                                @endphp
                                            </p>
                                        @endif
                                    @endforeach
                                </span>
                                @endif
                            </p>
                            <p class="d-flex total-price">
                                <span>Tổng tiền</span>
                                <span style="text-align: end">
                                    @if (Session::get('discount') == true)
                                        <?php echo number_format($total_money, 0, ',', '.'); ?> VND
                                    @else
                                        <?php echo number_format($total, 0, ',', '.'); ?> VND
                                    @endif
                                </span>
                            </p>
                        </div>
                        <?php
                        $client_id = Session::get('client_id');
                        if($client_id==NULL){?>
                        <p>
                            <a href="{{ URL::to('client_login_checkout') }}" class="btn btn-primary py-3 px-4"> {{-- đăng nhập --}}
                                Tiến hành thanh toán
                            </a>
                        </p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            @endif
        </div>
        {{-- nếu không có sản phẩm trong giỏ hàng --}}
        <?php }else{ ?>
        <table class="table">
            <thead class="thead-primary">
                <tr class="text-center">
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Trái cây</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>

            </thead>
            <tbody>
                <td colspan="6">
                    <b class="text-danger">
                        Giỏ hàng đang trống vui lòng <span><a href="{{URL::to('client_list_product')}}">xem tiếp</a></span> sản phẩm
                    </b>
                </td>
            </tbody>
        </table>
        <?php }?>
    </section>
@endsection
