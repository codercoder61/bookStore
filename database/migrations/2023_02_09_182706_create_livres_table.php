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
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string('ISBN_livre');
            $table->string('AUTEUR');
            $table->string('NOM');
            $table->year('EDITION');
            $table->string('DESCRIPTION');
            $table->integer('NBR_COPIES');
            $table->string('MAISON_EDITION');
            $table->integer('id_categorie');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE livres ADD IMAGES LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livres');
    }
};
