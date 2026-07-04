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
        Schema::table('attendances', function (Blueprint $table) {
            if (!Schema::hasIndex('attendances', 'attendances_user_id_date_index')) {
                $table->index(['user_id', 'date']);
            }
            if (!Schema::hasIndex('attendances', 'attendances_status_index')) {
                $table->index('status');
            }
            if (!Schema::hasIndex('attendances', 'attendances_date_index')) {
                $table->index('date');
            }
        });

        Schema::table('leave_requests', function (Blueprint $table) {
            if (!Schema::hasIndex('leave_requests', 'leave_requests_user_id_status_index')) {
                $table->index(['user_id', 'status']);
            }
            if (!Schema::hasIndex('leave_requests', 'leave_requests_status_index')) {
                $table->index('status');
            }
        });

        Schema::table('notifications', function (Blueprint $table) {
            if (!Schema::hasIndex('notifications', 'notifications_notifiable_id_read_at_index')) {
                $table->index(['notifiable_id', 'read_at']);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'date']);
            $table->dropIndex(['status']);
            $table->dropIndex(['date']);
        });

        Schema::table('leave_requests', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['status']);
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex(['notifiable_id', 'read_at']);
        });
    }
};
