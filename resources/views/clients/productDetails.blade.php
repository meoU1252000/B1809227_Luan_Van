@extends('clients.main')
@section('css')
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.scss') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css.map') }}" rel="stylesheet" />
@endsection
@section('content')
    <section class="category_section_book detailproduct_section layout_padding">
        @include('clients.alert')
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="img-box">
                        <img src="{{ asset($product->main_image_src) }}" alt="" class="img_book">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="detail-box">
                        <div class="heading_container">
                            <span class="product_id" hidden></span>
                            <span class="product_quantity" hidden></span>
                            <h2 class="product_name">
                                {{ $product->product_name }}
                            </h2>
                        </div>
                        <div class="detail_product">
                            <div class="detail_product--content">
                                <p>
                                    Thương Hiệu : <strong>{{ $product->get_brand->brand_name }}</strong>
                                </p>
                                {{-- <p>
                  Nhà Xuất Bản : <strong ></strong>
                </p> --}}

                            </div>
                            {{-- <div class="detail_product--content">
                <p>
                Thể Loại: <strong></strong>
                </p>
              </div> --}}
                        </div>
                        <p>
                            Giá: <strong> <span class="product_price" style="font-size: 16px">
                                    @if ($product->product_price !== null)
                                        {{ number_format($product->product_price) }} VNĐ
                                    @endif
                            </strong>
                        </p>


                        <div class="detail-box_wrap">
                            @if (!$productCart)
                                <form action="{{ route('cart.store', ['id' => $product->id]) }}" style="display:flex"
                                    method="POST">
                                    @csrf
                                    <div class="input-box">
                                        <button id="decrement" onclick="stepper(this)" type="button"> - </button>
                                        <input type="number" min="1" max="100" step="1" value="1"
                                            id="my-input" name="product_quantity" readonly>
                                        <button id="increment" onclick="stepper(this)" type="button"> + </button>
                                    </div>
                                    <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                                    <input type="text" name="product_name" value="{{ $product->product_name }}" hidden>
                                    <input type="text" name="product_price" value="{{ $product->product_price }}"
                                        hidden>
                                    <input type="text" name="main_image_src" value="{{ $product->main_image_src }}"
                                        hidden>
                                    <button class="btn btn-primary "
                                        style="background-color: #212529;margin-bottom:32px;margin-left: 12px;display: inline-block;"
                                        type="submit">Thêm Vào Giỏ Hàng</button>
                                </form>
                            @else
                                <form action="{{ route('cart.store', ['id' => $productCart[0]->rowId]) }}"
                                    style="display:flex" method="POST">
                                    @csrf
                                    <div class="input-box">
                                        <button id="decrement" onclick="stepper(this)" type="button"> - </button>
                                        <input type="number" min="1" max="100" step="1" value="1"
                                            id="my-input" name="product_quantity" readonly>
                                        <button id="increment" onclick="stepper(this)" type="button"> + </button>
                                    </div>

                                    <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                                    <input type="text" name="product_name" value="{{ $product->product_name }}" hidden>
                                    <input type="text" name="product_price" value="{{ $product->product_price }}"
                                        hidden>
                                    <input type="text" name="main_image_src" value="{{ $product->main_image_src }}"
                                        hidden>
                                    <button class="add_cart" type="submit">Thêm Vào Giỏ Hàng</button>
                                </form>
                            @endif
                        </div>

                    </div>



                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row_detailproduct--content">
                        <div class="row_detailproduct_label--seperate">
                            <span>Thông Tin Sản Phẩm</span>
                        </div>
                        <div class="row_detailproduct--main">
                            <ul>
                                @foreach ($attributes as $attribute)
                                    <li><span style="width: 25%;">{{ $attribute->attribute_name }}: </span><span
                                            style="font-weight: normal;">
                                            @if ($attribute->get_param($attribute->id, $product->id) !== null)
                                                {{ $attribute->get_param($attribute->id, $product->id)->param_value }}
                                            @endif
                                        </span></li>
                                @endforeach
                            </ul>


                            <button class="read_more" onclick="readMore()" id="myBtn">Read More</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="row_detailproduct--content">
                        <div class="row_detailproduct_label--seperate">
                            <span>Đánh Giá Sản Phẩm</span>
                        </div>
                        <div class="row_detailproduct--rating">
                            <table class="table table-bordered">
                                <!-- <thead>
                              <tr>
                                <th scope="col" colspan="2">Đánh Giá Sản Phẩm</th>
                              </tr>
                            </thead> -->
                                <tbody>
                                    <tr>

                                        <td width="40%" style="vertical-align: middle;">


                                            <i class="fa-solid fa-star starNotActive"></i>
                                            <i class="fa-solid fa-star starNotActive"></i>
                                            <i class="fa-solid fa-star starNotActive"></i>
                                            <i class="fa-solid fa-star starNotActive"></i>
                                            <i class="fa-solid fa-star starNotActive"></i>

                                            <p style="margin-top:8px">0 đánh giá</p>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row_detailproduct--content">
                        <div class="row_detailproduct_label--seperate">
                            <span>Bình Luận</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="row_detailproduct--content" style="display:flex;margin-bottom: 0px;">
                        <img src="../assets/img/user11.png" alt=""
                            style="width:62px;height:62px;margin-right:12px;">
                        <div class="form-group" style="width:90%">
                            <textarea class="form-control" rows="2" id="productComment"
                                placeholder="Nhập vào bình luận của bạn ... (tối đa 255 ký tự)" maxlength="255"></textarea>
                        </div>


                    </div>

                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary "
                        style="background-color: #212529;margin-top:12px;margin-bottom:32px;float: right;margin-right: 32px;"
                        id="submitComment">Đăng Bình Luận</button>
                </div>
            </div>




            <!-- <div class="row">
                         <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-primary " style="background-color: #212529;margin-top:12px;margin-bottom:32px;width:90%;">Tải Thêm</button>
                          </div>
                     
                       </div> -->

        </div>

        </div>
    </section>
    <script src="{{ asset('js/input-custom.js') }}"></script>
@endsection
