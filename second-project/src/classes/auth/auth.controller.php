<?php
namespace App\Classes;

use App\Controller;
use App\Classes\PDO;



class AuthController extends Controller {
  private $pdo;

  public function __construct() {
    $this->pdo = new PDO();
  }

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

  public function signup() {
    global $pdo;

    $_POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $authToken = bin2hex(random_bytes(20));

    $request_res = $this->pdo->execute(
      "INSERT INTO users (email, password, authToken) VALUES (:email, :password, :token)",
      [ 'email' => $email, 'password' => $password, 'token' => $authToken ]
    );

    var_dump($request_res);

    // echo json_encode([ 'email' => $email, 'password' => $password ]);

    // var_dump($_POST);
  }

}


?>