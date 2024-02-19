@extends('dashboard')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- create Category --}}
    <div class="container">
        <div class="row">
            <div class="col-md-6 pt-4 text-dark">
                <h1>Category</h1>
            </div>
            <div class="col-md-6 pt-4">
                <a href="/admin/category/create" type="button" class="btn btn-primary">Create Category</a>
            </div>
        </div>
        {{-- Category table --}}

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="d-flex flex-row bd-highlight">
                                        <a href="{{ url('/admin/category/edit', $category->id) }}">
                                            <button type="button" class="btn btn-success me-4 ">Edit</button>
                                        </a>
                                        <form method="post" action="{{ url('/admin/category/delete', $category->id) }}"
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
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection
