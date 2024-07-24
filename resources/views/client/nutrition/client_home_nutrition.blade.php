@extends('client_layout')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ URL::to('public/frontend/images/hh.png') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread" style="font-family: 'Times New Roman', Times, serif;">DINH DƯỠNG</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="position-ref full-height">
                        <div class="content">
                            <form class="typeahead search-form" role="search">
                                <div class="form-group">
                                    <input type="search" name="q" class="form-control search-nutrition" style="width: 350px; border: 1px solid #cccacb;"
                                        placeholder="&#9885;  Tìm kiếm theo bệnh hoặc dinh dưỡng..." autocomplete="off">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><br>


            <h2 class="col-md mb-3 text-center">DINH DƯỠNG VÀ LỢI ÍCH CỦA TRÁI CÂY ĐỐI VỚI SỨC KHỎE</h2>


            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <form>
                        <div style="text-align: center;">
                            <img src="{{asset('public/frontend/images/traicay.png')}}" alt="" style="width: 500px">
                        </div>
                        <div class="fruit">
                            <b>I. Nên ăn trái gì, vào lúc nào?</b>
                            <p style="margin-left: 20px; margin-right: 20px">
                                - Các nhà khoa học Mỹ đã tiến hành nghiên cứu và cho kết quả: Ăn trái cây một giờ trước bữa ăn có tác dụng giảm béo và giúp tiêu hóa có hiệu quả nhất. Trong trái cây có chứa chất đường, cơ thể dễ dàng hấp thu để bổ sung năng lượng, hơn nữa các chất xơ trong trái cây cơ thể không hấp thụ được giúp tạo cảm giác no, đó chính là bí quyết giảm béo khi dùng trái cây trước bữa ăn.
                                <br>
                                - Tương tự các nhà nghiên cứu Đài Loan (Trung Quốc) cũng có cùng kết luận với các đồng nghiệp ở Mỹ, lý do là nếu ăn cơm no rồi mới ăn trái cây thì lượng đường trong trái cây khỏng kịp hấp thụ vào hệ thống tiêu hóa, đường sẽ lên men trong dạ dày, sinh ra axít dễ dẫn tới đầy bụng, tháo dạ.
                                <br>
                                - Trái cây nào cũng tốt và bổ dưỡng, nên ăn loại trái cây nào là sự lựa chọn của mỗi người, tùy theo sở thích, thói quen ăn uổng và tùy theo tình trạng kinh tế của từng gia đình. Không cứ phải trái cây đắt tiền thì mới bổ dưỡng, Mỗi loại trái cây có vị và tính khác nhau nên nó cũng có công hiệu khác nhau. Các chuyên gia dinh dưỡng khuyên nên ăn 400g rau trái mỗi ngày, rau trái tươi là tốt nhất.
                            </p>
                            <b>II. Giá trị dinh dường của trái cây</b>
                            <p style="margin-left: 20px; margin-right: 20px">
                                - Trái cây cung cấp nhiều vitamin:
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;+ Vitamin A: cần cho mắt giúp ta nhìn rõ trong bóng tối, tốt cho da,... vô hiệu hóa khả năng xâm nhập của vi trùng và các chất ô nliiễm. Ngoài &nbsp;&nbsp;&nbsp;&nbsp;ra nhiều công trình y học đã chứng minh chất caroten, tiền sinh tố A có khả năng phòng ngừa một số loại ung thư. Caroten có rất nhiều ở trái &nbsp;&nbsp;&nbsp;&nbsp;có màu vàng như gấc, đu đủ, cam, dứa,...
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;+ Vitamin B: đóng vai trò quan trọng nhất trong việc tăng cường khả năng trí tuệ. Đặc biệt vitamin B9 (axit folic) giúp tránh được sự mệt mỏi &nbsp;&nbsp;&nbsp;&nbsp;trí tuệ, vitamin B1 giúp gia tăng sự tập trung, vitamin B12 giúp cho lứa tuổi thanh thiếu niên phát triển hài hòa đồng bộ tri thức.
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;+ Vitamin B6, vitamin B9 và vitamin B12 đóng vai trò then chốt trong quá trình tái sinh homocystein thành methionin để từ đó cơ thể sản sinh &nbsp;&nbsp;&nbsp;&nbsp;ra những protein mới. Nếu cơ thể thiếu 3 loại vitamin này, quá trình tái sinh sẽ không hiệu quả và nồng độ homoscystein sẽ tăng cao gây &nbsp;&nbsp;&nbsp;&nbsp;nguy cơ mắc các bệnh tim và chứng đột quỵ.
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;+ Vitamin C: Được xem là vitamin chống mệt mỏi, vitamin C có thành phần chống oxy hóa, nó tăng cường hệ miễn dịch, kích thích sự bài tiết &nbsp;&nbsp;&nbsp;&nbsp;và dự trữ chất sắt, thải ra ngoài các kim loại nặng gây sự mệt mỏi cho cơ thể, nó tạo sức năng động về thể chất và tinh thần, cần cho làm lành &nbsp;&nbsp;&nbsp;&nbsp;vết thương, chống nhiễm trùng. Vitamin C tham gia các quá trình tái sinh tế bào, sản xuất collagen cần thiết cho mạch máu, xương, răng,... &nbsp;&nbsp;&nbsp;&nbsp;tham gia tổng hợp chất keo, điều hòa sự chuyển hóa chất béo. Vitamin C có hầu hết trong các loại rau quả thông thường như rau cần tây, giá &nbsp;&nbsp;&nbsp;&nbsp;đỗ, cải xanh, cam, chanh, bưởi, ổi, cóc, sơri,....
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;+ Vitamin E: Là chất chống oxy hóa, bảo vệ nhiều chất biến hủy bởi oxy, kiềm chế sự tiêu hao đạm, chống xơ hóa chung và tốt đối với hệ thần &nbsp;&nbsp;&nbsp;&nbsp;kinh và cơ bắp, chống hiện tượng làm cục máu đông, phòng chống các bệnh tim mạch. Vitamin E có nhiều trong khoai lang, trái bơ, hạt hoa &nbsp;&nbsp;&nbsp;&nbsp;hướng dương.
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;+ Vitamin P: Hay còn gọi là vitamin R có tác dụng bảo vệ thành mao mạch, giảm độ xuyên thấm của chúng, vitamin P có tác dụng chống oxy &nbsp;&nbsp;&nbsp;&nbsp;hóa nên được xem là chất bảo thọ, có nhiều trong trà xanh, chanh, cam, quýt, bưởi.
                                <br>
                                - Trái cây chứa nhiều nước:
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;+ Nước chiếm từ 60% - 95% trong trái cây tùy loại, rất dồi dào và tươi mát mà lại là nước tinh khiết, không nhiễm trùng, vẩn đục. Nước từ lòng &nbsp;&nbsp;&nbsp;&nbsp;đất được hút lên, lọc sạch một cách tự nhiên, đặt vào trái để ta dùng mà không cần mất công đun sỏi, gạn lọc. Dùng nước này ta không còn &nbsp;&nbsp;&nbsp;&nbsp;sợ bị ô nhiễm của cát bụi, hóa chất,...
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;+ Chất xơ: trái cây chứa nhiều chất xơ, chất xơ là các polysacharides không tiêu hóa được khi ăn, bao gồm cellulose, pectin, linin,... Chất xơ &nbsp;&nbsp;&nbsp;&nbsp;một phần nhỏ được hấp thu vào máu, phần lớn chất xơ còn lại không được tiêu hóa sẽ thành phân và được đẩy ra khỏi cơ thể giúp ta không &nbsp;&nbsp;&nbsp;&nbsp;bị táo bón và những bệnh về đường ruột, nhất là ung thư ruột.
                                <br>
                            </p>
                            <div>
                                <p style="color: #28a745"><b>Sau đây là một số trái cây bán chạy tại ImportedFruit</b></p>
                                <div class="row">
                                    @foreach ($product_max as $show_product)
                                        {{-- <a href="{{url::to('client_detail_product/'.$product->product_id)}}" class="text_like_normal">{{$product->product_name}}</a><span>, </span> --}}
                                        <div class="col-md-4 col-lg-3 ftco-animate">
                                            <div class="product">
                                                <form>
                                                    {{ csrf_field() }}
                                                    <input type="hidden" value="{{ $show_product->product_id }}"
                                                        class="cart_product_id_{{ $show_product->product_id }}">
                                                    <input type="hidden" value="{{ $show_product->product_name }}"
                                                        class="cart_product_name_{{ $show_product->product_id }}">
                                                    <input type="hidden" value="{{ $show_product->product_image }}"
                                                        class="cart_product_image_{{ $show_product->product_id }}">
                                                    <input type="hidden" value="{{ $show_product->product_packing }}"
                                                        class="cart_product_packing_{{ $show_product->product_id }}">
                                                    @if ($show_product->product_sale == NULL)
                                                        <input type="hidden" value="{{$show_product->product_price}}"
                                                            class="cart_product_price_{{$show_product->product_id}}">
                                                    @else
                                                        <input type="hidden" value="{{$show_product->product_sale}}"
                                                            class="cart_product_price_{{$show_product->product_id}}">
                                                    @endif
                                                    <input type="hidden" value="{{ $show_product->product_amount }}"
                                                        class="cart_product_amount_{{ $show_product->product_id }}">
                                                    <input type="hidden" value="1"
                                                        class="cart_product_quantity_{{ $show_product->product_id }}">


                                                    {{-- thêm vào yêu thích --}}
                                                    <input type="hidden" value="{{ $show_product->product_id }}"
                                                        class="like_product_id_{{ $show_product->product_id }}">
                                                    <input type="hidden" value="{{ $show_product->product_name }}"
                                                        class="like_product_name_{{ $show_product->product_id }}">
                                                    <input type="hidden" value="{{ $show_product->product_image }}"
                                                        class="like_product_image_{{ $show_product->product_id }}">
                                                    <input type="hidden" value="{{ $show_product->product_packing }}"
                                                        class="like_product_packing_{{ $show_product->product_id }}">
                                                    @if ($show_product->product_sale == NULL)
                                                        <input type="hidden" value="{{$show_product->product_price}}"
                                                            class="like_product_price_{{$show_product->product_id}}">
                                                    @else
                                                        <input type="hidden" value="{{$show_product->product_sale}}"
                                                            class="like_product_price_{{$show_product->product_id}}">
                                                    @endif
                                                    <input type="hidden" value="{{ $show_product->product_amount }}"
                                                        class="like_product_amount_{{ $show_product->product_id }}">
                                                    <input type="hidden" value="1"
                                                        class="like_product_quantity_{{ $show_product->product_id }}">

                                                    <a href="{{ URL::to('client_detail_product/' . $show_product->product_id) }}"
                                                        class="img-prod"><img class="img-fluid"
                                                            src="{{ URL::to('public/upload/product/' . $show_product->product_image) }}"
                                                            alt="Colorlib Template">
                                                        @if ($show_product->product_sale == NULL)
                                                        @else
                                                            <span class="status">Khuyến mãi</span>
                                                        @endif
                                                    </a>

                                                    <div class="text py-3 pb-4 px-3 text-center">
                                                        <h3>
                                                            <a
                                                                href="{{ URL::to('client_detail_product/' . $show_product->product_id) }}">
                                                                {{ $show_product->product_name }}<br>
                                                                {{ $show_product->product_packing }}
                                                            </a>
                                                        </h3>
                                                        <div class="d-flex">
                                                            <div class="pricing">
                                                                @if ($show_product->product_sale == NULL)
                                                                    <p class="price">
                                                                        <span class="mr-2">
                                                                            {{ number_format($show_product->product_price, 0, '.', '.') }} VND
                                                                        </span>
                                                                    </p>
                                                                @else
                                                                    <p class="price">
                                                                        <span class="mr-2 price-dc">{{ number_format($show_product->product_price, 0, '.', '.') }} VND</span>
                                                                        <span class="price-sale">{{ number_format($show_product->product_sale, 0, '.', '.') }} VND</span>
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="bottom-area d-flex px-3">
                                                            <div class="m-auto d-flex">
                                                                @if (Session::get('client_id'))
                                                                <button class="view_now" type="button" name="view_now"
                                                                    data-id_product="{{ $show_product->product_id }}" data-toggle="modal"
                                                                    data-target="#viewnow"
                                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                                    <a class="buy-now d-flex justify-content-center align-items-center">
                                                                        <span><i class="ion-ios-menu"></i></span>
                                                                    </a>
                                                                </button>
                                                                <button class="add_cart" type="button" name="add_cart"
                                                                    data-id="{{ $show_product->product_id }}"
                                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                                    <a class="d-flex justify-content-center align-items-center">
                                                                        <span><i class="ion-ios-cart"></i></span>
                                                                    </a>
                                                                </button>

                                                                <button class="like_product" type="button" name="like_product"
                                                                    data-id="{{ $show_product->product_id }}"
                                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                                    <a class="heart d-flex justify-content-center align-items-center">
                                                                        <span><i class="ion-ios-heart"></i></span>
                                                                    </a>
                                                                </button>
                                                            @else
                                                                <button class="view_now" type="button" name="view_now"
                                                                    data-id_product="{{ $show_product->product_id }}" data-toggle="modal"
                                                                    data-target="#viewnow"
                                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                                    <a class="buy-now d-flex justify-content-center align-items-center">
                                                                        <span><i class="ion-ios-menu"></i></span>
                                                                    </a>
                                                                </button>
                                                                <button class="add_cart" type="button" name="add_cart"
                                                                    data-id="{{ $show_product->product_id }}"
                                                                    style="border: 0px solid rgba(0, 0, 0, 0); background-color: #fff">
                                                                    <a class="d-flex justify-content-center align-items-center">
                                                                        <span><i class="ion-ios-cart"></i></span>
                                                                    </a>
                                                                </button>
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <span style="margin-left: 12px;">
                                    {{ $product_max->links('pagination::bootstrap-4') }}
                                </span> --}}
                            </div>
                        </div>
                    </form>
                    <div class="modal fade" id="viewnow" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title product_viewnow_name" id="">
                                        <span id="product_viewnow_name"></span> - <span
                                            id="product_viewnow_packing"></span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body row">
                                    <style type="text/css">
                                        @media screen and (min-width: 992px) {

                                            /* ipad trở lên màn hình máy tính */
                                            .modal-lg {
                                                width: 950px;
                                            }
                                        }

                                        @media screen and (min-width: 992px) {

                                            /* điện thoại */
                                            .modal-dialog {
                                                width: 700px;
                                            }

                                            .modal-sm {
                                                width: 350px;
                                            }
                                        }

                                        /* span#product_viewnow_detail img{ hình ở thông tin sản phẩm co gián theo cột
                                                    width: 100px;
                                                } */
                                    </style>
                                    <div class="col-md-5">
                                        <span id="product_viewnow_image"></span>
                                    </div>
                                    <div class="col-md-7">
                                        <form>
                                            @csrf
                                            <div id="product_viewnow_value"></div>
                                            <div class="row">
                                                <p class="text-left mr-4">
                                                    <a class="mr-2 ml-3" style="color: #000;">
                                                        <span style="color: #bbb;">Còn lại</span>
                                                        <span id="product_viewnow_amount"></span>
                                                    </a>
                                                </p>
                                                <p class="text-left">
                                                    <a class="mr-2" style="color: #000;">
                                                        <span style="color: #bbb;">Đã bán</span>
                                                        <span id="product_viewnow_sold"></span>
                                                    </a>
                                                </p>
                                            </div>
                                            <p class="price">
                                                Giá: <b><span class="text-primary"
                                                        id="product_viewnow_price"></span></b>
                                            </p>
                                            <div class="w-50 d-flex mb-3 input-group"
                                                id="product_viewnow_button_add"></div>
                                            <div id="beforesend_viewnow"></div>
                                            <b>Thành phần dinh dưỡng: </b>
                                            <span id="product_viewnow_summary"></span>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-primary w-25">Chi tiết sản phẩm</button> --}}
                                    <span id="product_viewnow_detail"></span>
                                    <button type="button" class="btn btn-primary redirect_list_cart w-25 ">Đi tới giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
