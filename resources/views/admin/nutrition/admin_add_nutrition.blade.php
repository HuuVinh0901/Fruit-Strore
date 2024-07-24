@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Thêm dinh dưỡng</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_nutrition') }}" class="btn btn-primary">
                        Danh sách dinh dưỡng
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
                                <form action="{{URL::to('admin_submit_add_nutrition')}}" method="POST" enctype="multipart/form-data"> {{-- gửi đến hàm --}}
                                    {{ csrf_field() }}

                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Tiêu đề</h6>
                                            <input type="text" name="title_nutrition" class="form-control" minlength="3">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Nội dung</h6>
                                            <textarea id="ckeditor" name="detail_nutrition"></textarea> {{-- ckeditor lát gắn link script ở layout --}}
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <h6>Tag</h6>
                                            <input type="text" name="tag_nutrition" class="form-control">
                                        </div>
                                    </div>

                                    <button type="submit" name="add_nutrition" class="btn btn-primary">Thêm dinh dưỡng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
