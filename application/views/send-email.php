<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <base href = "<?php echo base_url(); ?>" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <script src="assets/grocery_crud/js/jquery-1.8.1.min.js"></script>
  <script src="assets/grocery_crud/texteditor/ckeditor/ckeditor.js"></script>
  <script src="assets/grocery_crud/texteditor/ckeditor/adapters/jquery.js"></script>
  <script src="assets/grocery_crud/js/jquery_plugins/config/jquery.ckeditor.config.js"></script>
  </head>
<body>
<div class="row">
<div class="span12">
<div class="teaser">
<div class="title_h1">
<h1>Send Email To <?php echo $class_name; ?> Class</h1><br><br>
</div>
</div>
<div class="contact" style = "clear:both; ">
<form class="form-horizontal" id = "contact-form" method = "post" action = "backend/preview_message">

  <div class="control-group">
    <label class="control-label" for="inputSubject">Subject:</label>
    <div class="controls">
      <input type="text"  id="subject" name = "subject" placeholder="Enter the Subject">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputSubject">Message:</label>
    <div class="controls">
  <textarea class="input-xxlarge mini-texteditor" name = "message" id = "message" rows = "10" ></textarea>
  </div>
  </div>
  
      <input type="hidden"  id="classes" name = "classes" value="<?php echo $class; ?>">
	
	  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Send Message</button>
    </div>
    </div>
    </div>
  </div>
  </div>
</form>
</div>
</body>
</html>


