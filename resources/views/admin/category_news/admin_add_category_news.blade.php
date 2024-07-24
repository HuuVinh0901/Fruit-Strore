@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Thêm danh mục bài viết</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_category_news') }}" class="btn btn-primary">
                        Danh sách danh mục bài viết
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
                                <form action="{{URL::to('admin_submit_add_category_news')}}" method="POST"> {{-- gửi đến hàm --}}
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Tên danh mục</h6>
                                            <input type="text" name="name_category_news" class="form-control">
                                        </div>
                                    </div>
                                    <!-- row -->
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Trạng thái</h6>
                                            <div class="form-group">
                                                <select class="form-control" name="status_category_news">
                                                    <option value="0">Ẩn</option>
                                                    <option value="1">Hiện</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" name="add_category_news" class="btn btn-primary">Thêm danh mục</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
