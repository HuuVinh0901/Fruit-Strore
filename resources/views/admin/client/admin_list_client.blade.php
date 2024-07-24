@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-1">
                        <h4>Danh sách khách hàng</h4>
                    </div>
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
                                    <?php $n=1;?>
                                    <th class="text-center">STT</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($client as $key => $show_client) {{-- $list_category_product bên controller --}}
                                <tr>
                                    <td class="text-center"><?php echo $n++ ;?></td>
                                    <td>{{$show_client->client_name}}</td>
                                    <td>{{$show_client->client_email}}</td>
                                    <td class="text-center">{{$show_client->client_phone}}</td>
                                    <td>{{$show_client->client_address}}<br>
                                        {{$show_client->ward->ward_name}}<br>
                                        {{$show_client->district->district_name}}<br>
                                        Thành phố {{$show_client->province->province_name}}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{URL::to('admin_list_order_client/'.$show_client->client_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a onclick="return confirm('Bạn có chắc chắc xóa tài khoản này không?')"
                                           href="{{URL::to('admin_delete_client/'.$show_client->client_id)}}"
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
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th>Địa chỉ</th>
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
