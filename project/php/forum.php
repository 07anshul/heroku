<?php

session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == false) {
  header("location: login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $dir_path = 'forum_pages/';

  if (!empty($_POST["question"])) {

    $date = date("d-m-y");
    $time = date("H:i:s");
    $question = trim($_POST["question"]);

    $new_page_address = $dir_path.$question.'.php';

  if (isset($_POST["create_page"])) {
    $user_msg = fopen("$new_page_address", "x");

    header("location: $new_page_address");

  }
  }
}


 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="../css/forum.css">
  </head>
  <body>

    <header>
      <div class="forum_header">
        <!-- Task bar-->
        <nav>
            <div id="forum_menu">
              <ul>
                <li><a href="general.php">General</a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="suggestions.php">Suggestions</a></li>
                <li><a href="/project/index.html">Home</a></li>
              </ul>
            </div>
        </nav>
      </div>
    </header>

<div class="question_form">
  <form class="new_forum_page" action="" method="post">
    <textarea name="question" rows="8" cols="80" placeholder="Ask Something Here"></textarea>
    <input id="ask_bttn" type="submit" name="create_page" value="Ask">
  </form>
</div>

  </body>
</html>
