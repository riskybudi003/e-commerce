<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <div class="btn btn-danger print print-invoice mt-3">Print Invoice</div>

        <div class="content-invoice pt-5">
            <div class="row header-invoice">
                <div class="col-md-6">
                    <h3 class="brand-commerce">
                        Mini E-Commerce
                    </h3>
                </div>
                <div class="col-md-6">
                    <div class="detail-customer d-flex gap-4 align-content-end flex-column">
                        <div class="data-customer mb-1 d-flex">
                            <label for="" style="width: 50%">Kode Invoice</label>
                            <div class="dt w-50">:
                                {{ $order->kode_order }}
                            </div>
                        </div>
                        <div class="data-customer mb-1 d-flex">
                            <label for="" style="width: 50%">Customer Name</label>
                            <div class="dt w-50">:
                                {{ $order->user->name }}
                            </div>
                        </div>
                        <div class="data-customer mb-1 d-flex">
                            <label for="" style="width: 50%">Phone</label>
                            <div class="dt w-50">:
                                {{ $order->user->no_hp }}
                            </div>
                        </div>
                        <div class="data-customer mb-1 d-flex">
                            <label for="" style="width: 50%">Address</label>
                            <div class="dt w-50">:
                                {{ $order->user->alamat }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-order">
                <table style="width: 100%">
                    <thead style="border-bottom: 1px solid black; border-top: 1px solid black">
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th style="text-align:end">Price</th>
                            <th style="text-align:end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->details as $detail)
                            <tr style="border-bottom: 1px solid rgb(162, 161, 161)">
                                <td>
                                    <div class="produk-invoice">
                                        <label for="" class="name">{{ $detail->product->name }}</label>
                                        <div class="detail produk">
                                            <div class="var-product d-flex gap-1">
                                                <label for="">UK</label>
                                                <div class="dt-var-pro">{{ $detail->ukuran->ukuran }}</div>
                                            </div>
                                            <div class="var-product d-flex gap-1">
                                                <label for="">Color</label>
                                                <div class="dt-var-pro">{{ $detail->warna->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $detail->qty }}</td>
                                <td style="text-align: end">Rp. {{ number_format($detail->harga_product, 0, ',', '.') }}
                                </td>
                                <td style="text-align: end">Rp. {{ number_format($detail->total_item, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="footer-tabel border-bottom mt-1 d-flex flex-column align-items-end">
                    <div class="total-invoice d-flex gap-3" style="width:30%">
                        <label for="" style="width: 50%">Total Item</label>
                        <span>:</span>
                        <div class="dt-total text-end w-50">{{ $count }} Item</div>
                    </div>
                    <div class="total-invoice d-flex gap-3" style="width:30%">
                        <label for="" style="width: 50%"> SubTotal</label>
                        <span>:</span>
                        <div class="dt-total text-end w-50">Rp. {{ number_format($order->sub_total, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="total-invoice d-flex gap-3" style="width:30%">
                        <label for="" style="width: 50%">Grand Total</label>
                        <span>:</span>
                        <div class="dt-total text-end w-50">Rp. {{ number_format($order->total, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('.print-invoice').on('click', function() {
                invoicePrint();
            });

            function invoicePrint() {
                var style = document.createElement('style');
                style.innerHTML = '@media print { .content-invoice { display:block; } }';
                document.head.appendChild(style);

                var target = document.createElement('style');
                target.innerHTML = '@media print { .print-invoice{ display:none; } }';
                document.head.appendChild(target);

                window.print();
            }
        });
    </script>
</body>

</html>
