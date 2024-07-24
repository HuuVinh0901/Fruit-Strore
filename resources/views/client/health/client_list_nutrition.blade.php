
@extends('client_layout')
@section('content')
    {{-- <nav class="mt-4" aria-label="Page navigation sample">
  <ul class="pagination">
    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>

	</main>
	</div>
</div> --}}
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.min.css">
    </head>
    <style>
        .fruit {
            background-color: #f2f2f2;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;

        }
        .list_nution{
            color:rgb(30, 189, 91);
        }
        .text-like-normal {
            color: inherit; /* Màu văn bản kế thừa từ phần tử cha */
            text-decoration: none; /* Loại bỏ gạch chân */
        }


        .text-like-normal:hover {
            text-decoration: underline; /* Thêm gạch chân khi rê chuột qua */
        }

    </style>
    <div class="hero-wrap hero-bread" style="background-image: url({{ URL::to('public/frontend/images/bg3.png') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">Trái cây</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">


                <div class="col-md-3">
                    <div class="position-ref full-height">
                        <div class="content">
                            <form class="typeahead search-form" id="myForm">

                                <input id="autoComplete" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">

                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <h1 class="col-md mb-4 mt-2 text-center" style="text-transform: uppercase">GỢI Ý SẢN PHẨM THEO DINH DƯỠNG</h1>


            <div class="row">
                <div class="col-lg-12 col-md-6 col-12 row">
                    <div class="col-md-8 col-lg-12">

                            <div class="product">

                                <form>
                                    <div>
                                        <h3 style="color:rgb(30, 189, 91);" class="text-center">{{$nutrition->nutrition_title}}</h3>
                                    </div>
                                    <span>* Trái cây là một phần quan trọng của chế độ ăn uống lành mạnh và có nhiều lợi ích cho tim mạch, chủ yếu nhờ vào các thành phần dinh dưỡng chính sau:</span>
                                     <div class="fruit">
                                        <p>
                                            {!!str_replace('.','<br>',$nutrition->nutrition_detail)!!}

                                        </p>
                                        <div>
                                            <p style="color:rgb(40, 144, 185)">Sau đây là một số sản phẩm phù hơp với người bị vấn đề {{$nutrition->nutrition_tag}}:</p>
                                            =>
                                            @foreach($products as $product)
                                                <a href="{{url::to('client_detail_product/'.$product->product_id)}}" class="text_like_normal">{{$product->product_name}}</a><span>, </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal fade" id="viewnow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title product_viewnow_name" id="">
                                <span id="product_viewnow_name"></span> - <span id="product_viewnow_packing"></span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            <style type="text/css">
                                @media screen and (min-width: 992px) {

                                    /* ipad trở lên màn hình máy tính */
                                    .modal-lg {
                                        width: 950px;
                                    }
                                }

                                @media screen and (min-width: 992px) {

                                    /* điện thoại */
                                    .modal-dialog {
                                        width: 700px;
                                    }

                                    .modal-sm {
                                        width: 350px;
                                    }
                                }

                                /* span#product_viewnow_detail img{ hình ở thông tin sản phẩm co gián theo cột
                                                        width: 100px;
                                                    } */
                            </style>
                            <div class="col-md-5">
                                <span id="product_viewnow_image"></span>
                            </div>
                            <div class="col-md-7">
                                <form>
                                    @csrf
                                    <div id="product_viewnow_value"></div>
                                    <div class="row">
                                        <p class="text-left mr-4">
                                            <a class="mr-2 ml-3" style="color: #000;">
                                                <span style="color: #bbb;">Còn lại</span>
                                                <span id="product_viewnow_amount"></span>
                                            </a>
                                        </p>
                                        <p class="text-left">
                                            <a class="mr-2" style="color: #000;">
                                                <span style="color: #bbb;">Đã bán</span>
                                                <span id="product_viewnow_sold"></span>
                                            </a>
                                        </p>
                                    </div>
                                    <p class="price">
                                        Giá: <b><span class="text-primary" id="product_viewnow_price"></span></b>
                                    </p>
                                    {{-- <div class="row mt-4">
                                        <div class="col-md-6 d-flex mb-3 input-group">
                                            <input type="number" name="quantity_detail" value="1" min="1"
                                                class="cart_product_quantity_ w-100 input-number"
                                                style="border: 1.5px solid rgba(0, 0, 0, 0.1); border-radius: 20px; text-align:center">
                                            <input type="hidden" id="quantity" name="product_id_detail"
                                                value="">
                                        </div>
                                    </div> --}}
                                    <div class="w-50 d-flex mb-3 input-group" id="product_viewnow_button_add"></div>
                                    <div id="beforesend_viewnow"></div>
                                    <b>Thành phần dinh dưỡng: </b>
                                    <span id="product_viewnow_summary"></span>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-primary w-25">Chi tiết sản phẩm</button> --}}
                            <span id="product_viewnow_detail"></span>
                            <button type="button" class="btn btn-primary redirect_list_cart w-25 ">Đi tới giỏ
                                hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const myForm = document.getElementById("myForm");
        let autocompleteOptions = @json($nutritions_json);
        autocompleteOptions=JSON.parse(autocompleteOptions);

        console.log(autocompleteOptions);


        // $.ajax({
        //     url: '/imported_fruit/client_list_nutrition',
        //     type: 'GET',
        //     dataTyle: 'json',
        //     success: function(response) {
        //         response.forEach(function(item) {
        //             autocompleteOptions.push(item.tag);
        //         });
        //     },
        //     error: function(xhr, status, error) {
        //         console.error(error);   // Xử lý lỗi
        //         $('#list_nution').html('<p>Error loading data</p>'); // Hiển thị thông báo lỗi
        //     }
        // });

        // console.log(autocompleteOptions);


        const autoCompleteJS = new autoComplete({
            selector: "#autoComplete",
            placeHolder: "Tìm theo bệnh hoặc dinh dưỡng...",
            data: {
                src: autocompleteOptions,
                cache: true,
            },
            resultsList: {
                element: (list, data) => {
                    if (!data.results.length) {
                        // Create "No Results" message element
                        const message = document.createElement("div");
                        // Add class to the created element
                        message.setAttribute("class", "no_result");
                        // Add message text content
                        message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
                        // Append message element to the results list
                        list.prepend(message);
                    }
                },
                noResults: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        autoCompleteJS.input.value = selection;
                        myForm.setAttribute("action", 'http://localhost/imported_fruit/client_list_nutrition/'+autoCompleteJS.input.value);

                    }
                }
            },
            submit:true,

        });

    </script>
@endsection

