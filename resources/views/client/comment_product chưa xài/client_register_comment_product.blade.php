@extends('client_layout')
@section('content')
    <div class="container contact-section">
        <div class="row block-9">
            <div class="col-md order-md-last d-flex">
                <form action="{{URL::to('client_submit_register_comment_product')}}" method="POST"
                    class="bg-white p-5 contact-form">
                    {{ csrf_field() }}
                    <h3>ĐĂNG KÝ</h3>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input name="name_client" type="text" class="form-control" placeholder="Tên">
                            @error('name_client')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <input name="email_client" type="text" class="form-control" placeholder="Email">
                            @error('email_client')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <input name="phone_client" type="text" class="form-control" placeholder="Số điện thoại">
                            @error('phone_client')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <input name="password_client" type="password" class="form-control" placeholder="Mật khẩu">
                            @error('password_client')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <select class="form-control choose province" name="id_province" id="province">
                                <option value="" style="text-align: start">Thành phố</option>
                                    @foreach ($province as $key => $show_province)
                                        <option name="id_province"  value="{{$show_province->province_id}}">{{$show_province->province_name}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <select class="form-control choose district" name="id_district" id="district">
                                <option value="" style="text-align: start">Quận huyện</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <select class="form-control ward" name="id_ward" id="ward">
                                <option value="" style="text-align: start">Xã phường thị trấn</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <input name="address_client" type="text" class="form-control"  placeholder="Tên đường - số nhà - tòa nhà">
                        </div>
                    </div>


                    <div class="g-recaptcha" data-sitekey="6Lf2XvInAAAAAAaOTcwqm7VhPyDP0uxJ2EU5E2cr"></div>
                    <br/>
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="invalid-feedback" style="display:block">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif
                    <input type="submit" value="Đăng ký" class="btn btn-primary py-3 px-5">
                </form>
            </div>
        </div>
    </div>
@endsection

