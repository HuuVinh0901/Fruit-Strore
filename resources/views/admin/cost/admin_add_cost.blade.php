@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Thêm giá gốc</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_cost') }}" class="btn btn-primary">
                        Danh sách sản phẩm có giá gốc
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
                                <form action="{{URL::to('admin_submit_add_cost')}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <h6>Trái cây</h6>
                                            <div class="form-group">
                                                <select class="form-control" name="product">
                                                    <option>Chọn trái cây</option>
                                                    @foreach ($product as $key => $show_product)
                                                        <option value="{{$show_product->product_id}}">{{$show_product->product_name}} - {{$show_product->product_packing}} -> Bán ra: {{number_format($show_product->product_price,0,'.','.')}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <h6>Giá gốc</h6>
                                            <input type="text" name="buy_cost" class="form-control format_money">
                                        </div>
                                    </div>

                                    <button type="submit" name="add_product" class="btn btn-primary">Thêm giá gốc sản phẩm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
