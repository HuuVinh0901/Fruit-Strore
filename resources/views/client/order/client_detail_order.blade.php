@extends('client_layout')
@section('content')

<section class="ftco-section">
    <div class="container">
        @foreach ($order as $key => $show_order)
            <div class="row">
                <b class="ml-3"><h3 class="text-primary">CHI TIẾT ĐƠN HÀNG</h3></b>
                @if($show_order->payment_id!=4)
                    <div class="mr-3 ml-auto">
                        <form>
                            @csrf
                            {{-- @if ($status->status_id == 2)
                                <b class="btn btn-primary mb-3">Bạn không thể hủy đơn hàng</b>
                            @else --}}@if ($status->status_id == 3)
                                <b class="btn btn-primary mb-3" style="border-radius: 5px; font-size: 15px">
                                    Không thể hủy đơn hàng vì đơn hàng đang giao đến bạn
                                </b>
                            @elseif ($status->status_id == 4)

                            @elseif($status->status_id == 5)

                            @elseif($status->status_id == 6)
                                <b class="btn btn-primary mb-3" style="border-radius: 5px; font-size: 15px">
                                    Bạn đã hủy đơn hàng
                                </b>
                            @else
                                <input type="button" id="{{$show_order->order_id}}"
                                        class="btn btn-primary py-2 update_status_detail_order"
                                        value="Hủy đơn hàng"
                                        style="border-radius: 5px; font-size: 15px">
                                {{-- <select class="update_status_detail_order border border-success text-primary px-1 py-1 mb-3" style="text-align: start; border-radius: 5px; font-weight: bold;">
                                    <option id="{{$show_order->order_id}}" value="6">Hủy đơn hàng</option>
                                    <option id="{{$show_order->order_id}}" value="6">Lý do: Đặt lại đơn khác</option>
                                    <option id="{{$show_order->order_id}}" value="6">Lý do: Đổi địa chỉ giao hàng</option>
                                    <option id="{{$show_order->order_id}}" value="6">Lý do: Khác</option>

                                </select> --}}
                            @endif
                        </form>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="cart-detail cart-total p-3 p-md-4">
                        <h3 class="billing-heading mb-4">
                            ĐƠN HÀNG
                            <b style="color: red; text-transform: uppercase">{{$show_order->status->status_name}}</b>
                        </h3>
                        <p class="d-flex">
                            <span>Mã vận đơn:</span>
                            <span >{{$show_order->order_code}}</span>
                        </p>
                        <p class="d-flex">
                            <span>Ngày đặt hàng:</span>
                            <span>{{date_format($show_order->created_at,'d/m/Y H:i:s')}}</span>
                        </p>
                        @if($show_order->status_id == 4 || $show_order->status_id == 5)
                            <p class="d-flex">
                                <span>Người giao:</span>
                                <span>
                                    @if ($show_order->admin_id == 0)
                                        Đang cập nhật
                                    @else
                                        {{$show_order->admin->admin_name}}
                                    @endif
                                </span>
                            </p>
                            <p class="d-flex">
                                <span>Số điện thoại:</span>
                                <span>
                                    @if ($show_order->admin_id == 0)
                                        Đang cập nhật
                                    @else
                                        {{$show_order->admin->admin_phone}}
                                    @endif
                                </span>
                            </p>
                            <p class="d-flex">
                                <span>Ngày giao:</span>
                                <span>
                                    <?php
                                    if($info_order->district_id==1 || $info_order->district_id==3 || $info_order->district_id==4 || $info_order->district_id==7){
                                        $date_ship = $show_order->created_at->addDays(1);
                                        echo date_format($date_ship,'d/m/Y');
                                    }elseif($info_order->district_id==2 || $info_order->district_id==5 || $info_order->district_id==6 || $info_order->district->district_id==8 || $info_order->district->district_id==9){
                                        $date_ship = $show_order->created_at->addDays(2);
                                        echo date_format($date_ship,'d/m/Y');
                                    }

                                    ?>
                                </span>
                            </p>
                        @elseif($show_order->status_id == 1 || $show_order->status_id == 2)
                            <p class="d-flex">
                                <span>Người giao:</span>
                                <span>
                                    @if ($show_order->admin_id == 0)
                                        Đang cập nhật
                                    @else
                                        {{$show_order->admin->admin_name}}
                                    @endif
                                </span>
                            </p>
                            <p class="d-flex">
                                <span>Số điện thoại:</span>
                                <span>
                                    @if ($show_order->admin_id == 0)
                                        Đang cập nhật
                                    @else
                                        {{$show_order->admin->admin_phone}}
                                    @endif
                                </span>
                            </p>
                            <p class="d-flex">
                                <span>Ngày giao dự kiến:</span>
                                <span>
                                    <?php
                                    if($info_order->district_id==1 || $info_order->district_id==3 || $info_order->district_id==4 || $info_order->district_id==7){
                                        $date_ship = $show_order->created_at->addDays(1);
                                        echo date_format($date_ship,'d/m/Y');
                                    }elseif($info_order->district_id==2 || $info_order->district_id==5 || $info_order->district_id==6 || $info_order->district->district_id==8 || $info_order->district->district_id==9){
                                        $date_ship = $show_order->created_at->addDays(2);
                                        echo date_format($date_ship,'d/m/Y');
                                    }

                                    ?>
                                </span>
                            </p>
                        @elseif ($show_order->status_id == 3)
                            <p class="d-flex">
                                <span>Người giao:</span>
                                <span>
                                    {{$show_order->admin->admin_name}}
                                </span>
                            </p>
                            <p class="d-flex">
                                <span>Số điện thoại:</span>
                                <span>
                                    {{$show_order->admin->admin_phone}}
                                </span>
                            </p>
                            <p class="d-flex">
                                <span>Ngày giao dự kiến:</span>
                                <span>
                                    <?php
                                    if($info_order->district_id==1 || $info_order->district_id==3 || $info_order->district_id==4 || $info_order->district_id==7){
                                        $date_ship = $show_order->created_at->addDays(1);
                                        echo date_format($date_ship,'d/m/Y');
                                    }elseif($info_order->district_id==2 || $info_order->district_id==5 || $info_order->district_id==6 || $info_order->district->district_id==8 || $info_order->district->district_id==9){
                                        $date_ship = $show_order->created_at->addDays(2);
                                        echo date_format($date_ship,'d/m/Y');
                                    }

                                    ?>
                                </span>
                            </p>
                        @elseif($show_order->status_id == 6)

                        @endif

                        {{-- <p class="d-flex">
                            <span>Trạng thái đơn hàng:</span>
                            <span><b>{{$show_order->status->status_name}}</b></span>
                        </p> --}}
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="cart-detail cart-total p-3 p-md-4">

                        <h3 class="billing-heading mb-4">CHI PHÍ</h3>
                        @php
                            $total = 0;
                            $subtotal = 0;
                            foreach ($detail_order as $key => $show_detail_order){
                                $total = ($show_detail_order->product_price)*($show_detail_order->product_quantity);
                                $subtotal += $total;
                            }
                        @endphp

                        <p class="d-flex">
                            <span>Trái cây:</span>
                            <span style="text-align: end">{{number_format($subtotal,0,'.','.')}} VND</span>
                        </p>
                        @if($show_order->discount_code!='Null')
                            @if($discount->discount_category == 1)
                                <p class="d-flex">
                                    <span>Mã giảm giá {{ $discount->discount_be }}%:</span>
                                    <span style="text-align: end">-{{ number_format($subtotal*$discount->discount_be/100,0,'.','.') }} VND</span>
                                </p>
                            @elseif($discount->discount_category == 2)
                                <p class="d-flex">
                                    <span>Mã giảm giá:</span>
                                    <span style="text-align: end">-{{ number_format($discount->discount_be,0,',','.') }} VND</span>
                                </p>
                            @endif
                        @endif
                        <p class="d-flex">
                            <span>Phí vận chuyển:</span>
                            <span style="text-align: end">{{number_format($show_order->delivery_fee,0,'.','.')}} VND</span>
                        </p>

                        <p class="d-flex">
                            <span>Tổng tiền:</span>
                            <?php
                                if($show_order->discount_code!='Null'){
                                    if($discount->discount_category == 1){
                                        $total_discount =  (($subtotal * $discount['discount_be']) / 100);
                                        $total_money = $subtotal - $total_discount + $show_order->delivery_fee;
                                    }elseif($discount->discount_category == 2){
                                        $total_money = ($subtotal+($show_order->delivery_fee)) - $discount['discount_be'];
                                    }
                            ?>
                                    <span style="text-align: end"><b>{{number_format($total_money, 0, ',', '.');}} VND</b></span>
                            <?php
                                }else{
                                    $total_money = $subtotal+($show_order->delivery_fee);
                            ?>
                                    <span style="text-align: end"><b>{{number_format($total_money, 0, ',', '.');}} VND</b> </span>
                            <?php
                                }
                            ?>

                        </p>
                        <p class="d-flex">
                            <span>Thanh toán:</span>
                            <span style="text-align: end">{{$show_order->payment->payment_method}}</span>
                        </p>

                    </div>
                </div>


                <div class="col-md-7">
                    <div class="cart-detail cart-total p-3 p-md-4 mt-5">
                        <h3 class="billing-heading mb-4">THÔNG TIN CHI TIẾT</h3>
                        <p class="d-flex">
                            <span>Mặt hàng: </span>
                            <span>
                                @foreach ($detail_order as $key => $show_detail_order)
                                    <input name="product_quantity" type="hidden" value="{{ $show_detail_order->product_quantity }}">
                                    <input name="product_id" class="product_id" type="hidden" value="{{ $show_detail_order->product_id }}">
                                    {{$show_detail_order->product_quantity}} {{$show_detail_order->product_packing}} {{$show_detail_order->product_name}} <br>
                                @endforeach
                            </span>
                        </p>

                        <p class="d-flex">
                            <span>Lưu ý giao hàng:</span>
                            <span>Không cho xem trước</span>
                        </p>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="cart-detail cart-total p-3 p-md-4 mt-5">
                        <h3 class="billing-heading mb-4">NGƯỜI NHẬN</h3>
                        <p class="d-flex">
                            <span>Họ và tên:</span>
                            <span>{{$info_order->info_order_name}}</span>
                        </p>
                        <p class="d-flex">
                            <span>Số điện thoại:</span>
                            <span>{{$info_order->info_order_phone}}</span>
                        </p>
                        <p class="d-flex">
                            <span>Địa chỉ:</span>
                            <span>{{$info_order->info_order_address}}, {{$info_order->ward->ward_name}}, {{$info_order->district->district_name}}, {{$info_order->province->province_name}}</span>
                        </p>
                        <p class="d-flex">
                            <span>Ghi chú:</span>
                            <span>
                                @if ($info_order->info_order_note == 'Không có' || $info_order->info_order_note == NULL)
                                    Không có
                                @else
                                    {{ $info_order->info_order_note }}
                                @endif
                            </span>
                        </p>


                    </div>
                </div>

            </div>
        @endforeach
        <b><h3 class="mt-5 text-primary">LỊCH SỬ ĐẶT HÀNG</h3></b>
        <div class="row" style="margin: 0 1px 0 1px">
            <table class="table">
                <?php $n=1;?>
                <thead class="thead-primary">
                    <th>STT</th>
                    <th>Mã vận đơn</th>
                    <th>Người nhận</th>
                    <th>Ngày đặt hàng</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái giao hàng</th>
                    <th>Chi tiết</th>
                </thead>

                @foreach ($list_order as $key => $show_list_order)
                <tbody>
                    <td>{{$n++}}</td>
                    <td>{{$show_list_order->order_code}}</td>
                    <td>{{$show_list_order->info_order->info_order_name}}</td>
                    <td>{{date_format($show_list_order->created_at,'H:i:s d/m/Y')}}</td>
                    <td>
                        @if ($show_list_order->payment_id == 3)
                            Thanh toán khi nhận hàng
                        @elseif ($show_list_order->payment_id == 4)
                            Đã thanh toán VNPay
                        @endif
                    </td>
                    <td><b>{{$show_list_order->status->status_name}}</b></td>
                    <td><b><a href="{{URL::to('client_detail_order/'.$show_list_order->order_code)}}">Xem chi tiết</a></b></td>
                </tbody>
                @endforeach
            </table>
        </div>
        {{ $list_order->links('pagination::bootstrap-4') }}
    </div>
</section>


@endsection
