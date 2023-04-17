<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->unsignedBigInteger('order_column')
                    ->after('id')
                    ->nullable()
                    ->index();
            });

            $order = 1;
            foreach (DB::table('galleries')->get()->reverse() as $gallery) {
                DB::table('galleries')
                    ->where('id', $gallery->id)
                    ->update(['order_column' => $order]);

                $order++;
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('order_column');
        });
    }
};
