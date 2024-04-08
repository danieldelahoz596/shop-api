<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserSettingsController extends Controller
{
    public function updatePushNotificationSettings(Request $request)
    {
        $validatedData = $request->validate([
            'push_notifications_buying' => 'required|boolean',
        ]);

        $user = Auth::user();
        $user->settings()->update($validatedData);

        return $this->respondWithSuccess('Push notification settings updated successfully.');
    }

    public function updateEmailNotificationSettings(Request $request)
    {
        $validatedData = $request->validate([
            'email_notifications_buying_order' => 'required|boolean',
        ]);

        $user = Auth::user();
        $user->settings()->update($validatedData);

        return $this->respondWithSuccess('Email notification settings updated successfully.');
    }

    public function updateBuyingNotificationSettings(Request $request)
    {
        $validatedData = $request->validate([
            'email_notifications_buying_wallet' => 'required|boolean',
            'push_notifications_buying_updates_order' => 'required|boolean',
            'push_notifications_buying_updates_wallet' => 'required|boolean',
            'push_notifications_buying_news_price_drops' => 'required|boolean',
            'push_notifications_buying_news_new_features' => 'required|boolean',
            'push_notifications_buying_news_trends_campaigns' => 'required|boolean',
            'push_notifications_buying_news_sales_promotions' => 'required|boolean',
            'push_notifications_buying_news_shopping_updates' => 'required|boolean',
            'push_notifications_buying_news_personalized_recommendations' => 'required|boolean',
            'push_notifications_buying_social_chats' => 'required|boolean',
            'push_notifications_buying_social_offers' => 'required|boolean',
            'push_notifications_buying_social_new_followers' => 'required|boolean',
            'push_notifications_buying_social_unread_messages' => 'required|boolean',
        ]);

        $user = Auth::user();
        $user->settings()->update($validatedData);

        return $this->respondWithSuccess('Buying notification settings updated successfully.');
    }

    public function updateSellingNotificationSettings(Request $request)
    {
        return $this->respondWithSuccess('Selling notification settings updated successfully.');
    }

    public function updatePrivacySettings(Request $request)
    {
        $validatedData = $request->validate([
            'privacy_settings' => 'required|boolean',
        ]);

        $user = Auth::user();
        $user->settings()->update($validatedData);

        return $this->respondWithSuccess('Privacy settings updated successfully.');
    }

    public function updateBlockedUsers(Request $request)
    {
        $validatedData = $request->validate([
            'blocked_users' => 'sometimes|array',
            'blocked_users.*' => 'exists:users,id',
        ]);

        $user = Auth::user();
        $user->blockedUsers()->sync($validatedData['blocked_users'] ?? []);

        return $this->respondWithSuccess('Blocked users updated successfully.');
    }

    private function respondWithSuccess($message)
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);
    }
}