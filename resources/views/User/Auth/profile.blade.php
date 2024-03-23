@extends('User.layout.masterLayout')
@section('title', 'Profile-User')
@section('content')
    <div class="section-profile">
        @if (session()->has('Success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('Failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('Failed') }}
            </div>
        @endif
        <div class="header-profile d-flex gap-5 align-items-center">
            <div class="col-lg-3 col-sm-12">
                <div class="image-profile" style="height: 200px; width: 200px;">
                    @if ($User->image === null)
                        <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="" class="img-fluid"
                            style="border-radius:100px">
                    @else
                        <img src="{{ asset('assets/images/profile_user/' . $User->image) }}" alt=""
                            class="img-fluid" style="border-radius: 100px">
                    @endif

                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="data-user">
                    <label for="" class="cl-dark">{{ $User->name }}</label>
                    <div class="cl-grey mb-2">{{ $User->no_hp }}</div>
                    <div class="cl-grey mb-2">{{ $User->email }}</div>
                    <div class="cl-grey mb-2">{{ $User->alamat }}</div>
                </div>
            </div>
        </div>
        <div class="pannel-profile pt-5 border-bottom">
            <div class="list-pannel d-flex gap-3 mb-3 mt-3">
                <div class="btn btn-dark box-panel" order="1" target="panel1">Update Data</div>
                <div class="btn btn-dark box-panel" order="2" target="panel2">History Order</div>
                <a href="{{ route('logout-user') }}" class="btn btn-dark">Logout</a>
            </div>
        </div>

        <div class="tab-panel">
            <div class="panel mt-4" data-panel="panel1" panel-order="1" style="display:block">
                <h4 class="cl-dark">Update Profile</h4>
                <form action="{{ route('update-user', $User->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" name="name"
                            class="form-control form-control-xl @error('name') is-invalid @enderror" placeholder="Your Name"
                            value="{{ $User->name }}">

                        @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" name="email"
                            class="form-control form-control-xl @error('email') is-invalid @enderror"
                            placeholder="Your email" value="{{ $User->email }}">

                        @error('email')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="number" name="no_hp"
                            class="form-control form-control-xl @error('no_hp') is-invalid @enderror"
                            placeholder="Your telephone number" value="{{ $User->no_hp }}">

                        @error('no_hp')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <textarea type="text" name="alamat" class="form-control form-control-xl @error('alamat') is-invalid @enderror"
                            placeholder="Your address">{{ $User->alamat }}</textarea>

                        @error('alamat')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="file" name="image"
                            class="form-control form-control-xl @error('image') is-invalid @enderror"
                            placeholder="Your Image" value="{{ $User->image }}">

                        @error('image')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark">Update Data</button>
                </form>
            </div>
            <div class="panel mt-4" data-panel="panel2" panel-order="2">
                <h4 class="cl-dark">History Order</h4>
                <div class="content-history d-flex flex-grow gap-3">
                    @foreach ($orders as $order)
                        <div class="card p-3">
                            <div class="body-card">
                                <div class="dt-order d-flex gap-3">
                                    <label for="">Kode Order</label>
                                    <div class="text-dt">: {{ $order->kode_order }}</div>
                                </div>
                                <div class="dt-order d-flex gap-3">
                                    <label for="">Total Order</label>
                                    <div class="text-dt">: Rp. {{ number_format($order->total, 0, `,`, `.`) }}</div>
                                </div>
                                <div class="dt-order d-flex gap-3">
                                    <label for="">Status</label>
                                    <div class="text-dt">: {{ $order->status }}</div>
                                </div>
                            </div>
                            <div class="footer-card text-end mb-4">
                                <div class="btn btn-dark detail" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal-{{ $order->id }}">
                                    Detail Order</div>
                            </div>
                            <div class="modal fade" id="exampleModal-{{ $order->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Order</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
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
                                                                <p class="cl-dark">{{ $detail->product->name }}</p>
                                                                <div class="image-pro-detail"
                                                                    style="width: 150px; height: 120px;">
                                                                    <img src="{{ asset('assets/images/product/' . $detail->product->image) }}"
                                                                        alt="" class="img-fluid"
                                                                        style="height: 100%; border-radius:10px">
                                                                </div>
                                                                <div class="variasi">
                                                                    <div class="var-pro-detail d-flex gap-3">
                                                                        <label for="">Color</label>
                                                                        <div class="dt-var">: {{ $detail->warna->name }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="var-pro-detail d-flex gap-3">
                                                                        <label for="">Size</label>
                                                                        <div class="dt-var">:
                                                                            {{ $detail->ukuran->ukuran }}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $detail->qty }}</td>
                                                            <td>Rp.
                                                                {{ number_format($detail->harga_product, 0, ',', '.') }}
                                                            </td>
                                                            <td>Rp. {{ number_format($detail->total_item, 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
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
@endsection
@section('script')
    <script>
        $(() => {
            $('.box-panel').on('click', function() {
                var target = $(this).attr('target');
                $('.boxpanel').removeClass('active-panel');
                $(this).addClass('active-panel');

                $('.panel').hide();
                $(`.panel[data-panel="${target}"]`).show();
            })
        });
    </script>

@stop
