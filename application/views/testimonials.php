<!--*start of first row for news, video and button/-->
<script src="js/jquery.validate.min.js" type = "text/javascript"></script>
<script type = "text/javascript">
$(document).ready(function(){
 
 $('#contact-form').validate(
 {
  rules: {
    name: {
      minlength: 2,
      required: true
    },    
  
  captcha: {
      
      required: true
    
    },
    email: {
      required: true,
      email: true
    },
 confirm_email: { equalTo:'#email', email:true },

    subject: {
      minlength: 2,
      required: true
    },
    testimonial: {
      minlength: 2,
      required: true
    }
  },
  highlight: function(label) {
    $(label).closest('.control-group').addClass('error');
  },
  success: function(label) {
    label
      .text('OK!').addClass('valid')
      .closest('.control-group').addClass('success');
  }
 });
}); // end document.ready
</script>
<div class="span9">
<div class="content">
<div class="title_h1 summary_title_h1">
<h1><?php if(isset($title)) echo $title ?></h1>
</div>

<Br><a href = "<?php echo current_url(); ?>#testimonial-form" >Submit a Testimonial</a><br><br>
<?php foreach ($testimonials->result() as $testimonial): ?>
<p class = 'testimonial'><?php echo strip_tags($testimonial->message); ?><p> 
<p class = "signature"> <?php echo $testimonial->name ?>, <?php echo $testimonial->title; ?></p>
<hr>
<?php endforeach; ?>


 <div class="contact" id = "testimonial-form" style = "margin-top:0;">
  <?php if($this->uri->segment(4)==2): ?><Br><span style = "font-weight: bold; color:red;">Something Went Wrong, Please Type in your Testimonial Again</span><br><br><?php endif; ?>
 	<span style = "font-size: 18px; font-weight: bold;">Submit a Testimonial</span><br>
<form class="form-horizontal" style = "margin-top: 10px;" method = "post" action = "submittestimonial" id = "contact-form" >
  <div class="control-group">
    <label class="control-label" for="name">Name:</label>
    <div class="controls">
      <input type="text" name = "name" id="name" placeholder="Enter your Name">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="email">Email:</label>
    <div class="controls">
      <input type="text" name = "email" id="email" placeholder="Email Will Be Kept Private">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="confirm_email">Confirm Email:</label>
    <div class="controls">
      <input type="text" name="confirm_email" id="confirm_email" placeholder="Retype Your Email to Confirm">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="title">Title:</label>
    <div class="controls">
      <input type="text" name ="title" id="title" placeholder="e.g. Satisfied Parent, Former Student etc...">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="testimonial">Testimonial:</label>
    <div class="controls">
  <textarea rows="5" name = "testimonial" id="testimonial" ></textarea>
  </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="captcha">Captcha:</label>
    <div class="controls">
	<small style="font-weight: bold">Enter the text in the box below, only CAPITAL letters and numbers</small>
	<p><?php echo $cap['image'] ?></p>
    <input type="text" placeholder="Enter the words above" class="spam" name = "captcha" id = "captcha"><span class="help-inline"><!--<i>* Must be filled</i>--></span><br>
     </div>
    </div>
	
	  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Submit Testimonial</button>
    </div>
    </div>
    </div>
  </div>
  </div>
</form>
</div>
  </div> 
  <!--end of content
-->
</div>  <!--end of span9-->






</div>



