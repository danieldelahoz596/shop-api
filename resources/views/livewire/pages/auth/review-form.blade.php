<div>
    <textarea wire:model="comment"></textarea>
    <input type="number" wire:model="rating" min="1" max="5">
    <button wire:click.prevent="submitReview">Submit Review</button>
</div>