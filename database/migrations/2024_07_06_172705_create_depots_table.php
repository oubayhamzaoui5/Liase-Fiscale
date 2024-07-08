<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contribuable_id');
            $table->string('declaration_type');
            $table->string('exercice');
            $table->string('nature');
            $table->string('type');
            $table->string('bilan_actif')->nullable();
            $table->string('bilan_passif')->nullable();
            $table->string('etat_resultat')->nullable();
            $table->string('flux_tresorerie')->nullable();
            $table->string('resultat_fiscal_partiel')->nullable();
            $table->string('faits_marquants')->nullable();
            $table->string('autres_feuilles')->nullable();
            $table->string('situation')->default('en cours');
            $table->timestamps();

            $table->foreign('contribuable_id')->references('id')->on('contribuables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depots');
    }
}
