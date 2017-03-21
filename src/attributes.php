<?php

function manage_attribute( $content, $attribute="", $callback ) {
    if (! is_string( $attribute ) || empty($attribute) ) {
        return $content;
    }
    if (strpos($content, " {$attribute}=\"") !== false) {
        $replace = function( $match ) use ( $attribute, $callback ) { 
            if ( is_string($result = $callback($match[1])) ) {
                $result = trim( $result );
                return "{$attribute}=\"{$result}\"";
            } 
            return $match[0];
        };
        $pattern = '/'. $attribute .'="(.*?)"/';
        $changes = preg_replace_callback($pattern, $replace, $content);
        if ( $changes !== null ) {
            return $changes;
        }

    } else {
        $result = $callback("");
        if (! is_string($result) || empty($result)) {
            return $content;
        }
        $result = trim($result);
        $replacement = "$1 {$attribute}=\"{$result}\"";
        return preg_replace('/(<[^\s|\>|\/]+)/', $replacement, $content);
    }

    return $content;
}

function add_class( $content, $class="" ) {
    if (! is_string( $class ) || empty($class) ) {
        return $content;
    }
    return manage_attribute( $content, "class", function($attr) use ($class) {
        $result = array_merge(explode(" ", $attr), explode(" ", $class));
        return implode(" ", array_unique($result));
    });
}

function remove_class( $content, $class="" ) {
    if (! is_string( $class ) || empty($class) ) {
        return $content;
    }
    return manage_attribute( $content, "class", function($attr) use ($class) {
        $result = array_diff(explode(" ", $attr), explode(" ", $class));
        return implode(" ", $result);
    });
}