<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('dumper'))
{
	function dumper($multiple)
	{
		echo "<pre><code>";
		print_r($multiple);
		echo "</code></pre>";
	}
}

if ( ! function_exists('get_tags'))
{
	function get_tags()
	{
		//get all tags
		$flats = scandir("./flat/posts");
		unset($flats[0]);
		unset($flats[1]);
		
		$c = array();
		foreach($flats as $post){
			$cont = file_get_contents("./flat/posts/".$post);
			
			$exp = explode('
',$cont);
			$c = array_merge($c,unserialize($exp[2]));
		}
		
		return array_count_values($c);
	}
}


// ------------ lixlpixel recursive PHP functions -------------
// recursive_remove_directory( directory to delete, empty )
// expects path to directory and optional TRUE / FALSE to empty
// of course PHP has to have the rights to delete the directory
// you specify and all files and folders inside the directory
// ------------------------------------------------------------

// to use this function to totally remove a directory, write:
// recursive_remove_directory('path/to/directory/to/delete');

// to use this function to empty a directory, write:
// recursive_remove_directory('path/to/full_directory',TRUE);

function delete_all($directory, $empty=TRUE)
{
	// if the path has a slash at the end we remove it here
	if(substr($directory,-1) == '/')
	{
		$directory = substr($directory,0,-1);
	}

	// if the path is not valid or is not a directory ...
	if(!file_exists($directory) || !is_dir($directory))
	{
		// ... we return false and exit the function
		return FALSE;

	// ... if the path is not readable
	}elseif(!is_readable($directory))
	{
		// ... we return false and exit the function
		return FALSE;

	// ... else if the path is readable
	}else{

		// we open the directory
		$handle = opendir($directory);

		// and scan through the items inside
		while (FALSE !== ($item = readdir($handle)))
		{
			// if the filepointer is not the current directory
			// or the parent directory
			if($item != '.' && $item != '..')
			{
				// we build the new path to delete
				$path = $directory.'/'.$item;

				// if the new path is a directory
				if(is_dir($path)) 
				{
					// we call this function with the new path
					delete_all($path);

				// if the new path is a file
				}else{
					// we remove the file
					unlink($path);
				}
			}
		}
		// close the directory
		closedir($handle);

		// if the option to empty is not set to true
		if($empty == FALSE)
		{
			// try to delete the now empty directory
			if(!rmdir($directory))
			{
				// return false if not possible
				return FALSE;
			}
		}
		// return success
		return TRUE;
	}
}

if ( ! function_exists('zipit'))
{	
	
	function zipit($source, $destination){
		// increase script timeout value
		ini_set("max_execution_time", 300);
		// create object
		$zip = new ZipArchive();
		// open archive
		if ($zip->open($destination, ZIPARCHIVE::CREATE) !== TRUE) {
			die ("Could not open archive");
		}
		// initialize an iterator
		// pass it the directory to be processed
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source));
		
		// iterate over the directory
		// add each file found to the archive
		foreach ($iterator as $key=>$value) {
			//echo "key: ".$key."<br/>";
			//echo "realpath(key): ".realpath($key)."<br/>";
			//echo "value: ".$value."<br/><br/>";
			$zip->addFile(realpath($key), str_replace($source."\\","",$key) ) or die ("ERROR: Could not add file: $key");
		}
		// close and save archive
		$zip->close();
		//echo "Archive created successfully.";
	}
	
}


/* End of file text_helper.php */
/* Location: ./system/helpers/text_helper.php */