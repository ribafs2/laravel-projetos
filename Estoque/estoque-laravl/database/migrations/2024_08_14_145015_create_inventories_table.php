<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedBigInteger('product_id');
            $table->integer('quantity')->notNullable();
            $table->timestamps();
            
     $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDeletee('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventories');
    }
}
