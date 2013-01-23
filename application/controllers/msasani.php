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
		$data['text'] = $pages->row()->text;
		$header['title'] = $pages->row()->title;
		
		
		$logo_id = $pages->row()->logo;
		
		$header = $this->header($logo_id);
		
		$this->load->view('header',$header);
		$this->load->view('sidebar', $data);
		$this->load->view('subpage', $data);
		$this->load->view('footer');

	}
	
	function header($logo_id=1)
	{
		$header_images = $this->db->get('mw_header_images');
	
		$header['left'] = '';
		$header['centre_top'] ='';
		$header['centre_bottom'] = '';
		$header['right'] = '';
		
		foreach($header_images->result() as $imgs)
		{
			$header['left'] .= "<img src = 'img/" . $imgs->left . "' />";
			$header['centre_top'] .= "<img src = 'img/" . $imgs->centre_top . "' />";
			$header['centre_bottom'] .= "<img src = 'img/" . $imgs->centre_bottom . "' />";;
			$header['right'] .= "<img src = 'img/" . $imgs->right . "' />";
			
		}
		
		$this->db->where('id',$logo_id);
		$logo = $this->db->get('mw_logos');
		
		$header['logo'] = $logo->row()->logo;
		$header['tag_line'] = $logo->row()->tag_line;
		
		return $header;
	}
		
	function sidebar ($identifier = '')
	{
		$flag = 0;
		$page_categories=$this->db->get('mw_categories');
		
		$sidebar['sidebar']='';
		foreach($page_categories->result() as $category)
		{
			$this->db->where('type',3);
			$this->db->where('parent',$category->id);
			if($this->db->count_all_results('mw_pages') > 0)
			{
				$sidebar['sidebar'] .= '<p class="sidebarp">' . $category->title . '</p>';
				$this->db->where('type',3);
				$this->db->where('parent',$category->id);
				//$this->db->where('url',$identifier);
				$pages=$this->db->get('mw_pages');
				
				foreach($pages->result() as $page)
				{
					if($identifier == $page->url)
						$sidebar['sidebar'] .= '<li class="activex"><a href="msasani/page/' . $page->url . '">'. $page->title .'</a></li>';
					else
						$sidebar['sidebar'] .= '<li><a href="msasani/page/' . $page->url . '">'. $page->title .'</a></li>';
				}
				
				$flag++;
			}
			
		}
		
		//if($flag==0)
		//{
			$this->db->where('type',3);
			$this->db->where('parent',0);

			if($this->db->count_all_results('mw_pages') > 0){
				$this->db->where('type',3);
			$this->db->where('parent',0);

				$pages=$this->db->get('mw_pages');
				
				foreach($pages->result() as $page)
				{
					if($identifier == $page->url)
						$sidebar['sidebar'] .= '<li class="activex"><a href="msasani/page/' . $page->url . '">'. $page->title .'</a></li>';
					else
						$sidebar['sidebar'] .= '<li><a href="msasani/page/' . $page->url . '">'. $page->title .'</a></li>';
				}
			}
		//}
		
		return $sidebar;
	}
	
	function helpful_links($school){
		$links='';
		$this->db->where('school',3);
		$this->db->or_where('school',1);
		$categories = $this->db->get('mw_helpful_links_categories');
		
		foreach($categories->result() as $category)
		{
			$this->db->where('category',$category->id);
			$this->db->where_in('school',array(1,3));
			
			if($this->db->count_all_results('mw_helpful_links') > 0)
			{
			

				$links .= '<p>' . $category->category . '</p>';
				$this->db->where('category',$category->id);
				$this->db->where_in('school',array(1,3));
				
				$hlinks=$this->db->get('mw_helpful_links');
				
								//echo $this->db->last_query();
				
				
				foreach($hlinks->result() as $link)
				{
					$links .= '<a target="_blank" href="' . $link->url . '"><p>'. $link->link_text .'</p></a>';

				}
				
				$links .= '<hr />';
				
			}
		}
		//die();
		return $links;
	}
	
	function teaching_staff($school)
	{
		$staff = '';
		$this->db->where('school',$school);
		$teachers = $this->db->get('mw_teaching_staff');
		
		$this->db->where('school',$school);
		$classes = $this->db->get('mw_classes');
		$classes_array = array();
		
		foreach($classes->result() as $class)
		{
			$classes_array[$class->id] = $class->class_name;
		}
		
		
		foreach($teachers->result() as $teacher)
		{
			$staff .= "<strong>Teacher's Name: </strong>" . $teacher->name .  "<br>";
			$staff .= '<strong>Class(es): </strong>' ; 
			$this->db->where('teacher_id', $teacher->id);
			$tac = $this->db->get('mw_teachers_classes');
			
			if($tac->num_rows() > 0)
				foreach($tac->result() as $tc)	
					$staff .= $classes_array[$tc->class_id] . ', ' ;
			else
				$staff .= 'All Rounder  ';
				
			$staff = substr($staff,0,-2);
			
			//echo $staff; die();
			
			
			
			$staff .= '<br>';
			$staff .= '<img src="photos/' . $teacher->photo .'" alt=""  class="img7">';
			$staff .= "<p>" . $teacher->description . "<p><div style = 'clear:both; margin-top:7px; margin-bottom: 15px;  width: 740px; border-top:1px #cdcdcd solid;'></div>";
			
		}
		
		return $staff;
		
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
		
	public function page($identifier)
	{
		$this->db->where('type',3);
		$this->db->where('url',$identifier);
		$content = $this->db->get('mw_pages');
		
		$logo_id = $content->row()->logo;
		
		$header = $this->header($logo_id);
		$data['text'] = $content->row()->text;
		$header['title'] = $content->row()->title;
		
		$templateID = $content->row()->template;
		
		$this->db->where('id',$templateID);
		$obj=$this->db->get('mw_page_templates');
		
		$template = $obj->row()->view;
		
		switch($template)
		{
			case 'subsummary.php':
			$this->db->where('type',3);
			$data['news'] = $this->db->get('mw_projects');
			$data['url'] = 'msasani/project';
			break;
			
			case 'testimonials.php':
			$this->db->where('approved',1);
			$this->db->order_by('id', 'desc');
			$data['testimonials'] = $this->db->get('mw_testimonials');
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
			break;
			
			case 'hlinks.php':
			$data['links'] = $this->helpful_links(3);
			break;			
			
			
			case 'staff.php':
			$data['staff'] = $this->teaching_staff(3);
			break;
			
		}
		
		
		$sidebar = $this->sidebar($identifier);
		
		$this->load->view('header',$header);
		$this->load->view('sidebar', $sidebar);
		$this->load->view($template, $data);
		$this->load->view('footer');
	}
	
	function project($url)
	{
		$header = $this->header(4);
		$this->db->where('url',$url);
		$pages = $this->db->get('mw_projects');
		$data['text'] = $pages->row()->text;
		$header['title'] = $pages->row()->title;
		$sidebar = $this->sidebar();

	
		$this->load->view('header',$header);
		$this->load->view('sidebar', $sidebar);
		$this->load->view('subpage', $data);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */