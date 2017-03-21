<?php

// <tag> or [tag]
function slice_tag( $tag, $content="", $depth=0 ) {
    if ( empty($content) ) {
        return array();
    }
    if (! is_int($depth) || $depth < 0 ) {
        $depth = 0;
    }
    $tagLength = strlen($tag) - 1;
    $tagStart = substr($tag, 0, -1);
    $tagEnd = "/" . substr($tag, 1);

    if (! function_exists( "is_empty_trim" )) {
        function is_empty_trim( $value ) {
            return !empty(trim( $value ));
        }
    }
    $reg = '/(?='. $tagStart .')|(?<=\\'. $tagEnd .')/sm';
    $parts = preg_split($reg, $content, 0, PREG_SPLIT_NO_EMPTY);
    $parts = array_values(array_filter($parts, "is_empty_trim"));
    $currentLevel = 0;
    $result = array();

    // guess level
    foreach( $parts as $part ) {
        $part = trim($part);
        $in = substr($part, 0, $tagLength) == $tagStart;
        $out = substr($part, -$tagLength-1) == $tagEnd;

        if ( !$in && $out ) $currentLevel--;
        $levels[] = $currentLevel;
        if ( $in && !$out ) $currentLevel++;
    }

    // slice by depth
    foreach( $parts as $key => $part ) {
        if ( $levels[$key] < $depth ) {
            continue;
        }
        $isClosing = isset( $levels[$key-1] )
            && $levels[$key-1] > $levels[$key];

        if ( $levels[$key] > $depth || $isClosing )
             $result[count($result) - 1] .= $part;
        else $result[] = $part;
    }
    
    return $result;
}