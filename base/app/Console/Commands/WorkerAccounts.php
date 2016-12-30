<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transferusers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeletedAccount;
use App\Configuration;

class WorkerAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'worker:accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Background worker process for account tasks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $emailData = array();
      $emailConfig = array();
      $emailData['tmpl_emailtemplatetitle']   = Configuration::where('parameter', 'emailtemplatetitle')->value('value');
      $emailData['tmpl_emailpoweredby']       = Configuration::where('parameter', 'emailpoweredby')->value('value');
      $emailData['tmpl_emailpoweredbylink']   = Configuration::where('parameter', 'emailpoweredbylink')->value('value');
      $emailConfig['emailfrom']               = Configuration::where('parameter', 'emailfrom')->value('value');
      $emailConfig['emailfromaddress']        = Configuration::where('parameter', 'emailfromaddress')->value('value');

      // Start to disable expired accounts
      $nowDate = new Carbon();
      $transferUser = Transferusers::where('tb_status', 1)->whereDate('tb_expdate', '<=', $nowDate)->get();

      foreach ($transferUser as $user) {
        $updateUser = Transferusers::where('tb_uuid', $user->tb_uuid)->first();
        $updateUser->tb_status = 1;
        $updateUser->save();

        $emailData['ftp_username']              = $user->ftp_username;
        $emailData['tb_title']                  = $user->tb_title;
        $emailData['tb_expdate']                = $user->tb_expdate;

        Mail::to($user->tb_email)->send(new DeletedAccount($emailData, $emailConfig));
      }
      // End of disable expired accounts
    }
}
