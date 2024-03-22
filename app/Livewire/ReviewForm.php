<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Review;

class ReviewForm extends Component
{
    public $product_id;
    public $comment;
    public $rating;
    public $product;

    public function submitReview()
    {
        Review::with(['user', 'product'])->get();
        $this->validate([
            'comment' => 'required',
            'rating' => 'required|integer|between:1,5',
        ]);
        dd($this->product_id);
        Review::create([
            'product_id' => $this->product_id,
            'user_id' => 3,
            'comment' => $this->comment,
            'rating' => $this->rating,
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.auth.review-form');
    }
}
