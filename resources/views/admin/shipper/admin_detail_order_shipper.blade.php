<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Imported Fruit</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/images/logoo-web.png')}}">
    <link href={{ asset('public/backend/css/style.css') }} rel="stylesheet">
    <link href={{ asset('public/backend/vendor/datatables/css/jquery.dataTables.min.css') }} rel="stylesheet">
    <link href={{ asset('public/backend/icons/fontawesome/css/all.min.css') }} rel="stylesheet">
    <style>
        *{
            font-size: 13px;
        }
    </style>

</head>

<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">

        <!--nav-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="{{asset('public/backend/images/logoo.png')}}" alt="">
                <img class="logo-compact w-100" src="{{asset('public/backend/images/logoo-text.png')}}" alt="">
                <img class="brand-title" src="{{asset('public/backend/images/logoo-text.png')}}" alt="">
            </a>
        </div>
        <!-- end nav-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between row">
                        <ul class="navbar-nav header-left">
                        </ul>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <h6 class="mt-2">
                                        <i class="ti-user mr-2"></i>
                                        <?php
                                        if(Session::get('shipper_id')){
                                            $shipper_name = Session::get('shipper_name'); /* tudat = lấy admin_name bên kia */
                                            if ($shipper_name) {
                                                /* nếu tồn tại biến tự đặt */
                                                echo $shipper_name; /* in ra biến mình đặt */
                                            }
                                        }?>
                                    </h6>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Tài khoản </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Tin nhắn </span>
                                    </a>
                                    {{-- <a href="/admin_logout_admin" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Đăng xuất </span>
                                    </a> --}}
                                    <a href="{{URL::to('admin_logout_staff')}}" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Đăng xuất </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>





        {{-- NỘI DUNG ---------------------------------------------------------------------------------------------------------}}
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="navbar-nav col-6">
                        <h5 class="mt-2 mb-2" style="margin-left: 15px"><b>CHI TIẾT ĐƠN HÀNG</b></h5>
                    </div>
                    <div class="col-6 justify-content-end mt-sm-0 d-flex">
                        <a href="{{URL::to('admin_list_order_shipper')}}" class="btn btn-primary">
                            Danh sách đơn hàng
                        </a>
                    </div>
                    <p class="text-danger">
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo $message;
                                Session::put('message', null);
                            }
                            $shipper_id = session::get('shipper_id');
                            $subtotal = 0;
                        ?>
                    </p>

                    <div class="col-sm-10 p-md-0 mt-sm-0 d-flex mt-3">
                        <div style="margin-top: 4px">Trạng thái: &nbsp;</div>
                        <form>
                            @csrf
                            @if ($status_shipper->status_shipper_id == 2)
                                <b class="btn btn-light">Giao thành công</b>
                            @elseif($status_shipper->status_shipper_id == 3)
                                <b class="btn btn-light">Giao thất bại</b>
                            @else
                                @foreach ($order as $key => $show_order)
                                @endforeach
                                <select class="update_status_order_shipper btn btn-light">
                                    <option>Đang giao</option>
                                    <option id="{{$show_order->order_id}}" value="2">Giao thành công</option>
                                    <option id="{{$show_order->order_id}}" value="3">Giao thất bại</option>

                                </select>
                            @endif

                        </form>
                        <?php
                        $total = 0;
                        $subtotal = 0;
                        $n=1;
                        ?>
                    </div>

                    {{-- sản phẩm --}}
                    <div id="man" class="col">
                        <table id="datatable" class="mb-2">
                            <thead >
                                <tr>
                                    <th>Trái cây</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail_order as $key => $show_order_detail)
                                    <?php
                                    $total = ($show_order_detail->product_price * $show_order_detail->product_quantity);
                                    $subtotal += $total;
                                    ?>
                                    <tr>
                                        <td>&nbsp;
                                            {{ $show_order_detail->product_name }}<br>&nbsp;
                                            {{ $show_order_detail->product_packing }}
                                        </td>
                                        <td>&nbsp;&nbsp;{{ number_format($show_order_detail->product_price, 0, ',', '.') }}</td>
                                        <td>
                                            <input name="product_quantity" type="text" value="{{ $show_order_detail->product_quantity }}" style="border-color: #FFF; width: 30px">
                                            <input name="product_id" class="product_id" type="hidden" value="{{ $show_order_detail->product_id }}">
                                        </td>
                                        <td>&nbsp;&nbsp;&nbsp;{{ number_format(($show_order_detail->product_price * $show_order_detail->product_quantity), 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- người nhận --}}
                    <div class="card-body">
                        <h5><b>Người nhận</b></h5>
                        <table>
                            <tr>
                                <th>Họ tên:</th>
                                <td>{{ $info_order->info_order_name }}</td>
                            </tr>
                            <tr>
                                <th>Số điện thoại: &nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <td>{{ $info_order->info_order_phone }}</td>
                            </tr>
                            <tr>
                                <th style="vertical-align: top;">Địa chỉ:</th>
                                <td>
                                    {{$info_order->info_order_address}},
                                    {{$info_order->ward->ward_name}},<br>
                                    {{$info_order->district->district_name}},
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
                        </table>
                    </div>

                    {{-- chi phí --}}
                    <div class="card-body">
                        <h5><b>Chi phí</b></h5>
                        @foreach ($order as $key => $show_order)
                            <table>
                                <?php
                                    $fee = $show_order->delivery_fee;
                                ?>
                                <tr>
                                    <th>Ngày đặt:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <td class="float-right">{{ date_format($show_order->created_at,'H:i:s d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Thanh toán:</th>
                                    <td class="float-right">{{ $payment->payment_method }}</td>
                                </tr>
                                <tr>
                                    <th>Trái cây:</th>
                                    <td class="float-right"><?php echo number_format($subtotal,0,',','.')?> VND</td>
                                </tr>

                                <tr>
                                    @if($show_order->discount_code!='Null')
                                        @if($discount->discount_category == 1)
                                            <th>Mã giảm giá:</th>
                                            <td class="float-right">{{ $discount->discount_be }}%</td>
                                        @elseif($discount->discount_category == 2)
                                            <th>Mã giảm giá:</th>
                                            <td class="float-right">-{{ number_format($discount->discount_be,0,',','.') }} VND</td>
                                        @endif
                                    @endif
                                </tr>

                                <tr>
                                    <th>Phí giao hàng:</th>
                                    <td class="float-right">{{ number_format($fee, 0, ',', '.') }} VND</td>
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
                                            VND
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>


        {{-- FOOTER ----------------------------------------------------------------------------------------------------------------}}
        <div class="footer">
            <div class="copyright">
                <p>Copyright © 2023 thub1910152@student.ctu.edu.vn </p>
                <p>Luận văn tốt nghiệp Imported Fruit</p>
            </div>
        </div>
    </div>

    <!-- Required vendors -->
    <script src={{ asset('public/backend/vendor/global/global.min.js') }}></script>
    <script src={{ asset('public/backend/js/quixnav-init.js') }}></script>
    <script src={{ asset('public/backend/js/custom.min.js') }}></script>
    <!-- Datatable -->
    <script src={{ asset('public/backend/vendor/datatables/js/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('public/backend/js/plugins-init/datatables2.init.js') }}></script>

    <script type="text/javascript">
        $('.update_status_order_shipper').change(function(){
            var order_status_shipper = $(this).val();
            var order_id = $(this).children(":selected").attr("id");    //dựa vào order_id để update status
            var _token  = $('input[name="_token"]').val();              // kiểm tra trong bảo mật

            product_quantity = [] ; // mảng số lượng khách mua của từng sản phẩm
            $("input[name='product_quantity']").each(function(){
                product_quantity.push($(this).val());
            });
            product_id = [];
            $("input[name='product_id']").each(function(){
                product_id.push($(this).val());
            });
            $.ajax({
                url: "{{url('/admin_update_status_order_shipper')}}",
                method: 'POST',
                data:{
                    order_status_shipper:order_status_shipper,
                    order_id:order_id,
                    product_quantity:product_quantity,
                    product_id:product_id,
                    _token:_token},
                success:function(data){
                    alert('Cập nhật trạng thái đơn hàng thành công');
                    location.reload();
                }
            });
        })
    </script>

</body>

</html>
