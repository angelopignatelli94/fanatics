<header class="bg-gray-100">
    <nav class="container mx-auto flex max-w-7xl items-center justify-between py-6" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="{{ route('home') }}" class="-m-1.5 p-1.5 text-black">
                <div class="text-2xl font-bold">Fanatics Shop</div>
            </a>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="{{ route('home') }}" class="text-sm font-semibold leading-6 text-gray-900">Home</a>

            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach($categories as $category)
                        <a class="dropdown-item" href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('cart.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cart</a>
            <a href="{{ route('checkout.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Checkout</a>
            @if (Auth::check())
                <a href="{{ route('orders.index') }}" class="text-sm font-semibold leading-6 text-gray-900">My orders</a>
            @endif
        </div>

        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            @if (Auth::check())
                <div class="dropdown bg-white py-1 px-3 rounded-md">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form method="POST" action="{{ route('logout') }}" class="mb-0">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
            @endif
        </div>
    </nav>
</header>
