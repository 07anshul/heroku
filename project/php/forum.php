<?php

session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == false) {
  header("location: login.php");
  exit;
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

      <!-- Searching question form-->
      <div id="searched_question">
        <form action="basic_forum_str.php" method="get">
          <textarea name="question" rows="2" cols="30" placeholder="Search Question"></textarea>
          <input type="submit" name="search" value="Search"><br>
        </form>
      </div>

    </header>

<div class="question_form">
  <form class="new_forum_page" action="basic_forum_str.php" method="get">
    <textarea name="question" rows="5" cols="120" placeholder="Ask Something Here"></textarea>
    <input id="ask_bttn" type="submit" name="ask" value="Ask">
  </form>
</div>

  </body>
</html>
