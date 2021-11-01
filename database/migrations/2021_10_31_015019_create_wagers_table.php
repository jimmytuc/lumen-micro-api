<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wagers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_wager_value');
            $table->integer('odds');
            $table->integer('selling_percentage');
            $table->decimal('selling_price', 9, 4);
            $table->decimal('current_selling_price', 9, 4);
            $table->integer('percentage_sold')->nullable();
            $table->decimal('amount_sold', 9, 4)->nullable();
            $table->timestamp('placed_at');
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
        Schema::dropIfExists('wagers');
    }
}
