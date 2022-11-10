<?php

use App\Enums\UserRole;
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
            $table->uuid('id')->primary();

            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('email_preferences');
            $table->string('password');

            $table->string('role');
            $table->foreignId('student_id')->nullable();

            $table->string('avatar_url')->nullable();
            $table->mediumText('bio')->nullable();
            $table->string('max_voie');
            $table->string('max_bloc');
            $table->string('display_max');
            $table->string('rent_shoes')->nullable();
            $table->boolean('rent_harness');

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
