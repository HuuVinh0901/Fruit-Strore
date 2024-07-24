@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Chào bạn!</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card">
                                        <div class="stat-widget-one card-body">
                                            <div class="stat-icon d-inline-block">
                                                <i class="ti-user text-primary border-primary"></i>
                                            </div>
                                            <div class="stat-content d-inline-block">
                                                <div class="stat-text">Khách hàng</div>
                                                <div class="stat-digit">
                                                    <?php echo $client; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card">
                                        <div class="stat-widget-one card-body">
                                            <div class="stat-icon d-inline-block">
                                                <i class="ti-shopping-cart text-danger border-danger"></i>
                                            </div>
                                            <div class="stat-content d-inline-block">
                                                <div class="stat-text">Loại trái cây</div>
                                                <div class="stat-digit"><?php echo $product;?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card">
                                        <div class="stat-widget-one card-body">
                                            <div class="stat-icon d-inline-block">
                                                <i class="ti-pencil-alt text-success border-success"></i>
                                            </div>
                                            <div class="stat-content d-inline-block">
                                                <div class="stat-text">Bài viết</div>
                                                <div class="stat-digit"><?php echo $news;?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card">
                                        <div class="stat-widget-one card-body">
                                            <div class="stat-icon d-inline-block">
                                                <i class="ti-layout-grid2 text-pink border-pink"></i>
                                            </div>
                                            <div class="stat-content d-inline-block">
                                                <div class="stat-text">Tồn kho</div>
                                                <div class="stat-digit"><?php echo $product_amount;?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <span>Từ ngày</span>
                                        <input type="text" id="datepicker_from" class="btn border border-secondary form-control" style="text-align: start; color:black">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <span>Đến ngày</span>
                                        <input type="text" id="datepicker_to" class="btn border border-secondary form-control" style="text-align: start; color:black">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <span>&nbsp;</span><br>
                                        <a href="{{URL::to('/admin_revenue_statistical')}}" type="button" id="submit_revenue_statistical" class="btn btn-success">Xem thống kê </a>
                                    </div>
                                </div>
                            </form>
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 mb-3" style="text-align: end">
                                        <span class="float-left">Lọc theo</span><br>
                                        <select class=" btn border border-secondary form-control submit_revenue_statistical" style="text-align: start; color:black">
                                            <option>---Chọn---</option>
                                            <option value="7_days_ago">7 ngày trước</option>
                                            <option value="last_month">Tháng trước</option>
                                            <option value="this_month">Tháng này</option>
                                            <option value="365_days_ago">365 ngày trước</option>
                                            <option value="all">Tất cả</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <span>&nbsp;</span><br>
                                        <a href="{{URL::to('/admin_revenue_statistical')}}" class="btn btn-success">Xem thống kê</a>
                                    </div>
                                </div>
                            </form>


                            <div class="row mt-2">
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card">
                                        <div class="stat-widget-two card-body">
                                            <div class="stat-content">
                                                <div class="stat-text">Doanh thu</div>
                                                <div class="stat-digit">
                                                    @if (Session::get('price_sell')!=0)
                                                        <?php echo number_format(Session::get('price_sell'),0,'.','.'); ?>
                                                    @else

                                                    @endif
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success w-100" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card">
                                        <div class="stat-widget-two card-body">
                                            <div class="stat-content">
                                                <div class="stat-text">Lợi nhuận</div>
                                                <div class="stat-digit">
                                                    @if (Session::get('price_sell')!=0)
                                                        <?php echo number_format(Session::get('profit'),0,'.','.'); ?>
                                                    @else

                                                    @endif
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary w-100" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card">
                                        <div class="stat-widget-two card-body">
                                            <div class="stat-content">
                                                <div class="stat-text">Số sản phẩm bán ra</div>
                                                <div class="stat-digit">
                                                    <?php echo Session::get('product_quantity')?>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning w-100" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card">
                                        <div class="stat-widget-two card-body">
                                            <div class="stat-content">
                                                <div class="stat-text">Tổng đơn</div>
                                                <div class="stat-digit">
                                                    <?php echo Session::get('order_quantity')?>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger w-100" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /# card -->
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div id="chart" style="height: 250px;"></div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

