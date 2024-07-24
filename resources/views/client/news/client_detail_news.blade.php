@extends('client_layout')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ URL::to('public/frontend/images/bg333.png') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread" style="font-family: 'Times New Roman', Times, serif;">CHI TIẾT BÀI VIẾT</h1>
                </div>
            </div>
        </div>
    </div>
    @foreach ($detail_news as $key => $show_detail_news)
        <section class="ftco-section ftco-degree-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 ftco-animate">
                        <h2 class="mb-3">{!!$show_detail_news->news_title!!}</h2>
                        <div class="row">
                            <a href="#" class="col-10 mt-1">
                                <span class="icon-calendar"></span>
                                {{ date_format($show_detail_news->created_at,'H:i:s d/m/Y')}}
                            </a>
                            <div style="text-align: end" class="fb-share-button col-2" data-href="http://importedfruit.com/imported_fruit/client_detail_news/{{$show_detail_news->news_id}}" data-layout="" data-size="">
                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                                    Chia sẻ
                                </a>
                            </div>
                        </div>
                        <p>{!!$show_detail_news->news_summary!!}</p>
                        <p style="display: flex; justify-content: center">
                            <img src="{{URL::to('public/upload/news/'.$show_detail_news->news_image)}}" alt="" class="img-fluid">
                        </p>

                        <p>{!!$show_detail_news->news_content!!}</p>


                        {{-- BÌNH LUẬN --}}
                        <div class="pt-5 mt-5 mb-5">
                           {{--  <h3 class="mb-5">6 Comments</h3> --}}
                            {{-- <div class="fb-comments" data-href="http://importedfruit.com/imported_fruit/client_list_news" data-width="735" data-numposts="5"></div> bình luận fb --}}
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body p-4">
                                            {{-- <h4 class="text-center mb-4 pb-2">Nested comments section</h4> --}}
                                            <form>
                                                {{ csrf_field() }}
                                                <input type="hidden" class="comment_news_id" name="news_id" value="{{ $show_detail_news->news_id }}">
                                                <div id="show_comment_news"></div>
                                            </form>
                                            <div id="message_comment_news"></div>
                                            <?php
                                            $client_id = Session::get('client_id');
                                            if($client_id!=NULL){
                                            ?>
                                            <form>
                                                {{ csrf_field() }}
                                                <input type="hidden" class="comment_news_id" name="comment_news_id" value="{{ $show_detail_news->news_id }}">
                                                <div class="d-flex flex-start w-100">
                                                    <img class="rounded-circle shadow-1-strong mr-3"
                                                        src="{{URL::to('public/frontend/images/avatar.png')}}"
                                                        alt="avatar" width="50" height="50" />
                                                    <div class="form-outline w-100">
                                                        <label class="form-label" for="textAreaExample">Viết bình luận của bạn</label>
                                                        <textarea class="com_detail form-control" id="textAreaExample" rows="4" style="background: #fff; font-size: 14px"></textarea>
                                                    </div>
                                                </div>
                                                <div class="float-end mt-2 pt-1">
                                                    <input type="button" name="submit_comment_news"
                                                            class="submit_comment_news btn btn-primary" value="Bình luận"
                                                            style="font-size: 14px; width: 120px; height: 45px">
                                                    <input type="reset" name="" class=" btn btn-primary" value="Hủy"
                                                            style="font-size: 14px; width: 120px; height: 45px">
                                                </div>
                                            </form>
                                            <?php
                                            }else{
                                            ?>
                                                <div class="d-flex flex-start w-100">
                                                    <div class="form-outline w-100">
                                                        <b><a href="{{ URL::to('client_login_client') }}">
                                                            Đăng nhập
                                                        </a></b>
                                                        <label class="form-label" for="textAreaExample">và để lại bình luận</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-start w-100">
                                                    <div class="form-outline w-100">
                                                        <label class="form-label" for="textAreaExample">Bạn chưa có tài khoản ?</label>
                                                        <b><a href="{{ URL::to('client_register_client') }}">
                                                            Đăng ký
                                                        </a></b>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            <h5 style="font-size: 15px; background-color: #82AE46; color:#fff" class="card-header">Bài viết liên quan</h5>
                            <div class="sidebar-box ftco-animate">
                                @foreach ($related_news as $key => $show_news)
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
                                                {{-- <div><a href="#"><span class="icon-chat"></span> 19</a></div> --}}
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
    @endforeach
@endsection
