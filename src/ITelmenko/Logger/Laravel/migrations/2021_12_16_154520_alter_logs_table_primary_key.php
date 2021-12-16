<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLogsTablePrimaryKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            config('logging.channels.mysql.table'),
            function (Blueprint $table) {
                $table->char('id', 26)->primary()->change();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            config('logging.channels.mysql.table'),
            function (Blueprint $table) {
                $table->char('id', 26)->primary()->change();
            }
        );
    }
}
