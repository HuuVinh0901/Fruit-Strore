@extends('admin_layout')
@section('content')
    @foreach ($detail_nutrition as $key => $show)
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-12 p-md-0">
                        <div class="welcome-text mt-1">
                            <h4 style="text-transform: uppercase;">Thông tin dinh dưỡng của {{$show->nutrition_title}}</h4>
                        </div>
                    </div>
                </div>

                <!-- row -->
                <div class="row">
                    <div id="man" class="col">
                        <div class="card">
                            <div class="m-5">
                                <div class="row">{!! $show->nutrition_detail !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
