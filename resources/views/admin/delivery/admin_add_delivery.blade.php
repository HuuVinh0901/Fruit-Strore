@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Quản lý phí vận chuyển</h4>
                    </div>
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
                                <form> {{-- gửi đến hàm --}}
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Thành phố</h6>
                                            <div class="form-group">
                                                <select class="form-control choose province" name="name_province" id="province">
                                                        <option value="">--Chọn thành phố--</option>
                                                    @foreach ($province as $key => $show_province)
                                                        <option value="{{$show_province->province_id}}">{{$show_province->province_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Quận - Huyện</h6>
                                            <div class="form-group">
                                                <select class="form-control choose district" name="name_district" id="district">
                                                        <option value="">--Chọn quận - huyện--</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Xã - Phường - Thị trấn</h6>
                                            <div class="form-group">
                                                <select class="form-control ward" name="name_ward" id="ward">
                                                        <option value="">--Chọn xã - phường - thị trấn--</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Phí vận chuyển</h6>
                                            <input type="text" name="transport_fee" class="form-control fee">
                                        </div>
                                    </div>
                                    <button type="button" name="add_delivery" class="btn btn-primary add_delivery">Thêm phí vận chuyển</button> {{-- //button kh refesh trang --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="load_delivery"></div>
        </div>
    </div>
@endsection
