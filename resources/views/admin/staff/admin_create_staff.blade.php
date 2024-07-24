@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Cấp tài khoản cho nhân viên</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_staff') }}" class="btn btn-primary">
                        Danh sách nhân viên
                    </a>
                </div>
                <p class="text-danger">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo $message;
                        Session::put('message', null);
                    }
                    ?>
                </p>
            </div>

            <!-- row -->
            <div class="row">
                <div id="man" class="col">
                    <div class="card">
                            <div class="row no-gutters">
                                <div class="col-xl-12">
                                    <div class="auth-form">
                                        <form action="{{ URL::to('admin_submit_create_staff') }}" method="POST">
                                            {{-- trường này gửi bảo mật hơn --}}
                                            {{ csrf_field() }}

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label><strong>Tên</strong></label>
                                                    <input type="text" name="staff_name" class="form-control" value="{{old('staff_name')}}"> {{-- value="{{old('staff_name')}}" báo lỗi cái khác như vẫn giữu cái vừa nhập lấy đúng name --}}
                                                    @error('staff_name')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label><strong>Email</strong></label>
                                                    <input type="email" name="staff_email" class="form-control" value="{{old('staff_email')}}">
                                                    @error('staff_email')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label><strong>Số điện thoại</strong></label>
                                                    <input type="text" name="staff_phone" class="form-control" value="{{old('staff_phone')}}">
                                                    @error('staff_phone')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label><strong>Mật khẩu</strong></label>
                                                    <input type="password" name="staff_password" class="form-control" value="{{old('staff_password')}}">
                                                    @error('staff_password')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- <div class="form-group">
                                                <label><strong>Nơi ở hiện tại</strong></label>
                                                <textarea type="text" name="staff_address" class="form-control" value=""></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label><strong class="mr-4">Quyền</strong></label>
                                                <select name="" id="" class="btn btn-light">
                                                    <option value="">----Chọn quyền----</option>
                                                </select>
                                            </div> --}}

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">Cấp tài khoản cho nhân viên</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
