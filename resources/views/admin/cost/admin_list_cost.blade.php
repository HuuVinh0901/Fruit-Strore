@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Danh sách giá gốc</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_add_cost') }}" class="btn btn-primary">
                        Thêm giá gốc
                    </a>
                </div>
                <p class="text-danger">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
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
                                    <th>Trái cây</th>
                                    <th>Giá gốc</th>
                                    <th>Giá bán</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n=1; ?>
                                    @foreach ($list_cost as $key => $show_cost)
                                        <tr>
                                            <td><?php echo $n++?><br></td>
                                            <td>{{ $show_cost->product->product_name }}<br></td>
                                            <td>&nbsp;&nbsp;{{ number_format($show_cost->cost_buy,0,'.','.') }}</td>
                                            <td>&nbsp;&nbsp;{{ number_format($show_cost->product->product_price,0,'.','.') }}</td>
                                            <td class="text-center">
                                                <?php

                                                if($show_cost->product->product_status==0){
                                                ?>
                                                    <a href="{{ URL::to('admin_undisplay_product/' . $show_cost->product_id) }}">
                                                        <i class="fa-regular fa-circle-down"
                                                            style="font-size: 18px; color: red"></i>
                                                    </a>
                                                    <?php
                                                }
                                                else{
                                                ?>
                                                    <a href="{{ URL::to('admin_display_product/' . $show_cost->product_id) }}">
                                                        <i class="fa-regular fa-circle-up" style="font-size: 18px; color: blue"></i>
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ URL::to('admin_edit_cost/' . $show_cost->cost_id) }}"
                                                    style="margin-left: 10px; color:black">
                                                    <i class="fa-solid fa-check"></i>
                                                </a>
                                                <a onclick="return confirm('Bạn có chắc chắc xóa giá gốc của sản phẩm này không?')"
                                                    href="{{ URL::to('admin_delete_cost/' . $show_cost->cost_id) }}"
                                                    style="margin-left: 10px; color:black">
                                                    <i class="fa-solid fa-x"></i>
                                                </a>
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Trái cây</th>
                                    <th>Giá gốc</th>
                                    <th>Giá bán</th>
                                    <th>Trạng thái</th>
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
