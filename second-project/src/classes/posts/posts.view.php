<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Posts</title>
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style><?php include "../src/classes/posts/posts.style.css" ?></style>


<?php

use App\Classes\PostsController;
$postsController = new PostsController();
$posts = $postsController->getPosts();
$user = $postsController->getUser();

?>


<div class="header">
  <div class="title">
    <h1>Posts</h1>
  </div>
  <div class="logout">
    You are <?php echo $user['email']; ?>
    <button id="logout">Logout</button>
  </div>
</div>


<?php include "./../src/classes/posts/write-post.view.php"; ?>
<script> <?php include "./../src/classes/posts/posts.js"; ?> </script>


<div class="posts" id="post-list">
<?php
if(count($posts) > 0):
?>
    <?php foreach($posts as $post): ?>
      <?php include "./../src/classes/posts/post.view.php"; ?>
    <?php endforeach; ?>
<?php endif; ?>
</div>


</body>
</html>