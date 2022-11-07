<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('blog')->index(); // slug du blog 
            $table->datetime('datetime')->nullable(); // datetime 
            $table->string('location')->nullable(); // Lieu
            $table->text('content')->nullable();

            // matos et grimpeurs
            $table->integer('maxplaces')->default('-1');
            $table->mediumText('availables')->nullable(); // nom des grimpeurs venant et le matériel demandé
            $table->mediumText('unavailables')->nullable(); // ceux étant indisponibles

            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog');
    }
}
