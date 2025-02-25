<?php

namespace App;

class Controller {
  // this function is used to show html from views directory 
  protected function render($view, $data = []) {
    extract($data);

    include "$view";
  }
}

?>