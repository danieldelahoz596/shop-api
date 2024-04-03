<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewHistory;
use App\Models\SellerShop;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class ReviewController extends Controller
{
    public function addReview(Request $request, $type, $id)
    {
        $reviewable = $this->findReviewable($type, $id);
        $review = new Review([
            'comment' => $request->comment,
            'rating' => $request->rating,
            'user_id' => auth()->id(),
        ]);

        $reviewable->reviews()->save($review);

        return response()->json(['status' => true, 'message' => "Comment has been added"], 200);
    }

    public function getReviews($type, $id)
    {
        $reviewable = $this->findReviewable($type, $id);
        $reviews = $reviewable->reviews()->get();
        return response()->json(['status' => true, 'data' => $reviews], 200);
    }


    public function updateReview(Request $request, $review_id)
    {
        $review = Review::findOrFail($review_id);

        if($review->user_id !== auth()->id()){
            return response()->json([
                'status'=>false,
                'user_id'=>auth()->id(),
                'review_id'=>$review->user_id,
                'message'=> "Unauthorized to update this comment"
            ], 403);
        }

        ReviewHistory::create([
            'review_id'=> $review->id,
            'user_id'=>$review->user_id,
            'comment'=>$request->comment,
            'rating'=>$request->rating,
        ]);

        $review->update($request->only(["comment", "rating"]));

        return response()->json([
            'status'=>true,
            'message'=>"Comment has been updated"
        ],200);
    }

    public function getHistoryReview($review_id)
    {
        $review = ReviewHistory::where('review_id', $review_id)->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status'=>true,
            'data' => $review
        ],200);
    }


    //Helper
    protected function findReviewable($type, $id)
    {
        if ($type === 'product') {
            return Product::findOrFail($id);
        } else if ($type === 'seller') {
            return SellerShop::findOrFail($id);
        } else {
            abort(404, 'Invalid reviewable type');
        }
    }

}
