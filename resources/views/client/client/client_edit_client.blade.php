@extends('client_layout')
@section('content')
@php
    $client_id = Session::get('client_id');
    $province_name = Session::get('province_name');
    $province_id = Session::get('province_id');

    $district_name = Session::get('district_name');
    $district_id = Session::get('district_id');

    $ward_name = Session::get('ward_name');
    $ward_id = Session::get('ward_id');

    $client_address = Session::get('client_address');
@endphp
<div class="container" style="margin-bottom: 85px">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate">
            <h3 class="mt-5">CHỈNH SỬA THÔNG TIN</h3>

                @foreach ($info_client as $show_client)
                <form action="{{URL::to('client_submit_edit_client/'.$show_client->client_id)}}" method="POST" style="font-size: 14px;">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label style="margin-right: 40px"><b>Tên:</b></label>
                            <input  name="name_client" type="text" class="form-control" style="font-size: 14px; height:10px" value="{{$show_client->client_name}}">
                            @error('name_client')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label style="margin-right: 40px"><b>Email:</b></label>
                            <input  name="email_client" type="email" class="form-control" style="font-size: 14px" value="{{$show_client->client_email}}">
                            @error('email_client')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label style="margin-right: 40px"><b>Số điện thoại:</b></label>
                            <input name="phone_client" type="text" class="form-control" style="font-size: 14px" value="{{$show_client->client_phone}}">
                            @error('phone_client')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label style="font-size: 14px"><b>Thành phố</b></label>
                            <select class="form-control choose province" name="province" id="province"  style="text-align: start; font-size: 14px">
                                <option value="{{$province_id}}" >Thành phố {{$province_name}}</option>
                                    @foreach ($province as $key => $show_province)
                                        <option name="id_province"  style="font-size: 14px" value="{{$show_province->province_id}}">{{$show_province->province_name}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label style="font-size: 14px"><b>Quận - Huyện</b></label>
                            <div class="form-group">
                                <select class="form-control choose district" name="district" id="district" style="text-align: start; font-size: 14px">
                                    <option value="{{$district_id}}">{{$district_name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label style="font-size: 14px"><b>Xã - Phường - Thị trấn</b></label>
                            <select class="form-control ward" name="ward" id="ward"  style="text-align: start; font-size: 14px">
                                <option value="{{$ward_id}}">{{$ward_name}}</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label style="margin-right: 40px"><b>Tên đường - Tòa nhà - Số nhà</b></label>
                            <input  name="address_client" type="text" class="form-control" style="font-size: 14px" value="{{$show_client->client_address}}">
                        </div>
                    </div>

                    <input type="submit" value="CẬP NHẬT" class="btn btn-primary py-3 px-5">
                </form>
                @endforeach

        </div>
    </div>
</div>


@endsection


