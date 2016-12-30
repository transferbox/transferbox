<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transferusers;
use Carbon\Carbon;


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
      // Start to disable expired accounts
      $nowDate = new Carbon();
      $transferUser = Transferusers::where('tb_status', 1)->whereDate('tb_expdate', '<=', $nowDate)->get();

      foreach ($transferUser as $user) {
        $updateUser = Transferusers::where('tb_uuid', $user->tb_uuid)->first();
        $updateUser->tb_status = 0;
        $updateUser->save();
      }
      // End of disable expired accounts
    }
}
