<div class="container py-5">
    @if ($step == 1)
    <h2 class="mb-4">Checkout</h2>
    <div class="row">
        <!-- Left column for product review -->
        <div class="col-lg-5 mb-4">
            <div class="card">
                @if(isset($sellers[$singleProduct['user_id']]))
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span>
                        <img src="" alt="Seller" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                        <strong>{{ $sellers[$singleProduct['user_id']]->name }}</strong>
                    </span>
                    <span class="badge bg-secondary">★★★★★</span>
                </div>
                @endif
                <div class="card-body">
                    @if ($isSingleProductCheckout)
                    <!-- Single Product Checkout -->
                    <h5 class="card-title">{{ $singleProduct['product_name'] }}</h5>
                    <p class="card-text">Price: ${{ number_format($singleProduct['price'], 2) }}</p>
                    <!-- Display Seller Info -->
                    @if(isset($sellers[$singleProduct['user_id']]))
                    <p class="card-text">Seller: {{ $sellers[$singleProduct['user_id']]->name }}</p>
                    <p class="card-text">Rating: {{ $sellers[$singleProduct['user_id']]->ratings }}</p>
                    @endif
                    @else
                    <!-- Multiple Products Checkout -->
                    <h5 class="card-title">Review Your Cart</h5>
                    @foreach ($cartItems as $item)
                    <p>{{ $item->product->name }} - {{ $item->quantity }} x
                        ${{ number_format($item->product->price, 2) }}</p>
                    <!-- Display Seller Info -->
                    @if(isset($sellers[$item->product->user_id]))
                    <p class="card-text">Seller: {{ $sellers[$item->product->user_id]->name }}</p>
                    <p class="card-text">Rating: {{ $sellers[$item->product->user_id]->ratings }}</p>
                    @endif
                    @endforeach
                    @endif
                    <hr>
                    <h5 class="card-title">Order Summary</h5>
                    <!-- Dynamically generated order summary -->
                    <div class="mb-3">
                        @foreach ($cartItems as $item)
                        <div class="d-flex justify-content-between">
                            <span>Item(s) Total</span>
                            <span>${{ $item->count() }}</span>
                        </div>
                        @endforeach
                        <div class="d-flex justify-content-between">
                            <span>Shipping Fee</span>
                            <span>$150</span>
                        </div>

                        <div class="d-flex justify-content-between fw-bold">
                            <span>Grand Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right column for shipping and payment -->
        <div class="col-lg-7">
            <div class="card mb-3">
                <div class="card-header">
                    Shipping Address
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" wire:model="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" wire:model="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number:</label>
                        <input type="text" class="form-control" wire:model="phoneNumber">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address:</label>
                        <textarea class="form-control" wire:model="address"></textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Payment</h5>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="myWalletCheck">
                        <label class="form-check-label" for="myWalletCheck">My Wallet</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="creditCardCheck">
                        <label class="form-check-label" for="creditCardCheck">Debit/Credit Card</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="eWalletCheck">
                        <label class="form-check-label" for="eWalletCheck">E-Wallets</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="codCheck">
                        <label class="form-check-label" for="codCheck">COD</label>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="voucherCode" class="form-label">Voucher Code:</label>
                        <input type="text" id="voucherCode" class="form-control" placeholder="Enter your code">
                    </div>
                    <button wire:click.prevent="checkout" class="btn btn-primary btn-lg w-100">Proceed to
                        Payment</button>
                </div>
            </div>
        </div>
    </div>
    @elseif ($step == 2)
    <!-- Payment and Final Confirmation Step -->
    @endif
</div>