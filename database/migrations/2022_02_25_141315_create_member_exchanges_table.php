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
        Schema::create('member_exchanges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_product_id');
            $table->foreignId('user_id');
            $table->integer('qty');
            $table->integer('point_total');
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
        Schema::dropIfExists('member_exchanges');
    }
};
