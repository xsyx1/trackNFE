<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('name', 70)->nullable();
            $table->string('cod', 50)->nullable();
            $table->string('ncm', 50)->nullable();
            $table->string('cest', 50)->nullable();
            $table->string('amount', 50)->nullable();
            $table->string('unit', 50)->nullable();
            $table->double('weight', 50)->nullable();
            $table->double('subtotal', 50)->nullable();
            $table->double('total', 50)->nullable();
            $table->double('federal_texas', 50)->nullable();
            $table->double('state_texas', 50)->nullable();
            $table->string('origin', 150)->nullable();
            $table->boolean('is_enabled')->nullable();
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
        Schema::dropIfExists('products');
    }
}
