<?php

namespace App\Http\Controllers;

use View;
use App\Transferusers;

class AdminUsersController extends Controller
{
  public function index()
  {
    $transferUsers = Transferusers::where('tb_status', 1)->get();
    return View::make('admin/users', ['transferusers' => $transferUsers]);
  }

  public function view($userUuid)
  {
    $transferUser = Transferusers::where('tb_uuid', $userUuid)->get();
    return View::make('admin/viewuser', ['transferuser' => $transferUser, 'userUuid' => $userUuid]);
  }
}
?>
