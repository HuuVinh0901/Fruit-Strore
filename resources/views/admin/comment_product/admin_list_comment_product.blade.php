@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-2">
                        <h4>Danh sách bình luận sản phẩm</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_list_product') }}" class="btn btn-primary">
                        Danh sách sản phẩm
                    </a>
                </div>
                <p class="text-danger" id="message_reply_comment">
                    <b><?php
                        $message = Session::get('message');
                        if ($message) {
                            echo $message;
                            Session::put('message', null);
                        }
                        $n=1;
                    ?></b>
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
                                    <th>Họ và tên</th>
                                    <th>Sản phẩm</th>
                                    <th>Bình luận</th>
                                    <th>Phản hồi</th>
                                    <th>Nhập phản hồi</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n=1;?>
                                @foreach ($comment_product as $key => $show_comment_product)
                                    {{-- $list_product bên controller --}}
                                    <tr>
                                        <td class="text-center border-bottom"><?php echo $n++?></td>
                                        <td class="border-bottom">{{ $show_comment_product->client->client_name }}</td>
                                        <td class="border-bottom">
                                            {{ $show_comment_product->product->product_name }}<br>
                                            {{ $show_comment_product->product->product_packing }}
                                        </td>
                                        <td class="border-bottom">{{ $show_comment_product->comment_product_detail}}</td>
                                        <td class="border-bottom">
                                            <ul>
                                                @foreach ($reply_comment_product as $key => $reply)
                                                    @if ($reply->comment_product_reply == $show_comment_product->comment_product_id) {{-- nếu cái cột reply bằng comment_id --}}
                                                        <li>&#10150; {{$reply->comment_product_detail}}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td contenteditable class="reply_comment_product border-bottom"
                                            data-comment_product_id="{{$show_comment_product->comment_product_id}}"
                                            data-product_id="{{$show_comment_product->product_id}}">
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc chắc xóa bình luận này không?')"
                                                href="{{ URL::to('admin_delete_comment_product/' . $show_comment_product->comment_product_id) }}"
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
                                    <th>Họ và tên</th>
                                    <th>Sản phẩm</th>
                                    <th>Bình luận</th>
                                    <th>Phản hồi</th>
                                    <th>Nhập phản hồi</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
