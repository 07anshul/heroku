<?php
session_start();
require_once "config.php";

// Search Question
$var_question = "";
if (isset($_GET["search"])) {

  if (!empty(trim($_GET["question"]))) {

    // assigining question searched
    $var_question = trim($_GET["question"]);
  }
}

//Question retrieval
$select = "SELECT user, ask_time FROM user_questions where question = ?";

// Prepare select statement
if ($stmt = $mysqli->prepare($select)) {
  $stmt->bind_param("s", $param_question);
  if ($var_question != "") {
    $param_question = $var_question;
  }
  else {
    $param_question = $_SESSION["asked_question"];
  }

  if ($stmt->execute()) {
    $stmt->store_result();

    // Check question is in Database
    if ($stmt->num_rows == 1) {
      $searched_question = $param_question;
      $stmt->bind_result($asker, $ask_time);
      $stmt->fetch();
    }
    else {
      // Redirect to NO result page
      header("location: error.php");
      exit;
    }
  }
  else {
    echo "<script>alert('Sorry for inconvenience. PLease try again')</script>";
  }

  // Close statement
  $stmt->close();
}

// Comment retrieval
$select = "SELECT user, comment, ans_time FROM user_comments where question = ?";

// Prepare select statement
if ($stmt = $mysqli->prepare($select)) {
  $stmt->bind_param("s", $param_question);
  if ($var_question != "") {
    $param_question = $var_question;
  }
  else {
    $param_question = $_SESSION["asked_question"];
  }

  if ($stmt->execute()) {

    // Retrieve all the comments
    $result = $stmt->get_result();


  }
  else {
    echo "<script>alert('Sorry for inconvenience. PLease try again')</script>";
  }

  // close statement
  $stmt->close();
}

$mysqli->close();
?>

<!-- Html - Discusssion Page -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>

    <header>

      <!-- Searching question form-->
      <div id="searched_question">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
          <textarea name="question" rows="2" cols="30" placeholder="Search Question"></textarea>
          <input type="submit" name="search" value="Search"><br>
        </form>
      </div>

      <div class="discussion_page_header">
        <!-- Task bar-->
        <nav>
            <div id="discussion_page_menu">
              <ul>
                <li><a href="./index.html">Home</a></li>
                <li><a href="forum.php">Ask Question</a></li>
                <li><a href="profile.php">My Profile</a></li>
              </ul>
            </div>
        </nav>
      </div>
    </header>

    <div class="question_section">
      <h2>Discussion</h2>
      <?php
      echo "$asker <br>";
      echo "$searched_question <br>";
      echo "$ask_time";
      ?>

    </div>

    <div class="thread">
      <h2>Thread</h2>
      <?php
      while ($comments = $result->fetch_assoc()) {
        echo $comments["user"].'<br>';
        echo $comments["comment"].'<br>';
        echo $comments["ans_time"].'<br>';
      }
      ?>
    </div>

    <div class="add_comment">
      <h2>Contribute</h2>
      <form class="add_comment" action="basic_forum_str.php" method="get">
        <textarea name="comment" rows="5" cols="120" placeholder="Make your contribution here"></textarea>
        <input id="add_comment" type="submit" name="add_comment" value="Push">
      </form>
    </div>

  </body>
</html>
