<?php

/*
array(
    "author" => "",
    "description" => "",
    "robots" => "index, follow",
    "fb:app_id" => "",
    "og:title" => "",
    "og:type" => "website",
    "og:url" => "",
    "og:image" => "",
    "og:description" => "",
    "og:locale" => array(
        "pl_PL",
        "alternate" => array(
            "en_US"
            "fr_FR"
        )
    ),
    "og:site_name" => "",
    "og:video" => "",

    ...
);
*/

function meta_tags( $data=array() ) {
    if (! is_array( $data) || empty($data)) {
        return "";
    }
    $echo = function ($property, $content) use (&$echo) {
        if (is_array($content)) {
            foreach ($content as $key => $value ) {
                $key = !is_int($key) ? ":$key" : "";
                $echo($property.$key, $value);
            }
        } else {
            $attr = strpos($property, ":") !== false ? "property" : "name";
            echo "<meta $attr='$property' content='$content' />";
        }
    };
    foreach ($data as $property => $content) {
        $echo($property, $content);
    }
}