<?php

echo "what is the problem";
$myfile = fopen("../messages/21-04-08/11/02:04:03, "r);
while (!feof($myfile)) {
   echo fgets($myfile).'<br>';
}
?>
