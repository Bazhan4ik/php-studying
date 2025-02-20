<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" href="index.css" type="text/css">
  <link rel="stylesheet" href="components/message/message-component.css" type="text/css">
</head>
<body>

<script>
async function deleteMessage(messageId) {
  if (!confirm("Are you sure you want to delete this message?")) {
    return;
  }

  const result = await fetch('delete-message.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'id=' + encodeURIComponent(messageId),
  });

  const data = await result.json();

  if(data.success) {
    document.getElementById('msg-' + messageId).remove();
  }

  // .then(response => response.json())
  // .then(data => {
  //   if (data.success) {
  //     document.getElementById('msg-' + messageId).remove();
  //   } else {
  //     alert("Error deleting message: " + data.error);
  //   }
  // })
  // .catch(error => console.error("Fetch error:", error));
}
</script>







<?php
include "message.php";
include "utils.php";


$messages = [];

$name = $email = $msg = "";
$bigError = $nameErr = $emailErr = $msgErr = "";





if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(empty($_POST["name"])) {
    $nameErr = createError("Name is required");
  } else {
    $name = verifyRawString($_POST["name"]);
  }
  if(empty($_POST["email"])) {
    $emailErr = createError("Email is required");
  } else {
    $email = verifyRawString($_POST["email"]);
  }
  if(empty($_POST["message"])) {
    $msgErr = createError("Message is required");
  } else {
    $msg = verifyRawString($_POST["message"]);
  }


  // an error occured
  if($msgErr || $emailErr || $nameErr) {
    return;
  }

  $newMessage = new Message($email, $name, $msg);


  // save message
  try {
    $newMessage->save();
    setcookie("user_email", $newMessage->email, time() + (86400 * 30), "/");
    array_push($messages, $newMessage);

    // remove POST data so that no duplicate message is saved
    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();
  } catch (PDOException $e) {
    $bigError = "Something went wrong.";
  }
}


if($_COOKIE["user_email"]) {
  $messages = findMessages($_COOKIE["user_email"]);
}
?>

  <div class="screen">

    <form action="index.php" method="post">

      <div class="title">
        <h1>Send us a message:</h1>
      </div>
      
      <div class="input">
        <label for="name">
          Name
          <?php
          echo($nameErr);
          ?>
        </label>
        <input placeholder="Joe Goldberg" type="text" name="name">
      </div>

      <div class="input">
        <label for="email">
          E-mail 
          <?php
          echo($emailErr);
          ?>
        </label>
        <input placeholder="joe@goldberg.me" type="text" name="email">
      </div>

      <div class="message-input">
        <label for="textarea">
          Your message 
          <?php
          echo($msgErr);
          ?>
        </label>
        <textarea placeholder="Lorem ipsum dolor sit..." name="message"></textarea>
      </div>


      <div class="bottom">
        <div class="big-err">
          <?php echo($bigError) ?>
        </div>
        
        <div class="submit">
          <input type="submit">
        </div>
      </div>
    </form>
  
<?php if(count($messages) > 0): ?>

    <div class="messages">
      <div class="title">
        <h2>Your messages:</h2>
      </div>
      <?php foreach($messages as $message): ?>
        <?php include 'components/message/message-component.php'; ?>
      <?php endforeach; ?>

    </div>

  </div>

<?php endif ?>


</body>
</html>