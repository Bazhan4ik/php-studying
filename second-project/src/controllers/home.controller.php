<?php
namespace App\Controllers;

use App\Controller;



class HomeController extends Controller {

  // the action that is called when the controller matches the request
  public function index() {
    // renders views/index.php
    $this->render('home/home.view.php');

  }
}


?>