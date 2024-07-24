@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-9 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Cập nhật người giao hàng đơn này ở
                            {{$district_order->district->district_name}}
                        </h4>
                    </div>
                </div>
                <div class="col-sm-3 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_order') }}" class="btn btn-primary">
                        Danh sách đơn hàng
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
                                @foreach ($order_code as $key => $show_order_code)
                                    <form action="{{URL::to('admin_submit_shipper_detail_order/'.$show_order_code->order_code)}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <h6>Tên người giao hàng</h6>
                                                <div class="form-group">
                                                    <select class="form-control" name="shipper_order">
                                                        <option>Chọn người giao hàng</option>
                                                        @foreach ($shipper as $key => $show_shipper)
                                                            <option value="{{$show_shipper->admin->admin_id}}">{{$show_shipper->admin->admin_name}} - {{$show_shipper->admin->admin_email}} - {{$show_shipper->admin->admin_phone}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" name="" class="btn btn-primary">Cập nhật</button>
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
