@extends('client_layout')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ URL::to('public/frontend/images/bg333.png') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread" style="font-family: 'Times New Roman', Times, serif;">BÀI VIẾT</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <div class="row">
                        @foreach ($list_news as $key => $show_news)
                            <div class="col-md-12 d-flex ftco-animate">
                                <div class="blog-entry align-self-stretch d-md-flex">
                                    <a href="{{URL::to('client_detail_news/'.$show_news->news_id)}}" class="block-20"
                                        style="background-image: url('{{ URL::to("public/upload/news/".$show_news->news_image) }}')">
                                    </a>
                                    <div class="text d-block pl-md-4">
                                        <div class="row">
                                            <div class="col-10 meta mb-3" style="margin-top: 7px">
                                                <div><a href="{{URL::to('client_detail_news/'.$show_news->news_id)}}" class="meta-chat"><span class="icon-calendar"></span> {{$show_news->created_at}}</a></div>
                                                {{-- <div><a href="{{URL::to('client_detail_news/'.$show_news->news_id)}}">Admin</a></div> --}}
                                                {{-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div> --}}
                                            </div>
                                            <div class="col-2">
                                                <div class="fb-share-button" data-href="http://importedfruit.com/imported_fruit/client_list_news" data-layout="" data-size="">
                                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                                                        Chia sẻ
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h3 class="heading">
                                                <a href="{{URL::to('client_detail_news/'.$show_news->news_id)}}" style="text-decoration: none">
                                                    {!!$show_news->news_title!!}
                                                </a>
                                            </h3>
                                            <p><i>{!!$show_news->news_summary!!}</i></p>
                                            <p><a href="{{URL::to('client_detail_news/'.$show_news->news_id)}}" class="btn btn-primary py-1 px-2" style="font-size:12px">Xem thêm</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="fb-comments" data-href="http://importedfruit.com/imported_fruit/client_list_news" data-width="" data-numposts="5"></div> --}}

                    </div>
                </div> <!-- .col-md-8 -->


                <div class="col-lg-4 col-md-6 col-12 sidebar ftco-animate pl-5">
                    <div class="mb-4" style="border: 1px solid #f0f0f0;">
                        <h5 style="font-size: 15px; background-color: #82AE46; color:#fff" class="card-header">Danh mục sản phẩm</h5>
                        <div class="sidebar-box ftco-animate">
                            @foreach ($category_product as $key => $show_category_product)
                                <li><a
                                        href="{{ URL::to('client_category_product/' . $show_category_product->category_product_id) }}">{{ $show_category_product->category_product_name }}
                                        {{-- <span>(12)</span> --}}</a></li>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4" style="border: 1px solid #f0f0f0;">
                        <h5 style="font-size: 15px; background-color: #82AE46; color:#fff" class="card-header">Danh mục bài viết</h5>
                        <div class="sidebar-box ftco-animate">
                            @foreach ($category_news as $key => $show_category_news)
                                <li><a
                                        href="{{ URL::to('client_category_news/' . $show_category_news->category_news_id) }}">{{$show_category_news->category_news_name}}
                                    </a></li>
                            @endforeach
                        </div>
                    </div>

                    <div class="" style="border: 1px solid #f0f0f0;">
                        <h5 style="font-size: 15px; background-color: #82AE46; color:#fff" class="card-header">Bài viết gần đây</h5>
                        <div class="sidebar-box ftco-animate">
                            @foreach ($new_news as $key => $show_news)
                                <div class="block-21 d-flex">
                                    <a  href="{{URL::to('client_detail_news/'.$show_news->news_id)}}"
                                        class="blog-img mr-4" style="background-image: url('{{URL::to("public/upload/news/".$show_news->news_image)}}');"></a>
                                    <div class="text">
                                        <b>
                                            <a href="{{URL::to('client_detail_news/'.$show_news->news_id)}}">
                                                {!!$show_news->news_title!!}
                                            </a>
                                        </b>
                                        <div class="meta">
                                            <div><a href="#"><span class="icon-calendar"></span> {{$show_news->created_at}}</a></div>
                                            {{-- <div><a href="#"><span class="icon-person"></span> Admin</a></div> --}}
                                            <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
