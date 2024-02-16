<!-- register.blade.php -->

@extends('dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container h-100 text-dark">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Reg Form</h1>
            <form action="/admin/vehicle/reg/store" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="regName" class="form-label">Registration Name</label>
                    <input type="text" class="form-control" id="regName" name="regName" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

@endsection
