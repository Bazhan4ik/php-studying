<?php
namespace App\Classes;

use App\Controller;
use App\Classes\PDO;



class PostsController extends Controller {
  private $pdo;

  public function __construct() {
    $this->pdo = new PDO();
  }

  // the action that is called when the controller matches the request
  public function index() {
    // renders views/index.php
    session_start();

    if(!isset($_SESSION["authToken"])) {
      header("Location: /auth");
      exit;
    }

    $this->render('../src/classes/posts/posts.view.php');
  }


  public function addPost() {
    session_start();

    $_POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $title = $_POST["title"];
    $text = $_POST["text"];
    $tags = $_POST["tags"];


    $user = $this->getUser();


    $postId = $this->pdo->executeReturnId(
      "INSERT INTO posts (title, text, tags, userId, email) VALUES (:title, :text, :tags, :userId, :email)",
      [ 'title' => $title, 'tags' => json_encode(explode(" ", $tags)), 'text' => $text, 'userId' => $user['id'], 'email' => $user['email'] ]
    );

    // var_dump($postId);
    echo json_encode([ 'success' => true, 'userId' => $user['id'], 'postId' => $postId, 'userEmail' => $user['email'] ]);
  }
  public function removePost() {
    session_start();

    $_POST = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $postId = $_POST['id'];

    if(!$postId) {
      echo json_encode([ 'success' => false ]);
      exit;
    }

    $result = $this->pdo->execute(
      "DELETE FROM posts WHERE id = :id",
      [ 'id' => $postId ]
    );

    echo json_encode([ 'success' => true ]);



  }

  
  public function getPosts() {
    $requestRes = $this->pdo->execute(
      "SELECT * FROM posts;",
      [ ]
    );

    // var_dump($requestRes);
    return $requestRes;
  }


  public function getUser() {
    $authToken = $_SESSION["authToken"];

    $requestRes = $this->pdo->execute(
      "SELECT * FROM users WHERE authToken = :token LIMIT 1",
      [ 'token' => $authToken ]
    );

    if(!isset($requestRes[0])) {
      return null;
    }

    return $requestRes[0];
  }
}


?>