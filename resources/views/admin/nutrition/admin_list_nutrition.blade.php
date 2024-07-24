@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Danh sách dinh dưỡng</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{URL::to('admin_add_nutrition')}}" class="btn btn-primary">
                        Thêm dinh dưỡng
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
                                    <th>STT</th>
                                    <th>Tiêu đề dinh dưỡng</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n=1;?>
                                @foreach ($list_nutrition as $key => $show_nutrition) {{-- $list_category_product bên controller --}}
                                <tr>
                                    <td><?php echo $n++;?></td>
                                    <td>&nbsp;&nbsp;&nbsp;{{$show_nutrition->nutrition_title}}</td>
                                    <td class="text-center">
                                        <a href="{{URL::to('admin_detail_nutrition/'.$show_nutrition->nutrition_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a href="{{URL::to('admin_edit_nutrition/'.$show_nutrition->nutrition_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                        {{-- <a onclick="return confirm('Bạn có chắc chắc xóa dinh dưỡng này không?')" href="{{URL::to('admin_delete_nutrition/'.$show_nutrition->nutrition_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-x"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên dinh dưỡng</th>
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
