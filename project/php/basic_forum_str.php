<?php

session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == false) {
  header("location: login.php");
  exit;
}

// Include config file
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET["ask"])) {
    if ($_GET["question"] != "") {
      $insert = "INSERT INTO user_questions (user, question) VALUES (?, ?)";

      // prepare insert statement
      if ($stmt = $mysqli->prepare($insert)) {
        $stmt->bind_param("ss", $param_user, $param_question);

        $param_user = $_SESSION["username"];
        $param_question = trim($_GET["question"]);

        if ($stmt->execute()) {
          session_start();
          $_SESSION["asked_question"] = trim($_GET["question"]);
          // Redirect to forum page
          header("location: discussion_page.php");
        }
        else {
          echo "<script>alert('Sorry for inconvenience. PLease try again')</script>";
        }

        // Close Statement
        $stmt->close();
      }
    }
    else {
      header("location: forum.php");
    }
  }

  // Push Comment to Database
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["add_comment"])) {

      if ($_GET["comment"] != "") {
        $insert = "INSERT INTO user_comments (question, user, comment) VALUES (?, ?, ?)";

        // prepare insert statement
        if ($stmt = $mysqli->prepare($insert)) {
          $stmt->bind_param("sss", $param_question, $param_user, $param_comment);

          $param_question = $_SESSION["asked_question"];
          $param_user = $_SESSION["username"];
          $param_comment = trim($_GET["comment"]);

          if ($stmt->execute()) {

            // Redirect to discussion_page
            header("location: discussion_page.php");
          }
          else {
            echo "<script>alert('Sorry for inconvenience. PLease try again')</script>";
          }

          // Close Statement
          $stmt->close();
        }
      }
      else {
        header("location: discussion_page.php");
      }
    }
  }

  // Account user search - question
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["search"])) {

      if (!empty(trim($_GET["question"]))) {

        // assigning session variable to asked query
        session_start();
        $_SESSION["asked_question"] = trim($_GET["question"]);

        // Redirect to Discussion Page
        header("location: discussion_page.php");
      }
      else {
        header("location: forum.php");
      }
    }
  }

  // Close connection
  $mysqli->close();
}


 ?>
