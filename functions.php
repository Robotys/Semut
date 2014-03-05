<?php
	
	session_start();

	CONST disalowed_uri_char = '!@#;\'&^|[]';
	CONST base_uri = 'http://localhost/semut';
	
	function elapse_time(){
		global $start_time;
		global $stop_time;

		return number_format(($stop_time - $start_time), 5).' second';
	}

	function dumper($multi){
		echo '<pre>';
		var_dump($multi);
		echo '</pre>';
	}

	function article_links($param = ''){
		$order_by = 'date';
		$sort_to = 'ASC';
		$limit = 0;

		$param = json_decode($param, TRUE); 
		if(isset($param) AND count($param) > 0){
			foreach($param as $key=>$val){
				$$key = $val;
			}
		}

		$all = articles($order_by, $sort_to, $limit);

		foreach($all as $post){
			$li[] = '<li><a href="'.site_url('read/'.$post['slug']).'">'.$post['title'].'</a></li>';
		}

		echo implode($li);
	}

	function articles($order_by = 'date', $sort_to = 'ASC', $limit = 0){
		// sedut dari mds

		$scanned = scandir('mds');

		foreach($scanned as $filename){
			if($filename !== '.' AND $filename !== '..' AND $filename !== '.DS_Store' AND $filename !== 'index.html') $files[] = $filename;
		}

		if($limit === 0) $limit = count($files);

		for($i = 0; $i < $limit; $i++){
			$filename = $files[$i];	
			$timestamp  = filemtime('mds/'.$filename);
			$param['timestamp'] = $timestamp;
			$param['datetime'] = date('d M Y H:i a',$timestamp);
			$param['filename'] = $filename;
			$param['slug'] = get_slug($filename);
			$param['title'] = get_title($filename);
			$param['excerpt'] = get_excerpt($filename);
			$fs[] = $param;	
		}

		return $fs;
	}

	function get_title($filename){
		$exp = explode('
', get_content($filename));

		return trim(str_replace('#', '', $exp[0]));
	}

	function get_content($filename){
		return file_get_contents('mds/'.$filename);
	}

	function get_excerpt($filename){
		$content = get_content($filename);
		$exp = explode('
', $content);

		// if(array_key_exists(0, $exp) !== FALSE) $arr[] = $exp[0];
		if(array_key_exists(1, $exp) !== FALSE) $arr[] = $exp[1];
		if(array_key_exists(2, $exp) !== FALSE) $arr[] = $exp[2];
		// if(array_key_exists(3, $exp) !== FALSE) $arr[] = $exp[3];
		// if(array_key_exists(4, $exp) !== FALSE) $arr[] = $exp[4];
		
		return trim(implode('
', $arr));
	}

	function get_slug($str){
		$ex = explode('.', $str);
		unset($ex[(count($ex)-1)]);
		$s = trim(implode(' ',$ex));
		$result = preg_replace("/[^a-zA-Z0-9 -_]+/", "", $s);
		$result = strtolower($result);
		$result = str_replace(' ', '-', $result);
		return $result;
	}

	function base_url($str = ''){
		if($str != '') return base_uri.'/'.$str;
		else return base_uri;
	}

	function site_url($str = ''){
		if($str != '') return base_uri.'/?/'.$str;
		else return base_uri;
	}

	function uri_segment($segment = 'all'){
		$uri_string = uri_string();
		
		if($uri_string !== false){
			$segments = explode('/', $uri_string);
			if($segment === 'all') return $segments;
			else{
				if(array_key_exists($segment, $segments) !== FALSE) return $segments[$segment];
				else return false;
			}
		}else{
			return false;
		}
	}

	function uri_string(){
		foreach($_GET as $string=>$val){
			// lalala;
		}

		$str = ISSET($string);

		// make a check to disable invalid uri_string
		if($str){ 
			$str = trim($string, '/');
			$allowed = check_uri_string($str);

			if($allowed === false) $str = false;
		}

		return $str;

	}

	function check_uri_string($str){
		if($str !== FALSE){
			$char = str_split(disalowed_uri_char);
			foreach($char as $character){
				if(strpos($str, $character) !== FALSE){ 
					$message = 'disallowed character ('.$character.') in uri string ('.$str.')';
					push_log($message);
					return false;
				}
			}

			return true;
		}
	}

	function console_log($toggle = true){
		if($toggle && count($_SESSION['semut_log']) > 0){

			foreach($_SESSION['semut_log'] as $log){
				echo '<pre style="color: #FF005A">semut_log: '.$log.'</pre>';
			}
			$_SESSION['semut_log'] = array();
		}
	}

	function push_log($message){
		if(array_key_exists('semut_log', $_SESSION) === FALSE){
			$_SESSION['semut_log'] = array();
		}

		$semut_log = $_SESSION['semut_log'];
		$semut_log[] = $message;

		$_SESSION['semut_log'] = $semut_log;
	}

?>