@extends('admin_layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text mt-1">
                        <h4>Danh sách danh mục</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex">
                    <a href="{{URL::to('admin_add_category_news')}}" class="btn btn-primary">
                        Thêm danh mục bài viết
                    </a>
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
                                    <th>STT</th>
                                    <th>Tên danh mục</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th>Ngày thêm</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_category_news as $key => $show_category_news) {{-- $list_category_product bên controller --}}
                                <tr>
                                    <td><?php echo $n++?></td>
                                    <td>{{$show_category_news->category_news_name}}</td>
                                    <td class="text-center">
                                        <?php
                                        if($show_category_news->category_news_status==0){
                                    ?>
                                            <a href="{{URL::to('admin_undisplay_category_news/'.$show_category_news->category_news_id)}}">
                                                <i class="fa-regular fa-circle-down" style="font-size: 18px; color: red"></i>
                                            </a>
                                    <?php
                                        }
                                        else{
                                    ?>
                                            <a href="{{URL::to('admin_display_category_news/'.$show_category_news->category_news_id)}}">
                                                <i class="fa-regular fa-circle-up" style="font-size: 18px; color: blue"></i>
                                            </a>
                                    <?php
                                        }
                                    ?>
                                    </td>
                                    <td>{{$show_category_news->created_at}}</td>
                                    <td class="text-center">
                                        <a href="{{URL::to('admin_edit_category_news/'.$show_category_news->category_news_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                        {{-- <a onclick="return confirm('Bạn có chắc chắc xóa danh mục này không?')" href="{{URL::to('admin_delete_category_news/'.$show_category_news->category_news_id)}}" style="margin-left: 10px; color:black">
                                            <i class="fa-solid fa-x"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên danh mục</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th>Ngày thêm</th>
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
{{-- <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Tên danh mục</th>
                                <th>Mô tả chi tiết danh mục</th>
                                <th>Trạng thái</th>
                                <th>Ngày thêm</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>19</td>
                                <td>
                                    <a href="#" style="margin-left: 10px">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by
                                            @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                                        </svg>
                                    </a>
                                    <a href="#" style="margin-left: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by
                                            @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                                <td>27</td>
                                <td>
                                    <a href="#" style="margin-left: 10px">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by
                                            @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                                        </svg>
                                    </a>
                                    <a href="#" style="margin-left: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by
                                            @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>125</td>
                                <td>
                                    <a href="#" style="margin-left: 10px">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by
                                            @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                                        </svg>
                                    </a>
                                    <a href="#" style="margin-left: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by
                                            @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tên danh mục</th>
                                <th>Mô tả chi tiết danh mục</th>
                                <th>Trạng thái</th>
                                <th>Ngày thêm</th>
                                <th>Thao tác</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div> --}}
