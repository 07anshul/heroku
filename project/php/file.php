<?php

echo "what is the problem";
$myfile = fopen("../messages/ww", "r");
while (!feof($myfile)) {
   echo fgets($myfile).'<br>';
}
?>
