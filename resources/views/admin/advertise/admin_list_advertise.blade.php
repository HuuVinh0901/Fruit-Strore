@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Danh sách quảng cáo</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_add_advertise') }}" class="btn btn-primary">
                        Thêm quảng cáo
                    </a>
                </div>
                <p class="text-danger">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
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
                                    <th class="text-center">STT</th>
                                    <th>Tên</th>
                                    <th>Hình ảnh</th>
                                    <th>Mô tả</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th>Ngày thêm</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_advertise as $key => $show_advertise)
                                    <tr>
                                        <td class="text-center"><?php echo $n++;?></td>
                                        <td>
                                            {{ $show_advertise->advertise_name }}<br>
                                        </td>
                                        <td>
                                            <img src="public/upload/advertise/{{ $show_advertise->advertise_image }}" height="50" width="50" alt="">
                                        </td>

                                        <td>{!! $show_advertise->advertise_detail !!}</td>
                                        <td class="text-center">
                                            <?php
                                        if($show_advertise->advertise_status==0){
                                        ?>
                                            <a href="{{ URL::to('admin_undisplay_advertise/' . $show_advertise->advertise_id) }}">
                                                <i class="fa-regular fa-circle-down"
                                                    style="font-size: 18px; color: red"></i>
                                            </a>
                                            <?php
                                        }
                                        else{
                                        ?>
                                            <a href="{{ URL::to('admin_display_advertise/' . $show_advertise->advertise_id) }}">
                                                <i class="fa-regular fa-circle-up" style="font-size: 18px; color: blue"></i>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                        </td>
                                        <td>{{ $show_advertise->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ URL::to('admin_edit_advertise/' . $show_advertise->advertise_id) }}"
                                                style="margin-left: 10px; color:black">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                            <a onclick="return confirm('Bạn có chắc chắc xóa quản cáo này không?')"
                                                href="{{ URL::to('admin_delete_advertise/' . $show_advertise->advertise_id) }}"
                                                style="margin-left: 10px; color:black">
                                                <i class="fa-solid fa-x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th>Tên</th>
                                    <th>Hình ảnh</th>
                                    <th>Mô tả</th>
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
