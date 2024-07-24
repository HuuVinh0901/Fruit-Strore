@extends('admin_layout')
@section('content')
@php
    $name_admin = Auth::user()->admin_name;

@endphp
@if ($name_admin)
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-1">
                        <h4>Thông tin đơn hàng <?php echo Session::get('order_code')?></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    @foreach ($order as $key => $show_order)
                        <a href="{{URL::to('admin_list_order')}}" class="btn btn-primary">
                            Danh sách đơn hàng
                        </a>
                    @endforeach

                </div>

                <div class="col-sm-10 p-md-0 mt-sm-0 d-flex mt-3">

                    @if ($show_order->admin_id == NULL)
                        Vui lòng&nbsp;
                        <b><a href="{{URL::to('admin_shipper_detail_order/'.$show_order->order_code)}}" style="color: #848383">
                            cập nhật nhân viên giao hàng
                        </a></b>
                        &nbsp;để cập nhật trạng thái giao hàng
                    @else
                        <div style="margin-top: 7px">Trạng thái: &nbsp;</div>
                        <form>
                            @csrf
                            @if ($status->status_id == 1)
                                <select class="update_status_detail_order btn btn-light">
                                    <option>Chờ xử lý</option>
                                    <option id="{{$show_order->order_id}}" value="2">Đã được xác nhận</option>
                                    <option id="{{$show_order->order_id}}" value="6">Hủy đơn hàng</option>
                                </select>
                            @elseif ($status->status_id == 2)
                                <select class="update_status_detail_order btn btn-light">
                                    <option>Đã được xác nhận</option>
                                    <option id="{{$show_order->order_id}}" value="3">Đang giao hàng</option>
                                </select>
                            @elseif ($status->status_id == 3)
                                <select class="update_status_detail_order btn btn-light">
                                    <option>Đang giao hàng</option>
                                    <option id="{{$show_order->order_id}}" value="4">Giao hàng thành công</option>
                                    <option id="{{$show_order->order_id}}" value="5">Giao hàng thất bại</option>
                                    <option id="{{$show_order->order_id}}" value="6">Hủy đơn hàng</option>
                                </select>
                            @elseif ($status->status_id == 4)
                                <b class="btn btn-light">Giao hàng thành công</b>
                            @elseif($status->status_id == 5)
                                <b class="btn btn-light">Giao hàng thất bại</b>
                            @elseif($status->status_id == 6)
                                <b class="btn btn-light">Đơn hàng bị hủy</b>
                            @else
                                {{-- <select class="update_status_detail_order btn btn-light">
                                    <option>{{$status->status_name}}</option>
                                    @foreach ($list_status as $key => $show_status)
                                        @foreach ($order as $key => $show_order)
                                            <option id="{{$show_order->order_id}}" value="{{$show_status->status_id}}">{{$show_status->status_name}}</option>
                                        @endforeach
                                    @endforeach
                                </select> --}}
                            @endif
                        </form>
                    @endif
                    <?php
                    $total = 0;
                    $subtotal = 0;
                    $n=1;
                    ?>
                </div>
                <div class="col-sm-2 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    @foreach ($order as $key => $show_order)
                        <a href="{{URL::to('admin_print_order/'.$show_order->order_code)}}" style="font-size: 20px; color:#000; padding-right:70px">
                            <i class="fa-solid fa-print"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="row">
                <div id="man" class="col">
                    <div class="card">
                        <table id="datatable">
                            <thead >
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th>Trái cây</th>
                                    <th>Quy cách</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Kho hàng</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($detail_order as $key => $show_order_detail)
                                    <?php
                                    $total = ($show_order_detail->product_price * $show_order_detail->product_quantity);
                                    $subtotal += $total;
                                    ?>
                                    <tr>
                                        <td class="text-center">{{ $n++ }}</td>
                                        <td>&nbsp;&nbsp;{{ $show_order_detail->product_name }}</td>
                                        <td>&nbsp;&nbsp;{{ $show_order_detail->product_packing }}</td>
                                        <td>&nbsp;&nbsp;&nbsp;{{ number_format($show_order_detail->product_price, 0, ',', '.') }}</td>
                                        <td>
                                            <input name="product_quantity" type="text" disabled value="{{ $show_order_detail->product_quantity }}" style="border-color: #FFF; width: 30px">
                                            <input name="product_id" class="product_id" type="hidden" value="{{ $show_order_detail->product_id }}">
                                        </td>
                                        <td>&nbsp;&nbsp;&nbsp;{{ number_format(($show_order_detail->product_price * $show_order_detail->product_quantity), 0, ',', '.') }}</td>
                                        <td>&nbsp;&nbsp;{{ $show_order_detail->product->product_amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h6><b>NGƯỜI NHẬN</b></h6>
                            <table>
                            <tr>
                                <th>Họ tên:</th>
                                <td>{{ $info_order->info_order_name }}</td>
                            </tr>
                            <tr>
                                <th>Số điện thoại: &nbsp;&nbsp;</th>
                                <td>{{ $info_order->info_order_phone }}</td>
                            </tr>
                            <tr>
                                <th style="vertical-align: top;">Địa chỉ:</th>
                                <td>
                                    {{$info_order->info_order_address}}, <br>
                                    {{$info_order->ward->ward_name}}, <br>
                                    {{$info_order->district->district_name}},<br>
                                    {{$info_order->province->province_name}}
                                </td>
                            </tr>
                            <tr>
                                <th>Ghi chú:</th>
                                <td>
                                    @if ($info_order->info_order_note == 'Không có' || $info_order->info_order_note == NULL)
                                        Không có
                                    @else
                                        {{ $info_order->info_order_note }}
                                    @endif
                                </td>
                            </tr>
                            {{-- <div>Ghi chú: {{ $info_order->info_order_note }}</div> --}}
                            {{-- <div>Ngày giao:</div> --}}
                        </table>
                        </div>
                    </div>
                </div>
                @foreach ($order as $key => $show_order)
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h6><b>CHI PHÍ</b></h6>
                                <table>
                                    <?php
                                        $fee = $show_order->delivery_fee;
                                    ?>
                                    <tr>
                                        <th>Ngày đặt:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <td class="float-right">{{ date_format($show_order->created_at,'H:i:s d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Thanh toán:</th>
                                        <td class="float-right">{{ $payment->payment_method }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trái cây:</th>
                                        <td class="float-right"><?php echo number_format($subtotal,0,',','.')?></td>
                                    </tr>

                                    <tr>

                                        @if($show_order->discount_code!='Null')
                                            @if($discount->discount_category == 1)
                                                <th>Mã giảm giá:</th>
                                                <td class="float-right">{{ $discount->discount_be }}%</td>
                                            @elseif($discount->discount_category == 2)
                                                <th>Mã giảm giá:</th>
                                                <td class="float-right">-{{ number_format($discount->discount_be,0,',','.') }}</td>
                                            @endif
                                        @endif

                                        {{--  --}}
                                    </tr>

                                    {{-- <tr>
                                        <th>Ngày đặt:</th>
                                        <td>{{ $show_order->created_at }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th>Phí giao hàng:</th>
                                        <td class="float-right">{{ number_format($fee, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền:</th>
                                        <td class="float-right">
                                            @php
                                            if($show_order->discount_code!='Null'){
                                                if($discount->discount_category == 1){
                                                    $total_discount = ($subtotal * $discount['discount_be']) / 100;
                                                    $total_money = $subtotal - $total_discount + $fee;
                                                }elseif($discount->discount_category == 2){
                                                    $total_money = ($subtotal+$fee) - $discount['discount_be'];
                                                }
                                                echo number_format($total_money, 0, ',', '.');
                                                session::put('total_money',$total_money);
                                            }else{
                                                $total_money = $subtotal+$fee;
                                                echo number_format($total_money, 0, ',', '.');
                                                session::put('total_money',$total_money);
                                            }

                                            @endphp
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h6><b>NHÂN VIÊN GIAO HÀNG</b></h6>
                                <table>
                                    <tr>
                                        <th>Người giao:</th>
                                        <td>
                                            @if($show_order->admin_id == 0)
                                                Chưa có
                                            @else
                                                <a href="{{URL::to('admin_shipper_detail_order/'.$show_order->order_code)}}" style="color: #848383">
                                                    {{$show_order->admin->admin_name}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại: &nbsp;&nbsp;</th>
                                        <td>
                                            @if($show_order->admin_id == 0)
                                                Chưa có
                                            @else
                                                {{ $show_order->admin->admin_phone }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ngày giao:</th>
                                        <td>
                                            @if($show_order->admin_id == 0)
                                                Chưa có
                                            @else
                                                {{date_format($show_order->created_at->addDays(1),'d/m/Y')}}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
    Hi
    @endif
@endsection
