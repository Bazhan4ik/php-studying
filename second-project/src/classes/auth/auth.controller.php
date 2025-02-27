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

    // check if the user is already logged in
    session_start();
    if(isset($_SESSION["authToken"])) {
      header("Location: /posts");
      exit;
    }

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
    $_POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST["email"];
    $password = $_POST["password"];

    $requestRes = $this->pdo->execute(
      "SELECT * FROM users WHERE email = :email LIMIT 1",
      [ 'email' => $email ]
    );

    if(!$requestRes || !isset($requestRes[0])) {
      var_dump($requestRes);
      echo json_encode([ 'error' => 'invalid_data' ]);
      return;
    }

    $user = $requestRes[0];

    $correctPassword = password_verify($password, $user['password']);

    if(!$correctPassword) {
      echo json_encode([ 'error' => 'incorrect_password' ]);
      return;
    }

    $authToken = bin2hex(random_bytes(20));
    
    session_start();
    $_SESSION["authToken"] = $authToken;
    $_SESSION["email"] = $email;

    $this->pdo->execute(
      "UPDATE users SET authToken = :token WHERE email = :email",
      [ 'email' => $email, 'token' => $authToken ]
    );

    echo json_encode([ 'success' => true ]);
    
    die();

  }

  public function signup() {
    $_POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST["email"];

    $request_res = $this->pdo->execute(
      "SELECT * FROM users WHERE email = :email",
      [ 'email' => $email ]
    );
    if(isset($request_res[0])) {
      echo json_encode([ 'success' => false, 'error' => 'email' ]);
      exit;
    }

    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $authToken = bin2hex(random_bytes(20));

    $request_res = $this->pdo->execute(
      "INSERT INTO users (email, password, authToken) VALUES (:email, :password, :token)",
      [ 'email' => $email, 'password' => $password, 'token' => $authToken ]
    );


    echo json_encode([ 'success' => true, 'email' => $email, 'password' => $password ]);

  }

  public function logout() {

    session_start();
    session_unset();
    session_destroy();

    echo json_encode([ 'success' => true ]);

  }

}


?>