@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Chỉnh sửa danh mục bài viết</h4>
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
                                @foreach ($edit_category_news as $key => $show_category_news)
                                    <form action="{{URL::to('admin_update_edit_category_news/'.$show_category_news->category_news_id)}}" method="POST"> {{-- gửi đến hàm --}}
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Tên danh mục</h6>
                                                <input type="text" name="name_category_news" class="form-control" value="{{$show_category_news->category_news_name}}">
                                            </div>
                                        </div>

                                        <button type="submit" name="edit_category_news" class="btn btn-primary">Chỉnh sửa danh mục</button>
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
