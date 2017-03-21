<?php

require_once("../src/meta-tags.php");

meta_tags(array(
    "title" => "Title",
    "description" => "description",
    "og:image" => "screenshot.png",
    "og:locale" => array(
        "pl_PL",
        "alternate" => array(
            "en_EN",
            "fr_FR"
        )
    )
));

echo "success";