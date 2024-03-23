@extends('User.layout.masterLayout')
@section('title', 'Detail Product')
@section('content')

    <div class="section detail-product mb-5">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="image-pro">
                    <img src="{{ asset('assets/images/product/' . $product->image) }}" alt=""
                        class="img-itm-pro img-fluid">
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="cl-dark mb-3">{{ $product->name }}</h4>
                        <h3 class="cl-dark mb-3">Rp. {{ number_format($product->harga, 0, ',', '.') }}</h3>
                        <div class="varian-warna d-flex gap-3 align-items-center mb-3">
                            <label for="">Product Color:</label>
                            @foreach ($product->warna as $color)
                                <button class="btn btn-outline-dark color" xid="{{ $color->id }}"
                                    onclick="btnActiveOption(this, 'color')">{{ $color->name }}</button>
                            @endforeach
                        </div>

                        <div class="varian-ukuran d-flex gap-3 align-items-center mb-3">
                            <label for="">Product Size</label>
                            @foreach ($product->ukuran as $size)
                                <button class="btn btn-outline-dark size" xid="{{ $size->id }}"
                                    onclick="btnActiveOption(this, 'size')">{{ $size->ukuran }}</button>
                            @endforeach
                        </div>

                        <div class="detail mt-5 mb-3">
                            <p class="cl-grey">{{ $product->deskripsi }}</p>
                        </div>

                        <div class="footer-card d-flex justify-content-between gap-4">
                            <div class="qty-control" id="qty">
                                <button class="btn btn-dark" id="qty-decrease"> - </button>
                                <input type="text" value="1" class="qty-input text-center" id="qty-value-input"
                                    style="width:30%">
                                <button class="btn btn-dark" id="qty-increase"> + </button>
                            </div>
                            @auth
                                <div class="cekout-btn">
                                    <div class="btn btn-dark addTocart" xid="{{ $product->id }}" style="width:250px"> Order Now
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('login-user') }}">
                                    <div class="cekout-btn">
                                        <div class="btn btn-dark addTocart" style="width:250px"> Order Now </div>
                                    </div>
                                </a>

                            @endauth

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section pt-5 mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="lebel-header-section-product bg-dark d-flex align-items-center justify-content-between p-2 mb-3">
                        <div>Top Products</div>
                    </div>
                    <div class="row product-section px-5">
                        @foreach ($topProduct as $pro)
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
                                            <div class="price-product cl-dark">Rp.
                                                {{ number_format($pro->harga, 0, ',', '.') }}
                                            </div>
                                            <div class="btn action-cart">
                                                <div class="cart-detail">
                                                    <a href="{{ route('detail-product', $pro->slug) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" fill="black" class="bi bi-cart-fill"
                                                            viewBox="0 0 16 16">
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
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var qtyValue = document.getElementById('qty-value-input');
            var btnDecrease = document.getElementById('qty-decrease');
            var btnIncrease = document.getElementById('qty-increase');

            btnDecrease.addEventListener('click', function() {
                var curentValue = parseInt(qtyValue.value, 10);
                if (curentValue > 1) {
                    qtyValue.value = curentValue - 1;
                }
            });

            btnIncrease.addEventListener('click', function() {
                var curentValue = parseInt(qtyValue.value, 10);
                qtyValue.value = curentValue + 1;

            });
        });

        $('.cekout-btn .addTocart').on('click', function() {
            var xid = $(this).attr('xid');
            addToCart(xid);
        });



        function addToCart(id) {
            var qty = $('.qty-control .qty-input').val();
            var id_warna = $('.varian-warna .color.active').attr('xid');
            var warna = $('.varian-warna .color.active').text();
            var id_ukuran = $('.varian-ukuran .size.active').attr('xid');
            var ukuran = $('.varian-ukuran .size.active').text();


            var postData = {
                _token: "{{ csrf_token() }}",
                id: id,
                qty: qty,
                id_ukuran: id_ukuran,
                ukuran: ukuran,
                id_warna: id_warna,
                warna: warna
            }

            console.log(postData);

            $.post('{{ route('addToCart') }}', postData).done(function(data) {
                if (data.success == 0) {
                    console.log('add to cart successfully');
                    alert(data.message);
                } else {
                    $(this).attr('data-notify', data['count']);
                    location.reload();
                    console.log(postData)
                }
            }).fail(function(data) {
                console.log('error', data)
            });


        }

        function btnActiveOption(button, type) {
            button.classList.toggle('active');

            if (type == 'color') {
                var buttons = document.querySelectorAll('.varian-warna .color');
            } else {
                var buttons = document.querySelectorAll('.varian-ukuran .size');
            }

            for (var i = 0; i < buttons.length; i++) {
                if (buttons[i] !== button) {
                    buttons[i].classList.remove('active');
                }
            }
        }
    </script>
@endsection
