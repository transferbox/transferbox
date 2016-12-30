<?php

use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('configurations')->insert([
          'parameter' => 'usernamelength',
          'value'     => '6',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'passwordstrength',
          'value'     => '4',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'passwordlength',
          'value'     => '6',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'accountlifetime',
          'value'     => '60',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'accountlifetimerenewal',
          'value'     => '30',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'systemftpip',
          'value'     => '127.0.0.1',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'systemftphostname',
          'value'     => 'node.transferbox.io',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'emailsubjectnewaccount',
          'value'     => 'FTP Account Information',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'emailsubjectnewaccountinformation',
          'value'     => 'New FTP Account (Do not forward)',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'emailtemplatetitle',
          'value'     => 'Transferbox FTP account!',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'emailpoweredby',
          'value'     => 'Transferbox',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'emailpoweredbylink',
          'value'     => 'https://transferbox.io',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'emailfrom',
          'value'     => 'Transferbox FTP Creator',
      ]);

      DB::table('configurations')->insert([
          'parameter' => 'emailfromaddress',
          'value'     => 'your@domain.com',
      ]);
    }
}
