<?php

require_once("../src/slice-tag.php");

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