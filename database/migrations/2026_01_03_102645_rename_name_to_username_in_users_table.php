<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('ALTER TABLE users RENAME COLUMN name TO username');
            DB::statement('CREATE UNIQUE INDEX users_username_unique ON users(username)');
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('name', 'username');
            });

            Schema::table('users', function (Blueprint $table) {
                $table->unique('username');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('DROP INDEX IF EXISTS users_username_unique');
            DB::statement('ALTER TABLE users RENAME COLUMN username TO name');
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique(['username']);
            });

            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('username', 'name');
            });
        }
    }
};
