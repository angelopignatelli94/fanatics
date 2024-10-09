@extends('layouts.app')
@section('title', 'Cart - Fanatics Shop')

@section('content')
@include('partials.header')

<div id="content-cart" class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">Your Cart</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Product</th>
                        <th class="py-3 px-6 text-left">Quantity</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Total</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach(session('cart') as $id => $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $item['name'] }}</td>
                            <td class="py-3 px-6">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="border border-gray-300 rounded px-2 py-1 w-20" required>
                                    <button type="submit" class="ml-2 bg-blue-500 text-white py-1 px-2 rounded">Update</button>
                                </form>
                            </td>
                            <td class="py-3 px-6">€{{ number_format($item['price'], 2) }}</td>
                            <td class="py-3 px-6">€{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td class="py-3 px-6">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <a href="{{ route('checkout.index') }}" class="bg-green-500 text-white py-2 px-4 rounded">Proceed to Checkout</a>
        </div>
    @else
        <div class="alert alert-secondary">Your cart is empty.</div>
    @endif
</div>

@endsection
