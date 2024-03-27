<div class="w-75 mx-auto mt-3">
    @if($cartItems->count() > 0)
    <h2>Bag</h2>
    @foreach($cartItems as $sellerId => $items)
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center">
                @if($items->first()->product->user->profile_picture)
                <img class="rounded-circle me-3"
                    src="{{ Storage::url($items->first()->product->user->profile_picture)}}" alt=""
                    style="width: 50px; height: 50px;">
                @else
                <img class="rounded-circle me-3" src="{{ asset('assets/img/public_profile/Vector.jpg') }}" alt=""
                    style="width: 50px; height: 50px;">
                @endif
                <h4 class="mb-0">{{ $items->first()->product->user->name }}</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    @foreach($items as $item)
                    <div class="d-flex flex-column  mb-2">
                        <div class="me-2"><strong>{{ $item->product->product_name }}</strong></div>
                        <div class="me-2 muted">{{ $item->product->product_description }}</div>
                        <div>${{ number_format($item->product->price, 2) }}</div>
                        <div>${{ number_format($item->quantity * $item->product->price, 2) }}</div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-heart"></i>
                            <button wire:click="deleteItem({{ $item->id }})" class="border-0"
                                style=" all: unset; cursor:pointer;">
                                <i class=" fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col">
                    <div class=" d-flex justify-content-between">
                        <span><strong>Subtotal:</strong></span>
                        <strong>${{ number_format($totalsPerSeller[$sellerId], 2) }}</strong>
                    </div>
                    <div>Shipping calculated at checkout</div>
                    <div class="text-center mb-4">
                        <button wire:click="checkout" class="btn font-weight-bold text-white btn-primary">Checkout
                            {{ $items->count() }}
                            item(s)</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <strong>Grand Total: ${{ number_format($total, 2) }}</strong>
    </div>
    @else
    <p class="text-center">Your cart is empty.</p>
    @endif
</div>