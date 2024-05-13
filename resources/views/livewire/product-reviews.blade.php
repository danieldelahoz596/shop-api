<div>
    <h3>Reviews</h3>
    @forelse($reviews as $review)
    <div class="review">
        <div class="review-header">
            <span class="reviewer-name">{{ $review->user->name }}</span>
            <span class="review-date">{{ $review->created_at->format('M d, Y') }}</span>
        </div>
        <div class="review-content">
            <p>{{ $review->comment }}</p>
            <div class="review-rating">Rating: {{ $review->rating }}</div>
        </div>
    </div>
    @empty
    <p>No reviews yet.</p>
    @endforelse
</div>
