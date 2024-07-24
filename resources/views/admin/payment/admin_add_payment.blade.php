@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Thêm phương thức thanh toán</h4>
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
                                <form action="{{URL::to('admin_submit_add_payment')}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Tên phương thức thanh toán</h6>
                                            <input type="text" name="method_payment" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Trạng thái</h6>
                                            <div class="form-group">
                                                <select class="form-control" name="status_payment">
                                                    <option value="0">Ẩn</option>
                                                    <option value="1">Hiện</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" name="add_payment" class="btn btn-primary">Thêm phương thức</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
