{{-- @include('sweetalert::alert') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <title>{{$meta_title}}</title>

    <meta name="description" content="{{$meta_description}}">
    <meta name="keywords" content="{{$meta_keyword}}">
    <meta name="robots" content="INDEX,FOLLOW">
    <link rel="canonical" href="{{$link_canonical}}">
    <meta name="author" content="">
    <meta property="og:image" content="{{$image_og}}" >
    <meta property="og:site_name" content="thiatv.com" >
    <meta property="og:description" content="{{$meta_desc}}" >
    <meta property="og:title" content="{{$meta_title}}" >
    <meta property="og:url" content="{{$url_canonical}}" >
    <meta property="og:type" content="website" > --}}

    <base href="{{asset('/')}}"> {{-- không sai đường dẫn --}}

    {{-- <link rel="canonical" href="{{ $url_canonical }}"> --}}
    <meta property="og:site_name" content="http://importedfruit.com/imported_fruit/">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $url_canonical }}">

    <title>Imported Fruit</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/images/logoo-web.png')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href={{ asset('public/frontend/css/open-iconic-bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('public/frontend/css/animate.css') }}>

    <link rel="stylesheet" href={{ asset('public/frontend/css/owl.carousel.min.css') }}>
    {{-- <link rel="stylesheet" href={{ asset('public/frontend/css/owl.theme.default.min.css') }}>
    <link rel="stylesheet" href={{ asset('public/frontend/css/magnific-popup.css') }}> --}}

    {{-- <link rel="stylesheet" href={{ asset('public/frontend/css/aos.css') }}> --}}

    <link rel="stylesheet" href={{ asset('public/frontend/css/ionicons.min.css') }}>

    <link rel="stylesheet" href={{ asset('public/frontend/css/bootstrap-datepicker.css') }}>
    {{-- <link rel="stylesheet" href={{ asset('public/frontend/css/jquery.timepicker.css') }}> --}}


    <link rel="stylesheet" href={{ asset('public/frontend/css/flaticon.css') }}>
    <link rel="stylesheet" href={{ asset('public/frontend/css/icomoon.css') }}>
    <link rel="stylesheet" href={{ asset('public/frontend/css/sweetalert.css') }}>
    <link rel="stylesheet" href={{ asset('public/frontend/css/style.css') }}>


    <link rel="stylesheet" href={{ asset('public/frontend/css/lightgallery.min.css') }}>
    <link rel="stylesheet" href={{ asset('public/frontend/css/lightslider.css') }}>
    <link rel="stylesheet" href={{ asset('public/frontend/css/prettify.css') }}>


    <link rel="stylesheet" href={{ asset('public/frontend/css/jquery-ui.min.css') }}>



</head>

