<?php
namespace App\Classes;

use App\Controller;


class AuthController extends Controller {

  public function index() {
    $url = htmlspecialchars("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    $parts = parse_url($url);
    
    // echo $url;
    if(isset($parts["query"])) {
      parse_str($parts['query'], $query);
      if(isset($query["signup"])) {
        include "../src/classes/auth/signup.view.php";
        return;
      }
    }

    include "../src/classes/auth/login.view.php";
  }

  public function login() {
    var_dump($_POST);
  }

}


?>