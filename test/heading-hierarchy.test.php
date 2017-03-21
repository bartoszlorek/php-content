<?php

require_once("../src/heading-hierarchy.php");

$html = "<div>
    <h1>Equi blacept atibust</h1>
    <p>Aximolup taquat voluptatur? Ihit, sincias sincto ipissim peligni ssent.</p>
    <p>Et eum quiaspe non con corro modio eium int, est, odita diaturesto berum consequi?</p>
    <h2>Nam verecte optinissed</h2>
    <p>Quis inist offic tet occum exerum qui berempor aut accullati.</p>
    <blockquote>
        <h3>Equi blacept</h3>
        <h3>Sitatquam veriand</h3>
        <h4>Sluptatur autem quuntus</h4>
    </blockquote>
    <h2>Namus vel ilique</h2>
    <p>Sinihil lumqui tent parumenes nuscid min et hillabo.</p>
    <h1>Rentium liam nonectur</h1>
    <p>Quis inist offic tet occum exerum qui berempor aut accullati a et volume vellor?</p>
</div>";


//print_r( get_heading_hierarchy($html) );

the_heading_hierarchy($html);

echo $html;