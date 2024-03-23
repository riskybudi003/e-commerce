@extends('Dashboard.layoute.masterLayoute')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Order</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Order</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <p>Data Order</p>

                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        @php
                            $no = 1;
                        @endphp
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Order</th>
                                <th>Customer Name</th>
                                <th>Total Order</th>
                                <th>Status Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $order)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $order->kode_order }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal-{{ $order->id }}">Detail</a>
                                            <a href="{{ route('invoice', encrypt($order->id)) }}"
                                                class="btn btn-primary">Invoice</a>
                                            <a href="{{ route('delete-order', encrypt($order->id)) }}"
                                                class="btn btn-danger">Delete</a>

                                            <div class="modal fade" id="exampleModal-{{ $order->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" style="width:718px; max-width:800px">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Order
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="content detail-order mb-4">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="data-customer d-flex gap-3">
                                                                            <label for="" style="width:50%">Customer
                                                                                Name</label>
                                                                            <div class="dt-customer">:
                                                                                {{ $order->user->name }}</div>
                                                                        </div>
                                                                        <div class="data-customer d-flex gap-3">
                                                                            <label for=""
                                                                                style="width:50%">Phone</label>
                                                                            <div class="dt-customer">:
                                                                                {{ $order->user->no_hp }}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="data-customer d-flex gap-3">
                                                                            <label for=""
                                                                                style="width:50%">Address</label>
                                                                            <div class="dt-customer">:
                                                                                {{ $order->user->alamat }}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <table class="table w-100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product</th>
                                                                        <th>Qty</th>
                                                                        <th>Price</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($order->details as $detail)
                                                                        <tr>
                                                                            <td>
                                                                                <p class="cl-dark">
                                                                                    {{ $detail->product->name }}</p>

                                                                                <div class="variasi">
                                                                                    <div
                                                                                        class="var-pro-detail d-flex gap-3">
                                                                                        <label for="">Color</label>
                                                                                        <div class="dt-var">:
                                                                                            {{ $detail->warna->name }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="var-pro-detail d-flex gap-3">
                                                                                        <label for="">Size</label>
                                                                                        <div class="dt-var">:
                                                                                            {{ $detail->ukuran->ukuran }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>{{ $detail->qty }}</td>
                                                                            <td>Rp.
                                                                                {{ number_format($detail->harga_product, 0, ',', '.') }}
                                                                            </td>
                                                                            <td>Rp.
                                                                                {{ number_format($detail->total_item, 0, ',', '.') }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal"
                                                                xid="{{ $order->id }}">Close</button>
                                                            @if ($order->status == 'OnProses')
                                                                <button type="button" class="btn btn-primary approve"
                                                                    data-bs-dismiss="modal"
                                                                    xid="{{ $order->id }}">Approve</button>
                                                            @elseif($order->status == 'Order Approve')
                                                                <button type="button" class="btn btn-primary finish"
                                                                    data-bs-dismiss="modal"
                                                                    xid="{{ $order->id }}">Finish</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
@section('script')
    <script>
        $(() => {
            $('.approve').on('click', function() {
                var id = $(this).attr('xid');
                UpdateStatus(id, 'approve');
            });
            $('.finish').on('click', function() {
                var id = $(this).attr('xid');
                UpdateStatus(id, 'finish');
            });

            function UpdateStatus(id, type) {
                var Url = "{{ route('Approve', '') }}" + '/' + id;

                if (type == 'finish') {
                    var Url = "{{ route('Finish', '') }}" + '/' + id;
                }

                $.ajax({
                    url: Url,
                    method: 'POST',
                    type: 'json',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    }
                }).fail(function(data) {
                    console.log(data);
                });
            }
        })
    </script>
@endsection
