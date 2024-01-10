@extends('dashboard')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- create product form --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h1>Create Product Form</h1>
            </div>
            <div class="col-md-12 pt-4">
                <form action="/admin/product/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ old('name') }}">
                        @error('name')
                            <div id="nameError" class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                            id="price" min="1" value="{{ old('price') }}">
                        @error('price')
                            <div id="priceError" class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                            id="quantity" min="1" value="{{ old('quantity') }}">
                        @error('quantity')
                            <div id="quantityError" class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select @error('category') is-invalid @enderror" name="category_id"
                            id="category_id">
                            <option value="" disabled>Select a category</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}" {{ old('categary_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category')
                            <div id="categoryError" class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                            id="image" value="{{ old('image') }}">
                        @error('image')
                            <div id="imageError" class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div id="descriptionError" class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        //disable the form submission to once at a time
        $('form').submit(function() {
            $(this).find(':submit').attr('disabled', 'disabled');
        });

        $(document).ready(function() {
            // Name validation
            $('#name').on('input', function() {
                var input = $(this);
                var is_name = input.val();
                if (is_name) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    $('#nameError').hide();
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    $('#nameError').show().text("Name is required.");
                }
            });

            // Price validation
            $('#price').on('input', function() {
                var input = $(this);
                var is_price = input.val();
                var errorContainer = $(
                    '#priceError');

                if (is_price && is_price > 0) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide();
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Price is required and must be greater than 0.");
                }
            });



            // Quantity validation
            $('#quantity').on('input', function() {
                var input = $(this);
                var is_quantity = input.val();
                var errorContainer = $(
                    '#quantityError');

                if (is_quantity && is_quantity > 0) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide();
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Quantity is required and must be greater than 0.");
                }
            });

            // Image validation
            $('#image').on('change', function() {
                var input = $(this);
                var is_image = input.val();
                var errorContainer = $(
                    '#imageError');

                if (is_image) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide();
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Image is required.");
                }
            });
            // Category validation
            $('#category').on('change', function() {
                var input = $(this);
                var is_category = input.val();
                var errorContainer = $('#categoryError');

                if (is_category && is_category !== '') {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide();
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Category is required.");
                }
            });
            // Description validation
            $('#description').on('input', function() {
                var input = $(this);
                var is_description = input.val();
                var errorContainer = $(
                    '#descriptionError');

                if (is_description) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide();
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Description is required.");
                }
            });
        });
    </script>
@endsection
