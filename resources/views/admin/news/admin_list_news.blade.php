@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-1">
                        <h4>Danh sách bài viết</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{ URL::to('admin_add_news') }}" class="btn btn-primary">
                        Thêm bài viết
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
                                    <th class="text-center">STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Hình ảnh</th>
                                    <th>Danh mục</th>
                                    <th class="text-center">Ngày đăng</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Thao tác</th>
                                    <?php $n=1;?>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_news as $key => $show_news)
                                    {{-- $list_product bên controller --}}
                                    <tr>
                                        <td class="text-center"><?php echo $n++?></td>
                                        <td>{!! $show_news->news_title !!}</td>
                                        <td><img src="public/upload/news/{{ $show_news->news_image }}"
                                                height="50" width="50" alt=""></td>
                                        <td>{{ $show_news->category_news->category_news_name }}</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date_format($show_news->created_at,'H:i:s d/m/Y') }}</td>
                                        <td class="text-center">
                                            <?php
                                            if($show_news->news_status==0){
                                            ?>
                                                <a href="{{ URL::to('admin_undisplay_news/' . $show_news->news_id) }}">
                                                    <i class="fa-regular fa-circle-down"
                                                        style="font-size: 18px; color: red"></i>
                                                </a>
                                                <?php
                                            }
                                            else{
                                            ?>
                                                <a href="{{ URL::to('admin_display_news/' . $show_news->news_id) }}">
                                                    <i class="fa-regular fa-circle-up" style="font-size: 18px; color: blue"></i>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{URL::to('admin_detail_news/'.$show_news->news_id)}}"
                                                style="margin-left: 10px; color:black">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <a href="{{ URL::to('admin_edit_news/' . $show_news->news_id) }}"
                                                style="margin-left: 10px; color:black">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                            {{-- <a onclick="return confirm('Bạn có chắc chắc xóa bài viết này không?')"
                                                href="{{ URL::to('admin_delete_news/' . $show_news->news_id) }}"
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
                                    <th>Tiêu đề</th>
                                    <th>Hình ảnh</th>
                                    <th>Danh mục</th>
                                    <th class="text-center">Ngày đăng</th>
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
