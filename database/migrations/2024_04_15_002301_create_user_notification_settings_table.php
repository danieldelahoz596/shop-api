<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_notification_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->boolean('push_notifications_buying')->default(1);
            $table->boolean('email_notifications_buying')->default(1);
            $table->boolean('push_notifications_selling')->default(1);
            $table->boolean('email_notifications_selling')->default(1);
            $table->boolean('push_notification_sound')->default(1);
            $table->boolean('push_notifications_updates_order')->default(1);
            $table->boolean('push_notifications_updates_wallet')->default(1);
            $table->boolean('push_notifications_news_price_drops')->default(1);
            $table->boolean('push_notifications_news_new_features')->default(1);
            $table->boolean('push_notifications_news_trends_campaigns')->default(1);
            $table->boolean('push_notifications_news_sales_promotions')->default(1);
            $table->boolean('push_notifications_news_shopping_updates')->default(1);
            $table->boolean('push_notifications_news_personalized_recommendations')->default(1);
            $table->boolean('push_notifications_social_chats')->default(1);
            $table->boolean('push_notifications_social_offers')->default(1);
            $table->boolean('push_notifications_social_new_followers')->default(1);
            $table->boolean('push_notifications_social_unread_messages')->default(1);
            $table->boolean('email_notifications_updates_order')->default(1);
            $table->boolean('email_notifications_updates_wallet')->default(1);
            $table->boolean('email_notifications_news_price_drops')->default(1);
            $table->boolean('email_notifications_news_new_features')->default(1);
            $table->boolean('email_notifications_news_trends_campaigns')->default(1);
            $table->boolean('email_notifications_news_sales_promotions')->default(1);
            $table->boolean('email_notifications_news_shopping_updates')->default(1);
            $table->boolean('email_notifications_news_personalized_recommendations')->default(1);
            $table->boolean('email_notifications_social_offers')->default(1);
            $table->boolean('email_notifications_social_unread_messages')->default(1);
            $table->boolean('privacy_settings')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_notification_settings');
    }
};
