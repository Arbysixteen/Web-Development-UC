<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_address')->nullable()->after('paid_at');
            $table->string('city')->nullable()->after('shipping_address');
            $table->string('postal_code')->nullable()->after('city');
            $table->string('phone')->nullable()->after('postal_code');
            $table->string('payment_method')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['shipping_address', 'city', 'postal_code', 'phone', 'payment_method']);
        });
    }
};
