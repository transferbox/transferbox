<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Systemstatus;
use App\Transferusers;

class WorkerSystemstatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'worker:systemstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Background worker process for general system status';

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
        $ftpdataTotalSpace = disk_total_space("/opt/transferbox/data/");
        $ftpdataFreeSpace = disk_free_space("/opt/transferbox/data/");
        $ftpdataUsedSpace = $ftpdataTotalSpace - $ftpdataFreeSpace;
        $ftpdataNumberFolders = (count(scandir("/opt/transferbox/data/")) - 2);

        $transferUser = Transferusers::where('tb_status', 1)->count();
        if($ftpdataNumberFolders - $transferUser  <= 0)
        {
          $expiredNonDeleted = 0;
        }
        else {
          $expiredNonDeleted = $ftpdataNumberFolders - $transferUser;
        }

        $systemStatus = new Systemstatus;
        $systemStatus->ftpdata_totalspace             = $ftpdataTotalSpace;
        $systemStatus->ftpdata_freespace              = $ftpdataFreeSpace;
        $systemStatus->ftpdata_usedspace              = $ftpdataUsedSpace;
        $systemStatus->ftpdata_numberfolders          = $ftpdataNumberFolders;
        $systemStatus->dashboard_activeusers          = $transferUser;
        $systemStatus->dashboard_expirednondeleted    = $expiredNonDeleted;
        $systemStatus->save();
    }
}
