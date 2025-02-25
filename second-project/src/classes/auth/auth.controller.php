<?php
namespace App\Classes;

use App\Controller;


class AuthController extends Controller {

  public function index() {
    $url = htmlspecialchars("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    $parts = parse_url($url);
    parse_str($parts['query'], $query);

    // echo $url;
    if($query["signup"]) {
      include "../src/classes/auth/signup.view.php";
    } else {
      include "../src/classes/auth/login.view.php";
    }

  }

}


?>