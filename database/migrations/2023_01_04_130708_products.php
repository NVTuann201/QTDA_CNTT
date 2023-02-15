<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('group_product_id')->unsigned();
            $table->string('name',255);
            $table->text('description')->nullable();
            $table->float('import_price',15,3);
            $table->float('export_price',15,3)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('group_image', 500)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1-public, 0-private');
            $table->tinyInteger('priority')->default(0)->comment('Thu tu uu tien');
            $table->timestamps();
            $table->foreign('group_product_id')->references('id')->on('group_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
