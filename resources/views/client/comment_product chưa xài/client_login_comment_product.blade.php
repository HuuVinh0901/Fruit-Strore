@extends('client_layout')
@section('content')
    <section class="ftco-section contact-section bg-light">
        <div class="container">
            <div class="row block-9">
                <div class="col-md order-md-last d-flex">
                    <form action="{{URL::to('client_submit_login_comment_product')}}" method="POST" class="bg-white p-5 contact-form">
                        {{ csrf_field() }}
                        <h3>ĐĂNG NHẬP</h3>
                        <div class="form-group">
                            <input name="email_client" type="email" class="form-control" placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <input name="password_client" type="password" class="form-control" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="form-group">
                            <span>Nêu bạn chưa có tài khoản </span>
                            <b><a href="{{URL::to('client_register_comment_product')}}">Đăng ký</a></b>
                        </div>
                        <div class="form-group">
                            <button name="submit_login" type="submit" class="btn btn-primary py-3 px-5">ĐĂNG NHẬP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
