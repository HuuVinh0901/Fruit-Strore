@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Danh sách nhân viên</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_create_staff') }}" class="btn btn-primary">
                        Cấp tài khoản cho nhân viên
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
                            {{-- <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Admin</th>
                                    <th>Bán hàng</th>
                                    <th>Kho</th>
                                    <th>Giao hàng</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead> --}}
                            <tbody>
                                <?php $n=1?>
                                @foreach ($list_staff as $key => $show) {{-- $list_product bên controller --}}
                                    <form action="{{URL::to('admin_allow_role_staff')}}" method="POST">
                                        @csrf
                                        <tr>
                                            <td class="text-center"><?php echo $n++;?></td>
                                            <td>{{$show->admin_name}}</td>
                                            <td>
                                                {{$show->admin_email}}
                                                <input type="hidden" name="admin_email" value="{{$show->admin_email}}">
                                            </td>
                                            <td>{{$show->admin_phone}}</td>
                                            {{-- <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="checkbox" name="admin_role" {{$show->hasRole('admin') ? 'checked' : ''}}>
                                            </td> --}} {{--nếu có quyền bên model thì check--}}
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="checkbox" name="nvbh_role" {{$show->hasRole('Nhân viên bán hàng') ? 'checked' : ''}}>
                                            </td>
                                            {{-- <td>&nbsp;&nbsp;&nbsp;
                                                <input type="checkbox" name="nvk_role" {{$show->hasRole('Nhân viên kho') ? 'checked' : ''}}>
                                            </td> --}}
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="checkbox" name="nvgh_role" {{$show->hasRole('Nhân viên giao hàng') ? 'checked' : ''}}>
                                            </td>
                                            <td>
                                                <input type="submit" value="Hoàn tất" class="btn btn-success border border-success">
                                                <a href="{{URL::to('admin_delete_staff/'.$show->admin_id)}}" class="btn btn-success border border-success">
                                                    Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    {{-- <th>Admin</th> --}}
                                    <th>Bán hàng</th>
                                    {{-- <th>Kho</th> --}}
                                    <th>Giao hàng</th>
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
