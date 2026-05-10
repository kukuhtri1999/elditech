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
        Schema::table('contact_submissions', function (Blueprint $table) {
            $table->boolean('is_read')->default(false)->after('source');
            $table->timestamp('read_at')->nullable()->after('is_read');

            $table->index(['is_read', 'created_at']);
            $table->index(['source', 'locale', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_submissions', function (Blueprint $table) {
            $table->dropIndex(['is_read', 'created_at']);
            $table->dropIndex(['source', 'locale', 'created_at']);
            $table->dropColumn(['is_read', 'read_at']);
        });
    }
};
