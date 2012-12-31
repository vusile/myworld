<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upanga extends CI_Controller {

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

		$this->db->where('identifier','UPANGA');
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
		$page_categories=$this->db->get('mw_categories');
		
		$sidebar['sidebar']='';
		foreach($page_categories->result() as $category)
		{
			$this->db->where('type',2);
			$this->db->where('parent',$category->id);
			if($this->db->count_all_results('mw_pages') > 0)
			{
				$sidebar['sidebar'] .= '<p class="sidebarp">' . $category->title . '</p>';
				$this->db->where('type',2);
				$this->db->where('parent',$category->id);
				//$this->db->where('url',$identifier);
				$pages=$this->db->get('mw_pages');
				
				foreach($pages->result() as $page)
				{
					if($identifier == $page->url)
						$sidebar['sidebar'] .= '<li class="activex"><a href="upanga/page/' . $page->url . '">'. $page->title .'</a></li>';
					else
						$sidebar['sidebar'] .= '<li><a href="upanga/page/' . $page->url . '">'. $page->title .'</a></li>';
				}
				
			}
			
		}
		
		return $sidebar;
	}
	
	function helpful_links($school){
		$links='';
		$this->db->where('school',2);
		$this->db->or_where('school',1);
		$categories = $this->db->get('mw_helpful_links_categories');
		
		foreach($categories->result() as $category)
		{
			$this->db->where('category',$category->id);
			$this->db->where_in('school',array(1,2));
			
			if($this->db->count_all_results('mw_helpful_links') > 0)
			{
			

				$links .= '<p>' . $category->category . '</p>';
				$this->db->where('category',$category->id);
				$this->db->where_in('school',array(1,2));
				
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
			$staff .= "<p>" . $teacher->description . "<p><div style = 'clear:both; margin-top:7px;  width: 740px; border-top:1px #cdcdcd solid;'></div>";
			
		}
		
		return $staff;
		
	}
		
	public function page($identifier)
	{

		$this->db->where('type',2);
		$this->db->where('url',$identifier);
		$content = $this->db->get('mw_pages');
		
		$data['text'] = $content->row()->text;
		
		$templateID = $content->row()->template;
		
		
		$logo_id = $content->row()->logo;
		
		$header = $this->header($logo_id);
		$header['title'] = $content->row()->title;
		
		$this->db->where('id',$templateID);
		$obj=$this->db->get('mw_page_templates');
		
		$template = $obj->row()->view;
		
		switch($template)
		{
			case 'subsummary.php':
			$this->db->where('type',2);
			$data['news'] = $this->db->get('mw_projects');
			$data['url'] = 'msasani/project';
			break;
			
			case 'testimonials.php':
			$this->db->where('school',2);
			$data['testimonials'] = $this->db->get('mw_testimonials');
			break;
			
			case 'hlinks.php':
			$data['links'] = $this->helpful_links(2);
			break;			
			
			
			case 'staff.php':
			$data['staff'] = $this->teaching_staff(2);
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
		$header = $this->header(5);
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