@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Chỉnh sửa dinh dưỡng</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_nutrition') }}" class="btn btn-primary">
                        Danh sách dinh dưỡng
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
                                @foreach ($edit_nutrition as $key => $show_nutrition)
                                    <form action="{{URL::to('admin_update_edit_nutrition/'.$show_nutrition->nutrition_id)}}" method="POST"> {{-- gửi đến hàm --}}
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Tên dinh dưỡng</h6>
                                                <input type="text" name="title_nutrition" class="form-control" value="{{$show_nutrition->nutrition_title}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Nội dung</h6>
                                                <textarea id="ckeditor" name="detail_nutrition">{{$show_nutrition->nutrition_detail}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Tag</h6>
                                                <input type="text" name="tag_nutrition" class="form-control" value="{{$show_nutrition->nutrition_tag}}">
                                            </div>
                                        </div>
                                        <!-- row -->

                                        <button type="submit" name="edit_nutrition" class="btn btn-primary">Chỉnh sửa dinh dưỡng</button>
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
