@extends('clients.main')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{asset('css/style.css')}}" rel="stylesheet" />
<!-- responsive style -->
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
<link href="{{asset('css/style.scss')}}" rel="stylesheet" />
<link href="{{asset('css/style.css.map')}}" rel="stylesheet" />

<style>
    .slider_section {
        display:none;
    }
    .cart{
        display:none;
    }
    .table_product  tbody {
     display: block;
     max-height: 500px;
     overflow-y: scroll;
    }  

   .table_product  thead, table tbody tr {
     display: table;
     width: 100%;
     table-layout: fixed;  
   }
   .table_product  tbody::-webkit-scrollbar {
      width: 10px;
    }

    .table_product  tbody::-webkit-scrollbar-track {
      background-color: #eee;
      border-radius: 100rem;
    }
    
    .table_product  tbody::-webkit-scrollbar-thumb {
      border-radius: 100rem;
      background-image: linear-gradient(to bottom, #063547, #44b89d);
      height: 50px;
    }
    
</style>
@endsection
@section('content')
<section class="body_section layout_padding" style="margin-top:36px">
  @include('admin.alert')
    <div class="container">
      
        <div class="row header_page">
          <i class="fa-solid fa-bag-shopping"></i>
          <h4>Giỏ Hàng Của Bạn</h4>
        </div>
        <div class="row">
             <div class="col-md-12">
                   <table class="table table_product">
                       <thead>
                         <tr>
                           <th scope="col">Sản Phẩm</th>
                           <th scope="col">Tên</th>
                           <th scope="col">Giá</th>
                           <th scope="col">Số Lượng</th>
                           <th scope="col">Tạm Tính</th>
                           <th scope="col">Tác Vụ</th>
                         </tr>
                       </thead>
                       <tbody >
                           @foreach ($cartItems as $item)
                           
                            <tr class="cart_page">
                              <td>
                                  <img src="{{asset($item->options['image'])}}" alt="" class="img_product">
                             </td>
                             <td class="name_product">{{$item->name}}</td>
                             <td class="cartPage_price">{{number_format($item->price)}} VND</td>
                             <td>
                                <div class="detail-box_wrap">
                                        <div class="input-box">
                                          {{-- @csrf --}}
                                           <button class="decrementQuantity" data-url="{{route('cart.edit')}}" data-token="{{csrf_token()}}"> - </button>
                                           <input type="text" name="id" value="{{$item->rowId}}" class="rowID" hidden>
                                           <input type="text" class="product_id" value="{{$item->id}}" hidden>
                                           <input type="number" min="1" max="100" step="1" value="{{$item->qty}}"  class="product_quantity" readonly>
                                           <button class="incrementQuantity" data-url="{{route('cart.edit')}}" data-token="{{csrf_token()}}"> + </button>
                                         </div>
                                   
                                </div>
                             </td>
                             <td class="cartPage_total">
                                 {{number_format(($item->price)*($item->qty))}} VND
                             </td>
                             <td>
                                 <form action="{{route('cart.remove',['id'=>$item->rowId])}}" method="POST" name="form_delete">
                                    @csrf
                                     <button class="btn btn-outline-dark mt-auto" type="submit">Xóa khỏi giỏ hàng</button>
                                 </form>
                             </td>
                            </tr>
                            @endforeach
                       </tbody>
                      
                   </table>

                   <table class="table">
                          <thead>
                               <th scope="col">
                                    <button class="btn edit_cart">Cập Nhật Giỏ hàng</button>
                               </th>
                             </tr>
                         </thead>
                     </table>

             </div>

          
        </div>
       

      
        <div class="row header_page">
          <button class="purchase btn btn-primary">Thanh Toán</button>
        </div>

       
    </div>
    
</section>
<script src="{{asset('js/cart-page.js')}}"></script>


@endsection