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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->integer('modele')->nullable(false);
            $table->string('matricule')->unique()->nullable(false);
            $table->string('marque')->nullable(false);
            $table->unsignedBigInteger('autoEcole_id')->nullable(false);//non negative value
            $table->unsignedBigInteger('permis_id')->nullable(false);
            $table->timestamps();
           

            // Foreign key 
           // $table->foreign('autoEcole_id')->references('id')->on('autoEcoles')->onDelete('cascade');
           // $table->foreign('permis_id')->references('id')->on('permis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_vehicules');
    }
};
