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


$html =
    '<div class="level-0"></div>
    <div class="level-0">
        <div class="level-1">
            <div class="level-2">
                <div class="level-3">deep nested div</div>
            </div>
        </div>
        <div class="level-1">nested div</div>
        <p>ignore other tags like this paragraph</p>
    </div>
    <div class="level-0">
        <div class="level-1">nested div</div>
    </div>';
?>

<style>
    body { font-family:sans-serif; }
    section { margin:0 auto; padding:16px 0; max-width:600px;}
    div { color:#fff; padding:12px; margin-bottom:4px }
    div:last-child { margin-bottom:0 }
    .level-0 { background:#90A4AE }
    .level-1 { background:#607D8B }
    .level-2 { background:#455A64 }
    .level-3 { background:#263238 }
</style>

<section>
    <h1>reference</h1>
    <?php echo $html; ?>
</section>
<section>
    <h1>first level</h1>
    <?php echo implode(slice_tag("<div>", $html, 1)); ?>
</section>
<section>
    <h1>second level</h1>
    <?php echo implode(slice_tag("<div>", $html, 2)); ?>
</section>
<section>
    <h1>third level</h1>
    <?php echo implode(slice_tag("<div>", $html, 3)); ?>
</section>