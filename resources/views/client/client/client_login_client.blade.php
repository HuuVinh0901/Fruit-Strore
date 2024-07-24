@extends('client_layout')
@section('content')
        <div class="container contact-section">
            <div class="row block-9">
                <div class="col-md order-md-last d-flex">
                    <form action="{{ URL::to('client_submit_login_client') }}" method="POST"
                        class="bg-white p-5 contact-form">
                        {{ csrf_field() }}
                        <p class="text-danger mb-4">
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo $message;
                                Session::put('message', null);
                            }
                            ?>
                            </b>
                        <h3>ĐĂNG NHẬP</h3>
                        <div class="form-group">
                            <input name="email_client" type="email" class="form-control" placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <input name="password_client" type="password" class="form-control" placeholder="Nhập mật khẩu">
                        </div>
                        {{-- <div class="form-group">
                            <span>
                                <input type="checkbox" class=""> Ghi nhớ đăng nhập
                            </span>
                        </div> --}}

                        <div class="form-group">
                            <button name="submit_login" type="submit" class="btn btn-primary py-3 px-5">ĐĂNG NHẬP</button>
                        </div>

                        {{-- <div class="form-group">
                            <a href="{{URL::to('client_login_google_client')}}">
                                <img src="{{asset('public/frontend/images/google.png')}}" alt="Đăng nhập bằng Google" width="30px" class="mr-2">
                            </a>

                            <a href="{{URL::to('client_login_facebook_client')}}">
                                <img src="{{asset('public/frontend/images/facebook.png')}}" alt="Đăng nhập bằng Facebook" width="30px">
                            </a>
                        </div> --}}
                        <div class="form-group">
                            <b>
                                <a href="{{URL::to('/client_forget_client')}}">Quên mật khẩu</a>
                            </b>
                        </div>
                        <div class="form-group">
                            <span>Bạn chưa có tài khoản? </span>
                            <b><a href="{{ URL::to('client_register_client') }}">Đăng ký</a></b>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
