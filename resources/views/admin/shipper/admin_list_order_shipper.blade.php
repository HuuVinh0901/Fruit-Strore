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
                        <h5 class="mt-2 mb-2" style="margin-left: 15px"><b>DANH SÁCH ĐƠN HÀNG</b></h5>
                    </div>
                    {{-- <div class="col-6 justify-content-end mt-sm-0 d-flex">
                        Tổng thu:&nbsp; <b>?php echo number_format($money_total,'0','.','.');?></b>&nbsp;VND
                    </div> --}}
                    <p class="text-danger">
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo $message;
                                Session::put('message', null);
                            }
                            $shipper_id = session::get('shipper_id');
                        ?>
                    </p>
                    <div id="man" class="col">
                        <table id="datatable">
                            <thead>
                                <tr>
                                    <th>Mã vận đơn</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shipper_order as $key => $show_order)
                                    <tr>
                                        <td>&nbsp;&nbsp;{{$show_order->order_code}}</td>
                                        <td>&nbsp;&nbsp;
                                            @if($show_order->status_shipper_id == 2)
                                                <b class="text-primary">Giao thành công</b>
                                            @elseif($show_order->status_shipper_id == 3)
                                                <b class="text-danger">Giao thất bại</b>
                                            @else
                                                <b>Đang giao</b>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{URL::to('admin_detail_order_shipper/'.$show_order->order_code)}}" style="margin-left: 10px; color:black">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Mã vận đơn</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Chi tiết</th>
                                </tr>
                            </tfoot>
                        </table>
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

</body>

</html>
