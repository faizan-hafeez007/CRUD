<!-- show.blade.php -->
@extends('dashboard')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error {
            color: red;
        }

        .is-valid {
            border-color: #198754 !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .checkmark {
            color: #198754;
        }

        .crossmark {
            color: #dc3545;
        }
    </style>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form id="vehicleForm" action="/admin/car/store" method="POST">
            @csrf
            <input type="hidden" id="vehicleCount" value="{{ $vehicleCount }}">
            <table class="table" id="vehicleTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>REG</th>
                        <th>VALUE</th>
                        <th>Lender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control reg" name="reg[]" placeholder="Enter REG"></td>
                        <td><input type="number" class="form-control value" name="value[]" placeholder="Enter VALUE"
                                min="1"></td>
                        <td><input type="text" class="form-control lender" name="lender[]" placeholder="Enter Lender">
                        </td>
                        <td>
                            <input type="hidden" class="form-control" name="reg_id" value="{{ $reg_id }}" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger deleteRow">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary" id="appendRow">Append Row</button>
            <button type="submit" class="btn btn-success" id="sendData">Send</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            var vehicleCount = parseInt($('#vehicleCount').val());
            console.log(vehicleCount);

            // Append vehicleCount rows to the table when the page loads
            for (var i = 1; i < vehicleCount; i++) {
                appendRow();
            }

            $('#appendRow').click(function(e) {
                e.preventDefault();
                appendRow(); // Call the appendRow function when the button is clicked
            });

            function appendRow() {
                var originalRow = $('#vehicleTable tbody tr:first');
                var newRow = originalRow.clone(); // Clone the original row

                // Update input names and placeholders
                newRow.find('input[name^="reg"]').val('').attr('placeholder', 'Enter REG').removeClass(
                    'is-valid is-invalid');
                newRow.find('input[name^="value"]').val('').attr('placeholder', 'Enter VALUE').removeClass(
                    'is-valid is-invalid');
                newRow.find('input[name^="lender"]').val('').attr('placeholder', 'Enter Lender').removeClass(
                    'is-valid is-invalid');

                // Generate a unique ID for the new row
                var newRowId = 'row_' + Date.now();
                newRow.attr('id', newRowId);

                // Update the reg_id field in the new row
                var regId = $('input[name="reg_id"]').val();
                newRow.find('input[name="reg_id"]').val(regId);

                // Append new row to the table
                $('#vehicleTable tbody').append(newRow);

                // Add a delete button to the new row (not to the original row)
                if (newRowId !== 'row_0') {
                    var deleteButton = $('<button type="button" class="btn btn-danger deleteRow">Delete</button>');
                    deleteButton.click(function() {
                        // Check if there's more than one row before removing
                        if ($('#vehicleTable tbody tr').length > 1) {
                            $('#' + newRowId).remove();
                        } else {
                            alert("Cannot delete the only remaining row.");
                        }
                    });
                    newRow.find('td:last').empty().append(deleteButton);
                }
            }

            var table = document.querySelector('table'); // Adjust this selector if needed
            var index = 1;

            // Loop through each row in the tbody
            table.querySelectorAll('tbody tr').forEach(function(row) {
                // Create a new cell for the index and append it to the row
                var cell = document.createElement('td');
                cell.textContent = index++;
                row.insertBefore(cell, row.firstChild);
            });

            // Delete row (excluding the original row)
            $('#vehicleTable').on('click', '.deleteRow', function() {
                if ($('#vehicleTable tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert("Cannot delete the only remaining row.");
                }
            });

            // Validation using jQuery Validate plugin
            $('#vehicleForm').validate({
                rules: {
                    'reg[]': {
                        required: true
                    },
                    'value[]': {
                        required: true,
                        min: 1
                    },
                    'lender[]': {
                        required: true
                    }
                },
                messages: {
                    'reg[]': {
                        required: "Enter REG"
                    },
                    'value[]': {
                        required: "Enter VALUE",
                        min: "VALUE must be greater than or equal to 1"
                    },
                    'lender[]': {
                        required: "Enter Lender"
                    }
                },
                errorPlacement: function(error, element) {
                    // Show validation error messages
                    error.appendTo(element.closest('td'));
                },
                success: function(label, element) {
                    // Show checkmark for valid fields
                    $(element).addClass('is-valid');
                    $(element).closest('td').append('<span class="checkmark">&#10004;</span>');
                },
                highlight: function(element, errorClass, validClass) {
                    // Highlight invalid fields
                    $(element).removeClass(validClass).addClass(errorClass);
                    $(element).closest('td').find('.checkmark').remove();
                },
                unhighlight: function(element, errorClass, validClass) {
                    // Remove highlighting and checkmark on valid fields
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).closest('td').find('.checkmark').remove();
                },
                // submitHandler function for show.blade.php
                submitHandler: function(form) {
                    // Disable submit button to prevent multiple form submissions
                    $('#sendData').prop('disabled', true);

                    // Submit the form
                    form.submit();

                    // Enable the submit button again after 3 seconds
                    setTimeout(function() {
                        $('#sendData').prop('disabled', false);
                    }, 3000);
                }

            });
        });
    </script>
@endsection
