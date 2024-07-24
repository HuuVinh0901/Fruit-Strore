@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Chỉnh sửa thương hiệu</h4>
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
                                @foreach ($edit_brand as $key => $show_brand)
                                    <form action="{{URL::to('admin_update_edit_brand/'.$show_brand->brand_id)}}" method="POST"> {{-- gửi đến hàm --}}
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Tên thương hiệu</h6>
                                                <input type="text" name="name_brand" class="form-control" value="{{$show_brand->brand_name}}">
                                            </div>
                                        </div>
                                        <!-- row -->
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Địa chỉ thương hiệu</h6>
                                                <textarea class="form-control" style="resize: none" rows="6" name="address_brand">{{$show_brand->brand_address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Số điện thoại thương hiệu</h6>
                                                <input type="text" pattern="(\+84|0)\d{9,10}" name="phone_brand" class="form-control" value="{{$show_brand->brand_phone}}">
                                            </div>
                                        </div>
                                        <button type="submit" name="edit_brand" class="btn btn-primary">Chỉnh sửa thương hiệu</button>
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
