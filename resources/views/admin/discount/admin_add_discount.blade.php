@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Thêm mã giảm giá</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_discount') }}" class="btn btn-primary">
                        Danh sách mã giảm giá
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
                                <form action="{{URL::to('admin_submit_add_discount')}}" method="POST"> {{-- gửi đến hàm --}}
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Mã giảm giá</h6>
                                            <input type="text" name="code_discount" class="form-control">
                                        </div>
                                        <div class="form-group col-md">
                                            <h6>Tên giảm giá</h6>
                                            <input type="text" name="name_discount" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Số lượng</h6>
                                            <input type="text" name="amount_discount" class="form-control">
                                        </div>
                                        <div class="form-group col-md">
                                            <h6>Tính năng</h6>
                                            <div class="form-group">
                                                <select class="form-control" name="category_discount">
                                                    <option value="0">Chọn</option>
                                                    <option value="1">Giảm theo phần trăm</option>
                                                    <option value="2">Giảm theo tiền</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Nhập số phần trăm hoặc tiền giảm</h6>
                                            <input type="text" name="be_discount" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Ngày bắt đầu</h6>
                                            <input type="text" name="start_discount" class="form-control" id="datepicker_start">
                                        </div>
                                        <div class="form-group col-md">
                                            <h6>Ngày kết thúc</h6>
                                            <input type="text" name="end_discount" class="form-control" id="datepicker_end">
                                        </div>
                                    </div>

                                    <button type="submit" name="add_discount" class="btn btn-primary">Thêm giảm giá</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
