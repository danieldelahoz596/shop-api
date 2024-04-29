<div class="d-none d-md-block">
    <div class="steals">
        <div class="display-6 tertiary-color fw-bold ps-md-5 ps-3">Steals</div>
        <div class="wrapper px-5">
            @foreach ($steals as $steal)
                <div class="stealsContainer">
                    <h1>{{ $steal->product->product_name }}</h1>
                    <h1>P {{ $steal->item_price }}</h1>
                </div>
            @endforeach
        </div>
    </div>
</div>
