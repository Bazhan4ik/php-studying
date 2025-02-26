<?php
namespace App\Classes;

use App\Controller;



class PostsController extends Controller {

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
}


?>