<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->string('language')->default('en');
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(false);
            $table->boolean('bid_alerts')->default(true);
            $table->boolean('price_alerts')->default(true);
            $table->boolean('two_factor_enabled')->default(false);
            $table->boolean('dark_mode')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'bio', 'language',
                'email_notifications', 'sms_notifications',
                'bid_alerts', 'price_alerts',
                'two_factor_enabled', 'dark_mode'
            ]);
        });
    }
};