<body class="goto-here">

    <input type="hidden" value={{ URL::to('') }} id="url_nutrition">
    <div class="py-1 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-phone2"></span></div>
                            <span class="text">079 599 3732</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-paper-plane"></span></div>
                            <span class="text">thub1910152@student.ctu.edu.vn</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text">Trái cây tươi nhập khẩu chất lượng &amp; an toàn</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ URL::to('client_home_page') }}">IMPORTED FRUIT</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    {{-- trang chủ --}}
                    <li class="nav-item"><a href="{{ URL::to('client_home_page') }}" class="nav-link">Trang chủ</a>
                    </li>

                    {{-- sản phẩm --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Trái cây</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="{{ URL::to('client_list_product') }}">Tất cả<br></a>
                            @foreach ($category_product as $category_products)
                                <a class="dropdown-item" href="{{ URL::to('client_category_product/'.$category_products->category_product_id) }}">{{$category_products->category_product_name}}<br></a>
                            @endforeach
                            {{-- <a class="dropdown-item" href="{{ URL::to('client_list_product') }}">Trái cây</a>
                            <a class="dropdown-item" href="{{ URL::to('hi') }}">Wishlist</a>
                            <a class="dropdown-item" href="product-single.html">Single Product</a>
                            <a class="dropdown-item" href="{{ URL::to('client_list_ajax_cart') }}">Giỏ hàng</a>
                            ?php
                            $client_id = session()->get('client_id');
                            $delivery_fee = session()->get('fee_delivery');
                            if($client_id==NULL){?>
                            <a class="dropdown-item" href="{{ URL::to('client_login_checkout') }}">Thanh toán</a>
                            ?php
                            }elseif($client_id!=NULL && $delivery_fee==NULL){?>
                            <a class="dropdown-item" href="{{ URL::to('client_list_ajax_cart') }}">Thanh toán</a>
                            ?php
                            }elseif($client_id!=NULL && $delivery_fee!=NULL){?>
                            <a class="dropdown-item" href="{{ URL::to('client_checkout') }}">Thanh toán</a>
                            ?php }?> --}}
                        </div>
                    </li>

                    {{-- dinh dưỡng --}}
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">Dinh dưỡng</a>


                       <div class="dropdown-menu" aria-labelledby="dropdown04" id='list_nution'>
                        @foreach($nutritions as $nutrition)
                            <a class="dropdown-item" href="client_list_nutrition/{{  $nutrition->nutrition_tag }}"> {{$nutrition->nutrition_title}} </a>
                        @endforeach
                       </div>
                   </li> --}}

                   {{-- dinh dưỡng --}}
                   <li class="nav-item">
                        <a href="{{ URL::to('client_home_nutrition') }}" class="nav-link">Dinh dưỡng</a>
                    </li>

                    {{-- bài viết --}}
                    <li class="nav-item">
                        <a href="{{ URL::to('client_list_news') }}" class="nav-link">Bài viết</a>
                    </li>

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ URL::to('client_list_news') }}" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Bài viết</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            {{-- @foreach ($category_news as $key => $show_category_news)
                                <a class="dropdown-item" href="{{ URL::to(/client_list_news/'.$show_category_news->category_news_id) }}">{{$show_category_news->category_news_name}}</a>
                            @endforeach --}
                        </div>
                    </li> --}}

                    {{-- liên hệ --}}
                    {{-- <li class="nav-item"><a href="contact.html" class="nav-link">Liên hệ</a></li> --}}


                    <li class="nav-item "> {{-- cta cta-colored --}}
                        <a href="{{URL::to('client_list_ajax_cart')}}" class="nav-link">
                            <span class="icon-shopping_cart"></span><sup><b id="count_cart"></b></sup>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{URL::to('client_like_product')}}" class="nav-link">
                            <span class="ion-ios-heart"></span>
                        </a>
                    </li>

                    <?php
                    $client_id = session()->get('client_id');
                    if($client_id!=NULL){
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="icon-user"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="{{ URL::to('client_info_client/'.$client_id) }}">Thông tin</a>
                            <a class="dropdown-item" href="{{ URL::to('client_history_order') }}">Lịch sử mua hàng</a>
                            <a class="dropdown-item" href="{{ URL::to('client_logout_client') }}">Đăng xuất</a>
                        </div>
                    </li>
                    <?php
                    }else{
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="icon-user"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="{{ URL::to('client_login_client') }}">Đăng nhập</a>
                            <a class="dropdown-item" href="{{ URL::to('client_register_client') }}">Đăng ký</a>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    @yield('content')

    <footer class="ftco-footer ftco-section">
        <div class="container">
            <div class="row">
                <div class="mouse">
                    <a href="#" class="mouse-icon">
                        <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                    </a>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Imported Fruit</h2>
                        <p>Trái cây được nhập khẩu luôn tươi sạch nhập khẩu trực tiếp nên luôn đảm bảo độ tươi ngon và cung cấp đầy đủ chất dinh dưỡng cho mọi người.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Liên hệ</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">Số 17 đường 3/2
                                        Ninh Kiều Cần Thơ</span></li>
                                <br>
                                <li><span class="icon icon-phone"></span><span class="text">0795993732</span></li>
                                <br>
                                <li><span class="icon icon-envelope"></span><span
                                        class="text">thub1910152@student.ctu.edu.vn</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Chúng tôi</h2>
                        <div class="d-flex">
                            <ul class="">
                                <li><a href="#" class="py-2 d-block text-center">Miễn phí giao hàng đơn từ 300.000 VND</a></li>
                                <li><a href="#" class="py-2 d-block text-center">Hỗ trợ 24/7</a></li>
                                <li><a href="#" class="py-2 d-block text-center">Chất lượng và an toàn</a></li>
                            </ul>
                            {{-- <ul class="list-unstyled">
                                <li><a href="#" class="py-2 d-block">FAQs</a></li>
                                <li><a href="#" class="py-2 d-block">Contact</a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> thub1910152@student.ctu.edu.vn
                        {{-- <i
                            class="icon-heart color-danger" aria-hidden="true"></i>  --}}{{-- by <a href="https://colorlib.com"
                            target="_blank">Colorlib</a> --}}
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    {{-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div> --}}

    {{-- <script src={{ asset('public/frontend/js/captcha.js') }}></script> --}}
    <script src={{ asset('public/frontend/js/jquery.min.js') }}></script>
    <script src={{ asset('public/frontend/js/jquery-migrate-3.0.1.min.js') }}></script>
    <script src={{ asset('public/frontend/js/popper.min.js') }}></script>
    <script src={{ asset('public/frontend/js/bootstrap.min.js') }}></script>
    <script src={{ asset('public/frontend/js/jquery.easing.1.3.js') }}></script>
    <script src={{ asset('public/frontend/js/jquery.waypoints.min.js') }}></script>
    <script src={{ asset('public/frontend/js/jquery.stellar.min.js') }}></script>
    <script src={{ asset('public/frontend/js/jquery-ui.min.js') }}></script>
    <script src={{ asset('public/frontend/js/owl.carousel.min.js') }}></script>
    <script src={{ asset('public/frontend/js/jquery.magnific-popup.min.js') }}></script>
    <script src={{ asset('public/frontend/js/aos.js') }}></script>
    <script src={{ asset('public/frontend/js/jquery.animateNumber.min.js') }}></script>
    <script src={{ asset('public/frontend/js/bootstrap-datepicker.js') }}></script>
    <script src={{ asset('public/frontend/js/scrollax.min.js') }}></script>
    <script src={{ asset('public/frontend/js/main.js') }}></script>
    <script src={{ asset('public/frontend/js/simple.money.format.js') }}></script>

    <script src={{ asset('public/frontend/js/typeahead.bundle.min.js') }}></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

    <script src={{ asset('public/frontend/js/lightgallery-all.min.js') }}></script>
    <script src={{ asset('public/frontend/js/lightslider.js') }}></script>
    <script src={{ asset('public/frontend/js/prettify.js') }}></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0&appId=317889877565130&autoLogAppEvents=1"
        nonce="qAPvVEJh"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v17.0"
        nonce="mcxXoNb3"></script>
    {{-- <script src={{ asset('public/frontend/js/captcha.js') }}></script> --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    {{-- thêm vào giỏ hàng --}}
    <script type="text/javascript">
        $(document).ready(function() {
            //đếm số lượng
            count_cart();
            function count_cart(){
                $.ajax({
                    url: "{{ url('/client_count_cart') }}", //chọn địa chỉ
                    method: 'GET',
                    success: function(data){
                        $('#count_cart').html(data);
                    }
                })
            }

            //thêm vào giỏ hàng
            $('.add_cart').click(function() { //lớp bên button
                var id = $(this).data('id'); //id bên data-
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_packing = $('.cart_product_packing_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_amount = $('.cart_product_amount_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var _token = $('input[name="_token"]').val();
                if (parseInt(cart_product_quantity) > parseInt(cart_product_amount)) {
                    swal({
                        text: "Vui lòng đặt hàng ít hơn " + cart_product_amount,
                        icon: "error",
                        button: "Đã hiểu",
                    })
                } else {
                    $.ajax({
                        url: "{{ url('/client_add_ajax_cart') }}",
                        method: 'POST',
                        data: {
                            cart_product_id: cart_product_id,
                            cart_product_name: cart_product_name,
                            cart_product_image: cart_product_image,
                            cart_product_packing: cart_product_packing,
                            cart_product_price: cart_product_price,
                            cart_product_amount: cart_product_amount,
                            cart_product_quantity: cart_product_quantity,
                            _token: _token
                        },
                        success: function(data) {
                            swal({
                                title: "Đã thêm vào giỏ hàng",
                                text: "Vui lòng nhấn tiếp tục để xem thêm sản phẩm",
                                icon: "success",
                                button: "Tiếp tục",
                            })
                            count_cart();
                        }
                    })
                }
            })
        });
    </script>


    {{-- thêm vào yêu thích --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.like_product').click(function() { //lớp bên button
                var id = $(this).data('id'); //id bên data-
                var like_product_id = $('.like_product_id_' + id).val();
                var like_product_name = $('.like_product_name_' + id).val();
                var like_product_image = $('.like_product_image_' + id).val();
                var like_product_packing = $('.like_product_packing_' + id).val();
                var like_product_price = $('.like_product_price_' + id).val();
                var like_product_amount = $('.like_product_amount_' + id).val();
                var like_product_quantity = $('.like_product_quantity_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/client_add_like_product') }}",
                    method: 'POST',
                    data: {
                        like_product_id: like_product_id,
                        like_product_name: like_product_name,
                        like_product_image: like_product_image,
                        like_product_packing: like_product_packing,
                        like_product_price: like_product_price,
                        like_product_amount: like_product_amount,
                        like_product_quantity: like_product_quantity,
                        _token: _token
                    },
                    success: function(data) {
                        swal({
                            title: "Đã thêm vào yêu thích",
                            text: "Vui lòng nhấn tiếp tục để xem thêm sản phẩm",
                            icon: "success",
                            button: "Tiếp tục",
                        })
                    }
                })
            })
        });
    </script>


    {{-- chon địa chỉ --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id'); //lấy thuộc tính id=tên
                var id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'province') {
                    result = 'district';
                } else {
                    result = 'ward';
                }
                $.ajax({
                    url: "{{ url('/client_select_delivery') }}", //chọn địa chỉ
                    method: 'POST',
                    data: {
                        action: action,
                        id: id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            })
        })
    </script>
    {{-- tính phí vận chuyển --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.fee_delivery').click(function() {
                var province_id = $('.province').val();
                var district_id = $('.district').val();
                var ward_id = $('.ward').val();
                var info_order_address = $('.info_order_address').val();
                var _token = $('input[name="_token"]').val();
                if (province_id == '' || district_id == '' || ward_id == '' || info_order_address == '') {
                    swal({
                        text: "Vui lòng chọn địa chỉ để tính phí vận chuyển",
                        icon: "error",
                        button: "Đã hiểu",
                    })
                } else {
                    $.ajax({
                        url: "{{ url('/client_submit_delivery') }}", //chọn địa chỉ
                        method: 'POST',
                        data: {
                            province_id: province_id,
                            district_id: district_id,
                            ward_id: ward_id,
                            info_order_address: info_order_address,
                            _token: _token
                        },
                        success: function(data) {
                            location.reload(); //reload lại ngay chỗ đó kh cần refesh
                        }
                    })
                }
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.submit_delivery').click(function() {
                swal({
                    text: "Vui lòng tính phí vận chuyển để thanh toán",
                    icon: "error",
                    button: "Đã hiểu",
                })
            })
        })
    </script>
    {{-- xác nhận thanh toán lớn hơn 300000 --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.submit_max_300000_checkout').click(function() { //lớp bên button
                var info_order_name = $('.info_order_name ').val();
                var info_order_email = $('.info_order_email ').val();
                var info_order_phone = $('.info_order_phone').val();
                var info_order_address = $('.info_order_address').val();
                var info_order_note = $('.info_order_note').val();

                var province = $('.province').val();
                var district = $('.district').val();
                var ward = $('.ward').val();

                var payment_id = $('.method_checkout').val();

                var delivery_fee = $('.delivery_fee').val();
                var discount_code = $('.discount_code').val();

                var order_total = $('.order_total').val();

                var _token = $('input[name="_token"]').val();

                if (info_order_name == '' || info_order_email == '' || info_order_phone == '' ||
                    info_order_address == '') {
                    swal({
                        text: "Vui lòng nhập đầy đủ thông tin nhận hàng",
                        icon: "error",
                        button: "Đã hiểu",
                    })
                }
                if (info_order_note == '') {
                    info_order_note = 'Không có';
                    $.ajax({
                        url: "{{ url('/client_submit_max_300000_checkout') }}",
                        method: 'POST',
                        data: {
                            info_order_name: info_order_name,
                            info_order_email: info_order_email,
                            info_order_phone: info_order_phone,
                            info_order_address: info_order_address,
                            info_order_note: info_order_note,
                            province: province,
                            district: district,
                            ward: ward,
                            payment_id: payment_id,
                            delivery_fee: delivery_fee,
                            discount_code: discount_code,
                            order_total: order_total,
                            _token: _token
                        },
                        success: function() {
                            window.location = "{{ URL('/client_thank_order') }}";
                        }
                    })
                } else {
                    $.ajax({
                        url: "{{ url('/client_submit_max_300000_checkout') }}",
                        method: 'POST',
                        data: {
                            info_order_name: info_order_name,
                            info_order_email: info_order_email,
                            info_order_phone: info_order_phone,
                            info_order_address: info_order_address,
                            info_order_note: info_order_note,
                            payment_id: payment_id,
                            province: province,
                            district: district,
                            ward: ward,
                            delivery_fee: delivery_fee,
                            discount_code: discount_code,
                            order_total: order_total,
                            _token: _token
                        },
                        success: function() {
                            window.location = "{{ URL('/client_thank_order') }}";
                        }
                        /* success:function(){
                            swal("Bạn đã đặt hàng thành công", {
                                buttons: ["Mua tiếp", "Đơn hàng"], //chưa dc mua tiếp
                            }).then(function() {
                                window.location = "{{ URL('/client_detail_order/{$order_code}') }}";
                            });
                        } */
                    })
                }
            })
        });
    </script>
    {{-- xác nhận thanh toán nhỏ hơn 300000 --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.submit_min_300000_checkout').click(function() { //lớp bên button
                var info_order_name = $('.info_order_name ').val();
                var info_order_email = $('.info_order_email ').val();
                var info_order_phone = $('.info_order_phone').val();
                var info_order_address = $('.info_order_address').val();
                var info_order_note = $('.info_order_note').val();
                var payment_id = $('.method_checkout').val();

                var delivery_fee = $('.delivery_fee').val();
                var discount_code = $('.discount_code').val();

                var order_total = $('.order_total').val();

                var _token = $('input[name="_token"]').val();

                if (info_order_name == '' || info_order_email == '' || info_order_phone == '' ||
                    info_order_address == '') {
                    swal({
                        text: "Vui lòng nhập đầy đủ thông tin nhận hàng",
                        icon: "error",
                        button: "Đã hiểu",
                    })
                }
                if (info_order_note == '') {
                    info_order_note = 'Không có';
                    $.ajax({
                        url: "{{ url('/client_submit_min_300000_checkout') }}",
                        method: 'POST',
                        data: {
                            info_order_name: info_order_name,
                            info_order_email: info_order_email,
                            info_order_phone: info_order_phone,
                            info_order_address: info_order_address,
                            info_order_note: info_order_note,
                            payment_id: payment_id,
                            delivery_fee: delivery_fee,
                            discount_code: discount_code,
                            order_total: order_total,
                            _token: _token
                        },
                        success: function() {
                            window.location = "{{ URL('/client_thank_order') }}";
                        }
                    })
                } else {
                    $.ajax({
                        url: "{{ url('/client_submit_min_300000_checkout') }}",
                        method: 'POST',
                        data: {
                            info_order_name: info_order_name,
                            info_order_email: info_order_email,
                            info_order_phone: info_order_phone,
                            info_order_address: info_order_address,
                            info_order_note: info_order_note,
                            payment_id: payment_id,
                            delivery_fee: delivery_fee,
                            discount_code: discount_code,
                            order_total: order_total,
                            _token: _token
                        },
                        success: function() {
                            window.location = "{{ URL('/client_thank_order') }}";
                        }
                        /* success:function(){
                            swal("Bạn đã đặt hàng thành công", {
                                buttons: ["Mua tiếp", "Đơn hàng"], //chưa dc mua tiếp
                            }).then(function() {
                                window.location = "{{ URL('/client_detail_order/{$order_code}') }}";
                            });
                        } */
                    })
                }
            })
        });
    </script>
    {{-- ảnh chi tiết --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true, //nhiêu hình ảnh
                item: 1, //nhấp vào hiện 1 ảnh
                loop: true, //vòng lặp nhấp lên nhấp xuống
                thumbItem: 3, //bao nhiêu ảnh nhỏ
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
    {{-- xem ngay --}}
    <script type="text/javascript">
        $('.view_now').click(function() {
            var product_id = $(this).data('id_product'); //data- bên nút đó
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/client_view_now_product') }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    $('#product_viewnow_id').html(data.product_id);
                    $('#product_viewnow_name').html(data.product_name);
                    $('#product_viewnow_amount').html(data.product_amount);
                    $('#product_viewnow_sold').html(data.product_sold);
                    $('#product_viewnow_packing').html(data.product_packing);
                    $('#product_viewnow_price').html(data.product_price);
                    $('#product_viewnow_image').html(data.product_image);
                    $('#product_viewnow_summary').html(data.product_summary);
                    $('#product_viewnow_detail').html(data.product_detail);
                    $('#product_viewnow_value').html(data.product_value);
                    $('#product_viewnow_button_add').html(data.product_button_add);
                    $('#product_viewnow_detail').html(data.product_detail);
                }
            })
        })
    </script>
    {{-- thêm vào giỏ từ viewnow --}}
    <script type="text/javascript">
        count_cart();
            function count_cart(){
                $.ajax({
                    url: "{{ url('/client_count_cart') }}", //chọn địa chỉ
                    method: 'GET',
                    success: function(data){
                        $('#count_cart').html(data);
                    }
                })
            }
        $(document).on('click', '.add_cart_view_now', function() {
            var id = $(this).data('id_product'); //id bên data-
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_packing = $('.cart_product_packing_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_amount = $('.cart_product_amount_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/client_add_ajax_cart') }}",
                method: 'POST',
                data: {
                    cart_product_id: cart_product_id,
                    cart_product_name: cart_product_name,
                    cart_product_image: cart_product_image,
                    cart_product_packing: cart_product_packing,
                    cart_product_price: cart_product_price,
                    cart_product_amount: cart_product_amount,
                    cart_product_quantity: cart_product_quantity,
                    _token: _token
                },
                beforeSend: function() {
                    $("#beforesend_viewnow").html('<p class="text-danger"><b>Đang thêm vào giỏ hàng</b></p>');
                },
                success: function() {
                    $("#beforesend_viewnow").html('<p class="text-danger"><b>Đã thêm vào giỏ hàng</b></p>');
                    count_cart();

                }
            })
        });
        $(document).on('click', '.redirect_list_cart', function() {
            window.location.href = "{{ URL('/client_list_ajax_cart') }}";
        });
    </script>
    {{-- viewnow qua chi tiết --}}
    <script type="text/javascript">
        $(document).on('click', '.detail_view_now', function() {
            var id = $(this).data('id_product'); //id bên data-
            window.location.href = "{{ URL('client_detail_product') }}/" + id;
        });
    </script>

    {{-- bình luận sản phẩm--}}
    <script type="text/javascript">
        $(document).ready(function() {
            load_comment_product();
            function load_comment_product() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/client_comment_product') }}", //chọn địa chỉ
                    method: "POST",
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#show_comment_product').html(data);
                    }
                })
            }
            $('.submit_comment_product').click(function() {
                var product_id = $('.comment_product_id').val();
                var comment_product_detail = $('.com_detail').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/client_submit_comment_product') }}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        comment_product_detail: comment_product_detail,
                        _token: _token
                    },
                    success: function(data) {
                        $('#message_comment_product').html('<p class="text-primary"><b>Thêm bình luận thành công</b></p>')
                        load_comment_product();
                        $('#message_comment_product').fadeOut(5000); //hiện thông báo 2s rồi mất
                        $('.com_detail').val('');
                    }
                })
            })
        })
    </script>

    {{-- bình luận bài viết --}}
    <script type="text/javascript">
        $(document).ready(function() {
            load_comment_news();
            function load_comment_news() {
                var news_id = $('.comment_news_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/client_comment_news') }}", //chọn địa chỉ
                    method: "POST",
                    data: {
                        news_id: news_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#show_comment_news').html(data);
                    }
                })
            }
            $('.submit_comment_news').click(function() {
                var news_id = $('.comment_news_id').val();
                var comment_news_detail = $('.com_detail').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/client_submit_comment_news') }}",
                    method: "POST",
                    data: {
                        news_id: news_id,
                        comment_news_detail: comment_news_detail,
                        _token: _token
                    },
                    success: function(data) {
                        $('#message_comment_news').html('<p class="text-primary"><b>Thêm bình luận thành công</b></p>')
                        load_comment_news();
                        $('#message_comment_news').fadeOut(5000); //hiện thông báo 2s rồi mất
                        $('.com_detail').val('');
                    }
                })
            })
        })
    </script>

    {{-- sắp xếp --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#client_sort_product').on('change',function() {
                var url = $(this).val();
                /* alert(url); */
                if(url){
                    window.location = url; //refresh với url
                }
                return false;
            })
        })
    </script>


    {{-- lọc giá --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $( "#slider-range" ).slider({
                orientation: "horizontal",
                range: true,

                min:{{$min_amount}},
                max:{{$max_amount}},

                values: [ {{$min_amount}}, {{$max_amount}} ],

                step: 1000, //kéo lên 10 đơn vị
                slide: function( event, ui ) {
                    $( "#amount_min" ).val(ui.values[ 0 ]).simpleMoneyFormat(); //kéo
                    $( "#amount_max" ).val(ui.values[ 1 ]).simpleMoneyFormat(); //kéo

                    $( "#min_amount" ).val(ui.values[ 0 ]);
                    $( "#max_amount" ).val(ui.values[ 1 ] );
                }
            });
            $( "#amount_min" ).val( $( "#slider-range" ).slider( "values", 0 )).simpleMoneyFormat(); //hiển thị chưa kéo
            $( "#amount_max" ).val( $( "#slider-range" ).slider( "values", 1 )).simpleMoneyFormat(); //hiển thị chưa kéo
        })
    </script>

    {{-- lọc trong origin --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $( "#slider-range-origin" ).slider({
                orientation: "horizontal",
                range: true,

                min:{{$min_amount_origin}},
                max:{{$max_amount_origin}},

                values: [ {{$min_amount_origin}}, {{$max_amount_origin}} ],

                step: 1000, //kéo lên 10 đơn vị
                slide: function( event, ui ) {
                    $( "#amount_min_origin" ).val(ui.values[ 0 ]).simpleMoneyFormat(); //kéo
                    $( "#amount_max_origin" ).val(ui.values[ 1 ]).simpleMoneyFormat(); //kéo

                    $( "#min_amount_origin" ).val(ui.values[ 0 ]);
                    $( "#max_amount_origin" ).val(ui.values[ 1 ] );
                }
            });
            $( "#amount_min_origin" ).val( $( "#slider-range-origin" ).slider( "values", 0 )).simpleMoneyFormat(); //hiển thị chưa kéo
            $( "#amount_max_origin" ).val( $( "#slider-range-origin" ).slider( "values", 1 )).simpleMoneyFormat(); //hiển thị chưa kéo
        })
    </script>

    {{-- lọc trong category --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $( "#slider-range-category" ).slider({
                orientation: "horizontal",
                range: true,

                min:{{$min_amount_category}},
                max:{{$max_amount_category}},

                values: [ {{$min_amount_category}}, {{$max_amount_category}} ],

                step: 1000, //kéo lên 10 đơn vị
                slide: function( event, ui ) {
                    $( "#amount_min_category" ).val(ui.values[ 0 ]).simpleMoneyFormat(); //kéo
                    $( "#amount_max_category" ).val(ui.values[ 1 ]).simpleMoneyFormat(); //kéo

                    $( "#min_amount_category" ).val(ui.values[ 0 ]);
                    $( "#max_amount_category" ).val(ui.values[ 1 ] );
                }
            });
            $( "#amount_min_category" ).val( $( "#slider-range-category" ).slider( "values", 0 )).simpleMoneyFormat(); //hiển thị chưa kéo
            $( "#amount_max_category" ).val( $( "#slider-range-category" ).slider( "values", 1 )).simpleMoneyFormat(); //hiển thị chưa kéo
        })
    </script>

    {{-- lọc trong category --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $( "#slider-range-tag" ).slider({
                orientation: "horizontal",
                range: true,

                min:{{$min_amount_tag}},
                max:{{$max_amount_tag}},

                values: [ {{$min_amount_tag}}, {{$max_amount_tag}} ],

                step: 1000, //kéo lên 10 đơn vị
                slide: function( event, ui ) {
                    $( "#amount_min_tag" ).val(ui.values[ 0 ]).simpleMoneyFormat(); //kéo
                    $( "#amount_max_tag" ).val(ui.values[ 1 ]).simpleMoneyFormat(); //kéo

                    $( "#min_amount_tag" ).val(ui.values[ 0 ]);
                    $( "#max_amount_tag" ).val(ui.values[ 1 ] );
                }
            });
            $( "#amount_min_tag" ).val( $( "#slider-range-tag" ).slider( "values", 0 )).simpleMoneyFormat(); //hiển thị chưa kéo
            $( "#amount_max_tag" ).val( $( "#slider-range-tag" ).slider( "values", 1 )).simpleMoneyFormat(); //hiển thị chưa kéo
        })
    </script>

    {{-- thanh toán sau khi nhận hàng --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.method_cod').click(function() { //lớp bên button
                /* var p = $('.method_checkout').val();
                alert(p) */
                swal({
                    title: "Thanh toán sau khi nhận hàng",
                    text: "Vui lòng nhấn tiếp tục để xem hoàn tất đặt hàng",
                    icon: "success",
                    button: "Tiếp tục",
                })
            }),
            $('.method_vnpay').click(function() { //lớp bên button
                /* var p = $('.method_checkout').val();
                alert(p) */
                swal({
                    title: "Thanh toán VNPay",
                    text: "Vui lòng nhấn tiếp tục để xem hoàn tất đặt hàng",
                    icon: "success",
                    button: "Tiếp tục",
                })
            })
        });
    </script>

    {{-- hủy đơn --}}
    <script type="text/javascript">
        /* $('.update_status_detail_order').change(function(){ */
            /* var order_id = $(this).children(":selected").attr("id"); */    //dựa vào order_id để update status
        $(".update_status_detail_order").click(function() {
            var order_status = 6;
            var order_id = $(this).attr("id");
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
                url: "{{url('/client_cancel_order')}}",
                method: 'POST',
                data:{
                    order_status:order_status,
                    order_id:order_id,
                    product_quantity:product_quantity,
                    product_id:product_id,
                    _token:_token},
                success:function(data){

                    swal({
                        title: "Bạn hủy đơn hàng thành công",
                        icon: "success",
                        button: "Tiếp tục",
                    })
                    setTimeout(() => {
                        location.reload();
                    }, 3000);

                }
            });
        })
    </script>

    {{-- tìm kiếm --}}
    <script type="text/javascript">
        $(document).ready(function($) {
            var engine1 = new Bloodhound({
                remote: {
                    url: '{{ URL::to('/search/product_name?value=%QUERY%') }}',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            var engine2 = new Bloodhound({
                remote: {
                    url: '{{ URL::to('/search/product_price?value=%QUERY%') }}',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            var engine3 = new Bloodhound({
                remote: {
                    url: '{{ URL::to('/search/category_product_name?value=%QUERY%') }}',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            var engine4 = new Bloodhound({
                remote: {
                    url: '{{ URL::to('/search/origin_name?value=%QUERY%') }}',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $(".search-input").typeahead({
                hint: true,
                highlight: true,
                minLength: 1 //nếu 0 thì chưa nhập đã show
            }, [{
                    source: engine1.ttAdapter(),
                    name: 'product-name',
                    display: function(data) {
                        return data.product_name;
                    },
                    templates: {
                        empty: [
                            '<div class="header-title bg-primary text-light pl-3">Trái cây</div><div class="list-group search-results-dropdown"><div class="list-group-item text-primary" style="width: 255px"><b>Không có kết quả phù hợp.&nbsp;&nbsp;&nbsp;</b></div></div>'
                        ],
                        header: [
                            '<div class="header-title bg-primary text-light pl-3">Trái cây</div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function(data) {
                            return '<a href="{{ URL::to('client_detail_product') }}/' + data.product_id + '" class="list-group-item" style="width: 255px">' + data.product_name + '</a>';
                        }
                    }
                },
                {
                    source: engine2.ttAdapter(),
                    name: 'product-price',
                    display: function(data) {
                        return data.product_price;
                    },
                    templates: {
                        empty: [
                            '<div class="header-title bg-primary text-light pl-3">Giá</div><div class="list-group search-results-dropdown"><div class="list-group-item text-primary" style="width: 255px"><b>Không có kết quả phù hợp.</b></div></div>'
                        ],
                        header: [
                            '<div class="header-title bg-primary text-light pl-3">Giá</div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function(data) {
                            return '<a href="{{ URL::to('client_price_product') }}/' + data.product_price + '" class="list-group-item" style="width: 255px">' + data.product_price +
                                '</a>';
                        }
                    }
                },
                {
                    source: engine3.ttAdapter(),
                    name: 'category-product-name',
                    display: function(data) {
                        return data.category_product_name;
                    },
                    templates: {
                        empty: [
                            '<div class="header-title bg-primary text-light pl-3">Danh mục</div><div class="list-group search-results-dropdown"><div class="list-group-item text-primary" style="width: 255px"><b>Không có kết quả phù hợp.</b></div></div>'
                        ],
                        header: [
                            '<div class="header-title bg-primary text-light pl-3">Danh mục</div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function(data) {
                            return '<a href="{{ URL::to('client_category_product') }}/' + data.category_product_id + '" class="list-group-item" style="width: 255px">' + data.category_product_name + '</a>';
                        }
                    }
                },
                {
                    source: engine4.ttAdapter(),
                    name: 'origin-name',
                    display: function(data) {
                        return data.origin_name;
                    },
                    templates: {
                        empty: [
                            '<div class="header-title bg-primary text-light pl-3">Xuất xứ</div><div class="list-group search-results-dropdown"><div class="list-group-item text-primary" style="width: 255px"><b>Không có kết quả phù hợp.</b></div></div>'
                        ],
                        header: [
                            '<div class="header-title bg-primary text-light pl-3">Xuất xứ</div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function(data) {
                            return '<a href="{{ URL::to('client_origin_product') }}/' + data.origin_id + '" class="list-group-item"  style="width: 255px">' + data.origin_name + '</a>';
                        }
                    }
                }
            ]);
        });
    </script>




    {{-- tìm kiếm DINH DƯỠNG--}}
    <script type="text/javascript">
        $(document).ready(function($) {
            var engine = new Bloodhound({
                remote: {
                    url: '{{ URL::to('/search/nutrition_tag?value=%QUERY%') }}',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });


            $(".search-nutrition").typeahead({
                hint: true,
                highlight: true,
                minLength: 1 //nếu 0 thì chưa nhập đã show
            }, [{
                    source: engine.ttAdapter(),
                    name: 'nutrition-tag',
                    display: function(data) {
                        return data.nutrition_tag;
                    },
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown"><div class="list-group-item text-primary" style="width: 350px"><b>Không có kết quả phù hợp.</b></div></div>'
                        ],
                        header: [
                            '<div class="header-title bg-primary text-light pl-3">Kết quả</div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function(data) {
                            return '<a href="{{ URL::to('client_list_nutrition') }}/' + data.nutrition_tag + '" class="list-group-item"  style="width: 350px">' + data.nutrition_tag + '</a>';
                        }
                    }
                }
            ]);
        });
    </script>

    {{-- <script type="text/javascript">
        $.ajax({
            url: "{{ url('/client_list_nutrition') }}",
            type: 'GET',
            dataTyle: 'json',
            success: function(response) {

                // Giả sử 'response' là dữ liệu bạn nhận được
                $('#list_nution').html(''); // Xóa nội dung hiện tại của div
                response.forEach(function(item) {

                    // Thêm dữ liệu vào div, 'item' là mỗi phần tử của dữ liệu nhận được
                    $('#list_nution').append('<a class="dropdown-item" href="client_list_nutrition/'+ item.nutrition_tag + '">' + item.nutrition_title +'</a>');
                });
            },
            error: function(xhr, status, error) {
                console.log(error);   // Xử lý lỗi
                $('#list_nution').html('<p>Error loading data</p>'); // Hiển thị thông báo lỗi
            }
        });
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "http://localhost/imported_fruit/client_list_product", true); // Replace with your URL

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response
                console.log(xhr.responseText);
            }
        };

        xhr.send();

    </script> --}}


</body>

</html>
