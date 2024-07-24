<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .container{
            background-color: #8EEC91;
            color: #000;
            border-radius: 30px;
            width: 70%;
            padding: 30px;
        }
        body{
            font-family: Dejavu Sans ;
            font-size: 12px;
        }
        .border{
            border: 1px solid black;
        }
        .table{
            width: 100%;
            border-collapse: collapse;
            margin-top:20px
        }
        .center{
            text-align: center;
        }
        .right{
            text-align: right;
        }
        .uppercase{
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="container">
        <p class="uppercase" style="font-size: 12px">Cửa hàng nhập khẩu trái cây tươi ImportedFruit</p>
        <p style="font-size: 12px">Nhận ship tại khu vực Cần Thơ</p>
        <p>-------------------------------------------------------------------------------</p>
        <h2 class="center uppercase"><b>ĐƠN ĐẶT HÀNG</b></h2>
        <table>
            <tbody>
                <tr>
                    <td>Đơn hàng</td>
                    <td>{{$order_array['order_code']}}</td>
                </tr>
                <tr>
                    <td>Ngày đặt:</td>
                    <td>{{$order_array['created_at']}}</td>
                </tr>
                <tr>
                    <td>Người nhận:</td>
                    <td>{{$info_order_array['info_order_name']}}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{$info_order_array['info_order_email']}}</td>
                </tr>
                <tr>
                    <td>Điện thoại:</td>
                    <td>{{$info_order_array['info_order_phone']}}</td>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td>{{$info_order_array['info_order_address']}}, {{$info_order_array['ward_name']}}, {{$info_order_array['district_name']}}, {{$info_order_array['province_name']}}</td>
                </tr>
                <tr>
                    <td>Ghi chú:</td>
                    <td>{{$info_order_array['info_order_note']}}</td>
                </tr>
                <tr>
                    {{-- {{$order_array['discount_code']}} --}}
                    <td colspan="2"><b>Phương thức thanh toán: {{$order_array['payment_method']}}</b></td>
                </tr>
                <tr>
                    {{-- {{$order_array['discount_code']}} --}}
                    <td colspan="2"><b>Trạng thái đơn hàng: chờ xử lý</b></td>
                </tr>
                {{-- <tr>
                    <td>Người giao:</td>
                    <td>
                        @if ($order_array['admin_id'] == 0)
                            Đang cập nhật
                        @else
                            {{$order_array['admin_name']}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td>
                        @if ($order_array['admin_id'] == 0)
                            Đang cập nhật
                        @else
                            {{$order_array['admin_phone']}}
                        @endif
                    </td>
                </tr> --}}
            </tbody>
        </table>
        <table class="table">
            <thead>
                <th class="border">Trái cây</th>
                <th class="border">Quy cách</th>
                <th class="border">Giá tiền</th>
                <th class="border">Số lượng</th>
                <th class="border right">Thành tiền</th>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $subtotal = 0;
                foreach($cart_array as $show_cart_array){
                    $total = $show_cart_array['product_price'] * $show_cart_array['product_quantity'];
                    $subtotal += $total;
                ?>
                    <tr>
                        <td class="border">{{$show_cart_array['product_name']}}</td>
                        <td class="border">{{$show_cart_array['product_packing']}}</td>
                        <td class="border center">{{number_format($show_cart_array['product_price'],0,'.','.')}}</td>
                        <td class="border center">{{$show_cart_array['product_quantity']}}</td>
                        <td class="border right">{{number_format($show_cart_array['product_quantity']*$show_cart_array['product_price'],0,'.','.')}} VND</td>
                    </tr>
                <?php }?>
                    <tr>
                        <td colspan="4" class="border right">
                            Tiền hàng
                        </td>
                        <td class="border right">{{number_format($subtotal,0,'.','.')}} VND</td>
                    </tr>
                <?php
                    if($order_array['discount_code'] != 'Null'){
                        if($order_array['discount_category'] == 1){
                ?>
                            <tr>
                                <td colspan="4" class="border right">
                                    Mã giảm giá
                                </td>
                                <td class="border right">
                                    {{$order_array['discount_be']}}%&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                            </tr>
                    <?php }elseif($order_array['discount_category'] == 2){ ?>
                            <tr>
                                <td colspan="4" class="border right">
                                    Mã giảm giá
                                </td>
                                <td class="border right">
                                    - {{number_format($order_array['discount_be'],0,'.','.')}}
                                 VND</td>
                            </tr>

                    <?php }
                    }else{ ?>
                        <tr>
                            <td colspan="4" class="border right">
                                Mã giảm giá
                            </td>
                            <td class="border right">
                                0 VND
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" class="border right">
                            Phí vận chuyển
                        </td>
                        <td class="border right">{{number_format($order_array['delivery_fee'],0,'.','.')}} VND</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="border right">
                            <b>TỔNG TIỀN</b>
                        </td>
                        <?php
                        if($order_array['discount_code']!=Null){
                            if($order_array['discount_category'] == 1){
                                $total_discount = ($subtotal * $order_array['discount_be']) / 100;
                                $total_money = $subtotal - $total_discount + $order_array['delivery_fee'];
                            }elseif($order_array['discount_category'] == 2){
                                $total_money = ($subtotal+$order_array['delivery_fee']) - $order_array['discount_be'];
                            }
                        ?>
                            <td class="border right">{{number_format($total_money, 0, ',', '.')}} VND</td>
                        </tr>
                        <?php
                        }else{
                            $total_money = $subtotal+$order_array['delivery_fee'];
                        ?>
                            <td class="border right">{{number_format($total_money, 0, ',', '.')}} VND</td>
                        </tr>
                        <?php }?>

                    </tr>
            </tbody>
        </table>

    </div>
</body>
</html>
