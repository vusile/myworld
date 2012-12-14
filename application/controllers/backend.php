<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		
		$this->load->library('grocery_CRUD');	
				
		$this->load->library('image_CRUD');

	}
	
	function _example_output($output = null)
	{
		if ($this->ion_auth->logged_in())
			$this->load->view('example.php',$output);
		else
			redirect('login');
	}	
	
	function mw_directory()
	{
		$this->grocery_crud->set_relation('company_type','mw_company_types','title');
		$this->grocery_crud->set_relation('sector','mw_company_sectors','title');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}	
	
	function mw_newsletters()
	{
		$this->grocery_crud->unset_fields('url','identifier');
		$this->grocery_crud->set_relation_n_n('news_articles','mw_newsletter_news','mw_news','newsletter_id','news_id','title','priority');
		$this->grocery_crud->callback_after_insert(array($this, 'generate_newsletter_url'));
		$this->grocery_crud->callback_after_update(array($this, 'generate_newsletter_url'));
		$this->grocery_crud->unset_columns('identifier');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}
	
	
	function generate_newsletter_url($post_array,$primary_key)
	{

		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('mw_newsletters');
		
		if($title_obj->row()->url == '')
		{
			$data['url'] = base_url() . 'nl/' . $this->convert_url('mw_newsletters', 'url', $title_obj->row()->newsletter_subject);
			$data['identifier'] = $this->convert_url('mw_newsletters', 'url', $title_obj->row()->newsletter_subject);
			$this->db->where('id',$primary_key);
			$this->db->update('mw_newsletters',$data);
		}
		
		
		return true;
	}
	
	function mw_pages($type=0)
	{
		if($type != 0)
			$this->grocery_crud->where('type',$type);
		$this->grocery_crud->unset_delete();
		$this->grocery_crud->unset_fields('thumb_nail','type');
		$this->grocery_crud->unset_columns('thumb_nail','type');
		$this->grocery_crud->callback_after_insert(array($this, 'generate_thumb'));
		$this->grocery_crud->callback_after_update(array($this, 'generate_thumb'));
		$output = $this->grocery_crud->render();

		$this->_example_output($output);

	}
	
	function generate_thumb($post_array,$primary_key)
	{
	
		$data = array (
			'type' => $this->uri->segment(3)
		);
		
		$doc = new DOMDocument();
		@$doc->loadHTML($post_array['text']);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
				if($count > 0)
					break;
				else
					$src =  $tag->getAttribute('src');
					
				$count++;
			}
			
			$name = explode('/',$src);
			
			$index = count($name);
			
			$data['thumb_nail'] = $name[$index-1];	
			
			$this->db->where('id',$primary_key);
			$this->db->update('mw_pages',$data);
		}
		
	}
	
	function mw_company_sectors()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);

	}	
	function mw_company_types()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);

	}

	
	function mw_projects_and_publications($section)
	{
		$this->grocery_crud->set_relation('parent_category','mw_projects_and_publications','title',array('section' => $section, 'parent_category' =>''));
	
		$this->grocery_crud->unset_fields('section','url','link');
		$this->grocery_crud->unset_columns('section','url');		
		
		if($section == 1)
		{
			$this->grocery_crud->display_as ( 'link' , 'Projects' );
			$this->grocery_crud->callback_after_insert(array($this, 'generate_projects_link'));
			$this->grocery_crud->callback_after_update(array($this, 'generate_projects_link'));
			
		}
		else if($section == 2)
		{
			$this->grocery_crud->display_as ( 'link' , 'Publications' );
			$this->grocery_crud->callback_after_insert(array($this, 'generate_publications_link'));
			$this->grocery_crud->callback_after_update(array($this, 'generate_publications_link'));
		}	
			
		$this->db->where('mw_projects_and_publications.section',$section);
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	function mw_publications()
	{
		
		$this->grocery_crud->set_field_upload('publication_file','publications');
		$this->grocery_crud->callback_after_insert(array($this, 'set_publications_category'));
		$this->grocery_crud->callback_after_update(array($this, 'set_publications_category'));
		$this->grocery_crud->unset_fields('category');
		$this->grocery_crud->unset_columns('category');	
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function mw_projects()
	{
		
		$this->grocery_crud->set_relation('featured','mw_options','title');
		$this->grocery_crud->callback_after_insert(array($this, 'set_projects_category'));
		$this->grocery_crud->callback_after_update(array($this, 'set_projects_category'));
		$this->grocery_crud->display_as('text','Project Description');
		$this->grocery_crud->unset_fields('url','category');
		$this->grocery_crud->unset_columns('url','category');	
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function set_publications_category($post_array,$primary_key)
	{
		$data = array (
			'category' => $this->uri->segment(3)
		);
		
		$this->db->where('id',$primary_key);
		$this->db->update('mw_publications',$data);

		return true;
	}
	
	function set_projects_category($post_array,$primary_key)
	{
		$data = array (
			'category' => $this->uri->segment(3)
		);
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('mw_projects');
		
		if($title_obj->row()->url == '')
		{
			$data['url'] = $this->convert_url('mw_projects', 'url', $title_obj->row()->title);
		}
		

		
		$this->db->where('id',$primary_key);
		$this->db->update('mw_projects',$data);
		
		if($post_array['featured'] == 1)
		{
			$featured = array (
				'featured' => 2
			);
			$this->db->where('id <>',$primary_key);
			$this->db->update('mw_projects',$featured);
		}
		
		return true;
	}
	
	function convert_url($table, $column, $text)
	{
		
		$cleanurl = preg_replace('/[^A-Za-z0-9\s]/i', ' ', $text); 
		// eliminates extra white spaces created above 
		$cleanurl = preg_replace('/\s\s+/', ' ', $cleanurl); 
		// replaces white space with a hyphen 
		$cleanurl = str_replace(' ', '-', $cleanurl); 
		// removes any hyphen from beginning of string 
		$cleanurl = preg_replace('/^-/', '', $cleanurl); 
		// removes any hyphen from end of string 
		$cleanurl = preg_replace('/-$/', '', $cleanurl); 
		// makes all letters lower case 
		$cleanurl = strtolower($cleanurl); 
		
		//$cleanurl = $this->check_clean_url($table,$column,$cleanurl,$composer);
		
		$this->db->where($column,$cleanurl);
		$cleancheck = $this->db->get($table);
		
		if($cleancheck->num_rows() == 0)
		{
			return $cleanurl;
		}
		else
		{

			$cleanurl = $cleanurl . '-' . $cleanurl;
			return $cleanurl;
		}
		
		//return $cleanurl;	
		
	}
	
	
	function generate_publications_link($post_array,$primary_key)
	{	
	
		$data = array (
			'link' => '<a target = "_blank" href = "' . base_url() . 'backend/mw_publications/' . $primary_key .'">Publications</a>'
		);
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('mw_projects_and_publications');
		
		if($title_obj->row()->url == '')
		{
			$data['url'] = $this->convert_url('mw_projects_and_publications', 'url', $title_obj->row()->title);
		}
		
		
		$this->db->where('id',$primary_key);
		$this->db->update('mw_projects_and_publications',$data);
		
		return true;
	}	
	
	function generate_projects_link($post_array,$primary_key)
	{
		
		$data = array (
			'link' => '<a target = "_blank" href = "' . base_url() . 'backend/mw_projects/' . $primary_key .'">Projects</a>'
		);
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('mw_projects_and_publications');
		
		if($title_obj->row()->url == '')
		{
			$data['url'] = $this->convert_url('mw_projects_and_publications', 'url', $title_obj->row()->title);
		}
		
		$this->db->where('id',$primary_key);
		$this->db->update('mw_projects_and_publications',$data);
		
		return true;
	}
	
	function mw_news()
	{
		
		$this->grocery_crud->unset_fields('url','date','thumb_nail');
		$this->grocery_crud->unset_columns('url','thumb_nail');	
		$this->grocery_crud->order_by('date','desc');	
		$this->grocery_crud->callback_after_insert(array($this, 'add_url_to_news'));
		$this->grocery_crud->callback_after_update(array($this, 'add_url_to_news'));
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}
	

	
	function add_url_to_news($post_array,$primary_key)
	{
			$doc = new DOMDocument();
		@$doc->loadHTML($post_array['text']);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
				if($count > 0)
					break;
				else
					$src =  $tag->getAttribute('src');
					
				$count++;
			}
			
			$name = explode('/',$src);
			
			$index = count($name);
			
			$data['thumb_nail'] = $name[$index-1];
			
			
			/*$this->load->library('image_moo');
			$sizes = getimagesize($src);
			
			$width = $sizes[0];
			$height = $sizes[1];
			
			if($width >= $height and $width > 90)				
				$this->image_moo->load($source_image)->resize(90,999999999999)->save('thumb_' . $source_image,$overwrite=TRUE);
			else if($width <= $height and $height > 90)
				$this->image_moo->load($source_image)->resize(999999999999,90)->save('thumb_' . $source_image,$overwrite=TRUE);*/
		}
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('mw_news');
		
		$data['date'] = date('Y-m-d');
		if($title_obj->row()->url == '')
		{
			$data['url'] = $this->convert_url('mw_news', 'url', $title_obj->row()->title);
		}
		
		$this->db->where('id',$primary_key);
		$this->db->update('mw_news',$data);
		return true;
		
	}
	
	function mw_image_scroller()
	{
		$this->grocery_crud->set_field_upload('photo', 'img');
		$this->grocery_crud->callback_after_insert(array($this, 'scroller_after'));
		$this->grocery_crud->callback_after_update(array($this, 'scroller_after'));
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}	
	
	function mw_settings()
	{
		$this->grocery_crud->unset_texteditor('value');
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function scroller_after($post_array,$primary_key)
	{
		$this->db->where('id',$primary_key);
		$photo=$this->db->get('mw_image_scroller');
		$img = $photo->row()->photo;
		
		

		$this->resize_img($img,'img','400','300',0);
	}
	
	function resize_img($img_name,$folder,$resize_width=99999999999,$resize_height=9999999999999,$proportional=1)
	{
		$this->load->library('image_moo');
		$sizes = getimagesize($folder . '/' . $img_name );
		
		$width = $sizes[0];
		$height = $sizes[1];
		
		$source_image =  $folder . '/' . $img_name;
		
		
		
		if($proportional ==1 )
		{
			if($width >= $height and $width > $resize_width)				
				$this->image_moo->load($source_image)->resize($resize_width,999999999999)->save($source_image,$overwrite=TRUE);
			else if($width <= $height and $height > $resize_height)
				$this->image_moo->load($source_image)->resize(999999999999,$resize_height)->save($source_image,$overwrite=TRUE);
		}
		else
			$this->image_moo->load($source_image)->resize($resize_width,$resize_height)->save($source_image,$overwrite=TRUE);
	}
	
	function index()
	{
		if ($this->ion_auth->logged_in())
			$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		else
			redirect('login');
	}	
	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	

	
}