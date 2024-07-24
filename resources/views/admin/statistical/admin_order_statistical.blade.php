@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Thống kê đơn hàng</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="row">
                                @csrf
                                <div class="col-md-3 mb-3">
                                    <span>Ngày bắt đầu</span>
                                    <input type="text" id="datepicker_from" class="btn border border-secondary form-control" style="text-align: start; color:black">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <span>Ngày kết thúc</span>
                                    <input type="text" id="datepicker_to" class="btn border border-secondary form-control" style="text-align: start; color:black">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <span>&nbsp;</span><br>
                                    <input type="button" id="submit_order_statistical" class="btn btn-success" value="Xem thống kê">
                                </div>
                                <div class="col-md-3 mb-3" style="text-align: end">
                                    <span class="float-left">Lọc theo</span><br>
                                    <select class="filter_order_statistical btn border border-secondary form-control" style="text-align: start; color:black">
                                        <option>---Chọn---</option>
                                        <option value="7_days_ago">7 ngày trước</option>
                                        <option value="last_month">Tháng trước</option>
                                        <option value="this_month">Tháng này</option>
                                        <option value="365_days_ago">365 ngày trước</option>
                                    </select>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="chart" style="height: 250px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
