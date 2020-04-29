<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DbupgradeTransferusers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transferusers', function (Blueprint $table) {
          $table->integer('tb_expmailsent');
          $table->integer('tb_accountdeleted');
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
          $table->dropColumn(['tb_expmailsent', 'tb_accountdeleted']);
        });
    }
}
