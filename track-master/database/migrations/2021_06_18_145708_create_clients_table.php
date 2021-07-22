<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('nif', 21)->unique()->nullable();
            $table->string('email', 89);
            $table->string('address', 255)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('complement', 255)->nullable();
            $table->string('zip_code', 9)->nullable();
            $table->string('number', 9)->nullable();
            $table->string('city');
            $table->string('phone', 15)->nullable();
            $table->string('state')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
