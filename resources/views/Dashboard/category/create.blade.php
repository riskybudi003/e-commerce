@extends('Dashboard.layoute.masterLayoute')
@section('content')
    <section id="multiple-column-form">

        @if (session()->has('Failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('Failed') }}
            </div>
        @endif
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Category</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('post-category') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Name Category</label>
                                            <input type="text" id="first-name-column"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Name Category" name="name">
                                            @error('name')
                                                <small class="is-invalid feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Slug Category</label>
                                            <input type="text" id="last-name-column"
                                                class="form-control @error('slug_category') is-invalid @enderror"
                                                placeholder="Slug-Category" name="slug_category">
                                            @error('slug_category')
                                                <small class="is-invalid feedback">{{ $message }}</small>
                                            @enderror
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
