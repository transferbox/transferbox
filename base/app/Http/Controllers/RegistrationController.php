<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use View;
use App\Transferusers;
use App\Configuration;
use Carbon\Carbon;
use Session;
use Uuid;
use App\Mail\NewAccount;
use App\Mail\NewAccountInformation;

class RegistrationController extends Controller
{

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function index()
  {
    return View::make('registration');
  }

  /**
  * Store the new resource from registration form.
  *
  * @return Response
  */
  public function store()
  {
    $rules = array(
      'name'          => 'required',
      'email'         => 'required|email',
      'title'         => 'required'
    );
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) {
      return Redirect::to('/registration')
      ->withErrors($validator);
    } else {

      $usernameLength   = Configuration::where('parameter', 'usernamelength')->value('value');    // Length of username
      $passwordStrength = Configuration::where('parameter', 'passwordstrength')->value('value');; // Set to 1, 2, 4 or 8.
      $passwordLength   = Configuration::where('parameter', 'passwordlength')->value('value');;   // Set between 1 and 20.
      $accountLifetime  = Configuration::where('parameter', 'accountlifetime')->value('value');;  // Days account is allowed to be active

      $username = randomStringGen($usernameLength, "0");
      $password = randomStringGen($passwordLength, $passwordStrength);

      $nowDate = Carbon::now();
      $expireDate = Carbon::now();
      $expireDate->addDays($accountLifetime);
      $expireDate->format('Y-m-d H:i:s');

      $newUuid = Uuid::generate(4);

      $transferUser = new Transferusers;
      $transferUser->ftp_username     = $username;
      $transferUser->ftp_password     = $password;
      $transferUser->ftp_quota        = 0;
      $transferUser->ftp_dir          = "/opt/transferbox/data/$username";
      $transferUser->ftp_ipaccess     = "*";
      $transferUser->tb_title         = Input::get('title');
      $transferUser->tb_name          = Input::get('name');
      $transferUser->tb_email         = Input::get('email');
      $transferUser->tb_comment       = Input::get('comment');
      $transferUser->tb_regdate       = $nowDate;
      $transferUser->tb_expdate       = $expireDate;
      $transferUser->tb_status        = 1;
      $transferUser->tb_uuid          = $newUuid;
      $transferUser->save();

      $emailData = array();
      $emailData['ftp_username']                = $username;
      $emailData['ftp_password']                = $password;
      $emailData['tb_title']                    = Input::get('title');
      $emailData['tb_expdate']                  = $expireDate;
      $emailData['tb_uuid']                     = $newUuid;
      $emailData['tmpl_systemftphostname']      = Configuration::where('parameter', 'systemftphostname')->value('value');
      $emailData['tmpl_emailtemplatetitle']     = Configuration::where('parameter', 'emailtemplatetitle')->value('value');
      $emailData['tmpl_emailpoweredby']         = Configuration::where('parameter', 'emailpoweredby')->value('value');
      $emailData['tmpl_emailpoweredbylink']     = Configuration::where('parameter', 'emailpoweredbylink')->value('value');
      $emailData['tmpl_accountlifetime']        = Configuration::where('parameter', 'accountlifetime')->value('value');
      $emailData['tmpl_accountlifetimerenewal'] = Configuration::where('parameter', 'accountlifetimerenewal')->value('value');

      $emailConfig = array();
      $emailConfig['emailfrom']                         = Configuration::where('parameter', 'emailfrom')->value('value');
      $emailConfig['emailfromaddress']                  = Configuration::where('parameter', 'emailfromaddress')->value('value');
      $emailConfig['emailsubjectnewaccount']            = Configuration::where('parameter', 'emailsubjectnewaccount')->value('value');
      $emailConfig['emailsubjectnewaccountinformation'] = Configuration::where('parameter', 'emailsubjectnewaccountinformation')->value('value');

      Mail::to(Input::get('email'))->send(new NewAccount($emailData, $emailConfig));
      Mail::to(Input::get('email'))->send(new NewAccountInformation($emailData, $emailConfig));
      Session::flash('email', Input::get('email'));
      return Redirect::to('registration_success');
    }
  }

  /**
  * Show successful page after registration
  *
  * @return Response
  */
  public function success()
  {
    return View::make('status/registration_success');
  }
}
