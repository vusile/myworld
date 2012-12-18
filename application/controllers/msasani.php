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
		
		$this->load->view('header',$header);
		$this->load->view('sidebar', $data);
		$this->load->view('subpage', $data);
		$this->load->view('footer');

	}
		
	function sidebar ($identifier = '')
	{
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
				
			}
			
		}
		
		return $sidebar;
	}
		
	public function page($identifier)
	{
		
		
		$this->db->where('type',3);
		$this->db->where('url',$identifier);
		$content = $this->db->get('mw_pages');
		
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
			$this->db->where('school',3);
			$data['testimonials'] = $this->db->get('mw_testimonials');
			break;
			
			case '':
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