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
        Schema::create('trade_data', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_on',)->nullable()->default(NULL);
            $table->string('symbol', '55')->nullable()->default(NULL);
            $table->string('exchange', '55')->nullable()->default(NULL);
            $table->string('open', '55')->nullable()->default(NULL);
            $table->string('high', '55')->nullable()->default(NULL);
            $table->string('low', '55')->nullable()->default(NULL);
            $table->string('last', '55')->nullable()->default(NULL);
            $table->string('close', '55')->nullable()->default(NULL);
            $table->string('volume', '55')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade_data');
    }
};
