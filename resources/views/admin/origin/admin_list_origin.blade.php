@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Danh sách xuất xứ</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{URL::to('admin_add_origin')}}" class="btn btn-primary">
                        Thêm xuất xứ
                    </a>
                </div>
                <p class="text-danger">
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo $message;
                            Session::put('message', null);
                        }
                        $n=1;
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
                                    <th>STT</th>
                                    <th>Tên xuất xứ</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_origin as $key => $show_origin) {{-- $list_category_product bên controller --}}
                                <tr>
                                    <td><?php echo $n++;?></td>
                                    <td>&nbsp;&nbsp;&nbsp;{{$show_origin->origin_name}}</td>
                                    <td class="text-center">
                                        <?php
                                        if($show_origin->origin_status==0){
                                    ?>
                                            <a href="{{URL::to('admin_undisplay_origin/'.$show_origin->origin_id)}}">
                                                <i class="fa-regular fa-circle-down" style="font-size: 18px; color: red"></i>
                                            </a>
                                    <?php
                                        }
                                        else{
                                    ?>
                                            <a href="{{URL::to('admin_display_origin/'.$show_origin->origin_id)}}">
                                                <i class="fa-regular fa-circle-up" style="font-size: 18px; color: blue"></i>
                                            </a>
                                    <?php
                                        }
                                    ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{URL::to('admin_edit_origin/'.$show_origin->origin_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                        {{-- <a onclick="return confirm('Bạn có chắc chắc xóa xuất xứ này không?')" href="{{URL::to('admin_delete_origin/'.$show_origin->origin_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-x"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên xuất xứ</th>
                                    <th class="text-center">Trạng thái</th>
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
