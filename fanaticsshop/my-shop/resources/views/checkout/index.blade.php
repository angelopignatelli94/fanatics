@extends('layouts.app')
@section('title', 'Checkout - Fanatics Shop')

@section('content')
@include('partials.header')

<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">Checkout</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 mb-6">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Product</th>
                        <th class="py-3 px-6 text-left">Quantity</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Total</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @php $totalAmount = 0; @endphp
                    @foreach(session('cart') as $id => $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $item['name'] }}</td>
                            <td class="py-3 px-6">{{ $item['quantity'] }}</td>
                            <td class="py-3 px-6">€{{ number_format($item['price'], 2) }}</td>
                            <td class="py-3 px-6">€{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            @php $totalAmount += $item['price'] * $item['quantity']; @endphp
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h2 class="text-xl font-bold">Total Amount: €{{ number_format($totalAmount, 2) }}</h2>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" class="mt-6 mb-20">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="name" class="block text-gray-700">Full Name</label>
                    <input type="text" name="name" id="name" required class="border border-gray-300 rounded px-3 py-2 w-full"
                           placeholder="Enter your full name"
                           value="{{ Auth::check() ? Auth::user()->name : '' }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required class="border border-gray-300 rounded px-3 py-2 w-full"
                           placeholder="Enter your email address"
                           value="{{ Auth::check() ? Auth::user()->email : '' }}">
                </div>
            </div>
            @if (!Auth::check())
                <div class="row mb-4">
                    <div class="col-md-12">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" name="password" id="password" required class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Enter your password">
                    </div>
                </div>
            @endif
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="address" class="block text-gray-700">Shipping Address</label>
                    <input type="text" name="address" id="address" required class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Enter your shipping address">
                </div>
                <div class="col-md-6">
                    <label for="city" class="block text-gray-700">City</label>
                    <input type="text" name="city" id="city" required class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Enter your city">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="postal_code" class="block text-gray-700">Postal Code</label>
                    <input type="text" name="postal_code" id="postal_code" required class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Enter your postal code">
                </div>
                <div class="col-md-6">
                    <label for="country" class="block text-gray-700">Country</label>
                    <input type="text" name="country" id="country" required class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Enter your country">
                </div>
            </div>
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Complete Purchase</button>
        </form>
    @else
        <div class="alert alert-secondary">Your cart is empty. Please add products to your cart before checking out.</div>
    @endif
</div>

@endsection
