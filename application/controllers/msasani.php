<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msasani extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$this->db->where('identifier','MSASANI');
		$pages = $this->db->get('mw_pages');
		$data['home'] = $pages->row()->text;
		$header['title'] = $pages->row()->title;
		
		$this->load->view('header',$header);
		$this->load->view('sidebar', $data);
		$this->load->view('subhome', $data);
		$this->load->view('footer');

	}
		
	public function fetch_page($identifier)
	{
		$this->db->where('identifier',$identifier);
		$content = $this->db->get('mw_pages');
		return $content->row();
	}
	
	public function about()
	{
		$data['details'] = $this->fetch_page('ABOUT');
		$header['title'] = $data['details']->title;
		$this->load->view('header',$header);
		$this->load->view('page',$data);
		$this->load->view('footer');
	}
		
	public function blog()
	{
		$data['title'] = $header['title'] = 'My World Preschool Blog';
		
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);	
		$this->load->view('header',$header);
		$this->load->view('summary',$data);
		$this->load->view('footer');
	}	
	
	public function news()
	{
		$data['title'] =$header['title'] = 'My World Preschool News';
		$this->db->order_by('date','desc');
		$data['news'] = $this->db->get('mw_news');

			
		$this->load->view('header',$header);
		$this->load->view('summary',$data);
		$this->load->view('footer');
	}	
	
	
	
	public function article($url)
	{
		$this->db->where('url',$url);
		$article = $this->db->get('mw_news');
		
		if($article->num_rows() == 0)
			$this->news();
		else
		{
			$data['details'] = $article->row();
			$header['title'] = $data['details']->title;
			$this->load->view('header',$header);
			$this->load->view('page',$data);
			$this->load->view('footer');
		}
	}
	
	public function projects($url)
	{
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		
		$this->db->where('url',$url);
		$details = $this->db->get('mw_projects_and_publications');
		
		$data['title'] = $header['title'] = $details->row()->title;

		$this->db->where('category',$details->row()->id);
		$data['projects'] = $this->db->get('mw_projects');
		
		$this->load->view('Header',$header);
		$this->load->view('Projects',$data);
		$this->load->view('Footer');
	}
	
	public function project($url)
	{
		$this->db->where('url',$url);
		$article = $this->db->get('mw_projects');

		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		if($article->num_rows() == 0)
			$this->index();
		else
		{
			$data['details'] = $article->row();
			$header['title'] = $data['details']->title;
			$this->load->view('Header',$header);
			$this->load->view('Page',$data);
			$this->load->view('Footer');
		}
	}
	
	function the_directory()
	{
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		
		//$this->db->order_by('company_name');
	//	$data['partners'] = $this->db->get('mw_directory');
		
		$query = "select dir.*, nct.title company_type, ncs.title sector from mw_directory dir, mw_company_sectors ncs, mw_company_types nct where nct.id = dir.company_type and ncs.id = dir.sector order by company_name";
		
		$data['partners'] = $this->db->query($query);
		
		$data['title'] = $header['title'] = "Directory of our Partners";

		$data['text'] = "Some introductory text, blah blah blah.";
		
		$this->load->view('Header',$header);
		
		$this->load->view('Directory',$data);
		$this->load->view('Footer');
		

	}
	
	public function publications($url)
	{
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		
		$this->db->where('url',$url);
		$details = $this->db->get('mw_projects_and_publications');
		
		$data['title'] = $header['title'] = $details->row()->title;

		$this->db->where('category',$details->row()->id);
		$data['publications'] = $this->db->get('mw_publications');
		
		$this->load->view('Header',$header);
		
		$this->load->view('Publications',$data);
		$this->load->view('Footer');
	}
	
	public function album($id)
	{
		$this->db->where('album',$id);
		$this->db->order_by('priority');
		$data['images'] = $this->db->get('mw_images');
		
		$this->db->where('id',$id);
		$album = $this->db->get('mw_albums');
		
		if($album->num_rows() == 0)
			$this->gallery();
		else
		{
			$data['title'] = $header['title'] = $album->row()->title;
			$data['description'] = $album->row()->description;
			
			$this->load->view('Header',$header);
			$this->load->view('Gallery',$data);
			$this->load->view('Footer');
		}
	}
	
	private function randomAlphaNum($length){ 

		/*$rangeMin = pow(36, $length-1); //smallest number to give length digits in base 36 
		$rangeMax = pow(36, $length)-1; //largest number to give length digits in base 36 
		$base10Rand = mt_rand($rangeMin, $rangeMax); //get the random number 
		$newRand = base_convert($base10Rand, 10, 36); //convert it 
		
		return $newRand; //spit it out */
		
		$arr = str_split('ABCDEFGHJKMNPQRSTUVWXYZ23456789'); // get all the characters into an array
		shuffle($arr); // randomize the array
		$arr = array_slice($arr, 0, $length); // get the first six (random) characters out
		return implode('', $arr); // smush them back into a string

	} 
	
	public function contact($item='',$id=0)
	{
	
		$word = strtoupper($this->randomAlphaNum(7));
		
		
		$this->load->helper('captcha');
		$vals = array(
		'word' => $word,
		'img_path'	 => './captcha/',
		'img_url'	 => 'captcha/',
		'font_path'	 => './captcha/fonts/arial.ttf',
		'img_width'	 => '200',
		'img_height' => 50,
		);
		
		$data['cap'] = create_captcha($vals);
	
		$cap_data = array(
		'captcha_time'	=> $data['cap']['time'],
		'ip_address'	=> $this->input->ip_address(),
		'word'	 => $data['cap']['word']
		);
		
		$query = $this->db->insert_string('mw_captcha', $cap_data);	
		$this->db->query($query);
		
		$header['projects'] = $this->get_projects(1);
		$header['publications'] = $this->get_projects(2);
		
		switch($item)
		{
			case 'activity':
				
				$this->db->where('id',$id);
				$activities = $this->db->get('mw_activities');
				$activity = $activities->row();
									
				if($activity->contact_intro != '')
					$data['contact_intro'] = $activity->contact_intro;
				else
					$data['details'] = $this->fetch_page('CONTACT');
				
				$data['details']->title = $header['title'] = $activity->title;
				$data['subject'] = $activity->link_text;
			break;
			
			default:
				
				$data['details'] = $this->fetch_page('CONTACT');
				$data['title'] = $header['title'] = $data['details']->title;
			break;
		}
		//$data['details'] = $this->fetch_page('CONTACT');
		//$data['title'] = $header['title'] = $data['details']->title;
		$this->load->view('header',$header);
		$this->load->view('contact',$data);
		$this->load->view('footer');
	}
	
	function validate_captcha($captcha)
	{
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM mw_captcha WHERE captcha_time < ".$expiration);	

	
		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM mw_captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		
		
		if($row->count == 0){		// validate??
			$this->form_validation->set_message('validate_captcha', 'You Entered Incorrect Captcha');
			return FALSE;
		}else{
			return TRUE;
		}
		
	}
	
	function send_message()
	{
		if(isset($_POST))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('message', 'The Message', 'required');
			$this->form_validation->set_rules('captcha', 'The Captcha', 'required|callback_validate_captcha');
			
			$this->form_validation->set_error_delimiters('<li>','</li>');
			
			if ($this->form_validation->run() == TRUE)
			{	
			
				//echo "Not Configured";
				$this->load->library('email');
				
				$config['protocol'] = 'mail';
				$config['smtp_host'] = 'auth.smtp.1and1.com';
				$config['smtp_user'] = 'info@nipefagio.com';
				$config['smtp_pass'] = 'nipefagio123';
				$config['smtp_port'] = '25';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$config['charset']='utf-8';  
				$config['newline']="\r\n";  

				$this->email->initialize($config);

				$this->email->from('info@nipefagio.com', 'NipeFagio');
				$this->email->bcc('terence@zoomtanzania.com'); 
				$this->email->to('anton.fouquet@djpa.co.tz'); 
				
				
				$this->email->subject($_POST['subject']);
				$message = '<html><head></head><body>';
				$message .= 'Name: ' . $_POST['name'] . '<br><br>';
				$message .= 'E-mail: ' . $_POST['email'] . '<br><br>';
				if(isset($_POST['phone']))
					$message .= 'Phone: ' . $_POST['phone'] . '<br><br>';
				$message .= 'Subject: ' . $_POST['subject'] . '<br><br>';
				$message .= 'Message: '. $_POST['message'] . '<br><br>';
				$message .= '</body></html>';	
				$this->email->message($message);	

				if($this->email->send())
				{
					
					
					$this->db->where('identifier','MESSAGE_SENT');
					$details = $this->db->get('mw_pages');
					
					$header['projects'] = $this->get_projects(1);
					$header['publications'] = $this->get_projects(2);	
					$data['details'] = $details->row();
					$header['title'] = $details->row()->title;
					$this->load->view('Header',$header);
					$this->load->view('Page',$data);
					$this->load->view('Footer');
				}
				else
					$this->contact(2);
				
			}
			
			else
				$this->contact(2);
		}
		
		else
			redirect('contact/3');
	}
	
	/*function validate_captcha()
	{
	}*/
	
	function register_test()
	{
		$username = 'anton.fouquet@djpa.co.tz';
		$email = 'anton.fouquet@djpa.co.tz';
		$password = 'nIp3F@giO';
		$additional_data = array(
			'first_name' => 'Anton',
			'last_name' => 'Fouquet',
			'phone' => '+255 753 102 000'
		);								
//		$group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default

		$this->ion_auth->register($username, $password, $email, $additional_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */