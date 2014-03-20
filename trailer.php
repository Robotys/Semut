<?php
	
	if(count($_POST) >0){
		file_put_contents('logs/tracker.log', $_POST['data'] . PHP_EOL, FILE_APPEND);
	}

?>