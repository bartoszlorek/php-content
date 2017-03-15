<?php

function get_heading_hierarchy( $content, $depth=0 ) {
	preg_match_all("/(?<=<h)(\d){1}.*?>([^<]*)/",
		$content, $matches, PREG_SET_ORDER);

	if (empty($matches)) {
		return array();
	}
	foreach ($matches as $index => $heading) {
		$size = (int) $heading[1];
		if ($depth < 1 || $size <= $depth) {
			$parent = null;

			for ($i=$index-1; $i>=0; $i--) {
				$parentSize = (int) $matches[$i][1];
				if ($size > $parentSize) {
					$parent = $i;
					break;
				}
			}
		} else {
			$parent = -1;
		}
		$parentIndexes[] = $parent;
	}
	
	$parse = function( $indexes, $rootIndex=null ) use (&$parse, $matches) {
		$output = array();
		foreach($indexes as $index => $parentIndex) {
			if ($parentIndex === $rootIndex) {
				unset($indexes[$index]);
				$output[] = array(
					"index" => $index,
					"text" => $matches[$index][2],
					"size" => (int) $matches[$index][1],
					"parent" => $parentIndex,
					"children" => $parse($indexes, $index)
				);
			}
		}
		return $output;
	};

	return $parse($parentIndexes);
}

function the_heading_hierarchy( $content, $depth=0 ) {
	$tree = get_heading_hierarchy($content, $depth);	
	$print = function ($tree) use (&$print) {
		if (empty($tree)) {
			return false;
		}
		$output = "";
		$ancestor = false;

		foreach($tree as $node) {
			if (is_null($node["parent"])) {
				$ancestor = true;
			}
			if (!isset($size)) {
				$size = $node["size"];
			}
			$output .= "<li class='heading-item'>";
			$output .= "<a data-index='{$node['index']}'>{$node['text']}</a>";
			$output .= $print($node["children"]);
			$output .= "</li>";
		}
		$class = $ancestor ? "heading-list" : "sub-heading";
		return "<ul class='{$class}' data-size='{$size}'>{$output}</ul>";
	};

	echo $print($tree);
}


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