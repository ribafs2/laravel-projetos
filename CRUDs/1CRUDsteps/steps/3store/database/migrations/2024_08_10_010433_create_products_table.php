<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->notNullable();
            $table->decimal('price')->nullable();
            $table->timestamps();            
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}
