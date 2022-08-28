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
        Schema::create('itemimages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id')->comment('製品ID');
            $table->integer('image_id')->comment('画像ID');
            $table->string('url')->comment('画像URL');
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
        Schema::dropIfExists('itemimages');
    }
};
