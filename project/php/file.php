<?php

echo "what is the problem";
$myfile = fopen("../messages/ww", "w");
$text = "wowowowowowwo";
fwrite($myfile, $text);
$myfile = fopen("../messages/ww", "r");
while (!feof($myfile)) {
   echo fgets($myfile).'<br>';
}
?>
