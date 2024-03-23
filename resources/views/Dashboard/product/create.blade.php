@extends('Dashboard.layoute.masterLayoute')
@section('content')
    <section id="multiple-column-form">
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Products</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('post-product') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Name Products</label>
                                            <input type="text" id="first-name-column"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Name Product" name="name">
                                            @error('name')
                                                <small class="is-invalid feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Slug Product</label>
                                            <input type="text" id="last-name-column"
                                                class="form-control @error('slug') is-invalid @enderror" placeholder="Slug"
                                                name="slug">
                                            @error('slug')
                                                <small class="is-invalid feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Category</label>
                                            <select type="text" id="last-name-column"
                                                class="form-control @error('id_category') is-invalid @enderror"
                                                placeholder="id-Category" name="id_category">
                                                <option value=""> --Select Category-- </option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach

                                            </select>
                                            @error('id_category')
                                                <small class="is-invalid feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Price</label>
                                            <input type="text" id="last-name-column"
                                                class="form-control @error('harga') is-invalid @enderror"
                                                placeholder="Price Product" name="harga">
                                            @error('harga')
                                                <small class="is-invalid feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Description Product</label>
                                            <textarea type="text" id="last-name-column" class="form-control @error('deskripsi') is-invalid @enderror"
                                                placeholder="Product-Description" name="deskripsi"></textarea>
                                            @error('deskripsi')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Image Product</label>
                                            <input type="file" id="last-name-column"
                                                class="form-control @error('image') is-invalid @enderror"
                                                placeholder="Product Image" name="image" />
                                            @error('image')
                                                <small class="is-invalid feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="last-name-column">Color</label>
                                            <div class="btn btn-primary color">Add Color++</div>
                                        </div>
                                        <div class="varian-color mt-3">

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Size</label>
                                            <div class="btn btn-primary size">Add Size+</div>
                                        </div>
                                        <div class="varian-size mt-3">

                                        </div>
                                    </div>


                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(() => {
            var idxColor = 0;
            var idxSize = 0;

            $('.btn.color').on('click', function() {
                idxColor++;
                addColor(idxColor);
            });
            $('.btn.size').on('click', function() {
                idxSize++;
                addSize(idxSize);
            });

            $('body').on('click', '.item-color', function() {
                var id = $(this).attr('xid');
                removeColor(id);
            })

            $('body').on('click', '.item-size', function() {
                var id = $(this).attr('xid');
                removeSize(id);
            })


            function addColor(xid) {

                var $form = $('.card-body .form');
                var $target = $form.find('.varian-color');

                $target.append(
                    `<div class="itm-color" xid="${xid}">
                <div class="btn btn-danger item-color" xid="${xid}"><i class="bi bi-trash"></i></div>
                <input type="text" class="form-control @error('name
                ') is-invalid @enderror" name="color[${xid}][name]" xid="${xid}">

                @error('name')
                <small class="is-invalid feedback">{{ $message }}</small>
                @enderror
                </div>`
                );
            }

            function addSize(xid) {

                var $form = $('.card-body .form');
                var $target = $form.find('.varian-size');

                $target.append(
                    `<div class="itm-size" xid="${xid}">
                <div class="btn btn-danger item-size" xid="${xid}"><i class="bi bi-trash"></i></div>
                <input type="text" class="form-control @error('ukuran
                ') is-invalid @enderror" name="size[${xid}][ukuran]" xid="${xid}">

                @error('ukuran')
                <small class="is-invalid feedback">{{ $message }}</small>
                @enderror
                </div>`
                );
            }

            function removeColor(id) {
                var $form = $('.card-body .form');
                var $target = $form.find('.varian-color');
                $target.find('.itm-color[xid="' + id + '"]').remove();
            }

            function removeSize(id) {
                var $form = $('.card-body .form');
                var $target = $form.find('.varian-size');
                $target.find('.itm-size[xid="' + id + '"]').remove();
            }

        });
    </script>
@endsection
