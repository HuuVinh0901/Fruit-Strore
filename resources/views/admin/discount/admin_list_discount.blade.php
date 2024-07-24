@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-1">
                        <h4>Danh sách mã giảm giá</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{URL::to('admin_add_discount')}}" class="btn btn-primary">
                        Thêm mã giảm giá
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
                                    <th>Mã giảm giá</th>
                                    <th>Tên giảm giá</th>
                                    <th>Số lượng</th>
                                    <th>Điều kiện</th>
                                    <th>Ngày</th>
                                    <th class="text-center">Hạn sử dụng</th>
                                    <th class="text-center">Gửi mã</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n=1;?>
                                @foreach ($discount as $key => $show_discount) {{-- $list_brand_product bên controller --}}
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $n++;?></td>
                                    <td>{{$show_discount->discount_code}}</td>
                                    <td>{{$show_discount->discount_name}}</td>
                                    <td>&nbsp;&nbsp;{{$show_discount->discount_amount}}</td>
                                    <td>
                                        <?php
                                        if($show_discount->discount_category==1){
                                    ?>
                                        Giảm {{$show_discount->discount_be}}%
                                    <?php
                                        }
                                        elseif($show_discount->discount_category==2){
                                    ?>
                                        Giảm {{$show_discount->discount_be}}VND
                                    <?php
                                        }
                                    ?>
                                    </td>
                                    <td>
                                        Từ: {{$show_discount->discount_start}}<br>
                                        Đến: {{$show_discount->discount_end}}
                                    </td>
                                    </td>
                                    <td class="text-center">
                                        @if ($show_discount->discount_end>=$today)
                                            <b class="text-primary">Còn hạn</b>
                                        @else
                                            <b class="text-danger">Hết hạn</b>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <b><a href="{{URL::to('/admin_vip_discount_mail',[
                                                                                            'discount_code'=>$show_discount->discount_code,
                                                                                            'discount_name'=>$show_discount->discount_name,
                                                                                            'discount_amount'=>$show_discount->discount_amount,
                                                                                            'discount_category'=>$show_discount->discount_category,
                                                                                            'discount_be'=>$show_discount->discount_be,
                                                                                            'discount_start'=>$show_discount->discount_start,
                                                                                            'discount_end'=>$show_discount->discount_end
                                                                                         ])}}" style="color:#007700">Khách hàng VIP</a></b>
                                        <br>
                                        <b><a href="{{URL::to('/admin_discount_mail',[
                                                                                        'discount_code'=>$show_discount->discount_code,
                                                                                        'discount_name'=>$show_discount->discount_name,
                                                                                        'discount_amount'=>$show_discount->discount_amount,
                                                                                        'discount_category'=>$show_discount->discount_category,
                                                                                        'discount_be'=>$show_discount->discount_be,
                                                                                        'discount_start'=>$show_discount->discount_start,
                                                                                        'discount_end'=>$show_discount->discount_end
                                                                                    ])}}" style="color:#007700">Khách hàng</a></b>
                                    </td>
                                    <td class="text-center">
                                        {{-- <a href="{{URL::to('./admin_edit_discount/'.$show_discount->discount_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-check"></i>
                                        </a> --}}
                                        <a onclick="return confirm('Bạn có chắc chắc xóa mã giảm giá này không?')" href="{{URL::to('admin_delete_discount/'.$show_discount->discount_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-x"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã giảm giá</th>
                                    <th>Tên giảm giá</th>
                                    <th>Số lượng</th>
                                    <th>Điều kiện</th>
                                    <th>Ngày</th>
                                    <th class="text-center">Hạn sử dụng</th>
                                    <th class="text-center">Gửi mã</th>
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
