@extends('dashboard')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
{{-- create Category form --}}
<div class="container">
    <div class="row text-dark">
        <div class="col-md-12 mt-4">
            <h1>Create Category Form</h1>
        </div>
        <div class="col-md-12 pt-4">
            <form action="/admin/category/store" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
{{-- <script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            $('.alert').remove();

            // Disable the submit button to prevent Mutiple Submission
            let submitButton = $(this).find(':submit');
            submitButton.attr('disabled', 'disabled');
            setTimeout(function() {
                submitButton.removeAttr('disabled');
            }, 2000);
            // Validations
            let name = $('#name').val();
            let price = $('#price').val();
            let quantity = $('#quantity').val();
            let category_id = $('#category_id').val();
            let image = $('#image').val();
            let description = $('#description').val();
            let errorMessage = '';

            if (name === '') {
                errorMessage = 'Name is required';
            } else if (price === '') {
                errorMessage = 'Price is required';
            } else if (quantity === '') {
                errorMessage = 'Quantity is required';
            } else if (category_id === '') {
                errorMessage = 'Category is required';
            } else if (image === '') {
                errorMessage = 'Image is required';
            } else if (description === '') {
                errorMessage = 'Description is required';
            }

        });

        // Validate each field on change
        $('#name, #price, #quantity ,#category_id,#description,#image').on('input', function() {
            $('.alert').remove();
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            $('.alert').remove();

            // Disable the submit button
            var submitButton = $(this).find(':submit');
            submitButton.attr('disabled', 'disabled');

            // Set a timeout to enable the button after 2 seconds
            setTimeout(function() {
                submitButton.removeAttr('disabled');
            }, 2000);

            // Validation logic goes here
            var name = $('#name').val();
            var price = $('#price').val();
            var quantity = $('#quantity').val();
            var category_id = $('#category_id').val();
            var image = $('#image').val();
            var description = $('#description').val();
            var errorMessage = '';

            if (name === '') {
                errorMessage = 'Name is required';
            } else if (price === '') {
                errorMessage = 'Price is required';
            } else if (quantity === '') {
                errorMessage = 'Quantity is required';
            } else if (category_id === '') {
                errorMessage = 'Category is required';
            } else if (image === '') {
                errorMessage = 'Image is required';
            } else if (description === '') {
                errorMessage = 'Description is required';
            }

            // If there is an error, scroll to the top and display the error message
            if (errorMessage !== '') {
                $('html, body').animate({
                    scrollTop: $('#myForm').offset().top
                }, 500);
                $('#myForm').prepend('<div class="alert alert-danger">' + errorMessage + '</div>');
            } else {
                // If no errors, submit the form
                $('#myForm')[0].submit();
            }
        });

        // Validate each field on change
        $('#name, #price, #quantity').on('input', function() {
            // Clear the general error message
            $('.alert').remove();
        });
    });
</script>


@endsection
