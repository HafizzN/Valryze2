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
        if (Schema::hasTable('attendances')) {
            Schema::table('attendances', function (Blueprint $table) {
                if (Schema::hasColumns('attendances', ['user_id', 'date']) && !Schema::hasIndex('attendances', 'attendances_user_id_date_index')) {
                    $table->index(['user_id', 'date']);
                }
                if (Schema::hasColumn('attendances', 'status') && !Schema::hasIndex('attendances', 'attendances_status_index')) {
                    $table->index('status');
                }
                if (Schema::hasColumn('attendances', 'date') && !Schema::hasIndex('attendances', 'attendances_date_index')) {
                    $table->index('date');
                }
            });
        }

        if (Schema::hasTable('leave_requests')) {
            Schema::table('leave_requests', function (Blueprint $table) {
                if (Schema::hasColumns('leave_requests', ['user_id', 'status']) && !Schema::hasIndex('leave_requests', 'leave_requests_user_id_status_index')) {
                    $table->index(['user_id', 'status']);
                }
                if (Schema::hasColumn('leave_requests', 'status') && !Schema::hasIndex('leave_requests', 'leave_requests_status_index')) {
                    $table->index('status');
                }
            });
        }

        if (Schema::hasTable('notifications')) {
            Schema::table('notifications', function (Blueprint $table) {
                if (Schema::hasColumns('notifications', ['notifiable_id', 'read_at']) && !Schema::hasIndex('notifications', 'notifications_notifiable_id_read_at_index')) {
                    $table->index(['notifiable_id', 'read_at']);
                }
            });
        }
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
