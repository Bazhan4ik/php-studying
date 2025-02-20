<?php

function createError(string $str) {
  return ("<div class='required-message'>$str</div>");
}

function verifyRawString($str) {
  $str = trim($str);
  $str = stripslashes($str);
  $str = htmlspecialchars($str);
  return $str;
}

?>