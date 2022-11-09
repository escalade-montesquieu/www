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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->tinyInteger('level')->default(0); // niveau de perm
            $table->string('img'); // lien de la photo de profil
            $table->string('email')->unique();
            $table->string('email_preferences')->default('');
            $table->string('password');
            $table->mediumText('bio')->nullable(true);
            $table->string('max_voie')->default('Non renseigné');
            $table->string('max_bloc')->default('Non renseigné');
            $table->string('display_max')->default(true);
            $table->string('shoes')->default("no-need");
            $table->boolean('harness')->default(false);
            $table->tinyInteger('warn')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
