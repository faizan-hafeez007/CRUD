<!-- lender.blade.php -->

@extends('dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    #regName[readonly] {
        background-color: #f8f9fa; /* Use a color that indicates readonly */
        border: 1px solid #dee2e6; /* Add a border for better visibility */
    }
</style>

<div class="container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show auto-hide" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 mt-4 text-dark">
            <h1>Vehicle Details</h1>
        </div>
        <div class="col-md-12 pt-4 text-dark">
            <form action="/admin/vehicle/store" method="POST" enctype="multipart/form-data" id="vehicleForm" novalidate="novalidate">
                @csrf
                <div class="mb-3">
                    <label for="ownerName" class="form-label">Owner Name</label>
                    <input type="text" class="form-control" name="ownerName" id="ownerName">
                </div>
                <div class="mb-3">
                    <label for="regName" class="form-label">Reg Name</label>
                    <input type="text" class="form-control" value="{{ $reg_name }}" readonly>
                    <input type="hidden" class="form-control" name="reg_id" value="{{ $reg_id }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="carModel" class="form-label">Car Model</label>
                    <input type="text" class="form-control" name="carModel" id="carModel">
                </div>

                <div class="mb-3">
                    <label for="vehicleCount" class="form-label">Vehicle Count</label>

                    <div class="d-flex flex-row">
                        <div class="form-check flex-grow-1">
                            <input class="form-check-input" type="radio" name="vehicleCount" id="vehicleCount1" value="1" {{ old('vehicleCount') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="vehicleCount1">One</label>
                        </div>

                        <div class="form-check flex-grow-1">
                            <input class="form-check-input" type="radio" name="vehicleCount" id="vehicleCount2" value="2" {{ old('vehicleCount') == '2' ? 'checked' : '' }}>
                            <label class="form-check-label" for="vehicleCount2">Two</label>
                        </div>

                        <div class="form-check flex-grow-1">
                            <input class="form-check-input" type="radio" name="vehicleCount" id="vehicleCount3" value="3" {{ old('vehicleCount') == '3' ? 'checked' : '' }}>
                            <label class="form-check-label" for="vehicleCount3">Three</label>
                        </div>
                        <div class="form-check flex-grow-1">
                            <input class="form-check-input" type="radio" name="vehicleCount" id="vehicleCount5" value="5" {{ old('vehicleCount') == '5' ? 'checked' : '' }}>
                            <label class="form-check-label" for="vehicleCount5">Five</label>
                        </div>
                        <div class="form-check flex-grow-1">
                            <input class="form-check-input" type="radio" name="vehicleCount" id="vehicleCount10" value="10" {{ old('vehicleCount') == '10' ? 'checked' : '' }}>
                            <label class="form-check-label" for="vehicleCount5">Ten</label>
                        </div>
                    </div>
                </div>
                <button type="submit" id="submitButton" class="btn btn-primary">Next</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $("#vehicleForm").validate({
            focusInvalid: false,
            invalidHandler: function(form, validator) {
                if (!validator.numberOfInvalids()) return;
                $('html,body').animate({
                    scrollTop: $(validator.errorList[0].element).closest('.mb-3').find('label').offset().top
                }, 50);
            },
            rules: {
                ownerName: "required",
                carModel: "required",
                vehicleCount: "required"
            },
            messages: {
                ownerName: "Please enter Owner Name",
                carModel: "Please enter Car Model",
                vehicleCount: "Please select Vehicle Count"
            },
            errorClass: "is-invalid",
            validClass: "is-valid",
            errorPlacement: function(error, element) {
                if ($('.alert.alert-danger').length === 0) {
                    $('#vehicleForm').prepend('<div class="alert alert-danger">' + error.text() + '</div>');
                }
                if (element.is(":radio")) {
                    var label = $("label[for='" + element.attr('id') + "']");
                    error.insertBefore(label);
                } else {
                    error.insertBefore(element);
                }
            },
            submitHandler: function(form) {
                // disable submit button
                $('#submitButton').prop('disabled', true);
                form.submit();

                // Enable the submit button again
                setTimeout(function() {
                    $('#submitButton').prop('disabled', false);
                }, 3000);
            }
        });

        // Hide the success message
        setTimeout(function() {
            $('.alert.alert-success').fadeOut('slow');
        }, 3000);
    });
</script>
@endsection
