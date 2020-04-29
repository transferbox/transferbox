<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferusers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ftp_username', 32)->unique();
            $table->string('ftp_password', 64);
            $table->string('ftp_quota', 32)->nullable();
            $table->string('ftp_dir');
            $table->string('ftp_ipaccess', 15)->nullable();
            $table->string('tb_title');
            $table->string('tb_name');
            $table->string('tb_email');
            $table->text('tb_comment')->nullable();
            $table->datetime('tb_regdate');
            $table->datetime('tb_expdate');
            $table->integer('tb_status');
            $table->string('tb_uuid', 36)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transferusers', function (Blueprint $table) {
          Schema::drop('transferusers');
        });
    }
}
