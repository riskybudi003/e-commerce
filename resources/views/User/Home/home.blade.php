@extends('User.layout.masterLayout')
@section('title', 'Home')
@section('content')

    <div class="row header">
        <div class="col-lg-6 col-md-12">
            <div class="image">
                <img src="{{ asset('assets/images/logo/Ecommerce checkout laptop-rafiki.png') }}" alt=""
                    class="img-fluid">
            </div>
        </div>
        <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
            <div class="text-headling">
                <h2 class="cl-dark">Find Top Quality Products,
                    Or Quality Brand
                </h2>
                <p>Shop By product, brand or sale item!</p>
            </div>

        </div>
    </div>
    <div class="section">
        <div class="row">
            <div class="col-lg-12">
                <div
                    class="lebel-header-section-product bg-dark d-flex align-items-center justify-content-between p-2 mb-3">
                    <div>Top Products</div>
                    <a href="{{ route('all-product') }}" class="cl-white">See All Products</a>
                </div>
                <div class="row product-section px-5">
                    @foreach ($product as $pro)
                        <div class="col-lg-4 col-md-6 col-sm-3 mb-2">
                            <div class="card p-2">
                                <div class="card-content">
                                    <div class="image-card mb-3">
                                        <img src="{{ asset('assets/images/product/' . $pro->image) }}" alt=""
                                            class="img-fluid">
                                    </div>
                                    <div class="title-card"><a href="{{ route('detail-product', $pro->slug) }}"
                                            class="cl-dark">{{ $pro->name }}
                                        </a>
                                    </div>
                                    <div class="footer-card d-flex align-items-center justify-content-between px-3">
                                        <div class="price-product cl-dark">Rp. {{ number_format($pro->harga, 0, ',', '.') }}
                                        </div>
                                        <div class="btn action-cart">
                                            <div class="cart-detail">
                                                <a href="{{ route('detail-product', $pro->slug) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        fill="black" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>

@stop
