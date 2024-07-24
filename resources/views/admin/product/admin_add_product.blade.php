@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Thêm sản phẩm</h4>
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
                                <form action="{{URL::to('admin_submit_add_product')}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                    {{ csrf_field() }}

                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <h6>Tên sản phẩm</h6>
                                            <input type="text" name="name_product" class="form-control" minlength="3">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <h6>Hình ảnh</h6>
                                            <input type="file" name="image_product">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <h6>Danh mục sản phẩm</h6>
                                            <div class="form-group">
                                                <select class="form-control" name="category_product">
                                                    @foreach ($category_product as $key => $show_category_product)
                                                        <option value="{{$show_category_product->category_product_id}}">{{$show_category_product->category_product_name}}</option>
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
                                            <input type="text" name="packing_product" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <h6>Giá gốc</h6>
                                            <input type="text" name="cost_product" class="form-control format_money">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <h6>Giá bán</h6>
                                            <input type="text" name="price_product" class="form-control format_money">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <h6>Số lượng</h6>
                                            <input type="text" name="amount_product" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Mô tả ngắn</h6>
                                            <textarea id="ckeditor" name="summary_product"></textarea> {{-- ckeditor lát gắn link script ở layout --}}
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Tag</h6>
                                            <input type="text" data-role="tagsinput" name="tag_product" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Mô tả chi tiết</h6>
                                            <textarea id="ckeditor1" name="detail_product"></textarea> {{-- ckeditor lát gắn link script ở layout --}}
                                        </div>
                                    </div>

                                    {{-- <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Trạng thái</h6>
                                            <div class="form-group">
                                                <select class="form-control" name="status_product">
                                                    <option value="0">Ẩn</option>
                                                    <option value="1">Hiện</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <button type="submit" name="add_product" class="btn btn-primary">Thêm sản phẩm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
