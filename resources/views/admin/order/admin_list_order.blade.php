@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Danh sách đơn hàng</h4>
                    </div>
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
                                    <th class="text-center">STT</th>
                                    <th>Mã vận đơn</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Ngày đặt</th>
                                    <th>Người giao</th>
                                    <th>Trạng thái giao</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $key => $show_order) {{-- $list_product bên controller --}}
                                <tr>
                                    <td class="text-center"><?php echo $n++;?></td>
                                    <td>&nbsp;&nbsp;{{$show_order->order_code}}</td>
                                    <td>&nbsp;&nbsp;&nbsp;{{$show_order->client->client_phone}}</td>
                                    <td>&nbsp;&nbsp;
                                        <b>
                                            @if($show_order->status_id == 2)
                                                <b style="color: purple">Đã được xác nhận</b>
                                            @elseif($show_order->status_id == 3)
                                                <b style="color: #0000CD">Đang giao hàng</b>
                                            @elseif($show_order->status_id == 4)
                                                <b style="color: #007700;">Giao hàng thành công</b>
                                            @elseif($show_order->status_id == 5)
                                                <b class="text-danger">Giao hàng thất bại</b>
                                            @elseif($show_order->status_id == 6)
                                                <b class="text-dark">Đơn hàng bị hủy</b>
                                            @else
                                            {{-- <a href="{{URL::to('admin_update_status_order/'.$show_order->order_code)}}">
                                                {{$show_order->status_name}}
                                            </a> --}}
                                            <b>
                                                {{$show_order->status->status_name}}
                                            </b>
                                            @endif
                                        </b>
                                    </td>
                                    <td class="text-center">{{date_format($show_order->created_at,'H:i:s d/m/Y')}}</td>
                                    <td>&nbsp;&nbsp;
                                        @if ($show_order->status_id==6)
                                            <b><a class="text-dark">
                                                Đã bị hủy
                                            </a></b>
                                        @elseif($show_order->status_id==5)
                                            <b><a class="text-danger">
                                                {{$show_order->admin->admin_name}}
                                            </a></b>
                                        @elseif($show_order->status_id==4)
                                            <b><a style="color: #007700;">
                                                {{$show_order->admin->admin_name}}
                                            </a></b>
                                        @else
                                            @if ($show_order->admin_id == NULL)
                                                <b><a href="{{URL::to('admin_shipper_order/'.$show_order->order_code)}}">
                                                    Chưa có
                                                </a></b>
                                            @else
                                                <b><a href="{{URL::to('admin_shipper_order/'.$show_order->order_code)}}" style="color: #0000CD">
                                                    {{$show_order->admin->admin_name}}
                                                </a></b>
                                            @endif
                                        @endif

                                    </td>
                                    <td>&nbsp;&nbsp;
                                        @if($show_order->status_shipper_id == 2)
                                            <b style="color: #007700;">Đã giao</b>
                                        @elseif($show_order->status_shipper_id == 3)
                                            <b class="text-danger">Giao thất bại</b>
                                        @else
                                            @if ($show_order->status_id==6)
                                                <b class="text-dark">Đã bị hủy</b>
                                            @else
                                                <b>Chưa giao</b>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{URL::to('admin_detail_order/'.$show_order->order_code)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a onclick="return confirm('Bạn có chắc chắc xóa đơn hàng này không?')" href="{{URL::to('admin_delete_order/'.$show_order->order_code)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-x"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th>Mã vận đơn</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Ngày đặt</th>
                                    <th>Người giao</th>
                                    <th>Trạng thái giao</th>
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
