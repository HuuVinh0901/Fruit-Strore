@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Chỉnh sửa quảng cáo</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_advertise') }}" class="btn btn-primary">
                        Danh sách quảng cáo
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
                                @foreach ($edit_advertise as $key => $show_advertise)
                                    <form action="{{URL::to('admin_update_edit_advertise/'.$show_advertise->advertise_id)}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Tên quảng cáo</h6>
                                                <input type="text" name="name_advertise" class="form-control" value="{{$show_advertise->advertise_name}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Hình ảnh</h6>
                                                <input type="file" name="image_advertise"><br>
                                                <img src="{{URL::to('public/upload/advertise/'.$show_advertise->advertise_image)}}" height="50" width="50" alt="">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Mô tả chi tiết</h6>
                                                <textarea id="ckeditor" name="detail_advertise">{{$show_advertise->advertise_detail}}</textarea> {{-- ckeditor lát gắn link script ở layout --}}
                                            </div>
                                        </div>

                                        <button type="submit" name="edit_advertise" class="btn btn-primary">Chỉnh sửa quảng cáo</button>
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
