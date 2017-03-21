<?php

require_once("../src/image-orientation.php");
require_once("../src/attributes.php");

$img = '<img src="http://placehold.it/350x150" alt="image" width="350" data-misleading="100px" height="150"/>';
$img = add_class( $img, get_image_orientation($img));
echo $img;