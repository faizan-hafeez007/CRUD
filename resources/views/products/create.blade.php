@extends('dashboard')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .error {
                color: red;
            }
        </style>
    {{-- create product form --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4 text-light">
                <h1>Create Product Form</h1>
            </div>
            <div class="col-md-12 pt-4 text-light">
                <form action="/admin/product/store" method="POST" enctype="multipart/form-data" id="myForm"
                    novalidate="novalidate">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control " name="name" id="name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control " name="price" id="price" min="1"
                            value="{{ old('price') }}">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control " name="quantity" id="quantity" min="1"
                            value="{{ old('quantity') }}">
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select " name="category_id" id="category_id">
                            <option value="" disabled>Select a category</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}" {{ old('categary_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control " name="image" id="image"
                            value="{{ old('image') }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control " name="description" id="description">{{ old('description') }}</textarea>
                    </div>
                    <!-- Add remaining fields here -->

                    <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#myForm").validate({
                submitHandler: function(form) {
                    // Disable submit button to prevent multiple submissions
                    $('#submitButton').prop('disabled', true);

                    // Perform form submission
                    form.submit();

                    // Enable the submit button after a delay (e.g., 5 seconds)
                    setTimeout(function() {
                        $('#submitButton').prop('disabled', false);
                    }, 3000); // Adjust the time delay as needed (in milliseconds)
                },
                focusInvalid: false,
                invalidHandler: function(form, validator) {
                    if (!validator.numberOfInvalids())
                        return;

                    // Scroll to the label associated with the first invalid field
                    $('html, body').animate({
                        scrollTop: $(validator.errorList[0].element).closest('.mb-3').find(
                            'label').offset().top
                    }, 50);
                },
                rules: {
                    name: "required",
                    price: "required",
                    quantity: "required",
                    category_id: "required",
                    image: "required",
                    description: "required",
                },
                messages: {
                    name: "Please enter Name",
                    price: "Please enter Price",
                    quantity: "Please enter Quantity",
                    category_id: "Please select Category",
                    image: "Please select Image",
                    description: "Please enter Description",
                },
                errorPlacement: function(error, element) {
                    if ($('.alert.alert-danger').length === 0) {
                        $('#myForm').prepend('<div class="alert alert-danger">' + error.text() +
                            '</div>');
                    }
                    if (element.is(":radio")) {
                        var label = $("label[for='" + element.attr('id') + "']");
                        error.insertBefore(label);
                    } else {
                        error.insertBefore(element);
                    }
                },
            });
        });
    </script>

@endsection
