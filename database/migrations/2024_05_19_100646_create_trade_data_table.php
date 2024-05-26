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
            $table->double('open', 12,2)->nullable()->default(NULL);
            $table->double('high', 12,2)->nullable()->default(NULL);
            $table->double('low', 12,2)->nullable()->default(NULL);
            $table->double('close', 12,2)->nullable()->default(NULL);
            $table->double('volume', 12,2)->nullable()->default(NULL);
            $table->string('adj_open', 50)->nullable()->default(NULL);
            $table->string('adj_high', 50)->nullable()->default(NULL);
            $table->string('adj_low', 50)->nullable()->default(NULL);
            $table->string('adj_close', 50)->nullable()->default(NULL);
            $table->string('adj_volume', 50)->nullable()->default(NULL);
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
