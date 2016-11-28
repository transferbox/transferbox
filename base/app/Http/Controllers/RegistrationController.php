<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use View;
use App\Transferusers;

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
     * Store a newly created resource in storage.
     *
     * @return Response
   */
  public function store()
      {
          $rules = array(
              'name'          => 'required',
              'email'         => 'required|email',
              'transfertitle' => 'required'
          );
          $validator = Validator::make(Input::all(), $rules);

          if ($validator->fails()) {
              return Redirect::to('/registration')
                  ->withErrors($validator);
          } else {

            $usernameLength =
            $passwordStrength = "4"; // Set to 1, 2, 4 or 8.
            $passwordLength = "6"; // Set between 1 and 20.
            $accountLifetime = 60; // Days account is allowed to be active

            $username = randomStringGen("4", "0");
	          $password = randomStringGen($passwordLength, $passwordStrength);

            $nowDate = date('Y-m-d H:i:s');
            $expireDate = strtotime("+$accountLifetime day", $nowDate);

              $transferUser = new Transferusers;
              $transferUser->ftp_username     = "";
              $transferUser->ftp_password     = "";
              $transferUser->ftp_quota        = 0;
              $transferUser->ftp_dir          = "";
              $transferUser->ftp_ipaccess     = "*";
              $transferUser->tb_title         = Input::get('title');
              $transferUser->tb_name          = Input::get('name');
              $transferUser->tb_email         = Input::get('email');
              $transferUser->tb_comment       = Input::get('comment');
              $transferUser->tb_regdate       = $nowDate;
              $transferUser->tb_expdate       = $expireDate;
              $transferUser->tb_status        = 1;
              $transferUser->save();

              Session::flash('message', 'Successfully created nerd!');
              return Redirect::to('nerds');
          }
      }
}
