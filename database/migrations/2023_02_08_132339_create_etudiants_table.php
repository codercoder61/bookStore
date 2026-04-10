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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string("cin");
            $table->string("nom");
            $table->string("prenom");
            $table->string("groupe");
            $table->string("login");
            $table->string("password");
            $table->string("email");
            $table->integer("nbr_empr");
            $table->timestamps();
        });

        DB::statement("ALTER TABLE etudiants ADD profile LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
};
