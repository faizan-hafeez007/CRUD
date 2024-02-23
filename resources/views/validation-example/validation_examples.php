<!--Regeneration edit.blade.php -->

@extends('backend.layouts.app')
@section('content')
    <style>
        .tag-wrap span.tag-label {
            background: rgba(135, 129, 189, 0.3);
            border-radius: 3px;
            padding: 4px 11px;
            margin: 2px 2px;
            font-size: 14px;
            color: #000;
            text-align: center;
            display: inline-block;
            cursor: pointer;
        }
    </style>
<div class="content-wrapper dashboard-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <h4 class="card-title">Edit Leads</h4>
                        @if (isset($lead))
                            <form class="form-sample" id="regenerateForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="title" class="">Title</label>
                                            <div class="">
                                                <input type="text" name="title" id="title"
                                                    value="{{ old('title', $lead->title) }}" class="form-control"
                                                    placeholder="Enter title" onkeypress="return /[a-zA-Z]/.test(event.key)"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')" />
                                                <span id="titleError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="first_name" class="">First Name</label>
                                            <div class="">
                                                <input type="text" name="first_name" id="first_name"
                                                    value="{{ old('first_name', $lead->first_name) }}" class="form-control"
                                                    placeholder="Enter first name"
                                                    onkeypress="return /[a-zA-Z\s]/.test(event.key)"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
                                                <span id="first_nameError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="last_name" class="">Last Name</label>
                                            <div class="">
                                                <input type="text" name="last_name" id="last_name"
                                                    value="{{ old('last_name', $lead->last_name) }}" class="form-control"
                                                    placeholder="Enter last name"
                                                    onkeypress="return /[a-zA-Z\s]/.test(event.key)"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
                                                <span id="last_nameError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="email" class="">Email</label>
                                            <div class="">
                                                <input type="text" name="email" id="email"
                                                    value="{{ old('email', $lead->email) }}" class="form-control"
                                                    placeholder="Enter email" />
                                                <span id="emailError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="partner_first_name" class="">Partner First Name</label>
                                            <div class="">
                                                <input type="text" name="partner_first_name" id="partner_first_name"
                                                    value="{{ $lead->partner_first_name }}" class="form-control"
                                                    placeholder="Enter partner first name"
                                                    onkeypress="return /[a-zA-Z\s]/.test(event.key)"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
                                                <span id="partner_first_nameError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="partner_last_name" class="">Partner Last Name</label>
                                            <div class="">
                                                <input type="text" name="partner_last_name" id="partner_last_name"
                                                    value="{{ $lead->partner_last_name }}" class="form-control"
                                                    placeholder="Enter partner last name"
                                                    onkeypress="return /[a-zA-Z\s]/.test(event.key)"
                                                    oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
                                                <span id="partner_last_nameError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="pps_number" class="">PPS Number</label>
                                            <div class="">
                                                <input type="text" name="pps_number" id="pps_number"
                                                    value="{{ $lead->pps_number }}" class="form-control"
                                                    placeholder="Enter PPS Number" />
                                                <span id="pps_numberError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="partner_pps_number" class="">Partner PPS Number</label>
                                            <div class="">
                                                <input type="text" name="partner_pps_number" id="partner_pps_number"
                                                    value="{{ $lead->partner_pps_number }}" class="form-control"
                                                    placeholder="Enter Partner PPS Number" />
                                                <span id="partner_pps_numberError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="partner_email" class="">Partner Email</label>
                                            <div class="">
                                                <input type="text" name="partner_email" id="partner_email"
                                                    value="{{ $lead->partner_email }}" class="form-control"
                                                    placeholder="Enter partner email" />
                                                <span id="partner_emailError" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="regenerate_btns col-md-12 d-flex justify-content-center">
                                    <button type="submit" id="submitBtn" class="btn btn-primary mb-2">Save</button>
                                    <a href="/admin/regenerate-docs" type=""
                                        class="btn btn-gradient-light btn-fw mb-2" style="margin-left: 10px;">Cancel</a>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {

            // Validation for Partner PPS Number
            function validatePartnerPPSNumber() {
                var input = $('#partner_pps_number');
                var partner_pps_number = input.val();
                var errorContainer = $('#partner_pps_numberError');

                // Check if partner_pps_number is not empty and length is less than 7
                if (partner_pps_number.trim() !== '' && partner_pps_number.length < 7) {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Partner PPS Number should be at least 7 characters long.");
                    return false; // Validation failed
                } else {
                    // No error if input is empty or length is 7 or more
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide().text('');
                    return true; // Validation passed
                }
            }

            // Validation for Title
            function validateTitle() {
                var input = $('#title');
                var is_title = input.val();
                var errorContainer = $('#titleError');

                if (is_title && /^[a-zA-Z\s]*$/.test(is_title)) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide().text('');
                    return true;
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Title is required and should not contain numbers.");
                    return false;
                }
            }

            // Validation for First Name
            function validateFirstName() {
                var input = $('#first_name');
                var is_first_name = input.val();
                var errorContainer = $('#first_nameError');

                if (is_first_name && /^[a-zA-Z\s]*$/.test(is_first_name)) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide().text('');
                    return true;
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("First Name is required and should not contain numbers.");
                    return false;
                }
            }

            // Validation for Last Name
            function validateLastName() {
                var input = $('#last_name');
                var is_last_name = input.val();
                var errorContainer = $('#last_nameError');

                if (is_last_name && /^[a-zA-Z\s]*$/.test(is_last_name)) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide().text('');
                    return true;
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Last Name is required and should not contain numbers.");
                    return false;
                }
            }

            // Validation for Email
            function validateEmail() {
                var input = $('#email');
                var is_email = input.val();
                var errorContainer = $('#emailError');

                if (is_email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(is_email)) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide().text('');
                    return true;
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Enter a valid email address.");
                    return false;
                }
            }

            // Validation for Partner Email
            function validatePartnerEmail() {
                var input = $('#partner_email');
                var is_email = input.val();
                var errorContainer = $('#partner_emailError');

                if (!is_email || (is_email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(is_email))) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide().text('');
                    return true;
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Enter a valid partner email address.");
                    return false;
                }
            }

            // Validation for PPS Number
            function validatePPSNumber() {
                var input = $('#pps_number');
                var is_pps_number = input.val();
                var errorContainer = $('#pps_numberError');

                if (is_pps_number && is_pps_number.length >= 7) {
                    input.removeClass("is-invalid").addClass("is-valid");
                    errorContainer.hide().text('');
                    return true;
                } else {
                    input.removeClass("is-valid").addClass("is-invalid");
                    errorContainer.show().text("Enter a PPS Number minimum length 7.");
                    return false;
                }
            }

            // Submit button click event
            $('#submitBtn').on('click', function() {
                // Validate all fields
                var isValid = validatePartnerPPSNumber() &&
                    validateTitle() &&
                    validateFirstName() &&
                    validateLastName() &&
                    validateEmail() &&
                    validatePartnerEmail() &&
                    validatePPSNumber();

                // If any validation fails, prevent the form submission
                if (!isValid) {
                    return false;
                }
            });

            function bindInputEvents() {
                $('#partner_pps_number').on('input', validatePartnerPPSNumber);
                $('#title').on('input', validateTitle);
                $('#first_name').on('input', validateFirstName);
                $('#last_name').on('input', validateLastName);
                $('#email').on('input', validateEmail);
                $('#partner_email').on('input', validatePartnerEmail);
                $('#pps_number').on('input', validatePPSNumber);
            }
            bindInputEvents();

            $('#regenerateForm').validate({
                submitHandler: function(form) {
                    // Disable submit button to prevent multiple submissions
                    $('button[type="submit"]').prop('disabled', true);
                    // Perform AJAX request
                    $.ajax({
                        url: "{{ route('regenerate-docs-update', ['id' => $lead->id]) }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(data) {
                            if (data.success) {
                                window.location.href = '/admin/regenerate-docs';
                            } else {
                                $.each(data.errors, function(key, value) {
                                    $('#' + key + 'Error').text(value);
                                });
                                $('button[type="submit"]').prop('disabled', false);
                            }
                        },
                        error: function() {
                            $('button[type="submit"]').prop('disabled', false);
                        }
                    });
                },
            });
        });
    </script>
@endpush
