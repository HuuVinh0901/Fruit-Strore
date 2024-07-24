@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text mt-1">
                        <h4>Danh sách đơn hàng của {{$email_client->client->client_email}}
                        </h4>
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
                                    <?php $n=1; ?>
                                    <th>STT</th>
                                    <th>Mã vận đơn</th>
                                    <th>Người nhận</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $key => $show_order) {{-- $list_product bên controller --}}
                                <tr>
                                    <td><?php echo $n++;?></td>
                                    <td>{{$show_order->order_code}}</td>
                                    <td>{{$show_order->info_order->info_order_name}}</td>
                                    <td>{{$show_order->payment->payment_method}}</td>
                                    <td>{{$show_order->status->status_name}}</td>
                                    <td>{{date_format($show_order->created_at,'H:i:s d/m/Y')}}</td>
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
                                    <th>STT</th>
                                    <th>Mã vận đơn</th>
                                    <th>Người nhận</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
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
