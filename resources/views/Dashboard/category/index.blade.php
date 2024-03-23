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
                    <h3>Data Category</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <p>Data Category</p>
                    <a href="{{ route('from-create-cat') }}" class="btn btn-primary">Create Category</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        @php
                            $no = 1;
                        @endphp
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $cat)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('edit-category', encrypt($cat->id)) }}"
                                                class="btn btn-success">Edit</a>
                                            <a href="{{ route('delete-category', encrypt($cat->id)) }}"
                                                class="btn btn-danger">Delete</a>
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
