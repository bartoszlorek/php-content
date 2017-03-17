<?php

// <tag> or [tag]
function split_tag($tag, $content="") {
    if ( empty($content) ) {
        return array();
    }
    $tagLength = strlen($tag) - 1;
    $tagStart = substr($tag, 0, -1);
    $tagEnd = "/" . substr($tag, 1);

    if (! function_exists("is_empty_trim")) {
        function is_empty_trim($value) {
            return !empty(trim($value));
        }
    }
    $reg = '/(?='. $tagStart .')|(?<=\\'. $tagEnd .')/sm';
    $parts = preg_split($reg, $content, 0, PREG_SPLIT_NO_EMPTY);
    $parts = array_values(array_filter($parts, "is_empty_trim"));
    $index = 0;

    // find all closing states
    $lastState = 0;
    foreach($parts as $part) {
        $part = trim($part);
        $in = substr($part, 0, $tagLength) == $tagStart;
        $out = substr($part, -$tagLength-1) == $tagEnd;

        if (!$in && !$out) {
            $lastState = 0;

        } else {
            $close = $in && $out ? "close" : "in";
            if (! $in && $out) $close = "out";
            if ($close === "in") $lastState++;
            else if ($close === "out") $lastState--;
        }
        $closing[] = $lastState > 0;
    }
    
    // merge deep levels
    foreach($parts as $key => $part) {
        $prev = $key > 0 ? $closing[$key-1] : 0;

        if ($closing[$key] > 0 || $prev > 0) {
            if (! isset($result[$index]) )
                $result[$index] = "";
            $result[$index] .= $part;
            
        } else {
            $result[] = $part;
            $index++; 
        }
    }
    return $result;
}


$html =
    '<div class="level-1">
        <p>match only first level elements</p>
    </div>
    <div class="level-1">
        <div class="level-2">
            <div class="level-3">deep nested</div>
        </div>
        <div class="level-2">
            <p>ignore other tags</p>
        </div>
    </div>
    <div class="level-1"></div>';

print_r( split_tag("<div>", $html) );

echo $html;