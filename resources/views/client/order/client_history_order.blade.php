@extends('client_layout')
@section('content')
<section class="ftco-section">
    <div class="container">
        <b><h3 class="text-primary">LỊCH SỬ ĐẶT HÀNG</h3></b>
        <div class="row" style="margin: 0 1px 0 1px">
            <table class="table">
                <?php $n=1;?>
                <thead class="thead-primary">
                    <th>STT</th>
                    <th>Mã vận đơn</th>
                    <th>Người nhận</th>
                    <th>Ngày đặt hàng</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái giao hàng</th>
                    <th>Chi tiết</th>
                </thead>

                @foreach ($history_order as $key => $show_history_order)
                <tbody>
                    <td>{{$n++}}</td>
                    <td>{{$show_history_order->order_code}}</td>
                    <td>{{$show_history_order->info_order->info_order_name}}</td>
                    <td>{{date_format($show_history_order->created_at,'H:i:s d/m/Y')}}</td>
                    <td>{{$show_history_order->payment->payment_method}}</td>
                    <td><b>{{$show_history_order->status->status_name}}</b></td>
                    <td><b><a href="{{URL::to('client_detail_order/'.$show_history_order->order_code)}}">Xem chi tiết</a></b></td>
                </tbody>
                @endforeach
            </table>
        </div>
    {{ $history_order->links('pagination::bootstrap-4') }}
    </div>
</section>


@endsection
