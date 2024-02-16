<!--thankyou.blade.php-->

@extends('dashboard')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .error {
        color: red;
    }
</style>
<div class="h-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="border border-3 border-success"></div>
        <div class="card  bg-white shadow p-5">
            <div class="mb-4 text-center d-flex justify-content-center align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="100" height="100"
                    fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                </svg>
            </div>
            <div class="text-center text-dark">
                <h1>Thank You, {{ $ownerName }}!</h1>
                <p>We've sent the link to your inbox.</p>
                <button class="btn btn-outline-success"><a href="/admin/vehicle/reg">Back Home</a></button>
            </div>
        </div>
    </div>
</div>

@endsection
