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
            $table->integer('modele');
            $table->string('matricule')->unique();
            $table->string('marque');
            $table->unsignedBigInteger('autoEcole_id');
            $table->unsignedBigInteger('permis_id');
            $table->timestamps();
            $table->softDeletes();
            
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
        Schema::table('vehicules', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
