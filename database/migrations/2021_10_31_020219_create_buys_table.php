<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wager_id')->unsigned();
            $table->foreign('wager_id')
                ->references('id')
                ->on('wagers');
            $table->decimal('buying_price', 9, 4);
            $table->timestamp('bought_at')->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('buys', function (Blueprint $table) {
//            $table->dropIndex('wager_id');
//            $table->dropForeign('wager_id');
//            $table->dropColumn('wager_id');
//        });
        Schema::dropIfExists('buys');
    }
}
