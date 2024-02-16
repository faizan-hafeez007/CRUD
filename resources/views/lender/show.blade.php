<!--show.blade.php-->
@extends('dashboard')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error {
            color: red;
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
                        <td><input type="text" class="form-control" name="reg[]" placeholder="Enter REG"></td>
                        <td><input type="number" class="form-control" name="value[]" placeholder="Enter VALUE"
                                min="1"></td>
                        <td><input type="text" class="form-control" name="lender[]" placeholder="Enter Lender"></td>
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
                newRow.find('input[name^="reg"]').val('').attr('placeholder', 'Enter REG');
                newRow.find('input[name^="value"]').val('').attr('placeholder', 'Enter VALUE');
                newRow.find('input[name^="lender"]').val('').attr('placeholder', 'Enter Lender');

                // Generate a unique ID for the new row
                var newRowId = 'row_' + Date.now();
                newRow.attr('id', newRowId);

                // Update the reg_id field in the new row
                var regId = $('input[name="reg_id"]').val();
                newRow.find('input[name="reg_id"]').val(regId);

                // Append new row to the table
                $('#vehicleTable tbody').append(newRow);

                // Add a delete button to the new row
                var deleteButton = $('<button type="button" class="btn btn-danger deleteRow">Delete</button>');
                deleteButton.click(function() {
                    $('#' + newRowId).remove();
                });
                newRow.find('td:last').empty().append(deleteButton);
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

            // Delete row
            $('#vehicleTable').on('click', '.deleteRow', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
