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
        Schema::table('order_shipping', function (Blueprint $table) {
            $table->decimal('shipping_fee', 12, 0)->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_shipping', function (Blueprint $table) {
            Schema::table('order_shipping', function (Blueprint $table) {
                $table->dropColumn('shipping_fee');
            });
        });
    }
};
