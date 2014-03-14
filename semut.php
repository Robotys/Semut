<?php
	$start_time = microtime(TRUE);
	require('functions.php');
	require('parsedown.class.php');

	if(uri_segment(0) == false){
		//get latest
		$art = articles('date','DESC',1);
		// dumper($art);
		$md = get_content($art[0]['filename']);
		// $md = get_latest_post();


	}elseif(uri_segment(0) == 'read'){

		$slug = uri_segment(1);
		$filename = get_filename_from_slug($slug);
		$timestamp = filemtime('mds/'.$filename);
		$datetime = date('d M Y H:i a',$timestamp);
		$md = get_content($filename);

	}

	$html = Parsedown::instance()->parse($md);

	$stop_time = microtime(TRUE);

?>