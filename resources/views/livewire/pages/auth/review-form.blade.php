<div>
    <form wire:submit.prevent="submitReview">
        <textarea wire:model="comment"></textarea>
        <input type="number" wire:model="rating" min="1" max="5">
        <button type="submit">Submit Review</button>
    </form>
</div>