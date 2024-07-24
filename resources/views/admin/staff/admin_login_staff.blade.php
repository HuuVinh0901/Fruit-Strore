<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin ImportedFruit</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/images/logoo-web.png')}}">
    <link href="./public/backend/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">ĐĂNG NHẬP</h4>
                                    <p class="text-center text-danger">
                                        <?php
                                        $message = Session::get('message');
                                        if($message){
                                            echo $message;
                                            Session::put('message', null);
                                        }
                                        ?>
                                    </p>
                                    <form action="{{URL::to('admin_submit_login_staff')}}" method="POST">
                                        {{-- trường này gửi bảo mật hơn --}}
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" name="staff_email" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Mật khẩu</strong></label>
                                            <input type="password" name="staff_password" class="form-control" value="">
                                        </div>
                                        {{-- <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div> --}}
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">ĐĂNG NHẬP</button>
                                        </div>
                                        {{-- <a href="{{URL::to('./login_facebook')}}">Facebook</a> --}}
                                    </form>
                                    <div class="new-account mt-3">
                                        <p><a style="color: #6EAA3F" href="{{URL::to('/admin_login_shipper')}}"><b>Đăng nhập </b></a>bằng tài khoản nhân viên giao hàng?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./public/backend/vendor/global/global.min.js"></script>
    <script src="./public/backend/js/quixnav-init.js"></script>
    <script src="./public/backend/js/custom.min.js"></script>

</body>

</html>
