<?php

namespace App\Http\Controllers;

use View;
use App\Transferusers;
use Carbon\Carbon;
Use Session;
use Illuminate\Support\Facades\Redirect;


class AccountActionsController extends Controller
{
  public function resend($userUuid)
  {

  }

  public function extend($userUuid)
  {

    $accountRenewalTime = 30;

    $transferUser = Transferusers::where('tb_uuid', $userUuid)->get();
    $expireDate = new Carbon();
    $expireDate = Carbon::parse($transferUser{0}->tb_expdate);
    $expireDate->addDays($accountRenewalTime);
    $updateUser = Transferusers::find($transferUser{0}->id);
    $updateUser->tb_expdate = $expireDate;
    $updateUser->save();

    return View::make('status/extention_success', ['expiredate' => $expireDate]);

  }

  public function delete($userUuid)
  {
    $updateUser = Transferusers::where('tb_uuid', $userUuid)->first();
    $updateUser->tb_status = 0;
    $updateUser->save();

    return View::make('status/delete_success');
  }
}
?>
