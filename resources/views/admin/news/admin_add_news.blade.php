@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Thêm bài viết</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_news') }}" class="btn btn-primary">
                        Danh sách bài viết
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
                                <form action="{{URL::to('admin_submit_add_news')}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Tiêu đề bài viết</h6>
                                            <textarea id="ckeditor" name="title_news"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Danh mục bài viết</h6>
                                            <div class="form-group">
                                                <select class="form-control" name="category_news">
                                                    @foreach ($category_news as $key => $show_category_news)
                                                        <option value="{{$show_category_news->category_news_id}}">{{$show_category_news->category_news_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Hình ảnh</h6>
                                            <input type="file" name="image_news">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Tóm tắt</h6>
                                            <textarea id="ckeditor1" name="summary_news"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Nội dung</h6>
                                            <textarea id="ckeditor2" name="content_news"></textarea> {{-- ckeditor lát gắn link script ở layout --}}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Trạng thái</h6>
                                            <div class="form-group">
                                                <select class="form-control" name="status_news">
                                                    <option value="0">Ẩn</option>
                                                    <option value="1">Hiện</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="add_news" class="btn btn-primary">Thêm bài viết</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
