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
		
		$this->load->view('header',$header);
		$this->load->view('sidebar', $data);
		$this->load->view('subpage', $data);
		$this->load->view('footer');
	}
		
	public function page($identifier)
	{
		
		//$this->db->where('type',2);
		
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
		
		$this->db->where('type',2);
		$this->db->where('url',$identifier);
		$content = $this->db->get('mw_pages');
		
		$data['text'] = $content->row()->text;
		$header['title'] = $content->row()->title;
		
		$templateID = $content->row()->template;
		
		$this->db->where('id',$templateID);
		$obj=$this->db->get('mw_page_templates');
		
		$template = $obj->row()->view;
		
		if($template=='subsummary.php')
		{
			$this->db->where('type',2);
			$data['news'] = $this->db->get('mw_projects');
		}
		
		
		$this->load->view('header',$header);
		$this->load->view('sidebar', $sidebar);
		$this->load->view($template, $data);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */