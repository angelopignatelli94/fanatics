@extends('layouts.app')
@section('title', $category->name . ' - Fanatics Shop')

@section('content')
@include('partials.header')

<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">{{ $category->name }}</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white p-4 shadow-lg rounded-lg border border-gray-200 transition-transform transform hover:scale-105 hover:shadow-2xl text-center">
                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 50) }}</p>
                @if($product->in_promo)
                    <p class="text-red-500 font-bold text-lg mb-1">Promo Price: ${{ number_format($product->promo_price, 2) }}</p>
                    <p class="text-gray-500 line-through mb-2">Original Price: ${{ number_format($product->price, 2) }}</p>
                @else
                    <p class="text-gray-800 font-bold text-lg mb-2">Price: ${{ number_format($product->price, 2) }}</p>
                @endif
                <p class="text-sm text-green-600 font-medium mb-4">Available: {{ $product->quantity }} in stock</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="quantity" value="1" min="1" required>
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-full hover:bg-green-600 transition-colors duration-200">Add to Cart</button>
                </form>
            </div>
        @empty
            <p class="text-center col-span-4">No products available in this category.</p>
        @endforelse
    </div>
</div>

@endsection
