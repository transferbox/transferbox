<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use View;
use App\Transferusers;
use Carbon\Carbon;
use Session;
use Uuid;

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

      $usernameLength = 6;
      $passwordStrength = "4"; // Set to 1, 2, 4 or 8.
      $passwordLength = "6"; // Set between 1 and 20.
      $accountLifetime = 60; // Days account is allowed to be active

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
