<?php
// Session start
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == false) {
  header("location: login.php");
  exit;
}

// Include config file
require_once "config.php";

 ?>

<!-- Html - Searched Profile -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["username"]; ?>/Followers</title>
    <link rel="stylesheet" type="text/css" href="../css/searched_profile.css">
  </head>
  <body>
    <?php

    // Prepare select statement
    $select = "SELECT "

     ?>

  </body>
</html>
