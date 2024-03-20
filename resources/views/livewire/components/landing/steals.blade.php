<div class="px-4">
    <div class="steals">
        <h1>Steals</h1>
        <div class="wrapper">
            @foreach ($steals as $steal)
                <div class="stealsContainer">
                    <h6>{{ $steal->products->product_name }}</h6>
                    <h6>P {{ $steal->item_price }}</h6>
                </div>
            @endforeach
        </div>
    </div>
</div>
