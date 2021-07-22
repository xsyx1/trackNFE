<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('nickname', 120)->nullable();
            $table->string('nif', 21)->unique()->nullable();
            $table->string('email', 89);
            $table->string('address', 255)->nullable();
            $table->string('zip_code', 9)->nullable();
            $table->foreignId('city_id')->constrained();
            $table->string('phone', 15)->nullable();
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
        Schema::dropIfExists('people');
    }
}
