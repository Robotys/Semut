<?php
	$start_time = microtime(TRUE);
	require('functions.php');
	require('parsedown.class.php');

	$md = file_get_contents('mds/markdown-tutorial.md');

	$html = Parsedown::instance()->parse($md);

	$stop_time = microtime(TRUE);

?>