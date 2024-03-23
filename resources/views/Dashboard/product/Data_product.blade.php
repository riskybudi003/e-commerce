@extends('Dashboard.layoute.masterLayoute')
@section('content')
    <div class="page-heading">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Product</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Products</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <p>Data Products</p>
                    <a href="{{ route('create-product') }}" class="btn btn-primary">Create Product</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        @php
                            $no = 1;
                        @endphp
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $pro)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <div class="product d-flex gap-3">
                                            <p class="name-product">{{ $pro->name }}</p>
                                            <div class="img-product" style="width: 200px; height: 120px;">
                                                <img src="{{ asset('assets/images/product/' . $pro->image) }}"
                                                    alt="" class="image-product" width="100%" height="100%"
                                                    style="object-fit:contain">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        Rp. {{ number_format($pro->harga, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ $pro->category->name }}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <div class="btn btn-success block" data-bs-toggle="modal"
                                                data-bs-target="#default-{{ $pro->id }}">Detail</div>
                                            <a href="{{ route('edit-product', encrypt($pro->id)) }}"
                                                class="btn btn-warning">Edit</a>
                                            <a href="{{ route('delete-product', encrypt($pro->id)) }}"
                                                class="btn btn-danger">Hapus</a>
                                        </div>


                                        <!--Basic Modal -->
                                        <div class="modal fade text-left" id="default-{{ $pro->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1">
                                                            Detail Product
                                                        </h5>
                                                        <button type="button" class="close rounded-pill"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="detail-product">
                                                            <div class="row">
                                                                <div class="data-product d-flex gap-4">
                                                                    <label for="" style="width: 50%">Name
                                                                        Product</label>
                                                                    <div class="dt-product">: {{ $pro->name }}</div>
                                                                </div>
                                                                <div class="data-product d-flex gap-4">
                                                                    <label for="" style="width: 50%">Category
                                                                        Product</label>
                                                                    <div class="dt-product">: {{ $pro->category->name }}
                                                                    </div>
                                                                </div>
                                                                <div class="data-product d-flex gap-4">
                                                                    <label for="" style="width: 50%">Price
                                                                        Product</label>
                                                                    <div class="dt-product">: Rp.
                                                                        {{ number_format($pro->harga, 0, ',', '.') }}</div>
                                                                </div>
                                                                <div class="data-product d-flex gap-4">
                                                                    <label for="" style="width: 50%">Color
                                                                        Product</label>
                                                                    <div class="dt-product">:
                                                                        <ul>
                                                                            @foreach ($pro->warna as $color)
                                                                                <li>{{ $color->name }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="data-product d-flex gap-4">
                                                                    <label for="" style="width: 50%">Size
                                                                        Product</label>
                                                                    <div class="dt-product">:
                                                                        <ul>
                                                                            @foreach ($pro->ukuran as $size)
                                                                                <li>{{ $size->ukuran }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>

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
