<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            config('logging.channels.mysql.table'),
            function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->char('id', 26)->primary();
                $table->string('instance')->index();
                $table->string('channel')->index();
                $table->enum('level', [
                    'DEBUG',
                    'INFO',
                    'NOTICE',
                    'WARNING',
                    'ERROR',
                    'CRITICAL',
                    'ALERT',
                    'EMERGENCY'
                ])->default('INFO');
                $table->text('message');
                $table->mediumText('context');
                $table->timestamp('created_at', 6)->nullable();
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
        Schema::drop(config('logging.channels.mysql.table'));
    }
}
