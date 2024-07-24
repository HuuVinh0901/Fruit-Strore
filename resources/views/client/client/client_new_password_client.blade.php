@extends('client_layout')
@section('content')
    <section class="ftco-section contact-section bg-light">
        <div class="container">
            <div class="row block-9">
                <div class="col-md order-md-last d-flex">
                    <?php
                        $token = $_GET['token'];
                        $email = $_GET['email'];
                    ?>
                    <form action="{{URL::to('client_submit_new_password_client')}}" method="POST" class="bg-white p-5 contact-form">
                        {{ csrf_field() }}
                        <p class="text-danger mb-4">
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo $message;
                                    Session::put('message', null);
                                }
                            ?>
                        </b>
                        <h3>CẬP NHẬT MẬT KHẨU MỚI</h3>
                        <div class="form-group">
                            <input name="new_password_client" type="text" class="form-control" placeholder="Nhập mật khẩu mới của bạn">
                            <input type="hidden" name="email_client" class="form-control" value="{{$email}}">
                            <input type="hidden" name="token_client" class="form-control" value="{{$token}}">
                        </div>
                        <div class="form-group">
                            <button name="submit_new_password" type="submit" class="btn btn-primary py-3 px-5">Gửi email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
