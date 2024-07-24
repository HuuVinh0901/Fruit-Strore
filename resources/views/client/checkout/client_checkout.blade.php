@extends('client_layout')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ URL::to('public/frontend/images/hh.png') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread" style="font-family: 'Times New Roman', Times, serif;">THANH TOÁN</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <form class="billing-form" action="{{URL::to('client_vnpay_checkout')}}" method="post">
                {{ csrf_field() }}
                <div class="row justify-content-center">
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
                            if(session::get('cart')==true){
                            ?>
                                <table class="table">
                                    <thead class="thead-primary">
                                        <tr class="text-center">
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
                                                <td>
                                                    <img src="{{ URL::to('public/upload/product/' . $list_cart['product_image']) }}"
                                                        alt="" width="100">
                                                </td>
                                                <td class="product-name">
                                                    <h3>{{ $list_cart['product_name'] }}</h3>
                                                    <p>{{ $list_cart['product_packing'] }}</p>
                                                </td>

                                                <td class="price">{{ number_format($list_cart['product_price'], 0, ',', '.'); }}</td>

                                                <td class="price">
                                                    {{ number_format($list_cart['product_quantity'], 0, ',', '.'); }}
                                                </td>
                                                <td class="total mt-2">
                                                    <?php
                                                    $subtotal = $list_cart['product_price'] * $list_cart['product_quantity'];
                                                    echo number_format($subtotal, 0, ',', '.');
                                                    $total += $subtotal;
                                                    ?>
                                                </td>
                                            </tr><!-- END TR-->
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    @php
                        $client_id = Session::get('client_id');
                        $client_email = Session::get('client_email');
                        $client_name = Session::get('client_name');
                        $client_phone = Session::get('client_phone');
                        $province_id = Session::get('id_province');
                        $province_name = Session::get('name_province');
                        $district_id = Session::get('id_district');
                        $district_name = Session::get('name_district'); //lấy bên DeliveryController
                        $ward_id = Session::get('id_ward');
                        $ward_name = Session::get('name_ward');
                        $info_order_address = Session::get('info_order_address');
                    @endphp
                    {{-- nếu có đăng nhập và có tính phí vận chuyển <300000 --}}
                    @if ($client_id != null && $total<300000)
                        <div class="col-xl-7 ftco-animate mt-5">
                            <h3 class="mb-4 billing-heading">Thông tin giao hàng</h3>
                            <a href="{{URL::to('/client_list_ajax_cart')}}">Tính phí vận chuyển</a>
                            <div class="row align-items-end">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>Địa chỉ: {{$info_order_address}}, {{$ward_name}}, {{$district_name}}, Thành phố {{$province_name}}</p>
                                        <input type="hidden" value="{{$province_id}}" name="province_id">
                                        <input type="hidden" value="{{$district_id}}" name="district_id">
                                        <input type="hidden" value="{{$ward_id}}" name="ward_id">
                                        <input type="hidden" value="{{$info_order_address}}" name="info_order_address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input name="info_order_name" type="text" class="form-control info_order_name" value="{{$client_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Số điện thoại</label>
                                        <input name="info_order_phone" type="text" class="form-control info_order_phone" value="{{$client_phone}}">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lastname">Email</label>
                                        <input name="info_order_email" type="email" class="form-control info_order_email" value="{{$client_email}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{-- <label>Tên đường - Tòa nhà - Số nhà</label> --}}
                                        <input name="info_order_address" type="hidden" class="form-control info_order_address" value="{{$info_order_address}}">
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="emailaddress">Ghi chú</label>
                                        <textarea name="info_order_note" type="text" class="form-control info_order_note" rows="7" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="row mt-5 pt-3">
                                <div class="col-md-12 d-flex mb-4" style="margin-top: 32px">{{-- style="margin-top: 74px" --}}
                                    <div class="cart-detail cart-total p-3 p-md-4 mt-5">
                                        <h3 class="billing-heading mb-4">THANH TOÁN ĐƠN HÀNG</h3>
                                        <p class="d-flex">
                                            <span>Thành tiền</span>
                                            <span style="text-align: end"><?php echo number_format($total, 0, ',', '.'); ?> VND</span>
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

                                        @if (Session::get('discount') == true)
                                            <p class="d-flex">
                                                <span>Giảm giá</span>
                                                <span style="text-align: end">
                                                    @foreach (Session::get('discount') as $key => $show_discount)
                                                        @if ($show_discount['discount_category'] == 1)
                                                            -<?php echo number_format(($total * $show_discount['discount_be']) / 100, 0, ',', '.'); ?> VND
                                                            <p>
                                                                @php
                                                                    $total_discount = ($total * $show_discount['discount_be']) / 100;
                                                                    $total_money = $total - $total_discount;
                                                                @endphp
                                                            </p>
                                                        @elseif($show_discount['discount_category'] == 2)
                                                            -{{ number_format($show_discount['discount_be'], 0, ',', '.') }} VND
                                                            <p>
                                                                @php
                                                                    $total_money = $total - $show_discount['discount_be'];
                                                                @endphp
                                                            </p>
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </p>
                                        @endif

                                        <hr>
                                        <p class="d-flex total-price mb-5">
                                            <span>Tổng tiền</span>
                                            <span style="text-align: end" class="order_total">
                                                @if (Session::get('discount') == true && Session::get('fee_delivery') == true)
                                                    <?php
                                                        $money = $total_money + $fee_delivery;
                                                        echo number_format($money, 0, ',', '.');
                                                    ?> VND
                                                @elseif(Session::get('discount') != true && Session::get('fee_delivery') == true)
                                                    <?php
                                                        $money = $total + $fee_delivery;
                                                        echo number_format($money, 0, ',', '.');
                                                    ?> VND
                                                @endif
                                            </span>
                                            <input type="hidden" name="money_total" value="{{$money}}">
                                        </p>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {{-- <form>
                                                    @csrf
                                                    <input type="hidden" value="" class="method_checkout" name="method_checkout">
                                                    <button class="method_checkout btn btn-primary" type="button" name="method_checkout">
                                                        Thanh toán khi nhận hàng
                                                    </button>
                                                </form> --}}

                                                {{-- <button name="submit_min_300000_checkout" class="btn btn-primary py-2 submit_min_300000_checkout">
                                                    Thanh toán khi nhận hàng
                                                </button> --}}
                                                <input type="button" class="btn btn-primary py-2 submit_min_300000_checkout" value="Thanh toán khi nhận hàng">

                                                <div class="text-center mt-2">HOẶC</div>
                                                <button class="btn btn-primary mt-2 py-2" type="submit">
                                                    <input type="hidden" name="redirect" value="VNPay">Thanh toán VNPay
                                                </button>

                                                {{-- <select name="payment_id" class="payment_id form-control">
                                                    <option value="">--Chọn phương thức thanh toán--</option>
                                                        @foreach ($payment as $key => $show_payment)
                                                            <option value="{{ $show_payment->payment_id }}">{{ $show_payment->payment_method }}</option>
                                                        @endforeach
                                                </select> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .col-md-8 -->
                        @if (Session::get('fee_delivery')==true)
                        <input type="hidden" name="delivery_fee" class="delivery_fee" value="{{Session::get('fee_delivery')}}">
                        @else
                            <input type="hidden" name="delivery_fee" class="delivery_fee" value="0">
                        @endif

                        @if (Session::get('discount'))
                            @foreach (Session::get('discount') as $key => $show_discount)
                                <input type="hidden" name="discount_code" class="discount_code" value="{{$show_discount['discount_code']}}">
                            @endforeach
                        @else
                            <input type="hidden" name="discount_code" class="discount_code" value="Null">
                        @endif
                        {{-- <p>
                            <input type="button" name="submit_min_300000_checkout" value="Xác nhận đặt hàng" class="btn btn-primary py-3 px-4 submit_min_300000_checkout">
                        </p> --}}
                    @elseif ($client_id != null && $total>=300000)
                        @php
                            $province_name = Session::get('province_name');
                            $province_id = Session::get('province_id');

                            $district_name = Session::get('district_name');
                            $district_id = Session::get('district_id');

                            $ward_name = Session::get('ward_name');
                            $ward_id = Session::get('ward_id');

                            $client_address = Session::get('client_address');
                        @endphp
                        <div class="col-xl-7 ftco-animate mt-5">
                            <h3 class="mb-4 billing-heading">Thông tin giao hàng</h3>
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input name="info_order_name" type="text" class="form-control info_order_name" value="{{$client_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Số điện thoại</label>
                                        <input name="info_order_phone" type="text" class="form-control info_order_phone" value="{{$client_phone}}">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lastname">Email</label>
                                        <input name="info_order_email" type="email" class="form-control info_order_email" value="{{$client_email}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Thành phố</label>
                                        <select class="form-control choose province" name="province" id="province">
                                            <option value="{{$province_id}}" style="text-align: start">Thành phố {{$province_name}}</option>
                                            @foreach ($province as $key => $show_province)
                                                <option value="{{$show_province->province_id}}" style="text-align: start">{{$show_province->province_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quận - Huyện</label>
                                        <div class="form-group">
                                            <select class="form-control choose district" name="district" id="district">
                                                <option value="{{$district_id}}" style="text-align: start">{{$district_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Xã - Phường - Thị trấn</label>
                                        <div class="form-group">
                                            <select class="form-control ward" name="ward" id="ward">
                                                <option value="{{$ward_id}}" style="text-align: start">{{$ward_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên đường - Tòa nhà - Số nhà</label>
                                        <input name="info_order_address" class="form-control info_order_address" value="{{$client_address}}">
                                    </div>
                                </div>



                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="emailaddress">Ghi chú</label>
                                        <textarea name="info_order_note" type="text" class="form-control info_order_note" rows="7" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="row mt-5 pt-3">
                                <div class="col-md-12 d-flex mb-4" style="margin-top: 32px">{{-- style="margin-top: 74px" --}}
                                    <div class="cart-detail cart-total p-3 p-md-4 mt-5">
                                        <h3 class="billing-heading mb-4">THANH TOÁN ĐƠN HÀNG</h3>
                                        <p class="d-flex">
                                            <span>Thành tiền</span>
                                            <span style="text-align: end"><?php echo number_format($total, 0, ',', '.'); ?> VND</span>
                                        </p>

                                        <p class="d-flex">
                                            <span>Phí vận chuyển</span>
                                            <span style="text-align: end">
                                                0 VND
                                            </span>
                                        </p>

                                        @if (Session::get('discount') == true)
                                            <p class="d-flex">
                                                <span>Giảm giá</span>
                                                <span style="text-align: end">
                                                    @foreach (Session::get('discount') as $key => $show_discount)
                                                        @if ($show_discount['discount_category'] == 1)
                                                            -<?php echo number_format(($total * $show_discount['discount_be']) / 100, 0, ',', '.'); ?> VND
                                                            <p>
                                                                @php
                                                                    $total_discount = ($total * $show_discount['discount_be']) / 100;
                                                                    $total_money = $total - $total_discount;
                                                                @endphp
                                                            </p>
                                                        @elseif($show_discount['discount_category'] == 2)
                                                            -{{ number_format($show_discount['discount_be'], 0, ',', '.') }} VND
                                                            <p>
                                                                @php
                                                                    $total_money = $total - $show_discount['discount_be'];
                                                                @endphp
                                                            </p>
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </p>
                                        @endif

                                        <hr>
                                        <p class="d-flex total-price mb-5">
                                            <span>Tổng tiền</span>
                                            <span style="text-align: end" class="order_total">
                                                @if (Session::get('discount') == true)
                                                    <?php
                                                        $money = $total_money;
                                                        echo number_format($money, 0, ',', '.');
                                                    ?> VND
                                                @elseif(Session::get('discount') != true)
                                                    <?php
                                                        $money = $total;
                                                        echo number_format($money, 0, ',', '.');
                                                    ?> VND
                                                @endif
                                            </span>
                                            <input type="hidden" name="money_total" value="{{$money}}">
                                        </p>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {{-- <form>
                                                    @csrf
                                                    <input type="hidden" value="" class="method_checkout" name="method_checkout">
                                                    <button class="method_checkout btn btn-primary" type="button" name="method_checkout">
                                                        Thanh toán khi nhận hàng
                                                    </button>
                                                </form> --}}

                                                <input type="button" class="btn btn-primary py-2 submit_max_300000_checkout" value="Thanh toán khi nhận hàng">

                                                <div class="text-center mt-2">HOẶC</div>

                                                <button class="btn btn-primary mt-2 py-2" type="submit">
                                                    <input type="hidden" name="redirect" value="VNPay"> Thanh toán VNPay
                                                </button>
                                                        {{-- @foreach ($payment as $key => $show_payment)
                                                            <input value="{{ $show_payment->payment_id }}" type="radio" name="payment_id" class="mr-2 payment_id" id="payment_id">
                                                                <a href="">{{ $show_payment->payment_method }}</a>
                                                        @endforeach --}}

                                                {{-- <select name="payment_id" class="payment_id form-control">
                                                    <option value="">--Chọn phương thức thanh toán--</option>
                                                        @foreach ($payment as $key => $show_payment)
                                                            <option value="{{ $show_payment->payment_id }}">{{ $show_payment->payment_method }}</option>
                                                        @endforeach
                                                </select> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Session::get('fee_delivery')==true)
                            <input type="hidden" name="delivery_fee" class="delivery_fee" value="{{Session::get('fee_delivery')}}">
                        @else
                            <input type="hidden" name="delivery_fee" class="delivery_fee" value="0">
                        @endif

                        @if (Session::get('discount'))
                            @foreach (Session::get('discount') as $key => $show_discount)
                                <input type="hidden" name="discount_code" class="discount_code" value="{{$show_discount['discount_code']}}">
                            @endforeach
                        @else
                            <input type="hidden" name="discount_code" class="discount_code" value="Null">
                        @endif
                        {{-- <p>
                            <input type="button" name="submit_max_300000_checkout" value="Xác nhận đặt hàng" class="btn btn-primary py-3 px-4 submit_max_300000_checkout">
                        </p> --}}
                    @endif
                </div>
            </form><!-- END -->
            <?php }else{?>
                <table class="table">
                    <thead class="thead-primary">
                        <tr class="text-center">
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
        </div>
    </section>
@endsection
