@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text mt-1">
                        <h4>Thêm thư viện ảnh</h4>
                    </div>
                </div>
                <b class="text-danger">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo $message;
                        Session::put('message', null);
                    }
                    ?>
                </b>
            </div>

            <!-- row -->
            <div class="row">
                <div class="col-xl-6 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <input type="hidden" value="{{$id_product}}" class="id_product" name="id_product">
                                <form action="{{URL::to('admin_submit_add_gallery/'.$id_product)}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="col-12">
                                        <input type="file" id="file" class="mb-4" name="file[]" accept="img/*" multiple> {{-- accept cho chọn file ảnh multile cho chọn nhiều --}}
                                        <button type="submit" name="id_product" class="id_product btn btn-primary" value="{{$id_product}}" >
                                            Tải ảnh lên
                                        </button>
                                    </div>
                                    <span id="error_gallery"></span>
                                </form>
                                <form>
                                    {{ csrf_field() }}
                                    <div id="gallery_load"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
