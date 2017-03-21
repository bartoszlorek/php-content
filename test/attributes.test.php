<?php

require_once("../src/attributes.php");

$content = '<div class="dog cat house"></div>';
$content = add_class($content, "house building");
//$content = remove_class($content, "house");

echo $content;