<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemstatuses', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('ftpdata_totalspace');
            $table->bigInteger('ftpdata_freespace');
            $table->bigInteger('ftpdata_usedspace');
            $table->bigInteger('ftpdata_numberfolders');
            $table->bigInteger('dashboard_activeusers');
            $table->bigInteger('dashboard_expirednondeleted');
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
        Schema::dropIfExists('systemstatuses');
    }
}
