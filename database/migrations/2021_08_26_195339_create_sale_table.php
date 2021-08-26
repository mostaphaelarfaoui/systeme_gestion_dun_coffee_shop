<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_table', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("table_id")->unsigned();
            $table->bigInteger("sales_id")->unsigned();
            $table->foreign("table_id")
                ->references("id")
                ->on("tables")
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
        Schema::table('sale_table', function (Blueprint $table) {
            //
        });
    }
}