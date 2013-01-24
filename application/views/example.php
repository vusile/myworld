<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<base href = "<?php echo base_url(); ?>" />

<?php 
if(isset($css_files))
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php 
if(isset($js_files))
foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
	<div>
			<a href='<?php echo site_url('logout')?>'>Logout</a> |	
		<?php if($this->ion_auth->in_group(array('admin','su'))): ?>
			<h2>General</h2>
			<a href='<?php echo site_url('backend/mw_pages/1')?>'>Main Pages</a> |
			<a href='<?php echo site_url('backend/mw_news')?>'>News</a> |
			<a href='<?php echo site_url('backend/mw_helpful_links_categories')?>'>Helpful Links</a> |
			<a href='<?php echo site_url('backend/mw_image_scroller')?>'>Content Scroller</a> |
			<a href='<?php echo site_url('backend/mw_header_images')?>'>Header Images</a> |
			<a href='<?php echo site_url('backend/mw_testimonials')?>'>Testimonials</a> | 
			<a href='<?php echo site_url('backend/mw_partner_links')?>'>Partners Links</a> | 
			<a href='<?php echo site_url('backend/mw_settings')?>'>Home Page Settings</a> |
			<a href='<?php echo site_url('backend/mw_categories')?>'>Page Categories</a> |
			<a href='<?php echo site_url('backend/mw_logos')?>'>Logos</a> | 
			<a href='<?php echo site_url('backend/mw_files')?>'>Uploaded Files and Documents</a> |
			<?php if($this->ion_auth->is_admin()): ?>
				<a href='<?php echo site_url('backend/mw_messages')?>'>Site Messages</a> | 	
				<a href='<?php echo site_url('backend/mw_page_templates')?>'>Page Templates</a> |
			<?php endif; ?>
			<h2>My World Upanga</h2>
			<a href='<?php echo site_url('backend/mw_pages/2')?>'>My World Upanga Pages</a> |
			<a href='<?php echo site_url('backend/mw_projects/2')?>'>My World Upanga Projects</a> |
			<a href='<?php echo site_url('backend/mw_users/2')?>'>My World Upanga Staff</a> |
			<a href='<?php echo site_url('backend/mw_classes/2')?>'>My World Upanga Classes</a> |
			<h2>My World Msasani</h2>
			<a href='<?php echo site_url('backend/mw_pages/3')?>'>My World Msasani Pages</a> |
			<a href='<?php echo site_url('backend/mw_projects/3')?>'>My World Msasani Projects</a> |
			<a href='<?php echo site_url('backend/mw_users/3')?>'>My World Msasani Staff</a> |
			<a href='<?php echo site_url('backend/mw_classes/3')?>'>My World Msasani Classes</a> |
			<h2>My World Community Centre</h2>
			<a href='<?php echo site_url('backend/mw_pages/4')?>'>My World Community Centre Pages</a> |
			<h2>My World Training Centre Centre</h2>
			<a href='<?php echo site_url('backend/mw_pages/5')?>'>My World Training Centre Pages</a> |

		<?php elseif($this->ion_auth->in_group('teacher')): ?>
			<?php 
				$teacher = $this->ion_auth->user()->row();


				$this->db->where('teacher_id', $teacher->id);
				$classes =$this->db->get('mw_teachers_classes');

				$class_array = array();

				foreach($classes->result() as $class)
					$class_array[]=$class->class_id;

				$this->db->where_in('id',$class_array);
				$classes = $this->db->get('mw_classes');
			 ?>
			<?php foreach ($classes->result() as $class): ?>
				<a href='<?php echo site_url('backend/mw_classes/' .  $class->school .'/' . $class->id) ?>'><?php echo $class->class_name; ?> Class</a> |
			<?php endforeach; ?>
		<?php endif; ?>

	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php if (isset($output)) {
			echo $output; 
		} ?>
    </div>
</body>
</html>
