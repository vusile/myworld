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


	function _example_images_output($output = null)
	{
		if ($this->ion_auth->logged_in())
			$this->load->view('example_images.php',$output);
		else
			redirect('login');
	}	
	
	
	function make_url_from_title($title,$table,$id)
	{
		$url = strtolower(url_title($title));
		

		$this->db->where('url',$url);
		$obj=$this->db->get($table);
		
		if($obj->num_rows() > 0)
		{
			$this->db->where('id',$id);
			$this->db->where('url',$url);
			$obj=$this->db->get($table);
			
			if( $obj->num_rows() == 0 )
				$url = $this->make_url_from_title($url . '-' . $url,$table,$id);
		}
		
		return $url;
		
	}
	
	function mw_page_templates()
	{
	
		$this->grocery_crud->set_relation('access_level','mw_groups','description');
		
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}	

	function mw_logos()
	{		
		$this->grocery_crud->set_field_upload('logo', 'img');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	function mw_partner_links()
	{		
		$this->grocery_crud->callback_after_insert(array($this, 'partner_links_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'partner_links_callback'));
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	
	function partner_links_callback($post_array,$primary_key)
	{
		$data = array (
			'partner_website' => prep_url($post_array['partner_website'])
		);
		
		$this->db->where('id',$primary_key);
		$this->db->update('mw_partner_links',$data);
	
	}
	
	
	
	function mw_header_images()
	{		
		$this->grocery_crud->set_field_upload('left', 'img');
		$this->grocery_crud->display_as('left', 'Left Image (141px by 278px)');
		$this->grocery_crud->set_field_upload('centre_top', 'img');
		$this->grocery_crud->display_as('centre_top', 'Centre Top Image (237px by 128px)');
		$this->grocery_crud->set_field_upload('centre_bottom', 'img');
		$this->grocery_crud->display_as('centre_bottom', 'Centre Bottom Image (237px by 131px)');
		$this->grocery_crud->set_field_upload('right', 'img');
		$this->grocery_crud->display_as('right', 'Right Image (302px by 278px)');
		$this->grocery_crud->callback_after_insert(array($this, 'resize_header_images'));
		$this->grocery_crud->callback_after_update(array($this, 'resize_header_images'));
		
		
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	function resize_header_images($post_array,$primary_key)
	{
		$this->db->where('id',$primary_key);
		$images=$this->db->get('mw_header_images');
		$imgs = $images->row();
		
		$this->load->library('image_moo');
		$source_image141_by_278 = 'img/' . $imgs->left;
		$source_image237_by_128 = 'img/' . $imgs->centre_top;
		$source_image237_by_131 = 'img/' . $imgs->centre_bottom;
		$source_image302_by_278 = 'img/' . $imgs->right;
		
		$this->image_moo->load($source_image141_by_278)->set_background_colour("#FFF")->resize(141,278,true)->save( $source_image141_by_278,$overwrite=TRUE);
		$this->image_moo->load($source_image237_by_128)->set_background_colour("#FFF")->resize(237,128,true)->save( $source_image237_by_128,$overwrite=TRUE);
		$this->image_moo->load($source_image237_by_131)->set_background_colour("#FFF")->resize(237,131,true)->save( $source_image237_by_131,$overwrite=TRUE);
		$this->image_moo->load($source_image302_by_278)->set_background_colour("#FFF")->resize(302,278,true)->save( $source_image302_by_278,$overwrite=TRUE);
		
		return true;
	}
	
	function mw_testimonials()
	{
	
		$this->grocery_crud->set_relation('approved','mw_options','title');
		$this->grocery_crud->unset_columns('school');
		$this->grocery_crud->unset_fields('school','date');
		
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}	

	function mw_messages()
	{
	
		
		$this->grocery_crud->unset_columns('identifier');
		$this->grocery_crud->unset_fields('identifier');
		
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}

	function mw_helpful_links_categories()
	{
	
		//$this->grocery_crud->where('school',$school);
		$this->grocery_crud->unset_fields('the_links');
		$this->grocery_crud->set_relation('school','mw_schools','school_name');
		$this->grocery_crud->callback_after_insert(array($this, 'generate_links_link'));
		$this->grocery_crud->callback_after_update(array($this, 'generate_links_link'));
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}
	
	function generate_links_link($post_array,$primary_key)
	{	
	
		$data = array (
			'the_links' => '<a target = "_blank" href = "' . base_url() . 'backend/mw_helpful_links/' .  $primary_key . '">Helpful Links</a>'
		);
		
		
		$this->db->where('id',$primary_key);
		$this->db->update('mw_helpful_links_categories',$data);
		
		return true;
	}	
	
	function mw_helpful_links($cat)
	{
		
		$this->grocery_crud->where('category',$cat);
		$this->grocery_crud->unset_fields('category');
		$this->grocery_crud->unset_columns('category');
		$this->grocery_crud->set_relation('school','mw_schools','school_name');
		$this->grocery_crud->callback_after_insert(array($this, 'assign_link_to_category'));
		$this->grocery_crud->callback_after_update(array($this, 'assign_link_to_category'));
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	function assign_link_to_category($post_array,$primary_key)
	{
		$data = array (
			'category' => $this->uri->segment(3),
			'url' => prep_url($post_array['url'])
		);
		
		$this->db->where('id',$primary_key);
		$this->db->update('mw_helpful_links',$data);

		return true;
	}

	
	
	function mw_categories()
	{
		
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}	

	function callba($post_array, $primary_key) {
		
	}

	
	function mw_students($class)
	{
		//$this->grocery_crud->set_theme('datatables');
		$this->grocery_crud->order_by('first_name');
		$this->grocery_crud->unset_columns('class');
		$this->grocery_crud->unset_fields('class','parents');
		$this->grocery_crud->set_field_upload('photo','photos');
		$this->grocery_crud->callback_after_insert(array($this, 'students_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'students_callback'));
		$this->grocery_crud->where('class',$class);
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}	
	
	function students_callback($post_array,$primary_key)
	{
		$data = array (
			'class' =>$this->uri->segment(3)
		);
		
		$this->db->where('id',$primary_key);
		$this->db->update('mw_students',$data);
		
		
	}
	
	function mw_parents($student)
	{


		//$this->grocery_crud->unset_columns('school');
		$this->grocery_crud->unset_fields('parent_of');
		$this->grocery_crud->where('parent_of',$student);
		$this->grocery_crud->set_relation('type','mw_parent_types','title');
		$this->grocery_crud->set_relation('parent_of','mw_students','{first_name} {last_name}');
		$this->grocery_crud->callback_after_insert(array($this, 'parents_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'parents_callback'));
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}	
	
	function parents_callback($post_array,$primary_key)
	{
		$data = array (
			'parent_of' => $this->uri->segment(3),
			
		);
		
		$this->db->where('id',$primary_key);
		$this->db->update('mw_parents',$data);
	}
	
	
	function mw_users($school=2)
	{
		//$this->grocery_crud->set_table('mw_users');
	    $this->grocery_crud->add_fields('first_name','email','photo','description','classes');
	    $this->grocery_crud->edit_fields('first_name','email','photo','description','classes');
	    $this->grocery_crud->columns('first_name','email','photo','description');
	    $this->grocery_crud->display_as('first_name','Name');

		$this->grocery_crud->where('school',$school);
		$this->grocery_crud->set_relation_n_n('classes','mw_teachers_classes','mw_classes','teacher_id','class_id','class_name','priority',array('school'=>$school));
		$this->grocery_crud->callback_after_insert(array($this, 'set_school'));
		$this->grocery_crud->callback_after_update(array($this, 'set_school'));
		$this->grocery_crud->set_field_upload('photo','photos');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}

	function mw_classes($school=2,$class=0)
	{	
		if($class !=0)
			$this->grocery_crud->where('mw_classes.id',$class);	
		//$this->grocery_crud->set_theme('datatables');
		$this->grocery_crud->add_action('Upload Students', 'img/arrow_up-opt.png', 'backend/mw_upload_students_form');
		$this->grocery_crud->add_action('Send Email', 'img/email_20x20.png', 'backend/send_email_form');
		//$this->grocery_crud->set_relation('class_teacher','mw_teaching_staff','name',array('mw_teaching_staff.school'=>$school));
		$this->grocery_crud->unset_columns('school','class_teacher');
		$this->grocery_crud->unset_fields('school','class_teacher');
		if($this->ion_auth->in_group('teacher'))
		{
			$this->grocery_crud->unset_delete();
			$this->grocery_crud->unset_add();
		
		}		


		$this->grocery_crud->where('mw_classes.school',$school);
		$this->grocery_crud->callback_after_insert(array($this, 'set_school'));
		$this->grocery_crud->callback_after_update(array($this, 'set_school'));
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	function set_school($post_array,$primary_key)
	{
		$data = array (
			'school' => $this->uri->segment(3),
		);
		
		if($this->uri->segment(2)=='mw_classes')
			$data['students'] = '<a target = "_blank" href = "' . base_url() . 'backend/mw_students/' .  $primary_key . '">Students</a>';
		
		$this->db->where('id',$primary_key);
		$this->db->update($this->uri->segment(2),$data);
		
		if($this->uri->segment(2)=='mw_users')
		{

			$this->db->where('id',$primary_key);
			$this->db->delete('mw_users');
		//	$teachers= $this->db->get('mw_users');
			
			
			
	//		$teacher = $teachers->row();
			
			
			
	
			
			
			$this->load->library('image_moo');
			$source_image = 'photos/' . $_POST['photo'];
			$sizes = getimagesize('photos/' . $_POST['photo']);
			
			
			$width = $sizes[0];
			$height = $sizes[1];
			

			
			if($width >= $height and $width > 150 )				
				$this->image_moo->load($source_image)->resize(150,999999999999)->save( $source_image,$overwrite=TRUE);
			else if($width <= $height and $height > 150 )
				$this->image_moo->load($source_image)->resize(999999999999,150)->save( $source_image,$overwrite=TRUE);	


			$username = $_POST['email'];
			$email = $_POST['email'];
			$password = 'mYwOrLd';
			$additional_data = array(
				'first_name' => $_POST['first_name'],
				'photo'=>$_POST['photo'],
				'school'=>$this->uri->segment(3),
				'id'=>$primary_key,
				'description'=>$_POST['description']
			);								
			$group = array('3'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default
			$this->ion_auth->register($username, $password, $email, $additional_data,$group);
				
		}

		return true;
	}


	function mw_upload_students_form()
	{
		$this->grocery_crud->set_field_upload('file','uploads');
		$this->grocery_crud->unset_fields('class');
		$this->grocery_crud->unset_columns('class');
		$this->grocery_crud->callback_after_insert(array($this, 'upload_students_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'upload_students_callback'));
		$this->grocery_crud->set_lang_string('insert_success_message',
                 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page. <script type="text/javascript">window.location = "'.site_url(strtolower('backend') .'/'. strtolower('mw_students')) .'/'. $this->uri->segment(3) .'";</script><div style="display:none">.');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}

	function upload_students_callback($post_array, $primary_key) {
		$data['class'] = $this->uri->segment(3);
		$this->db->where('id', $primary_key);
		$this->db->update('mw_upload_students_form', $data);
		include 'Classes/PHPExcel/IOFactory.php';
		$objPHPExcel = PHPExcel_IOFactory::load('uploads/' . $post_array['file']);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

		$datas=array();
		$count = 0;
		foreach($sheetData as $student)
		{
			if($count > 0)
			{


					$data['class']=$this->uri->segment(3);
					$data['student_registration_number']=$student['A'];
					$data['first_name']=$student['B'];
					$data['last_name']=$student['C'];
					$data['parent_1_name']=$student['D'];
					$data['parent_1_email']=$student['E'];
					$data['parent_1_phone_numbers']=$student['F'];					
					$data['parent_2_name']=$student['G'];
					$data['parent_2_email']=$student['H'];
					$data['parent_2_phone_numbers']=$student['I'];					
					$data['parent_3_name']=$student['J'];
					$data['parent_3_email']=$student['K'];
					$data['parent_3_phone_numbers']=$student['L'];
					$datas[]=$data;


			}
			else
			{}
			$count++;
			
		}

		$this->db->insert_batch('mw_students', $datas);
		unlink('uploads/' . $post_array['file']);
		$this->db->where('id', $primary_key);
		$this->db->delete('mw_upload_students_form');
		//redirect('backend/mw_students/' . $this->uri->segment(3));

		//$this->mw_students( $this->uri->segment(3) );

		   

	}	

	
	
	function mw_newsletters()
	{
		$this->grocery_crud->unset_fields('url','identifier');
		$this->grocery_crud->unset_columns('identifier');
		$this->grocery_crud->set_relation_n_n('news_articles','mw_newsletter_news','mw_news','newsletter_id','news_id','title','priority');
		$this->grocery_crud->callback_after_insert(array($this, 'generate_newsletter_url'));
		$this->grocery_crud->callback_after_update(array($this, 'generate_newsletter_url'));
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
	
	function mw_pages($type=1)
	{
		$this->grocery_crud->where('type',$type);
		
		if(!$this->ion_auth->is_admin())
			$this->grocery_crud->set_relation('template','mw_page_templates','name',array('access_level'=>2));
		else
			$this->grocery_crud->set_relation('template','mw_page_templates','name');
		
	
		$this->grocery_crud->set_relation('logo','mw_logos','title');
		$this->grocery_crud->set_relation('parent','mw_categories','title');
		
		if($type == 1)
			$this->grocery_crud->unset_delete();

		if($this->ion_auth->in_group(array('su')))
		{
			$this->grocery_crud->unset_fields('thumb_nail','type','url','table','identifier');
			$this->grocery_crud->unset_columns('thumb_nail','type','url','table','identifier');	
		}
		else
		{
			$this->grocery_crud->unset_fields('thumb_nail','type');
			$this->grocery_crud->unset_columns('thumb_nail','type');	
		}
		
		$this->grocery_crud->callback_after_insert(array($this, 'generate_thumb'));
		$this->grocery_crud->callback_after_update(array($this, 'generate_thumb'));
		$output = $this->grocery_crud->render();

		$this->_example_output($output);

	}
	
	function generate_thumb($post_array,$primary_key)
	{
	
		$data = array (
			'type' => $this->uri->segment(3),
			'url' => $this->make_url_from_title($post_array['title'], 'mw_pages', $primary_key)
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
	
	function mw_projects($type)
	{
		
		$this->grocery_crud->where('type',$type);
		$this->grocery_crud->callback_after_insert(array($this, 'set_projects_category'));
		$this->grocery_crud->callback_after_update(array($this, 'set_projects_category'));
		$this->grocery_crud->display_as('text','Project Description');
		$this->grocery_crud->unset_fields('url','category','type');
		$this->grocery_crud->unset_columns('url','category','type');	
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
			$data['url'] = $this->make_url_from_title($title_obj->row()->title, 'mw_projects', $primary_key);
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

		$data['url'] = $this->make_url_from_title($title_obj->row()->title, 'mw_news', $primary_key);

		
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



		// if($post_array['youtube'] != '')
		// 	$data['youtube']= '<iframe width="400" height="300" src="' . str_replace('watch?v=', 'embed/', strip_tags($post_array['youtube']))  . '" frameborder="0" allowfullscreen></iframe>';

		// $this->db->where('id', $primary_key);
		// $this->db->update('mw_image_scroller', $data);
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

	function mw_files()
	{
		$this->grocery_crud->set_field_upload('file','uploads');
		$this->grocery_crud->unset_columns('file');
		$this->grocery_crud->unset_fields('url');
		$this->grocery_crud->callback_after_insert(array($this, 'files_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'files_callback'));
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}


	
	function files_callback($post_array, $primary_key) {
		$data['url'] = base_url() . "/uploads/" . $post_array['file'];
		$this->db->where('id', $primary_key); 
		$this->db->update('mw_files', $data);
	}

	function send_email_form($cls=0,$edit=0,$reuse=0)
	{

		if($cls != 0)
		{
			$this->db->where('id', $cls);
			$class = $this->db->get('mw_classes');
			$data['class_name']=$class->row()->class_name;
			$data['class'] = $cls;
		}

		if($edit!=0)
		{

			$this->db->where('id', $edit);
			$email=$this->db->get('mw_emails');
			$data['subject'] = $email->row()->title;
			$data['message'] = $email->row()->message;
			$data['edit'] = $edit;
		}

		if(isset($data))
			$this->load->view('send-email',$data);
		else
			$this->load->view('send-email');

		
	}


	function preview_message()
	{

		$teacher = $this->ion_auth->user()->row();


				
		$data = array(
			'title'=>$_POST['subject'],
			 'message'=>$_POST['message'],
			 'date'=> date('Y-m-d'),
			 'sent_by'=> $teacher->id
		);

		if(isset($_POST['edit']) and $_POST['edit'] != 0)
		{
			$this->db->where('id', $_POST['edit']);
			$this->db->update('mw_emails', $data);
			$id = $_POST['edit'];

			$this->db->where('email_id', $id);
			$m=$this->db->get('mw_email_sent_to');
			$sent_to_id = $m->row()->id;

		}
		else
		{
			$this->db->insert('mw_emails', $data);
			$id = $this->db->insert_id();

			$data = array();

			if(isset($_POST['classes']))
			{
				$data = array (
				'email_id'=>$id,
				'sent_to'=> $_POST['classes']
				);

				$this->db->insert('mw_email_sent_to', $data);
				$sent_to_id =$this->db->insert_id();
			}	

			else
			{
				

				if($_POST['category']==2 or $_POST['category']==3)
					$this->db->where('school', $_POST['category']);


				$classes=$this->db->get('mw_classes');

				foreach($classes->result() as $class)
				{
					$data[] = array (
						'email_id'=>$id,
						'sent_to'=> $class->id
						);
				}

				//print_r($data);
				$this->db->insert_batch('mw_email_sent_to', $data);
			}


		}	


		$data = array();

		$data['id'] = $id;
		$data['title'] = 'Email Preview'; 
		if(isset($_POST['classes']))
		$data['details']->text = '<strong>Subject:</strong> ' . $_POST['subject'] .'<br><br><strong>Message:</strong> ' . $_POST['message'] . '<a href = "send_class_message/' . $teacher->id . '/' . $id .  '">This is Correct, Send it</a>  |  <a href= "send_email_form/' . $_POST['classes'] . '/' . $id . '"> Wait a Minute, I need to edit this</a>';
		else
		$data['details']->text = '<strong>Subject:</strong> ' . $_POST['subject'] .'<br><br><strong>Message:</strong> ' . $_POST['message'] . '<a href = "send_class_message/' . $teacher->id . '/' . $id .  '">This is Correct, Send it</a>  |  <a href= "send_email_form/0/' . $id . '"> Wait a Minute, I need to edit this</a>';
		$data['teacher'] = $teacher->id;


		$this->load->view('page', $data);

	}

	function send_class_message($teacher, $email_id)
	{
		
		$not_sent = array();
		$this->load->library('email');
		
		$config['protocol'] = 'smtp';
		//$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_host'] = 'box800.bluehost.com';
		$config['smtp_user'] = 'info@zoomtanzaniahost.com';
		$config['smtp_pass'] = '123456';
		$config['smtp_port'] = '26';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$config['charset']='utf-8';  
		$config['newline']="\r\n";  

		$this->email->initialize($config);

		$this->db->where('email_id', $email_id);
		$emails=$this->db->get('mw_email_sent_to');

		$class=array();

		foreach($emails->result() as $email)
		{
			$class[]=$email->sent_to;
		}




		$this->db->where_in('class', $class);
		$students=$this->db->get('mw_students');	

		
		$this->db->where('id', $email_id);
		$email_to_send=$this->db->get('mw_emails');

		$email_subject = $email_to_send->row()->title;
		$email_message = $email_to_send->row()->message;
		$this->email->from('info@zoomtanzaniahost.com', 'My World');
		$this->email->subject($email_subject);
		$this->email->message($email_message);
		$this->email->set_alt_message(strip_tags($email_message));

		foreach ($students->result() as $student) {
	
			$parent_emails = array();
			if($student->parent_1_email != '')
				$parent_emails[1] = $student->parent_1_email;			
			if($student->parent_2_email != '')
				$parent_emails[2] = $student->parent_2_email;			
			if($student->parent_3_email != '')
				$parent_emails[3] = $student->parent_3_email;
			$this->email->to($parent_emails);

			//print_r($parent_emails);

			if(!$this->email->send())
				$not_sent[$student->id]=$student->id;	
		}

		if(isset($not_sent))
			$this->resend_email($not_sent,$email_id);


		echo "Email will be sent shortly. Return to <a href = 'backend'>Dashboard</a>.";

	}


	function resend_email($not_sent,$email_id)
	{
		$this->load->library('email');
		
		$config['protocol'] = 'smtp';
		//$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_host'] = 'box800.bluehost.com';
		$config['smtp_user'] = 'info@zoomtanzaniahost.com';
		$config['smtp_pass'] = '123456';
		$config['smtp_port'] = '26';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$config['charset']='utf-8';  
		$config['newline']="\r\n";  

		$this->email->initialize($config);

		$this->db->where_in('id', $not_sent);
		$students=$this->db->get('mw_students');

		$this->db->where('id', $email_id);
		$email_to_send=$this->db->get('mw_emails');

		$email_subject = $email_to_send->row()->title;
		$email_message = $email_to_send->row()->message;
		$this->email->from('info@zoomtanzaniahost.com', 'My World');
		$this->email->subject($email_subject);
		$this->email->message($email_message);
		$this->email->set_alt_message(strip_tags($email_message));

		foreach ($students->result() as $student) {
	
			$parent_emails = array();
			if($student->parent_1_email != '')
				$parent_emails[1] = $student->parent_1_email;			
			if($student->parent_2_email != '')
				$parent_emails[2] = $student->parent_2_email;			
			if($student->parent_3_email != '')
				$parent_emails[3] = $student->parent_3_email;
			$this->email->to($parent_emails);

			//print_r($parent_emails);

			if(!$this->email->send())
				$not_sent[$student->id]=$student->id;	
		}

		if(isset($not_sent))
			$this->resend_email($not_sent,$email_id);

	}



	function mw_photo_albums($school)
	{
		$albums=$this->db->get('mw_photo_albums');
		$image_array = array();
		if($albums->num_rows() > 0)
		{
			foreach($albums->result() as $album)
			{

				$this->db->where('album',$album->id);
				$this->db->where('priority',1);
				$images = $this->db->get('mw_album_images');
				
				if($images->num_rows() == 0)
				{

					$this->db->where('album',$album->id);
					$this->db->limit(1);
					$images = $this->db->get('mw_album_images');
					
					if($images->num_rows() == 0)
						continue;
				}
				
				$image = $images->row()->image;
				$image_array[] = array('id'=>$album->id,'thumb_nail'=>'<img width = "100" src = "img/thumb__' . $image . '" />');
				
			}
			

			if($images->num_rows()>0)
				$this->db->update_batch('mw_photo_albums',$image_array,'id');
		}

		$this->grocery_crud->where('school',$school);
		$this->grocery_crud->unset_fields('thumb_nail','images','url','school');
		$this->grocery_crud->unset_columns('url','school');
		$this->grocery_crud->callback_after_insert(array($this, 'albums_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'albums_callback'));
		
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}	
	
	function albums_callback($post_array,$primary_key)
	{
		$data = array();
		$data['images'] = '<a href = "backend/album_images/' . $primary_key . '/' . $this->uri->segment(3) . '">Images</a>'; 
		$data['url'] = $this->make_url_from_title($post_array['title'],'mw_photo_albums',$primary_key);
		$data['school'] = $this->uri->segment(3);
		$this->db->where('id',$primary_key);
		$this->db->update('mw_photo_albums', $data);

	}
	
	function album_images()
	{
		$image_crud = new image_CRUD();
	
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('image');
		$image_crud->set_title_field('title');
		$image_crud->set_table('mw_album_images')
		->set_ordering_field('priority')
		->set_relation_field('album')
		->set_image_path('img');
			
		$output = $image_crud->render();
		$output->additional_text = "<a href = 'backend/mw_photo_albums/" . $this->uri->segment(4) . "'>Return to Albums</a>";
	
		$this->_example_images_output($output);
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