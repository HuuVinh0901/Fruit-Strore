@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Chỉnh sửa giá gốc</h4>
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
                                @foreach ($edit_cost as $key => $show_cost)
                                    <form action="{{URL::to('admin_update_edit_cost/'.$show_cost->cost_id)}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <h6>Tên sản phẩm</h6>
                                                <input disabled class="form-control" value="{{$show_cost->product->product_name}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <h6>Giá bán</h6>
                                                <input disabled class="form-control" value="{{number_format($show_cost->product->product_price,0,'.','.')}}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Giá gốc</h6>
                                                <input type="text" name="buy_cost" class="form-control format_money" value="{{number_format($show_cost->cost_buy,0,'.','.')}}">
                                            </div>
                                        </div>
                                        <button type="submit" name="edit_cost" class="btn btn-primary">Chỉnh sửa giá gốc sản phẩm</button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
