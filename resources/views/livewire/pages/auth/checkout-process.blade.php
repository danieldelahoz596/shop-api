<div>
    @if ($step == 1)
    <h2>Checkout Step 1: Review Your Cart and Enter Shipping Information</h2>

    @if ($isSingleProductCheckout)
    <!-- Display single product checkout -->
    <h2>Checkout - {{ $singleProduct['product_name'] }}</h2>
    <p>Price: {{ number_format($singleProduct['price'], 2) }}</p>

    @else
    <!-- Display cart products checkout -->
    <h2>Review Your Cart</h2>
    @foreach ($cartItems as $item)
    <p>{{ $item->product->product_name }} - {{ $item->quantity }} x ${{ number_format($item->product->price, 2) }}</p>
    @endforeach
    <p>Total: ${{ number_format($total, 2) }}</p>
    @endif





    <!-- User Information Form -->
    <div>
        <label>Name:</label>
        <input type="text" wire:model="name">
    </div>
    <div>
        <label>Email:</label>
        <input type="email" wire:model="email">
    </div>
    <div>
        <label>Phone Number:</label>
        <input type="text" wire:model="phoneNumber">
    </div>
    <div>
        <label>Address:</label>
        <textarea wire:model="address"></textarea>
    </div>
    <button wire:click.prevent="nextStep">Proceed to Payment</button>

    @elseif ($step == 2)
    <!-- Step 2: Payment and Final Confirmation -->
    @endif
</div>