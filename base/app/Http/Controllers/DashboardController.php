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

class DashboardController extends Controller
{

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function index()
  {
    return View::make('admin/dashboard');
  }

}
?>
