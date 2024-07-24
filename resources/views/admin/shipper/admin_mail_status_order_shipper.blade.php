<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imported Fruit</title>
    <style>
        .container{
            background-color: #8EEC91;
            color: #000;
            border-radius: 30px;
            width: 70%;
            padding: 30px;
        }
        body{
            font-family: Dejavu Sans ;
            font-size: 12px;
        }
        .border{
            border: 1px solid black;
        }
        .table{
            width: 100%;
            border-collapse: collapse;
            margin-top:20px
        }
        .center{
            text-align: center;
        }
        .right{
            text-align: right;
        }
        .uppercase{
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="container">

        <h2 class="center uppercase"><b>THÔNG BÁO TRẠNG THÁI ĐƠN HÀNG</b></h2>
        <div style="text-align: center">
            Đơn hàng có mã vận đơn {{$order_array['order_code']}} @if ($order_array['status_shipper_id'] == 2) đã giao thành công
                                                                  @elseif ($order_array['status_shipper_id'] == 3) giao thất bại
                                                                  @endif
            <br>
            <b><a href="{{URL::to('admin_detail_order/'.$order_array['order_code'])}}" style="color: #000; text-decoration: none; text-align: center">
                Xem chi tiết đơn hàng
            </a></b>
        </div>
    </div>
</body>
</html>
