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
    <link rel="stylesheet" href={{ asset('public/backend/vendor/owl-carousel/css/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('public/backend/vendor/owl-carousel/css/owl.theme.default.min.css') }}>
    <link href={{ asset('public/backend/vendor/jqvmap/css/jqvmap.min.css') }} rel="stylesheet">
    <link href={{ asset('public/backend/css/style.css') }} rel="stylesheet">
    <link href={{ asset('public/backend/vendor/summernote/summernote.css') }} rel="stylesheet">
    <link href={{ asset('public/backend/css/style.css') }} rel="stylesheet">
    <link href={{ asset('public/backend/vendor/datatables/css/jquery.dataTables.min.css') }} rel="stylesheet">
    <link href={{ asset('public/backend/icons/fontawesome/css/all.min.css') }} rel="stylesheet">
    <link href={{ asset('public/backend/css/bootstrap-tagsinput.css') }} rel="stylesheet">
    {{-- chọn ngày --}}
    <link href={{ asset('public/backend/css/jquery-ui.css') }} rel="stylesheet">
    {{-- biểu đồ --}}
    <link href={{ asset('public/backend/css/morris.css') }} rel="stylesheet">


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
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line bg-success"></span><span class="line bg-success"></span><span
                        class="line bg-success"></span>
                </div>
            </div>
        </div>
        <!-- end nav-->

        <!--header-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            {{-- <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Tìm kiếm"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div> --}}
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                {{-- <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a> --}}
                                {{-- <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as
                                                        unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div> --}}
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <h6 class="mt-2">
                                        <i class="ti-user mr-2"></i>
                                        <?php
                                        $name_admin = Auth::user()->admin_name;
                                            if ($name_admin) {
                                                echo $name_admin;
                                            }
                                        ?>
                                        {{-- ?php
                                        if(Session::get('admin_name')){
                                            $name_admin = Session::get('admin_name'); /* tudat = lấy admin_name bên kia */
                                            if ($name_admin) {
                                                /* nếu tồn tại biến tự đặt */
                                                echo $name_admin; /* in ra biến mình đặt */
                                            }
                                        }else{
                                            $name_admin = Auth::user()->admin_name;
                                            if ($name_admin) {
                                                echo $name_admin;
                                            }
                                        /* Auth::user() in hết tất cả các cột trong user */
                                        }
                                        ?> --}}
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
        <!--end eader-->

        <!--sidebar-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">


                    {{-- menu tổng quan --}}
                    <li class="nav-label first">Tổng quan</li>
                    {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ti-view-grid"></i><span class="nav-text">Thống kê</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('admin_revenue_statistical') }}">Doanh thu</a></li>
                            <li><a href="{{ URL::to('admin_order_statistical') }}">Đơn hàng</a></li>
                        </ul>
                    </li> --}}
                    <li><a href="{{URL::to('admin_revenue_statistical')}}" aria-expanded="false"><i
                        class="ti-view-grid"></i><span class="nav-text">Thống kê</span></a>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="ti-video-clapper"></i><span class="nav-text">Quảng cáo</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('admin_list_advertise') }}">Danh sách quảng cáo</a></li>
                            <li><a href="{{ URL::to('admin_add_advertise') }}">Thêm quảng cáo</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="ti-heart-broken"></i><span class="nav-text">Dinh dưỡng</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('admin_list_nutrition') }}">Danh sách dinh dưỡng</a></li>
                            <li><a href="{{ URL::to('admin_add_nutrition') }}">Thêm dinh dưỡng</a></li>
                        </ul>
                    </li>


                    {{-- menu sản phẩm --}}
                    <li class="nav-label">Về sản phẩm</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ti-shopping-cart"></i><span class="nav-text">Sản phẩm</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('admin_list_product') }}">Danh sách sản phẩm</a></li>
                            <li><a href="{{ URL::to('admin_add_product') }}">Thêm sản phẩm</a></li>
                            {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Quản lý giá gốc</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ URL::to('admin_list_cost') }}">Danh sách giá gốc</a></li>
                                    <li><a href="{{ URL::to('admin_add_cost') }}">Thêm giá gốc</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ti-bar-chart-alt"></i><span class="nav-text">Danh mục</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('admin_list_category_product') }}">Danh sách danh mục</a></li>
                            <li><a href="{{ URL::to('admin_add_category_product') }}">Thêm danh mục</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="ti-world"></i><span class="nav-text">Xuất xứ</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('admin_list_origin') }}">Danh sách xuất xứ</a></li>
                            <li><a href="{{ URL::to('admin_add_origin') }}">Thêm xuất xứ</a></li>
                        </ul>
                    </li>
                    {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ti-server"></i><span class="nav-text">Thương hiệu</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ URL::to('admin_list_brand') }}">Danh sách thương hiệu</a></li>
                            <li><a href="{{ URL::to('admin_add_brand') }}">Thêm thương hiệu</a></li>
                        </ul>
                    </li> --}}
                    <li><a href="{{URL::to('admin_list_comment_product')}}" aria-expanded="false"><i
                        class="ti-comments-smiley"></i><span class="nav-text">Bình luận</span></a>
                    </li>

                    <li class="nav-label">Về đơn hàng</li>
                    <li><a href="{{URL::to('admin_list_order')}}" aria-expanded="false"><i
                                class="ti-receipt"></i><span class="nav-text">Quản lý đơn hàng</span></a>
                    </li>


                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ti-money"></i><span class="nav-text">Phương thức thanh toán</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('admin_list_payment')}}">Danh sách phương thức</a></li>
                            <li><a href="{{URL::to('admin_add_payment')}}">Thêm phương thức</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ti-bolt-alt"></i><span class="nav-text">Giảm giá</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('admin_list_discount')}}">Mã giảm giá</a></li>
                            <li><a href="{{URL::to('admin_add_discount')}}">Thêm mã giảm giá</a></li>
                        </ul>
                    </li>

                    <li><a href="{{URL::to('admin_add_delivery')}}" aria-expanded="false"><i
                        class="ti-truck"></i><span class="nav-text">Quản lý phí vận chuyển</span></a>
                    </li>



                    {{-- menu tài khoản --}}
                    <li class="nav-label">Về tài khoản</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="ti-user"></i><span class="nav-text">Nhân viên</span>
                        </a>
                        <ul aria-expanded="false">
                            @hasrole('admin')   {{-- @hasrole(['admin','Nhân viên bán hàng']) --}}
                            <a href="{{URL::to('admin_list_staff')}}">Danh sách nhân viên</a>
                            <a href="{{URL::to('admin_create_staff')}}">Cấp tài khoản mới</a>
                            @endhasrole         {{-- @endrole --}}


                        </ul>
                    </li>

                    <li>
                        <a href="{{URL::to('admin_list_client')}}" aria-expanded="false">
                            <i class="ti-face-smile"></i><span class="nav-text">Khách hàng</span>
                        </a>
                    </li>



                    {{-- menu bài viết --}}
                    <li class="nav-label">Về bài viết</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ti-layers-alt"></i><span class="nav-text">Danh mục</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('admin_list_category_news')}}">Danh sách danh mục</a></li>
                            <li><a href="{{URL::to('admin_add_category_news')}}">Thêm danh mục</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ti-pencil-alt"></i><span class="nav-text">Bài viết</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{URL::to('admin_list_news')}}">Danh sách bài viết</a></li>
                            <li><a href="{{URL::to('admin_add_news')}}">Thêm bài viết</a></li>
                        </ul>
                    </li>
                    <li><a href="{{URL::to('admin_list_comment_news')}}" aria-expanded="false"><i
                        class="ti-comment-alt"></i><span class="nav-text">Bình luận</span></a>
                    </li>
                </ul>
            </div>
        </div>

        @yield('content')

        <div class="footer">
            <div class="copyright">
                <p>Copyright © 2023 thub1910152@student.ctu.edu.vn </p>
                <p>Luận văn tốt nghiệp Imported Fruit</p>
            </div>
        </div>
    </div>


    {{-- biểu đồ --}}
    <script src={{ asset('public/backend/js/jquery.min.js') }}></script>
    <script src={{ asset('public/backend/js/raphael-min.js') }}></script>
    <script src={{ asset('public/backend/js/morris.min.js') }}></script>


    <!-- Required vendors -->
    <script src={{ asset('public/backend/vendor/global/global.min.js') }}></script>
    <script src={{ asset('public/backend/js/quixnav-init.js') }}></script>
    <script src={{ asset('public/backend/js/custom.min.js') }}></script>


    {{-- jquery --}}
    <script src={{ asset('public/backend/jquery/jquery.validate.min.js') }}></script>
    <script src={{ asset('public/backend/jquery/code.jquery.com_jquery-3.7.1.min.js') }}></script>
    <script type="text/javascript">
        $.validate({

        });
    </script>

    <!-- Vectormap -->
    <script src={{ asset('public/backend/vendor/raphael/raphael.min.js') }}></script>
    <script src={{ asset('public/backend/vendor/morris/morris.min.js') }}></script>


    <script src={{ asset('public/backend/vendor/circle-progress/circle-progress.min.js') }}></script>
    <script src={{ asset('public/backend/vendor/chart.js/Chart.bundle.min.js') }}></script>

    <script src={{ asset('public/backend/vendor/gaugeJS/dist/gauge.min.js') }}></script>

    <!--  flot-chart js -->
    <script src={{ asset('public/backend/vendor/flot/jquery.flot.js') }}></script>
    <script src={{ asset('public/backend/vendor/flot/jquery.flot.resize.js') }}></script>

    <!-- Owl Carousel -->
    <script src={{ asset('public/backend/vendor/owl-carousel/js/owl.carousel.min.js') }}></script>

    <!-- Counter Up -->
    <script src={{ asset('public/backend/vendor/jqvmap/js/jquery.vmap.min.js') }}></script>
    <script src={{ asset('public/backend/vendor/jqvmap/js/jquery.vmap.usa.js') }}></script>
    <script src={{ asset('public/backend/vendor/jquery.counterup/jquery.counterup.min.js') }}></script>


    <script src={{ asset('public/backend/js/dashboard/dashboard-1.js') }}></script>

    <script src={{ asset('public/backend/js/simple.money.format.js') }}></script>

    <!-- Summernote -->
    <script src={{ asset('public/backend/vendor/summernote/js/summernote.min.js') }}></script>
    <!-- Summernote init -->
    <script src={{ asset('public/backend/js/plugins-init/summernote-init.js') }}></script>

    <!-- Datatable -->
    <script src={{ asset('public/backend/vendor/datatables/js/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('public/backend/js/plugins-init/datatables2.init.js') }}></script>

    <script src={{ asset('public/backend/js/bootstrap-tagsinput.js') }}></script>

    <script src={{ asset('public/backend/ckeditor/ckeditor.js') }}></script>

    {{-- ngày --}}
    <script src={{ asset('public/backend/js/jquery-ui.js') }}></script>

    <script>
        CKEDITOR.replace("ckeditor");
        CKEDITOR.replace("ckeditor1");
        CKEDITOR.replace("ckeditor2");
    </script>

    <script>
        $( ".format_money" ).simpleMoneyFormat();
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            fetch_delivery();
            function fetch_delivery(){
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin_list_delivery')}}",
                    method: 'POST',
                    data:{
                        _token:_token},
                    success:function(data){
                        $('#load_delivery').html(data);
                    }
                });
            }

            $('.add_delivery').click(function(){
                var province = $('.province').val();
                var district = $('.district').val();
                var ward = $('.ward').val();
                var fee = $('.fee').val();
                var _token  = $('input[name="_token"]').val();
                /* alert(province);
                alert(district);
                alert(ward);
                alert(fee); */
                $.ajax({
                    url: "{{url('/admin_submit_add_delivery')}}",
                    method: 'POST',
                    data:{
                        province:province,
                        district:district,
                        ward:ward,
                        fee:fee,
                        _token:_token},
                    success:function(data){
                        fetch_delivery();
                    }
                });
            });

            $(document).on('blur','.edit_fee_delivery',function(){  //blur nhấn chỗ nào cũng update
                var delivery_id = $(this).data('delivery_id');      //data_bên DelivertController
                var delivery_money = $(this).text();
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin_edit_delivery')}}",
                    method: 'POST',
                    data:{
                        delivery_id:delivery_id,
                        delivery_money:delivery_money,
                        _token:_token},
                    success:function(data){
                        fetch_delivery();
                    }
                });
            })

            $('.choose').on('change',function(){
                var action = $(this).attr('id');    //lấy thuộc tính id=tên
                var id = $(this).val();             //lấy id_province
                var _token  = $('input[name="_token"]').val();
                var result = '';
                if(action == 'province'){
                    result = 'district';
                }
                else{
                    result = 'ward';
                }
                $.ajax({
                    url: "{{url('/admin_select_delivery')}}",
                    method: 'POST',
                    data:{
                        action:action,
                        id:id,
                        _token:_token},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                });
            })
        })
    </script>

    <script type="text/javascript">
        $('.update_status_detail_order').change(function(){
            var order_status = $(this).val();
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
                url: "{{url('/admin_update_status_detail_order')}}",
                method: 'POST',
                data:{
                    order_status:order_status,
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

    <script type="text/javascript">
        $(document).ready(function(){
            admin_load_gallery();
            function admin_load_gallery(){
                var id_product = $('.id_product').val();
                var _token  = $('input[name="_token"]').val();              // kiểm tra trong bảo mật
                /* alert(id_product); */
                $.ajax({
                    url: "{{url('/admin_list_gallery')}}",
                    method: 'POST',
                    data:{
                        id_product:id_product,
                        _token:_token},
                    success:function(data){
                        $('#gallery_load').html(data);
                    }
                })
            }
            //kiểm lỗi
            $('#file').change(function(){
                var error = '';
                var files = $('#file')[0].files;
                if(files.length>3){
                    error+='<p>Bạn chọn tối đa 3 ảnh</p>'
                }else if(files.length==''){
                    error+='<p>Bạn chưa chọn ảnh</p>'
                }/* else if(files.size>2000000){
                    error+='<p>Kích thướt ảnh không lớn hươn 20B</p>'
                } */
                if(error==''){

                }else{
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger"><b>'+error+'</b></span>');
                    return false;
                }
            })
            //xóa
            $(document).on('click','.delete_gallery',function(){
                var gallery_id = $(this).data('gallery_id');
                var _token  = $('input[name="_token"]').val();              // kiểm tra trong bảo mật
                if(confirm('Bạn muốn xóa hình ảnh này không?')){
                    $.ajax({
                        url: "{{url('/admin_delete_gallery')}}",
                        method: 'POST',
                        data:{
                            gallery_id:gallery_id,
                            _token:_token},
                        success:function(data){
                            admin_load_gallery();
                            $('#error_gallery').html('<span class="text-danger"><b>Xóa ảnh thành công</b></span>');
                        }
                    })
                }
            })

        })
    </script>

    {{-- trả lời bình luận sản phẩm--}}
    <script type="text/javascript">
        $(document).on('blur','.reply_comment_product',function(){
            var comment_product_id = $(this).data('comment_product_id');
            var product_id = $(this).data('product_id');
            var comment_product_detail = $(this).text();
            $.ajax({
                url: "{{url('/admin_reply_comment_product')}}",
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    comment_product_id:comment_product_id,
                    product_id:product_id,
                    comment_product_detail:comment_product_detail},
                success:function(data){
                    $('#message_reply_comment').html('<b>Phản hồi bình luận thành công</b>');
                }
            })
        });
    </script>

    {{-- trả lời bình luận bài viết --}}
    <script type="text/javascript">
        $(document).on('blur','.reply_comment_news',function(){
            var comment_news_id = $(this).data('comment_news_id');
            var news_id = $(this).data('news_id');
            var comment_news_detail = $(this).text();
            $.ajax({
                url: "{{url('/admin_reply_comment_news')}}",
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    comment_news_id:comment_news_id,
                    news_id:news_id,
                    comment_news_detail:comment_news_detail},
                success:function(data){
                    $('#message_reply_comment').html('<b>Phản hồi bình luận thành công</b>');
                }
            })
        });
    </script>

    {{-- ngày jquery thống kê--}}
    <script type="text/javascript">
        $( function() {
            $( "#datepicker_from" ).datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"],
                monthNames: ["Tháng 1 năm", "Tháng 2 năm", "Tháng 3 năm", "Tháng 4 năm", "Tháng 5 năm", "Tháng 6 năm", "Tháng 7 năm", "Tháng 8 năm", "Tháng 9 năm", "Tháng 10 năm", "Tháng 11 năm", "Tháng 12 năm"],
                duration: "slow"
            });
            $( "#datepicker_to" ).datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"],
                monthNames: ["Tháng 1 năm", "Tháng 2 năm", "Tháng 3 năm", "Tháng 4 năm", "Tháng 5 năm", "Tháng 6 năm", "Tháng 7 năm", "Tháng 8 năm", "Tháng 9 năm", "Tháng 10 năm", "Tháng 11 năm", "Tháng 12 năm"],
                duration: "slow"
            });
        } );
    </script>

    {{-- thống kê --}}
    <script type="text/javascript">
        $(document).ready(function(){

            show_30days();

            /* biểu đồ */
            var chart = new Morris.Bar({ //.Bar cũng được
                element: 'chart',
                parseTime: false, //định dạng ngày
                hideHover:'auto',
                xkey: 'order_date',
                ykeys: ['price_sell','profit'],
                labels: ['Doanh thu','Lợi nhuận']
            });

            /* chọn ngày */
            $('#submit_order_statistical').click(function(){
                var from_date = $('#datepicker_from').val();
                var to_date = $('#datepicker_to').val();
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin_submit_order_statistical')}}",
                    method: "POST",
                    dataType: "JSON",
                    data:{
                        from_date:from_date,
                        to_date:to_date,
                        _token:_token},
                    success:function(data){
                        chart.setData(data); //data nguyên cái fuction
                    }
                })
            });

            /* Lọc  */
            $('.filter_order_statistical').change(function(){
                var value_filter = $(this).val();
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin_filter_order_statistical')}}",
                    method: "POST",
                    dataType: "JSON",
                    data:{
                        value_filter:value_filter,
                        _token:_token},
                    success:function(data){
                        chart.setData(data); //data nguyên cái fuction
                    }
                })
            })

            /* Hiển thị 30 ngày trước*/
            function show_30days(){
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin_show_30days_order_statistical')}}",
                    method: "POST",
                    dataType: "JSON",
                    data:{_token:_token},
                    success:function(data){
                        chart.setData(data); //data nguyên cái fuction
                    }
                })
            }
        });
    </script>

    {{-- lọc thống kê --}}
    <script type="text/javascript">
        $(document).ready(function(){
            show_all_revenue();
            $('.submit_revenue_statistical').on('change',function(){
                var value_filter = $(this).val();
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin_submit_revenue_statistical')}}",
                    method: "POST",
                    dataType: "JSON",
                    data:{
                        value_filter:value_filter,
                        _token:_token},
                    success:function(data){
                        location.reload();
                    }
                })
            })
            $('#submit_revenue_statistical').click(function(){
                var from_date = $('#datepicker_from').val();
                var to_date = $('#datepicker_to').val();
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin_submit_date_revenue_statistical')}}",
                    method: "POST",
                    dataType: "JSON",
                    data:{
                        from_date:from_date,
                        to_date:to_date,
                        _token:_token},
                    success:function(data){
                        location.reload(); //data nguyên cái fuction
                    }
                })
            });
            function show_all_revenue(){
                var _token  = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/admin_show_all_revenue_statistical')}}",
                    method: "POST",
                    dataType: "JSON",
                    data:{_token:_token},
                    success:function(data){
                        location.reload(); //data nguyên cái fuction
                    }
                })
            }
        })
    </script>

    {{-- ngày giảm giá --}}
    <script type="text/javascript">
        $( function() {
            $( "#datepicker_start" ).datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"],
                monthNames: ["Tháng 1 năm", "Tháng 2 năm", "Tháng 3 năm", "Tháng 4 năm", "Tháng 5 năm", "Tháng 6 năm", "Tháng 7 năm", "Tháng 8 năm", "Tháng 9 năm", "Tháng 10 năm", "Tháng 11 năm", "Tháng 12 năm"],
                duration: "slow"
            });
            $( "#datepicker_end" ).datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"],
                monthNames: ["Tháng 1 năm", "Tháng 2 năm", "Tháng 3 năm", "Tháng 4 năm", "Tháng 5 năm", "Tháng 6 năm", "Tháng 7 năm", "Tháng 8 năm", "Tháng 9 năm", "Tháng 10 năm", "Tháng 11 năm", "Tháng 12 năm"],
                duration: "slow"
            });
        } );
    </script>


    <script type="text/javascript">

        $(document).on('blur','.add_product_amount',function(){  //blur nhấn chỗ nào cũng update
            var product_id = $(this).data('product_id');      //data_bên DelivertController
            var product_amount = $(this).text();
            var _token  = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/admin_add_amount_product')}}",
                method: 'POST',
                data:{
                    product_id:product_id,
                    product_amount:product_amount,
                    _token:_token},
                success:function(data){
                    location.reload();
                }
            });
        })

    </script>
</body>

</html>
