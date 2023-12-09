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
            $table->string('couleur');
            $table->unsignedBigInteger('autoEcole_id');
            $table->unsignedBigInteger('permis_id');
            $table->timestamps();
            $table->softDeletes();
            
           
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
