<?php
if(!isset($message)) {
  return;
}
?>

<div class="message" id="msg-<?php echo($message->id); ?>">

  <div class="name">
    <p>
      <?php echo($message->name); ?>
    </p>
    <button onclick="deleteMessage(<?php echo($message->id); ?>)">
      <img src="components/message/delete-button.svg" alt="rm">
    </button>
  </div>

  <div class="email">
    <p>
      <?php echo($message->email); ?>
    </p>
  </div>

  <div class="text">
    <p class="quote">"</p>
    <p class="msg">
      <?php echo($message->text); ?>
    </p>
  </div>

</div>