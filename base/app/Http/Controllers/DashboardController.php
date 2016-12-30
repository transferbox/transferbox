<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use View;
use App\Transferusers;
use App\Systemstatus;
use Carbon\Carbon;
use Session;
Use File;

class DashboardController extends Controller
{

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function index()
  {

    $activeAccounts = Transferusers::where('tb_status', 1)->count();
    if(File::exists("/opt/transferbox/data/")) {
      $freeSpace = round(disk_free_space("/opt/transferbox/data/") / 1024 / 1024 / 1024);
    }
    elseif(File::exists("/ftpdata/")) {
      $freeSpace = round(disk_free_space("/ftpdata/") / 1024 / 1024 / 1024);
    }
    else {
      $freeSpace = "N/A";
    }

    $systemStatus      = Systemstatus::orderby('created_at', 'desc')->first();
    $systemStatusMore  = Systemstatus::limit(60)->get();

    return View::make('admin/dashboard', ['activeaccounts' => $activeAccounts, 'systemstatus' => $systemStatus, 'systemstatusmore' => $systemStatusMore]);
  }
}
?>
