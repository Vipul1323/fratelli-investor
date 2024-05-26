<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetupAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('role_id')->nullable()->default(null)->comment('1- Super Admin, 2- admin, 3- sub admin, 4- user');
                $table->char('first_name', 100)->nullable()->default(null);
                $table->char('last_name', 100)->nullable()->default(null);
                $table->string('email', 255)->nullable()->default(null);
                $table->char('gender', 10)->nullable()->default(null);
                $table->string('phone_number', 255)->nullable()->default(null);
                $table->char('dial_code', 50)->nullable()->default(null);
                $table->string('password', 255)->nullable()->default(null);
                $table->string('access_token', 500)->nullable()->default(null);
                $table->string('image', 255)->nullable()->default(null);
                $table->boolean('is_active')->default(true)->comment('0- inactive, 1- active');
                $table->boolean('is_block')->default(true)->comment('1-unblock 0-block');
                $table->string('reset_token', 120)->nullable()->default(null);
                $table->rememberToken();
                $table->dateTime('last_logged_in')->nullable()->default(null);
                $table->dateTime('last_logged_out')->nullable()->default(null);
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at', $precision = 0);
            });
        }

        if (! Schema::hasTable('verify_email')) {
            Schema::create('verify_email', function (Blueprint $table) {
                $table->id();
                $table->string('email', 255);
                $table->char('otp', 20);
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at', $precision = 0);
            });
        }

        if (! Schema::hasTable('admin_settings')) {
            Schema::create('admin_settings', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255)->nullable()->default(null);
                $table->string('subject', 255)->nullable()->default(null);
                $table->string('title', 255)->nullable()->default(null);
                $table->text('description')->nullable()->default(null);
                $table->string('image', 255)->nullable()->default(null);
                $table->char('type', 25);
                $table->boolean('is_active')->default(true);
                $table->enum('language', ['en'])->default('en');
                $table->char('slug', 100);
                $table->string('tags', 255)->nullable()->default(null);
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at', $precision = 0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_settings');
        Schema::dropIfExists('broadcast_notifications');
        Schema::dropIfExists('broadcast_notifications_translations');
        Schema::dropIfExists('contact_us');
    }
}
