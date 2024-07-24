@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Thêm thương hiệu</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_brand') }}" class="btn btn-primary">
                        Danh sách thương hiệu
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
                                <form action="{{URL::to('admin_submit_add_brand')}}" method="POST"> {{-- gửi đến hàm --}}
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Tên thương hiệu</h6>
                                            <input type="text" name="name_brand" class="form-control">
                                        </div>
                                    </div>
                                    <!-- row -->
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Địa chỉ thương hiệu</h6>
                                            <textarea class="form-control" style="resize: none" rows="6" name="address_brand"></textarea> {{-- ckeditor lát gắn link script ở layout --}}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Số điện thoại</h6>
                                            <input type="text" pattern="(\+84|0)\d{9,10}" name="phone_brand" class="form-control" title="Số điện thoại bạn nhập chưa đúng" >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Trạng thái</h6>
                                            <div class="form-group">
                                                <select class="form-control" name="status_brand">
                                                    <option value="0">Ẩn</option>
                                                    <option value="1">Hiện</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="add_brand" class="btn btn-primary">Thêm thương hiệu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
