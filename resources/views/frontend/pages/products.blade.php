@extends('layouts.user-layout')

@section('front-content')
    <div class="row">
        {{-- @foreach ($categories as $products) --}}
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card" style="width: 100%; height: 100%;">
                        <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}"
                            alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Price $: </strong>{{ $product->price }}</p>
                            <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block"
                                role="button">Add to cart</a>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}
        @endforeach
    </div>
@endsection
