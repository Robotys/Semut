<?php
	class Settings extends CI_Model {
		var $settings = array();
		function __construct()
		{
			// Call the Model constructor
			parent::__construct();
			
			$this->refresh_setting();
		}
		
		public function reset_settings(){
			
			$array = array(
							"blog_name"=>'Semut Merah',
							"username"=>'semutadmin!',
							"password"=>sha1('!@#$%^&*()'),
							"admin_theme"=>'red_ant',
							"blog_theme"=>'posterous',						
							"blog_description"=>'Kuih Sarang Semut Sangat Sedap!'						
						);
						
			file_put_contents('flat/settings.txt', serialize($array));
			$this->refresh_setting();
		}
		
		public function refresh_setting(){
			$content = file_get_contents('flat/settings.txt');
			$set = unserialize($content);	
			$set['admin_theme'] = 'admin/'.$set['admin_theme'];
			$set['blog_theme'] = './template/'.$set['blog_theme'];
			$this->settings = $set;
			
			return $set;
		}
		
		public function cred(){				
			return sha1($this->settings['username'].$this->settings['password']);
		}
		public function set($array){				
			file_put_contents('flat/settings.txt', serialize($array));
			return $this->refresh_setting();
		}
		
		public function admin_theme(){				
			return $this->settings['admin_theme'];
		}
		public function blog_theme(){				
			return $this->settings['blog_theme'];
		}
		
		public function blog_name(){				
			return $this->settings['blog_name'];
		}
		
		public function all(){				
			return $this->settings;
		}
		
		
		
	}
?>