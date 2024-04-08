<div class="container mt-3">
    <h2 class="mb-4">Bag</h2>
    @if($cartItems->count() > 0)
    @foreach($cartItems as $sellerId => $items)
    <div class="card mb-4">
        <div class="card-header bg-light">
            <div class="d-flex align-items-center">
                <img class="rounded-circle me-3"
                    src="{{ $items->first()->product->user->profile_picture ? Storage::url($items->first()->product->user->profile_picture) : asset('assets/img/public_profile/Vector.jpg') }}"
                    alt="Profile Picture" style="width: 50px; height: 50px; object-fit: cover;">
                <h4 class="mb-0">{{ $items->first()->product->user->name }}</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    img
                </div>
                <div class="col-md-4">
                    @foreach($items as $item)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="flex-grow-1">
                            <strong>{{ $item->product->product_name }}</strong>
                            <p class="text-muted mb-1">{{ $item->product->product_description }}</p>
                            <div>${{ number_format($item->product->price, 2) }} each</div>
                            <button wire:click="toggleFavorite({{ $item->product->id }})" class="btn p-0 text-danger">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                            <button wire:click="deleteItem({{ $item->id }})" class="btn p-0 text-muted">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <strong>${{ number_format($totalsPerSeller[$sellerId], 2) }}</strong>
                    </div>
                    <p class="text-muted">Shipping calculated at checkout</p>
                    <div class="text-center mt-4">
                        <button wire:click="checkout" class="btn btn-primary text-white">Checkout
                            {{ $items->count() }} item(s)</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <p class="text-center">Your cart is empty.</p>
    @endif
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div></div>
        <strong>Grand Total: ${{ number_format($total, 2) }}</strong>
    </div>
</div>