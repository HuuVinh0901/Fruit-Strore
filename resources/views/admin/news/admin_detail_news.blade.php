@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-1">
                        <h4>Chi tiết bài viết</h4>
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
                        <div class="m-5">
                            @foreach ($detail_news as $key => $show_detail_news)
                                <h2>{!! $show_detail_news->news_title !!}</h2>
                                Danh mục {{$show_detail_news->category_news->category_news_name}}<br>
                                <img src="{{URL::to('public/upload/news/'.$show_detail_news->news_image)}}" height="" width="" alt="">
                                {!! $show_detail_news->news_summary !!}
                                {!! $show_detail_news->news_content !!}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
