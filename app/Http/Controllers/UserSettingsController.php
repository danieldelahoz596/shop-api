<?php

namespace App\Http\Controllers;

use App\Models\UserNotificationSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserSettingsController extends Controller
{
    public function updateNotificationSettings(Request $request)
    {
        $validatedData = $request->validate([
            'push_notifications_buying' => 'required|boolean',
            'email_notifications_buying' => 'required|boolean',
            'push_notifications_selling' => 'required|boolean',
            'email_notifications_selling' => 'required|boolean',
            'push_notification_sound' => 'required|boolean',
        ]);

        $notification = UserNotificationSettings::where('user_id', auth()->user()->id)->first();

        $notification->update($validatedData);

        return $this->respondWithSuccess('Push notification settings updated successfully.');
    }

    public function updateBuyingNotificationSettings(Request $request)
    {
        $validatedData = $request->validate([
            'push_notifications_updates_order' => 'required|boolean',
            'push_notifications_updates_wallet' => 'required|boolean',
            'push_notifications_news_price_drops' => 'required|boolean',
            'push_notifications_news_new_features' => 'required|boolean',
            'push_notifications_news_trends_campaigns' => 'required|boolean',
            'push_notifications_news_sales_promotions' => 'required|boolean',
            'push_notifications_news_shopping_updates' => 'required|boolean',
            'push_notifications_news_personalized_recommendations' => 'required|boolean',
            'push_notifications_social_chats' => 'required|boolean',
            'push_notifications_social_offers' => 'required|boolean',
            'push_notifications_social_new_followers' => 'required|boolean',
            'push_notifications_social_unread_messages' => 'required|boolean',
        ]);

        $notification = UserNotificationSettings::where('user_id', 8)->first();

        $notification->update($validatedData);

        return $this->respondWithSuccess('Push notification settings updated successfully.');
    }

    public function updateBuyingEmailNotificationSettings(Request $request)
    {
        $validatedData = $request->validate([
            'email_notifications_updates_order' => 'required|boolean',
            'email_notifications_updates_wallet' => 'required|boolean',
            'email_notifications_news_price_drops' => 'required|boolean',
            'email_notifications_news_new_features' => 'required|boolean',
            'email_notifications_news_trends_campaigns' => 'required|boolean',
            'email_notifications_news_sales_promotions' => 'required|boolean',
            'email_notifications_news_shopping_updates' => 'required|boolean',
            'email_notifications_news_personalized_recommendations' => 'required|boolean',
            'email_notifications_social_offers' => 'required|boolean',
            'email_notifications_social_unread_messages' => 'required|boolean',
        ]);

        $notification = UserNotificationSettings::where('user_id', auth()->user()->id)->first();

        $notification->update($validatedData);

        return $this->respondWithSuccess('Email notification settings updated successfully.');
    }

    public function updatePrivacySettings(Request $request)
    {
        $validatedData = $request->validate([
            'privacy_settings' => 'required|boolean',
        ]);

        $notification = UserNotificationSettings::where('user_id', auth()->user()->id)->first();

        $notification->update($validatedData);

        return $this->respondWithSuccess('Privacy settings updated successfully.');
    }

    private function respondWithSuccess($message)
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);
    }
}
