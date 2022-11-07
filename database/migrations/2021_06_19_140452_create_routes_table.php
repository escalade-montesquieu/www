<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // bloc or route
            $table->string('diff'); // 7a, 4b etc ou 'Difficile', 'Moyen'
            $table->string('color'); // rouge, violet, vers etc
            $table->string('sectors'); // r1, t3 pour voie 1 et traversée 3 
                                       // pas plus de 91 caractères

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
