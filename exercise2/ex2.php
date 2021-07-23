<?php

/**
 * Count Occurences of a word.
 *
 * @param $str String    Input Sentence
 * @return Array $word_count Associative Array with word as key, count as value
 *
*/
function countWords($str) {
	$words = explode(" ", strtolower($str));
	$word_count = array();
	foreach($words as $word) {
		if ($word == '') {
			continue;
		}
		if (isset($word_count[$word])) {
			$word_count[$word] += 1;
		}
		else {
			$word_count[$word] = 1;
		}
	}
	return $word_count;
}


/**
 * Generates table from word_count array.
 *
 * @param $arr Array  Word Count array
 * @return String $str $word_count array content as HTML table
 *
*/
function makeTable($arr) {
	$str = "<table>";
	$str .= "<tr><td>Word</td><td>Count</td></tr>";
	foreach($arr as $word=>$count) {
		$str .= "<tr><td>$word</td><td>$count</td></tr>";
	}
	$str .= "</table>";
	return $str;
}
?>
<html>
	<head>
		<title>Exercise 2</title>
	</head>
	<body>
		<?php
			if(isset($_GET['inp'])) {
				$counts = countWords($_GET['inp']);
				arsort($counts);
				echo makeTable($counts);
			}
		?>
		<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="GET">
			<input type="text" name="inp" />
			<input type="submit" />
		</form>
	</body>
</html>