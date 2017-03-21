<?php

function get_orientation( $width, $height ) {
    if (($width = (int) $width) < 1
    || ($height = (int) $height) < 1) {
        return "";
    }
    return $width >= $height
        ? "landscape"
        : "portrait";
}

function get_image_orientation( $content ) {
    $regex = '/width="(\d+).*?height="(\d+)/';
    if (preg_match($regex, $content, $match) !== 1) {
        return "";
    }
    return get_orientation($match[1], $match[2]);
}