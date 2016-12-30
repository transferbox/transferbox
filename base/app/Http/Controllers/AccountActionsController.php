<?php

namespace App\Http\Controllers;

use View;
use App\Transferusers;
use Carbon\Carbon;
use Session;
use App\Configuration;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExtendAccount;
use Illuminate\Support\Facades\Redirect;


class AccountActionsController extends Controller
{
  public function resend($userUuid)
  {
    Session::flash('message', "Function is not working in this version...");
    return Redirect::to('errormessage');
  }

  public function extend($userUuid)
  {

    $accountRenewalTime = Configuration::where('parameter', 'accountlifetimerenewal')->value('value');

    $transferUser = Transferusers::where('tb_uuid', $userUuid)->get();
    $nowDate = Carbon::now();
    $expireDate = new Carbon();
    $expireDate = Carbon::parse($transferUser{0}->tb_expdate);

    if($expireDate < $nowDate)
    {
      Session::flash('message', "System error, account should have been disabled.");
      return Redirect::to('errormessage');
    }
    elseif($transferUser{0}->tb_status == 0)
    {
      Session::flash('message', "Account is already deleted!");
      return Redirect::to('errormessage');
    }
    elseif($expireDate->diffInDays($nowDate) > 10)
    {
      $errorMessage = $expireDate->diffInDays($nowDate) . "You cannot extend this account yet.<p>You can extend in " . $expireDate->subDays(10)->diffForHumans() . "</p>";
      Session::flash('message', $errorMessage);
      return Redirect::to('errormessage');
    }
    elseif($expireDate->diffInDays($nowDate) <= 11)
    {

      $expireDate->addDays($accountRenewalTime);
      $updateUser = Transferusers::find($transferUser{0}->id);
      $updateUser->tb_expdate = $expireDate;
      $updateUser->save();

      $emailData = array();
      $emailData['ftp_username']              = $transferUser{0}->ftp_username;
      $emailData['tb_title']                  = $transferUser{0}->tb_title;
      $emailData['tb_expdate']                = $expireDate;
      $emailData['tmpl_emailtemplatetitle']   = Configuration::where('parameter', 'emailtemplatetitle')->value('value');
      $emailData['tmpl_emailpoweredby']       = Configuration::where('parameter', 'emailpoweredby')->value('value');
      $emailData['tmpl_emailpoweredbylink']   = Configuration::where('parameter', 'emailpoweredbylink')->value('value');
      $emailData['tmpl_accountlifetimerenewal'] = Configuration::where('parameter', 'accountlifetimerenewal')->value('value');

      $emailConfig['emailfrom']                   = Configuration::where('parameter', 'emailfrom')->value('value');
      $emailConfig['emailfromaddress']            = Configuration::where('parameter', 'emailfromaddress')->value('value');
      $emailConfig['emailsubjectextendedaccount'] = Configuration::where('parameter', 'emailsubjectextendedaccount')->value('value');

      Mail::to($transferUser{0}->tb_email)->send(new ExtendAccount($emailData, $emailConfig));

      return View::make('status/extention_success', ['expiredate' => $expireDate]);

    }
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
