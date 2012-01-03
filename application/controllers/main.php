<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function __construct()
   {
		parent::__construct();
		// Your own constructor code
		$this->load->model('settings');
		$this->load->helper('url');
		session_start();
   }
	
	public function index()
	{
		$this->load->view($this->settings->blog_theme().'/v_index.php');
	}
	
	function login(){
	
		if(count($_POST)>0){
			$this->load->helper('url');
			
			$login = sha1($_POST['uname'].sha1($_POST['pword']));
			
			if($login == $this->settings->cred()){
				$_SESSION['logged'] = TRUE;
				redirect('yellowpad');
			}
		}
		
		
		
		$this->load->view($this->settings->admin_theme().'/v_login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */