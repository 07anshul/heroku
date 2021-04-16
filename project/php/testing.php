<?php

// Session start
session_start();

 ?>


<!-- Html - General page-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>General- <?php echo $_SESSION["username"]; ?></title>
    <link rel="stylesheet" type="text/css" href="/project/css/general.css">
  </head>
  <body>

    <h1>General!</h1>

    <div class="post">
         <?php

         require_once "config.php";

         $dir = 'users_directory/';

           $select = "SELECT follower_id From user_followers WHERE user_id = ?";

           if ($stmt = $mysqli->prepare($select)) {
             $stmt->bind_param("i", $param_user_id);
             $param_user_id = "11";

             if ($stmt->execute()) {
               $result = $stmt->get_result();
               while ($dir_name = $result->fetch_assoc()) {
                 $file_array = scandir($dir.$dir_name["follower_id"], 1);

                 foreach ($file_array as $key => $file_name) {
                   if (!in_array($file_name, array(".",".."))) {

                      $real_time_post_updation["$file_name"] = $dir_name["follower_id"];

                   }
                 }
               }
             }
         }

         krsort($real_time_post_updation);
         foreach ($real_time_post_updation as $file_name => $dir_name) {
           echo '<div class="post">';
           $user_post = fopen("$dir$dir_name/$file_name", "r");

           echo '|| '.$dir_name.'<br>';
           echo $file_name.'<br><br>';

           while (!feof($user_post)) {
             echo fgets($user_post).'<br>';
           }
            echo '<br>-----------------------------------------------';
            echo '</div>';
         }


          ?>
    </div>

  </body>
</html>
