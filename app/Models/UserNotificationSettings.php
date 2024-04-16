<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotificationSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'push_notifications_buying',
        'email_notifications_buying',
        'push_notifications_selling',
        'email_notifications_selling',
        'push_notification_sound',
        'push_notifications_updates_order',
        'push_notifications_updates_wallet',
        'push_notifications_news_price_drops',
        'push_notifications_news_new_features',
        'push_notifications_news_trends_campaigns',
        'push_notifications_news_sales_promotions',
        'push_notifications_news_shopping_updates',
        'push_notifications_news_personalized_recommendations',
        'push_notifications_social_chats',
        'push_notifications_social_offers',
        'push_notifications_social_new_followers',
        'push_notifications_social_unread_messages',
        'email_notifications_updates_order',
        'email_notifications_updates_wallet',
        'email_notifications_news_price_drops',
        'email_notifications_news_new_features',
        'email_notifications_news_trends_campaigns',
        'email_notifications_news_sales_promotions',
        'email_notifications_news_shopping_updates',
        'email_notifications_news_personalized_recommendations',
        'email_notifications_social_offers',
        'email_notifications_social_unread_messages',
        'privacy_settings',
    ];

    /**
     * Get the user that owns the UserNotificationSettings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
