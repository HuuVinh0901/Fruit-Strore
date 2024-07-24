<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        <p class="uppercase" style="font-size: 12px">Cửa hàng nhập khẩu trái cây tươi ImportedFruit</p>
        <p style="font-size: 12px">Nhận ship tại khu vực Cần Thơ</p>
        <p>-------------------------------------------------------------------------------</p>
        <h2 class="center uppercase"><b>THÔNG BÁO ĐƠN HÀNG BỊ HỦY</b></h2>
        <div style="text-align: center">
            Đơn hàng có mã vận đơn {{$order_array['order_code']}} đã bị hủy bởi {{$order_array['client_name']}}
        </div>
        <div style="text-align: center">
            <b><a href="{{URL::to('admin_detail_order/'.$order_array['order_code'])}}" style="color: #000; text-decoration: none; text-align: center">
                Xem chi tiết đơn hàng
            </a></b>
        </div>
    </div>
</body>
</html>
