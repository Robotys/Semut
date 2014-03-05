<?php
	
	require('functions.php');
	require('parsedown.class.php');
	
	// dumper(base_uri('read/more/money'));
	articles();

	$md = file_get_contents('mds/sample-markdown.md');

	$html = Parsedown::instance()->parse($md);

?>