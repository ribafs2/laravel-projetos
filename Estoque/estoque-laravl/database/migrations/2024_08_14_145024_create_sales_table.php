<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedBigInteger('product_id');
            $table->integer('quantity')->notNullable();
            $table->decimal('price')->notNullable();
            $table->date('date')->nullable();
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
        Schema::drop('sales');
    }
}
