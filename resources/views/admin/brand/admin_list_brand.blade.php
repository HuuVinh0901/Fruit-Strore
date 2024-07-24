@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Danh sách thương hiệu</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{URL::to('admin_add_brand')}}" class="btn btn-primary">
                        Thêm thương hiệu
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
                <div id="man" class="col">
                    <div class="card">
                        <table id="datatable">
                            <thead>
                                <tr>
                                    <th>Tên thương hiệu</th>
                                    <th>Địa chỉ</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th>Ngày thêm</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_brand as $key => $show_brand) {{-- $list_brand_product bên controller --}}
                                <tr>
                                    <td>{{$show_brand->brand_name}}</td>
                                    <td>{{$show_brand->brand_address}}</td>
                                    <td class="text-center">{{$show_brand->brand_phone}}</td>
                                    <td class="text-center">
                                        <?php
                                        if($show_brand->brand_status==0){
                                    ?>
                                            <a href="{{URL::to('admin_undisplay_brand/'.$show_brand->brand_id)}}">
                                                <i class="fa-regular fa-circle-down" style="font-size: 18px; color: red"></i>
                                            </a>
                                    <?php
                                        }
                                        else{
                                    ?>
                                            <a href="{{URL::to('admin_display_brand/'.$show_brand->brand_id)}}">
                                                <i class="fa-regular fa-circle-up" style="font-size: 18px; color: blue"></i>
                                            </a>
                                    <?php
                                        }
                                    ?>
                                    </td>
                                    <td>{{$show_brand->created_at}}</td>
                                    <td class="text-center">
                                        <a href="{{URL::to('admin_edit_brand/'.$show_brand->brand_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                        <a onclick="return confirm('Bạn có chắc chắc xóa thương hiệu này không?')" href="{{URL::to('admin_delete_brand/'.$show_brand->brand_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-x"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tên thương hiệu</th>
                                    <th>Địa chỉ</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th>Ngày thêm</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
