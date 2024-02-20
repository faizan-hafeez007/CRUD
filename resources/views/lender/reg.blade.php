<!-- register.blade.php -->

@extends('dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container h-100 text-dark">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Reg Form</h1>
            <form action="/admin/vehicle/reg/store" method="POST" id="registrationForm">
                @csrf
                <div class="mb-3">
                    <label for="regName" class="form-label">Registration Name</label>
                    <input type="text" class="form-control" id="regName" name="regName" required
                    value="{{ old('regName') }}" placeholder="">
                </div>
                <button type="submit" class="btn btn-primary" id="registerButton">Register</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {

        var regNameInput = $('#regName');
        
        // Set initial value from sessionStorage on page load
        setStoredValue(regNameInput, 'regName');
        // set the value to the input field
        function setStoredValue(element, storageKey) {
            var storedValue = sessionStorage.getItem(storageKey);
            if (storedValue) {
                element.val(storedValue);
            }
        }

        // store the field value in sessionStorage
        function storeValue(element, storageKey) {
            sessionStorage.setItem(storageKey, element.val());
        }
        // Listen for changes in the input field and update sessionStorage
        regNameInput.on('input', function() {
        storeValue(regNameInput, 'regName');
        });
        $('#registrationForm').validate({
            rules: {
                regName: {
                    required: true,
                    // Add additional rules if needed
                }
            },
            messages: {
                regName: {
                    required: "Please enter Registration Name",
                    // Add additional messages if needed
                }
            },
            errorClass: "is-invalid",
            validClass: "is-valid",
            errorPlacement: function(error, element) {
                // Show validation error messages
                error.appendTo(element.closest('.mb-3'));
            },
            success: function(label, element) {
                // Show checkmark for valid fields
                $(element).addClass('is-valid');
            },
            highlight: function(element, errorClass, validClass) {
                // Highlight invalid fields
                $(element).removeClass(validClass).addClass(errorClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                // Remove highlighting and checkmark on valid fields
                $(element).removeClass(errorClass).addClass(validClass);
            },
            submitHandler: function(form) {
                // Disable submit button to prevent multiple form submissions
                $('#registerButton').prop('disabled', true);

                // Submit the form
                form.submit();

                // Enable the submit button again after 3 seconds
                setTimeout(function() {
                    $('#registerButton').prop('disabled', false);
                }, 3000);
            }
        });
    });
</script>

@endsection
