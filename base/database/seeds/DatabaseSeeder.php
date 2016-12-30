<?php

use Illuminate\Database\Seeder;
use App\User as User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create( [
        'email' => 'admin@transferbox.io' ,
        'password' => Hash::make( 'TransferBox!' ) ,
        'name' => 'TransferBox Admin' ,
      ]);
    }
}
