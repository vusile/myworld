<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
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
		<a href='<?php echo site_url('backend/mw_pages/1')?>'>Main Pages</a> |
		<a href='<?php echo site_url('backend/mw_categories')?>'>Page Categories</a> |
		<a href='<?php echo site_url('backend/mw_pages/2')?>'>My World Upanga Pages</a> |
		<a href='<?php echo site_url('backend/mw_projects/2')?>'>My World Upanga Projects</a> |
		<a href='<?php echo site_url('backend/mw_pages/3')?>'>My World Msasani Pages</a> |
		<a href='<?php echo site_url('backend/mw_projects/3')?>'>My World Msasani Projects</a> |
		<a href='<?php echo site_url('backend/mw_pages/4')?>'>My World Community Centre Pages</a> |
		<a href='<?php echo site_url('backend/mw_pages/5')?>'>My World Training Centre Pages</a> |
		<a href='<?php echo site_url('backend/mw_news')?>'>News</a> |
		<a href='<?php echo site_url('backend/mw_image_scroller')?>'>Image Scroller</a> |
		<a href='<?php echo site_url('backend/mw_testimonials')?>'>Testimonials</a> | 
		<a href='<?php echo site_url('backend/mw_messages')?>'>Site Messages</a> | 
		<a href='<?php echo site_url('backend/mw_settings')?>'>Settings</a> 
		<?php if($this->ion_auth->is_admin()): ?>
			| <a href='<?php echo site_url('backend/mw_page_templates')?>'>Page Templates</a> 
		<?php endif; ?>

	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
