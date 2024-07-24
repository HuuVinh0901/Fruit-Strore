@extends('client_layout')
@section('content')
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate">
                    <form action="{{URL::to('client_submit_forget_client')}}" method="POST" class="p-5 contact-form">
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
                        <h3>QUÊN MẬT KHẨU</h3>
                        <div class="form-group">
                            <input name="email_client" type="email" class="form-control" style="font-size: 14px" placeholder="Nhập email của bạn để lấy lại mật khẩu">
                        </div>
                        <div class="form-group">
                            <button name="submit_forget" type="submit" class="btn btn-primary py-3 px-5">GỬI EMAIL</button>
                        </div>
                    </form>
                </div>
            </div>
@endsection
