@extends('layouts.app')
@section('title', 'Home Page - Fanatics Shop')

@push('styles')
<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
@endpush

@section('content')
<div class="mx-auto">
  @include('partials.header')

  <div id="content-home">
    <p class="text-center text-lg mt-10">
      Here, we will showcase the latest 10 discounted products available in our store.<br>
      Don’t miss out on these amazing deals!
    </p>

    <div class="container ml-auto mr-auto">
      <div id="banner-home"></div>

      <div id="products-offer-home" class="mt-8 mb-20">
          @if($discountedProducts->isEmpty())
              <p class="text-center">No discounted products are currently available.</p>
          @else
              <div class="owl-carousel owl-theme">
                  @foreach($discountedProducts as $product)
                      <div class="item">
                          <div class="bg-white p-4 rounded-lg border border-gray-200 text-center transform transition-transform duration-200 hover:scale-105 hover:shadow-2xl">
                              <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                              <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 60) }}</p>
                              <p class="text-red-500 font-bold text-lg mb-1">
                                  Promo Price: ${{ number_format($product->promo_price, 2) }}
                              </p>
                              <p class="text-gray-500 line-through mb-4">
                                  Original Price: ${{ number_format($product->price, 2) }}
                              </p>
                              <p class="text-sm text-green-600 font-medium mb-4">Available: {{ $product->quantity }} in stock</p>

                              <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="quantity" value="1" min="1" required>
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors duration-200">Add to Cart</button>
                            </form>
                          </div>
                      </div>
                  @endforeach
              </div>
          @endif
      </div>
    </div>

  </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endpush

@section('scripts')
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            autoplay: true,
            autoplayTimeout: 3700,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 }
            }
        });
    });
</script>
@endsection
