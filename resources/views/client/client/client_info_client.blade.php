@extends('client_layout')
@section('content')
<div class="hero-wrap " style="background-image: url({{ URL::to('public/frontend/images/m7.png') }}); height: 350px">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate">
                <h1 class="mt-5 mb-4 bread text-center" style="color: #28a745; text-shadow: -1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff">THÔNG TIN CÁ NHÂN</h1>
                @foreach ($info_client as $show_client)
                    <div class="row" style="color: #000; ">
                        <div class="col-lg-2"></div>
                        <div class="col-lg">
                            <table>
                                <tr>
                                    <th>Họ và tên:</th>
                                    <th>&nbsp;&nbsp;&nbsp;{{$show_client->client_name}}</th>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <th>&nbsp;&nbsp;&nbsp;{{$show_client->client_email}}</th>
                                </tr>
                                <tr>
                                    <th>Số điện thoại:</th>
                                    <th>&nbsp;&nbsp;&nbsp;{{$show_client->client_phone}}</th>
                                </tr>
                                <tr>
                                    <th>Địa chỉ:</th>
                                    <th>&nbsp;&nbsp;
                                        {{$show_client->client_address}},
                                        {{$show_client->ward->ward_name}},
                                        {{$show_client->district->district_name}},
                                        {{$show_client->province->province_name}}
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 35px">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3">
                            <a href="{{URL::to('client_edit_client/'.$show_client->client_id)}}" class="btn btn-primary" style="font-size: 14px; width: 100%">Chỉnh sửa thông tin</a>
                        </div>

                        <div class="col-lg-3">
                            <a href="{{URL::to('client_forget_client')}}" class="btn btn-primary" style="font-size: 14px; width: 100%">Đổi mật khẩu</a>
                        </div>
                    </div>

                    {{-- <div class="row" style="margin-top: 35px">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3">
                            <a href="{{URL::to('client_edit_client/'.$show_client->client_id)}}" class="btn btn-primary" style="font-size: 14px; width: 100%">Chỉnh sửa thông tin</a>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{URL::to('client_history_order')}}" class="btn btn-primary" style="font-size: 14px; width: 100%">Lịch sử mua hàng</a>
                        </div>
                        <div class="col-lg-3"></div>
                    </div> --}}
                @endforeach
            </div>
        </div>
    </div>
</div>


<section class="ftco-section" style="margin-bottom: 20px">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-shipped"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Miễn phí vận chuyển</h3>
                        <span>Đơn hàng từ 300.0000</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-diet"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Luôn luôn tươi</h3>
                        <span>Cung cấp dinh dưỡng</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-award"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Chất lượng cao</h3>
                        <span>Nhập khẩu trực tiếp</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Hỗ trợ</h3>
                        <span>24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



