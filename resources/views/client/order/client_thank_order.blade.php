@extends('client_layout')
@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12" style="font-size: 20px; margin-top: 50px">
                Bạn đã đặt hàng thành công!<br>
                Cảm ơn bạn đã đặt hàng bên ImportedFruit của chúng tôi!
            </div>
            <div class="col-md-12 mt-3" style="margin-bottom: 50px">
                <a href="{{ URL::to('client_list_product') }}"
                    name="dalete_all_cart" class="btn btn-primary mb-3"
                    style="font-size: 14px;  width: 140px; height: 45px; padding-top: 11px">
                    Xem trái cây
                </a>
                <?php $order_code = Session::get('order_code');?>
                <a href="{{ URL::to('client_detail_order/'.$order_code) }}" type="submit"
                    name="dalete_all_cart" class="btn btn-primary mb-3"
                    style="font-size: 14px;  width: 150px; height: 45px; padding-top: 11px">
                    Chi tiết đơn hàng
                </a>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section mb-5">
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
