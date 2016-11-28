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
            $table->string('ftp_dir')->nullable();
            $table->string('ftp_ipaccess', 15)->nullable();
            $table->string('tb_title')->nullable();
            $table->string('tb_name')->nullable();
            $table->string('tb_email')->nullable();
            $table->text('tb_comment')->nullable();
            $table->timestamp('tb_regdate')->nullable();
            $table->date('tb_expdate')->nullable();
            $table->enum('tb_status', ['0', '1']);
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
