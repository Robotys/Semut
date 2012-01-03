<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yellowpad extends CI_Controller {
	
	public function __construct()
   {
		parent::__construct();
		// Your own constructor code
		$this->load->model('settings');
		session_start();
		$this->load->helper('rbt');
		$this->load->helper('url');
		$this->load->helper('form');
		if(!array_key_exists('logged',$_SESSION)) redirect("main/login");
   }
	
	public function index()
	{
		$this->load->view($this->settings->admin_theme().'/v_yellowpad');
	}
	
	public function blog_setting(){
		$settings = $this->settings->all();
		
		if(count($_POST)>0){
			
			if($_POST['password'] == ''){
				$_POST['password'] = $settings['password'];
			}else{
				$_POST['password'] = sha1($settings['password']);
			}
			
			$settings = $this->settings->set($_POST);
			//$settings = $_POST;
		}
		
		$admin_themes = scandir('./application/views/admin');
		unset($admin_themes[0]);
		unset($admin_themes[1]);
		
		$blog_themes = scandir('./template');
		unset($blog_themes[0]);
		unset($blog_themes[1]);
		
		$data['settings'] = $settings;
		$data['admin_themes'] = $admin_themes;
		$data['blog_themes'] = $blog_themes;
		
		//var_dump($data);
		
		$this->load->view($this->settings->admin_theme().'/v_setting', $data);
	}
	
	public function post(){
		if(count($_POST)>0){
			//var_dump($_POST);
			$filename = str_replace(" ", "_", $_POST['title']).".txt";
			$str = $_POST['title']."
";
			$str .= date("d-m-Y H:i:s")."
";
			$tags_raw = explode(',',$_POST['tags']);
			
			foreach($tags_raw as $tag){
				$this_tag[] = trim($tag);
			}
			
			$str .= serialize($this_tag)."
";
			$str .= $_POST['content']."
";
			
			
			//var_dump($filename);
			//var_dump($str);
			file_put_contents('flat/posts/'.$filename, $str);
			//redirect('yellowpad/generate_htmls');
			$this->generate_htmls();
			echo 'Done';
			//var_dump($this_tag);
		}
		
		
		
		$this->load->view($this->settings->admin_theme().'/v_post');
	}
	
	
	
	function upload_frame(){
		
		echo form_open_multipart('yellowpad/upload_frame');	
		if(count($_POST)>0){
			
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				echo $this->upload->display_errors();				
				//$this->load->view($this->settings->admin_theme().'/v_uploader', $error);
			}
			else
			{
				$data =  $this->upload->data();
				
				echo $data['file_name']." has been uploaded";
			}
			
		}else{	
		
		}
				
			echo "
		<input type='hidden' name='pegi' value='pegi'/>
		
		<input type='file' name='userfile' size='20' />
		
		<input type='submit' value='upload' style='width: auto;' />
		</form>
		";
		
	
		
			
		
	}
	
	function uploader(){
		
		$current = $_FILES;
		//unset($_FILES);
		
		foreach($_FILES['userfile']['name'] as $key=>$det){
			foreach($_FILES['userfile'] as $field=>$cont){
				$togo[$key][$field] = $_FILES['userfile'][$field][$key];
			}
		}

		unset($_FILES);
		
		$this->load->library('upload');
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$err = array();
		foreach($togo as $go){
			
			$_FILES['userfile'] = $go;
			//var_dump($_FILES);
			$this->upload->initialize($config); 
			
			if ( ! $this->upload->do_upload())
			{
				//$error = array('error' => $this->upload->display_errors());				
				//$this->load->view($this->settings->admin_theme().'/v_uploader', $error);
				//echo '{ "message": "' . $this->upload->display_errors() . '" }';
				$str = str_replace('<p>','',$this->upload->display_errors());
				$err[] = str_replace('</p>','',$str);
			}
			else
			{
				//$data = array('upload_data' => $this->upload->data());
				
				//var_dump($data);
				
				//echo '{ "message": "SUCCEED" }';
				
				//$this->load->view($this->settings->admin_theme().'/v_uploader', $data);
			}
			
			
		}
		
		if(count($err)>0){
			echo '{ "message": "' . implode(', ',$err) . '" }';
		}else{
			echo '{ "message": "SUCCEED" }';
		}
		
		
	}
	
	function posts_array(){
		//get all posts within flat/posts
		$posts_folder = scandir('flat/posts');
		unset($posts_folder[0]);
		unset($posts_folder[1]);
		
		//HERE COME THE TAGS
		//get all its contents;excerpts,tags,title,link,date
		foreach($posts_folder as $posts){
			
			//generate array from source
			$get = $this->get_post($posts);
			
			//generate key from date
			$exp = explode(' ',$get['post_date']);
			$date = explode('-',$exp[0]);
			$time = explode(':',$exp[1]);
			$key = $date[2]."-".$date[1]."-".$date[0]."-".$time[0]."-".$time[1]."-".$time[2];
			//$all_posts[$key] = $lines;
			
			$all_posts[$key] = $get;
		}
		
		krsort($all_posts);
		
		return $all_posts;
	}
	
	function generate_posts(){
		//$this->settings->reset_settings();
		$setting = $this->settings->all();
		
		//get all posts array
		$all_posts = $this->posts_array();
		
		//POST GENERATOR
		$prev = 'index.html';
		$keys = array_keys($all_posts);
		$i = 0;
		foreach($all_posts as $linos){
			
			//generate post.html
			////get template
			$post_template  = file_get_contents('template/posterus/post.html');
			////insert tag content
			$linos['blog_name'] = $setting['blog_name'];
			$linos['blog_description'] = $setting['blog_description'];
			$linos['home_url'] = 'index.html';
			
			//pagination
			if($i>0) $linos['prev_post'] = $all_posts[$keys[$i-1]]['post_link'];
			else $linos['prev_post'] = '#';
			if($i<(count($keys)-1))$linos['next_post'] = $all_posts[$keys[$i+1]]['post_link'];
			else $linos['next_post'] = "#";
			$i++;
			
			foreach($linos as $key=>$val){
				$post_template = str_replace('{'.$key.'}', $val, $post_template);
			}
			////put file
			file_put_contents('baca/'.$linos['post_link'], $post_template);
			
			echo $linos['post_title']." OK!<br/>";
			////make the html file inside baca		
		}
	}
	
	function generate_pages(){
		//$this->settings->reset_settings();
		$setting = $this->settings->all();
		
		//get all posts array
		$all_posts = $this->posts_array();
	
		//index and pages generator
		$index_template = file_get_contents('template/posterus/index.html');
		
		///cut the while part
		$index_cut = explode('{while_post',$index_template);
		$top = $index_cut[0];
		
		$cout = explode('}',$index_cut[1]);
		$count = (int)str_replace(':', '' ,$cout[0]);
		
		$index_cut2 = explode('{end_while}',$index_cut[1]);
					
		$bod = explode('}',$index_cut2[0]);
		unset($bod[0]);
		$body = trim(implode('}',$bod))."
";
		$bottom = $index_cut2[1];
		$bodies = "";
				
		//how many pages?
		$pages = ceil(count($keys)/$count);
		
		echo "<br/>count: ".$count;
		
		var_dump($all_posts);
		
		//create content for each pages
		$j=0;
		$i = 0;
		foreach($all_posts as $key=>$det){
			
		
			if($i < $count){
			
				//replace post template tag
				$temp = str_replace('{post_link}',$det['post_link'], $body);
				$temp = str_replace('{post_title}',$det['post_title'], $temp);
				$temp = str_replace('{post_date}',$det['post_date'], $temp);
				$temp = str_replace('{post_content}',$det['post_content'], $temp);
				$temp = str_replace('{post_tag}',$det['post_tag'], $temp);
				$temp = str_replace('{post_excerpt}',$det['post_excerpt'], $temp);
				$content[$j][$i] = $temp;				
				$i++;
			}else{
				$i=0;
				$j++;
			}
		}
		
		//create pagi
		$pagi[] = "<a href='index.html'>home</a>";
		for($ii=0; $ii<(count($content)-1); $ii++){
			$pagi[] = "<a href='page".($ii+2).".html'>".($ii+2)."</a>";
		}
		$pagination = "<div class='pagination'>".implode(' | ',$pagi)."</div>";
		//var_dump($pagination);
		
		//create index and pages
		foreach($content as $key=>$page_content){
			$html = $top."
".implode("
",$page_content).$bottom;
			
			//replace page template tag
			
			$html = str_replace("{pagination}",$pagination, $html);
			$html = str_replace("{home_url}",'index.html', $html);
			$html = str_replace("{blog_name}",$setting['blog_name'], $html);
			$html = str_replace("{blog_description}",$setting['blog_description'], $html);
			
			var_dump($key);
			
			
			if($key == 0){
				file_put_contents('baca/index.html',$html);
				echo "index.html OK! <br/>";
			}else{
				file_put_contents('baca/page'.($key+1).'.html',$html);
				echo 'page'.($key+1).'.html OK! <br/>';
			}
			
		}
	}
	
	public function generate_htmls(){
		//to generate all posts
		
		//delete previous generation 
		$this->load->helper('rbt');
		delete_all('baca/');
		
		//copy styles.css
		copy('template/posterus/style.css','baca/style.css');
		
		//generate all posts
		$this->generate_posts();
		
		//generate index and all pages
		$this->generate_pages();
		
		
		redirect('yellowpad');
		//echo "index.php and pages OK! <br/>";
		
	}
	
	public function get_thumb(){
		$pics = scandir("./uploads");
		unset($pics[0]);
		unset($pics[1]);
		//echo json_encode($pics);
		
		foreach($pics as $pic){
			$size = getimagesize(base_url()."uploads/".$pic);
			$time = filemtime("./uploads/".$pic);
			if($size[0]>$size[1]) $s = "width='105px'";
			else $s= "height='105px'";
			
			$all[$time][] = "<div class='thumbs' rel='".base_url()."uploads/".$pic."'><img src='".base_url()."uploads/".$pic."' ".$s."/></div>";
		}
		
		krsort($all);
		
		foreach($all as $img){
			foreach($img as $i){
				echo $i;
			}
		}		
	}
	
	public function logout(){
		$this->load->helper('url');
		session_destroy();
		redirect('main');
	}
	
	
	public function posts(){
		foreach($this->posts_array() as $post){
			//echo "<br/>".$post['post_title'];
			$table[]= array(
										"source"=>$post['post_txt'],
										'title' => $post['post_title'],
										'date' => $post['post_date'],
										'tag' => $post['post_tag']
									);
		}
		
		$data['table'] = $table;
		
		$this->load->view($this->settings->admin_theme().'/v_manage_posts',$data);
		
	}
	
	public function edit_post(){
		$content = $this->get_post($this->uri->segment(3));
		$data = $content;
		$this->load->view($this->settings->admin_theme().'/v_post',$data);
	}
	
	public function delete_post(){
		echo "Deleting ".$this->uri->segment(3)." in progress...";
		
		copy('./flat/posts/'.$this->uri->segment(3),'./flat/trash/'.$this->uri->segment(3));
		unlink('./flat/posts/'.$this->uri->segment(3));
		redirect('yellowpad/posts');
	}
	
	function get_post($source){
		$raw = file_get_contents('flat/posts/'.$source);
			
		$lines = array();				
		//$lines['html_name'] = str_replace('.txt','.html',$posts);
		$lines['post_txt'] = $source;
		$lines['post_link'] = str_replace('.txt','.html',strtolower($source));
		$liner = explode("
", trim($raw));

		$lines['post_title'] = ucwords($liner[0]);
		$lines['post_date'] = $liner[1];
		$lines['post_tag'] = implode(', ', unserialize($liner[2]));
		
		unset($liner[0]);
		unset($liner[1]);
		unset($liner[2]);
		
		$lines['post_content'] = implode($liner);
		$lines['post_excerpt'] = substr(strip_tags($lines['post_content']), 0, 300); //300 character excerpt
		
		return $lines;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */