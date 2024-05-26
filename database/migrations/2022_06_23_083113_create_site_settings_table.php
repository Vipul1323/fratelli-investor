<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('site_settings')) {
            Schema::create('site_settings', function (Blueprint $table) {
                $table->id();
                // Mail settings
                $table->text('mail_mailer')->nullable()->default(null);
                $table->text('mail_host')->nullable()->default(null);
                $table->text('mail_port')->nullable()->default(null);
                $table->text('mail_username')->nullable()->default(null);
                $table->text('mail_password')->nullable()->default(null);
                $table->text('mail_encryption')->nullable()->default(null);
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
        Schema::dropIfExists('site_settings');
    }
};
