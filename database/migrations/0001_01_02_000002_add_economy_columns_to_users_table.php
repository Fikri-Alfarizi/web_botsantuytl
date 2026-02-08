<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'last_daily')) {
                $table->bigInteger('last_daily')->default(0);
            }
            if (!Schema::hasColumn('users', 'last_weekly')) {
                $table->bigInteger('last_weekly')->default(0);
            }
            if (!Schema::hasColumn('users', 'last_work')) {
                $table->bigInteger('last_work')->default(0);
            }
            if (!Schema::hasColumn('users', 'coins')) {
                $table->bigInteger('coins')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_daily', 'last_weekly', 'last_work', 'coins']);
        });
    }
};
