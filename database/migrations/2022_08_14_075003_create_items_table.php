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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('header')->nullable()->comment('ヘッダーメッセージ');
            $table->string('name')->comment('商品名');
            $table->string('serial')->comment('シリアル番号');
            $table->integer('price')->comment('価格');
            $table->integer('inventory')->nullable()->comment('在庫数');
            $table->string('spec')->nullable()->comment('規格');
            $table->bigInteger('cat_id')->comment('カテゴリーID');
            $table->bigInteger('subcat_id')->comment('サブカテゴリーID');
            $table->string('maker')->comment('製造業者名');
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
        Schema::dropIfExists('items');
    }
};
