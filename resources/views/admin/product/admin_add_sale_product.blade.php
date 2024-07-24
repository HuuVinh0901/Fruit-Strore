@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Thêm giá khuyến mãi</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_product') }}" class="btn btn-primary">
                        Danh sách sản phẩm
                    </a>
                </div>
                <p class="text-danger">
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo $message;
                            Session::put('message', null);
                        }
                    ?>
                </p>
            </div>

            <!-- row -->
            <div class="row">
                <div class="col-xl-6 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                @foreach ($sale_product as $key1 => $show_sale_product)
                                    <form action="{{URL::to('admin_add_submit_sale_product/'.$show_sale_product->product_id)}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                        {{ csrf_field() }}

                                        <div class="form-row">
                                            <div class="form-group col-md-12 col-lg-4">
                                                <h6>Sản phẩm</h6>
                                                <input disabled type="text" class="form-control" value="{{ $show_sale_product->product_name}} - {{$show_sale_product->product_packing}}">
                                            </div>
                                            <div class="form-group col-md-12 col-lg-4">
                                                <h6>Giá gốc</h6>
                                                <input disabled type="text" class="form-control format_money" value="{{ $show_sale_product->product_cost}}">
                                            </div>
                                            <div class="form-group col-md-12 col-lg-4">
                                                <h6>Giá bán</h6>
                                                <input disabled type="text" class="form-control format_money" value="{{ $show_sale_product->product_price}}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <h6>Giá khuyến mãi</h6>
                                                <input type="text" name="sale_product" class="form-control format_money">
                                            </div>
                                        </div>

                                        <button type="submit" name="add_sale" class="btn btn-primary">Thêm giá khuyến mãi</button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            {{-- <div class="row">
                <div class="col-xl-6 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                @foreach ($sale_product as $key1 => $show_sale_product)
                                    @foreach ($cost as $key2 => $show_cost)
                                        @if($key1==$key2)
                                        <form action="{{URL::to('admin_add_submit_sale_product/'.$show_sale_product->product_id)}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --
                                            {{ csrf_field() }}

                                            <div class="form-row">
                                                <div class="form-group col-md-12 col-lg-4">
                                                    <h6>Sản phẩm</h6>
                                                    <input disabled type="text" class="form-control" value="{{ $show_sale_product->product_name}} - {{$show_sale_product->product_packing}}">
                                                </div>
                                                <div class="form-group col-md-12 col-lg-4">
                                                    <h6>Giá gốc</h6>
                                                    <input disabled type="text" class="form-control format_money" value="{{ $show_cost->cost_buy}}">
                                                </div>
                                                <div class="form-group col-md-12 col-lg-4">
                                                    <h6>Giá bán</h6>
                                                    <input disabled type="text" class="form-control format_money" value="{{ $show_sale_product->product_price}}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <h6>Giá khuyến mãi</h6>
                                                    <input type="text" name="sale_product" class="form-control format_money">
                                                </div>
                                            </div>

                                            <button type="submit" name="add_sale" class="btn btn-primary">Thêm giá khuyến mãi</button>
                                        </form>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

@endsection
