@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Danh sách sản phẩm</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_add_product') }}" class="btn btn-primary">
                        Thêm sản phẩm
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
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá gốc</th>
                                    <th>Giá bán</th>
                                    <th>Kho</th>
                                    <th>Bán ra</th>
                                    <th>Giá khuyến mãi</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_product as $key => $show_product)
                                    {{-- $list_product bên controller --}}
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $n++?>
                                        </td>
                                        <td>
                                            <img src="public/upload/product/{{ $show_product->product_image }}"
                                                height="50" width="50" alt="">

                                        </td>
                                        <td>&nbsp;&nbsp;
                                            {{ $show_product->product_name }}<br>
                                            &nbsp;&nbsp;
                                            {{ $show_product->product_packing }}<br>
                                            &nbsp;&nbsp;
                                            {{ $show_product->origin->origin_name }}<br>
                                        </td>
                                        <td>&nbsp;&nbsp; {{ number_format($show_product->product_cost,0,'.','.') }}</td>
                                        <td>&nbsp;&nbsp; {{ number_format($show_product->product_price,0,'.','.') }}</td>

                                        <td>
                                            <form action="">
                                                @csrf
                                                &nbsp;&nbsp;&nbsp;{{ $show_product->product_amount }} + <span data-product_id="{{$show_product->product_id}}" contenteditable class="add_product_amount">0</span>
                                            </form>
                                        </td>
                                        <td>&nbsp;&nbsp;&nbsp;{{ $show_product->product_sold}}</td>
                                        <td>&nbsp;&nbsp;
                                            @if($show_product->product_sale == NULL)
                                                <a href="{{URL::to('admin_add_sale_product/'.$show_product->product_id)}}">
                                                    <b style="color: #007700">Thêm giá khuyến mãi</b>
                                                </a>
                                            @else
                                                <a href="{{URL::to('admin_edit_sale_product/'.$show_product->product_id)}}" style="color: gray">
                                                    {{ number_format($show_product->product_sale,0,'.','.') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                                @if($show_product->product_status==0)
                                                    <a href="{{ URL::to('admin_undisplay_product/' . $show_product->product_id) }}">
                                                        <i class="fa-regular fa-circle-down"
                                                            style="font-size: 18px; color: red"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ URL::to('admin_display_product/' . $show_product->product_id) }}">
                                                        <i class="fa-regular fa-circle-up" style="font-size: 18px; color: blue"></i>
                                                    </a>
                                                @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ URL::to('admin_add_gallery/' . $show_product->product_id) }}" style="margin-left: 10px; color:black">
                                                <i class="fa-solid fa-plus"></i>
                                            </a>
                                            <a href="{{URL::to('admin_detail_product/'.$show_product->product_id)}}" style="margin-left: 10px; color:black">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <a href="{{ URL::to('admin_edit_product/' . $show_product->product_id) }}"
                                                style="margin-left: 10px; color:black">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                            {{-- <a onclick="return confirm('Bạn có chắc chắc xóa sản phẩm này không?')"
                                                href="{{ URL::to('admin_delete_product/' . $show_product->product_id) }}"
                                                style="margin-left: 10px; color:black">
                                                <i class="fa-solid fa-x"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá gốc</th>
                                    <th>Giá bán</th>
                                    <th>Kho</th>
                                    <th>Bán ra</th>
                                    <th>Giá khuyến mãi</th>
                                    <th class="text-center">Trạng thái</th>
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
