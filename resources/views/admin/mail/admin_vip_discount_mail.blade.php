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
            width: 50%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="padding-top: 20px; padding-bottom: 5px; text-align: center; font-weight: bold">Mã khuyến mãi từ trái cây nhập khẩu ImportedFruit</div>
        <div style="font-size: 30px; text-align: center; font-weight: bold; text-transform: uppercase; color: #000">
            {{($discount['discount_name'])}}
        </div>
        <div style="text-align: center; font-weight: bold; font-size: 18px;">
            @if ($discount['discount_category']==1)
                Giảm {{$discount['discount_be']}}%
            @else
                Giảm {{number_format($discount['discount_be'],0,'.','.')}}VND
            @endif
        </div>
        <div style="text-align: center; padding-left: 20px; padding-right: 20px; font-size: 14px;">
            Sử dụng mã <span><b>{{$discount['discount_code']}}</b></span> khi mua trái cây nhập khẩu tại
            <span><b><a href="{{URL::to('/client_home_page')}}" style="color: #000; text-decoration: none;">ImportedFruit</a></b></span>
            để được giảm @if ($discount['discount_category']==1)
                                {{$discount['discount_be']}}%
                            @else
                                {{number_format($discount['discount_be'],0,'.','.')}}VND
                            @endif nhé!
            Cảm ơn quý khách rất nhiều. ImportedFruit chúc quý khách sức khỏe vui vẻ và bình an!
        </div>
        <div style="font-style: italic; font-size: 12px; padding-top: 6px; padding-bottom: 20px; text-align: center; padding-bottom: 5px;">
            Bắt đầu từ ngày {{$discount['discount_start']}} đến hết ngày {{$discount['discount_end']}}
        </div>
    </div>
</body>
</html>
