<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewHistory;
use App\Models\SellerShop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    //Get history of edited review
    public function getHistoryReview($review_id)
    {
        try{
            $review = ReviewHistory::where('review_id', $review_id)->orderBy('created_at', 'desc')->get();
        } catch(\Exception $e){
            Log::error("Failed querying the history review: " . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message'=> 'Internal server error failed on querying history review'
            ],500);
        }

        return response()->json([
            'status'=>200,
            'data' => $review,
            'message'=>'Successfully retrieve review history'
        ],200);
    }
    
    //posting a review to a product or seller
    public function addReview(Request $request, $type, $id)
    {

        if (!auth()->check()) {
            return response()->json([
                'status' => 401,
                'message' => 'User not authenticated'
            ], 401);
        }

        try {
            $reviewable = $this->findReviewable($type, $id);
            $review = Review::create([
                'comment' => $request->comment,
                'rating' => $request->rating,
                'image'=>$request->image,
                'user_id' => auth()->id(),
            ]);
            $reviewable->reviews()->attach($review);
        }catch(\Exception $e){
            Log::error("Failed adding review: " . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message'=> 'Internal server error failed on adding review'
            ],500);
        }

        return response()->json([
            'status' => true, 
            'data' => $review,
            'message' => "Comment has been added"
        ], 200);
    }

    //Get all the reviews on a product or seller
    public function getReviews($type, $id)
    {
        try{
            $reviewable = $this->findReviewable($type, $id);
            $reviews = $reviewable->reviews()->get();
        } catch(\Exception $e){
            Log::error("Failed getting all reviews: " . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message'=> 'Internal server error failed on getting reviews'
            ],500);
        }

        return response()->json([
            'status' => true, 
            'data' => $reviews
        ], 200);
    }


    public function updateReview(Request $request, $review_id)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 401,
                'message' => 'User not authenticated'
            ], 401);
        }
        try{
            $review = Review::findOrFail($review_id);
            if($review->user_id !== auth()->id()){
                return response()->json([
                    'status'=>false,
                    'user_id'=>auth()->id(),
                    'review_id'=>$review->user_id,
                    'message'=> "Unauthorized to update this comment"
                ], 401);
            }
            ReviewHistory::create([
                'review_id'=> $review->id,
                'user_id'=>$review->user_id,
                'comment'=>$request->comment,
                'image'=>$request->image,
                'rating'=>$request->rating,
            ]);
            $review->update($request->only(["comment", "rating"]));
        } catch(\Exception $e){
            Log::error("Failed updating review: " . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message'=> 'Internal server error failed on updating review'
            ],500);
        }

        return response()->json([
            'status'=>true,
            'message'=>"Comment has been updated"
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
