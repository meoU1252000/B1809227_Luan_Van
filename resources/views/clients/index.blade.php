@extends('clients.main')
@section('css')
    <style>
        .fw-bolder {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
        }
    </style>
    
@endsection
@section('content')
    @include('clients.alert')
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset($product->main_image_src) }}" alt="..." /> 
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                    <!-- Product price-->
                                    @if ($product->product_price !== null)
                                        {{ number_format($product->product_price) }} VNĐ
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                        href="{{ route('client.detail', ['slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $product->product_name))), 'id' => $product->id]) }}">View
                                        More</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection

