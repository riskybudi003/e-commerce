@extends('User.layout.masterLayout')
@section('title', 'Cart')
@section('content')

    <div class="section">
        <div class="content-detail-cart py-5">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <h2 class="cl-dark mb-4">Your Cart</h2>
                    <div class="data-cart">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $k => $cart)
                                    <tr class="item-cart">
                                        <td>
                                            <div class="data-product">
                                                <p class="cl-dark">{{ $cart['name'] }}</p>
                                                <div class="img image-pro-cart"
                                                    style="width: 200px;
                                                height: 200px;">
                                                    <img src="{{ asset('assets/images/product/' . $cart['image']) }}"
                                                        alt="" class="img-fluid"
                                                        style="object-fit: cover;
                                                        height: 100%;">
                                                </div>
                                                <div class="varian d-flex gap-3 mt-3">
                                                    <div class="varian-color">
                                                        <label for="">Color</label>
                                                        <div class="dt-color var">: {{ $cart['warna'] }}</div>
                                                    </div>
                                                    <div class="varian-size">
                                                        <label for="">Size</label>
                                                        <div class="dt-color var">: {{ $cart['ukuran'] }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $cart['qty'] }}</td>
                                        <td>Rp. {{ number_format($cart['harga'], 0, ',', '.') }}</td>
                                        @php
                                            $total = 0;
                                            $total = $cart['qty'] * $cart['harga'];
                                        @endphp
                                        <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                                        <td>

                                            <div class="delete" xid={{ $k }}>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="black" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg>
                                            </div>


                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 pt-5 mt-5">
                    <div class="cart border">
                        <div class="content-card card-body">
                            <div class="total d-flex justify-content-between">
                                <div class="lebel-total-cart">
                                    Total Item
                                </div>
                                <div class="lebel-total-cart">
                                    @if (Session::has('cart'))
                                        {{ count(Session::get('cart')) }}
                                    @else
                                        0
                                    @endif Item
                                </div>
                            </div>

                            <div class="total d-flex justify-content-between">
                                <div class="lebel-total-cart">
                                    SubTotal
                                </div>
                                <div class="lebel-total-cart subtotal" data="{{ $subtotal }}">
                                    Rp. {{ number_format($subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                            <hr>
                            <div class="total d-flex justify-content-between">
                                <div class="lebel-total-cart">
                                    Total
                                </div>
                                <div class="lebel-total-cart total" data="{{ $subtotal }}">
                                    Rp. {{ number_format($subtotal, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="btn btn-dark cekout w-100 mt-3">Cekout</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(() => {
            $('.delete').on('click', function() {
                var id = $(this).attr('xid');
                var $elm = $(this).parents('.item-cart');
                var konfirmasi = confirm('Are you sure want to remove from cart?');
                if (konfirmasi) {
                    deleteItemCart(id, $elm);
                }
            });

            $('.cekout').on('click', function() {
                Cekout();
            })

            function Cekout() {
                var subtotal = $('.lebel-total-cart.subtotal').attr('data');
                var total = $('.lebel-total-cart.total').attr('data');

                var postData = {
                    _token: "{{ csrf_token() }}",
                    subtotal: subtotal,
                    total: total,
                };

                $.post('{{ route("cekout") }}', postData).done(function(data) {
                    console.log(data);
                    alert('Your Order Success');
                    location.reload();
                }).fail(function(err) {
                    console.log(err);
                    alert('Order Fail');
                });
            }



            function deleteItemCart(id, $elm) {
                var postData = {
                    _token: "{{ csrf_token() }}",
                    id: id
                };

                $.post('{{ route('delete-Item-Cart') }}', postData).done(function(data) {
                    if (data.success === 0) {
                        alert(data.message);
                    } else {
                        $(this).attr('data-notify', data['count']);
                        $elm.remove();
                        location.reload();
                    }
                }).fail(function(data) {
                    console.log('error', data)
                });
            }
        });
    </script>
@endsection
