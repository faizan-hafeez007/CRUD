@extends('dashboard')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

{{-- create product --}}
{{-- @include('profile.dashboard') --}}
<div class="row">
    <div class="col-md-6">
        <h1><a href="/admin/product">ALL Products</a></h1>
        <div class="container">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show auto-hide" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="row-md-6 d-flex justify-content-between align-items-center">
            <form method="GET" action="{{ url('/admin/product') }}" class="d-flex position-relative">
                <input type="text" class="form-control" id="search" name="search" placeholder="Enter text to search" style="width: 300px;">
                <button type="submit" class="btn btn-primary position-absolute top-0 end-0" style="height: 38px;">Search</button>
            </form>
            <a href="/admin/product/create" type="button" class="btn btn-info" data-mdb-ripple-init>Create Product</a>
        </div>
    </div>
    {{-- products table --}}
    <div class="row">
        <div class="col-md-14 ">
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table text-center ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">quantity</th>
                            <th scope="col">Category</th>
                            <th scope="col">image</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td><img src="{{asset('storage/products/'. $product->image) }}" alt="Product Image"
                                    style="width:50px; height:50px; border-radius: 50%; border: 2px solid #333;">
                            </td>

                            <td>{{ $product->description }}</td>
                            <td>
                                <div class="d-flex flex-row bd-highlight">
                                    <a href="{{ url('/admin/product/edit', $product->id) }}">
                                        <button type="button" class="btn btn-success me-4 ">Edit</button>
                                    </a>
                                    <form method="post" action="{{ url('/admin/product/delete', $product->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<!-- Add this script at the end of your HTML, just before the </body> tag -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var autoHideElements = document.querySelectorAll('.auto-hide');
            autoHideElements.forEach(function(element) {
                element.style.display = 'none';
            });
        }, 3000); // 3000 milliseconds (3 seconds)
    });
</script>
@endsection
