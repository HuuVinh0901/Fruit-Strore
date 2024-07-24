@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-1">
                        <h4>Thông tin sản phẩm</h4>
                    </div>
                </div>
            </div>

            <!-- row -->
            <div class="row">
                <div id="man" class="col">
                    <div class="card">
                        <div class="m-5">
                            @foreach ($detail_product as $key => $show)
                                <h1>I. Mô tả ngắn</h1>
                                <div class="row ml-4">
                                    {!!$show->product_summary!!}
                                </div>

                                <h1>II. Tag</h1>
                                <div class="row ml-4 mb-2">
                                    {!!$show->product_tag!!}
                                </div>

                                <h1>III. Mô tả chi tiết</h1>
                                <div class="row ml-4">
                                    {!!$show->product_detail!!}
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
