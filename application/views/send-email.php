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
<h1>Send Email <?php if (isset($class_name)) echo 'To ' . $class_name . ' Class'; ?> </h1><br><br>
</div>
</div>
<div class="contact" style = "clear:both; ">
<form class="form-horizontal" id = "contact-form" method = "post" action = "backend/preview_message">

  <div class="control-group">
    <label class="control-label" for="inputSubject">Subject:</label>
    <div class="controls">
      <input type="text"  id="subject" name = "subject" placeholder="Enter the Subject" value="<?php if(isset($subject)) echo $subject ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputSubject">Message:</label>
    <div class="controls">
  <textarea class="input-xxlarge mini-texteditor" name = "message" id = "message" rows = "10" ><?php if(isset($message)) echo $message ?></textarea>
  </div>
  </div>
  <?php if($this->ion_auth->in_group(array('admin','su')) and !isset($class)): ?>
    <div class="control-group">
    <label class="control-label" for="inputSubject">Send To:</label>
    <div class="controls">
      <select id="category" name = "category">
          <option value ="">Select One</option>
          <option value ="1">Both Schools</option>
          <option value ="2">Upanga School</option>
          <option value ="3">Msasani School</option>
  
      </select>
      </div>
  </div>
  <?php else: ?>
      <input type="hidden"  id="classes" name = "classes" value="<?php echo $class; ?>">
  <?php endif; ?>
      <input type="hidden"  id="edit" name = "edit" value="<?php if(isset($edit)) echo $edit; else echo 0; ?>">
	
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


