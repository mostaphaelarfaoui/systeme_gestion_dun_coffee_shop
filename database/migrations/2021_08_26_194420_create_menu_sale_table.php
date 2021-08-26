<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_sale', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("menu_id")->unsigned();
            $table->bigInteger("sales_id")->unsigned();
            $table->foreign("menu_id")
                ->references("id")
                ->on("menu")
                ->onDelete("cascade");
            $table->foreign("sales_id")
                ->references("id")
                ->on("sales")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_sale', function (Blueprint $table) {
            $table->drop(["sales_id", "menu_id"]);
        });
    }
}