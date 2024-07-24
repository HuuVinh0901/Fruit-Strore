@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Chỉnh sửa sản phẩm</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_product') }}" class="btn btn-primary">
                        Danh sách sản phẩm
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
                                @foreach ($edit_product as $key => $show_product)
                                    <form action="{{URL::to('admin_update_edit_product/'.$show_product->product_id)}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <h6>Tên sản phẩm</h6>
                                                <input type="text" name="name_product" class="form-control" value="{{$show_product->product_name}}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <h6>Hình ảnh</h6>
                                                <input type="file" name="image_product"><br>
                                                <img src="{{URL::to('public/upload/product/'.$show_product->product_image)}}" height="50" width="50" alt="">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <h6>Danh mục sản phẩm</h6>
                                                <div class="form-group">
                                                    <select class="form-control" name="category_product">
                                                       @foreach ($category_product as $key => $show_category_product)
                                                            @if ($show_category_product->category_product_id == $show_product->category_product_id)
                                                                <option selected value="{{$show_category_product->category_product_id}}">{{$show_category_product->category_product_name}}</option>
                                                            @else
                                                                <option value="{{$show_category_product->category_product_id}}">{{$show_category_product->category_product_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <h6>Xuất xứ</h6>
                                                <div class="form-group">
                                                    <select class="form-control" name="origin">
                                                        @foreach ($origin as $key => $show_origin)
                                                            <option value="{{$show_origin->origin_id}}">{{$show_origin->origin_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <h6>Quy cách</h6>
                                                <input type="text" name="packing_product" class="form-control" value="{{$show_product->product_packing}}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Giá gốc</h6>
                                                <input type="text" name="cost_product" class="form-control format_money" value="{{$show_product->product_cost}}">
                                            </div>
                                            <div class="form-group col-md">
                                                <h6>Giá bán</h6>
                                                <input type="text" name="price_product" class="form-control format_money" value="{{$show_product->product_price}}">
                                            </div>
                                            <div class="form-group col-md">
                                                <h6>Số lượng</h6>
                                                <input type="text" name="amount_product" class="form-control" value="{{$show_product->product_amount}}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Mô tả ngắn</h6>
                                                <textarea id="ckeditor" name="summary_product">{{$show_product->product_summary}}</textarea> {{-- ckeditor lát gắn link script ở layout --}}
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Tag</h6>
                                                <input type="text" data-role="tagsinput" name="tag_product" class="form-control" value="{{$show_product->product_tag}}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <h6>Mô tả chi tiết</h6>
                                                <textarea id="ckeditor1" name="detail_product">{{$show_product->product_detail}}</textarea> {{-- ckeditor lát gắn link script ở layout --}}
                                            </div>
                                        </div>

                                        <button type="submit" name="edit_product" class="btn btn-primary">Chỉnh sửa sản phẩm</button>
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
