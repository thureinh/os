<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codeno');
            $table->string('name');
            $table->text('photo');
            $table->integer('price');
            $table->integer('discount');    // %
            $table->text('description')->nullable();

            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('brand_id');

            $table->timestamps();

            $table->foreign('subcategory_id')  
                    ->references('id')
                    ->on('subcategories')
                    ->onDelete('cascade');

            $table->foreign('brand_id')  
                    ->references('id')
                    ->on('brands')
                    ->onDelete('cascade');
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
}
