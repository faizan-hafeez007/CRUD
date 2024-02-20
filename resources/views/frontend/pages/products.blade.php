@extends('layouts.user-layout')

@section('front-content')

    <div class="row">

        @foreach ($products as $product)

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('storage/products/default-image.jpg') }}"
                        alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Price $: </strong>{{ $product->price }}</p>
                        <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block"
                            role="button">Add to cart</a>
                    </div>
                </div>
            </div>

        @endforeach

    </div>

@endsection
