@extends('layouts.app')
@section('title', 'Orders - Fanatics Shop')

@section('content')
@include('partials.header')

<div id="content-orders" class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">My Orders</h1>

    @if($orders->isEmpty())
        <p>You haven't placed any orders yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Order ID</th>
                        <th class="py-3 px-6 text-left">Date</th>
                        <th class="py-3 px-6 text-left">Total</th>
                        <th class="py-3 px-6 text-left">Products</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($orders as $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $order->id }}</td>
                            <td class="py-3 px-6">{{ $order->created_at->format('d/m/Y') }}</td>
                            <td class="py-3 px-6">€{{ number_format($order->total, 2) }}</td>
                            <td class="py-3 px-6">
                                <ul>
                                    @foreach(json_decode($order->items, true) as $item)
                                        <li>
                                            {{ $item['name'] }} - Quantity: {{ $item['quantity'] }} - Price: €{{ number_format($item['price'], 2) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
