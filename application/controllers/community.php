<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Community extends CI_Controller {

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
		
		$this->db->where('identifier','COMMUNITY');
		$pages = $this->db->get('mw_pages');
		$data['text'] = $pages->row()->text;
		$header['title'] = $pages->row()->title;
		
		$this->load->view('header',$header);
		$this->load->view('sidebar', $data);
		$this->load->view('subhome', $data);
		$this->load->view('footer');

	}
	
	public function curriculum()
	{
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */