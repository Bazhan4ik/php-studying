<?php if(!isset($post)) return; ?>


<div class="post" id="post-<?php echo $post["id"]; ?>">
  <div class="author">
    <p>
      Written by <?php echo $post['email']; ?>
    </p>
  </div>
  <div class="title">
    <?php if($post['email'] == $user['email']): ?>
    <button class="remove" onclick="removePost(<?php echo $post["id"]; ?>)">
      <img src="./assets/rubbish-bin.svg">
    </button>
    <?php endif; ?>
    <p>
      <?php echo $post['title']; ?>
    </p>
  </div>
  <div class="text">
    <p>
      <?php echo $post['text']; ?>
    </p>
  </div>
  <div class="tags">
    <?php
    $tags = json_decode($post['tags']);
    if(count($tags) > 0):
    ?>
      <?php foreach($tags as $tag): ?>
        <p>
          <?php echo $tag ?>
        </p>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>