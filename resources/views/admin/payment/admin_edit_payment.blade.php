@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Chỉnh sửa phương thức thanh toán</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_payment') }}" class="btn btn-primary">
                        Danh sách phương thức thanh toán
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
                                @foreach ($edit_payment as $key => $show_payment)
                                    <form action="{{URL::to('admin_update_edit_payment/'.$show_payment->payment_id)}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Tên phương thức</h6>
                                                <input type="text" name="method_payment" class="form-control" value="{{$show_payment->payment_method}}">
                                            </div>
                                        </div>
                                        <button type="submit" name="edit_payment" class="btn btn-primary">Chỉnh sửa phương thức</button>
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
