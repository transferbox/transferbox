<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('systemstatuses')->insert([
          'parameter' => 'ftpdata_totalspace',
          'value'     => '0',
      ]);

      DB::table('systemstatuses')->insert([
          'parameter' => 'ftpdata_freespace',
          'value'     => '0',
      ]);

      DB::table('systemstatuses')->insert([
          'parameter' => 'ftpdata_usedspace',
          'value'     => '0',
      ]);

      DB::table('systemstatuses')->insert([
          'parameter' => 'ftpdata_numberfolders',
          'value'     => '0',
      ]);

      DB::table('systemstatuses')->insert([
          'parameter' => 'dashboard_activeusers',
          'value'     => '0',
      ]);

      DB::table('systemstatuses')->insert([
          'parameter' => 'dashboard_expirednondeleted',
          'value'     => '0',
      ]);
    }
}
