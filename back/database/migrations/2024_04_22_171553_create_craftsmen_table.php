<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('craftsmen', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('id_card')->nullable();
            $table->string('craftsman_certificate')->nullable();
            $table->double('price',10)->nullable();
            $table->double('rating',10)->default(0);
            $table->string('gender');          
            $table->integer('number_clients')->default(0);
            $table->integer('activate')->default(0);
            $table->string('image')->nullable();
            $table->string('place')->nullable();
            $table->date('birth_date');           
            $table->integer('id_crafts')->unsigned()->nullable();
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
        Schema::dropIfExists('craftsmen');
    }
};
