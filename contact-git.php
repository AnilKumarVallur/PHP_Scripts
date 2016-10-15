<?php
if(isset($_POST['submit'])){
	$message = " ";
	$fullName = $_POST["name"] ;
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$formMessage = $_POST["message"];
	
	
	$message .= "Full Name: " . $fullName . "\
";
	$message .= "Email Address: " . $email . "\
";
	$message .= "Comment: " . $formMessage . "\
";
	$myEmail ="abc@xyz.com";
	
	if (mail($myEmail, $subject, $message, "From:" . $email)){
		$success = "Sending mail was successful";
	}else{
		$success = "Sending mail failed, try again!";
	}
}
?>
<!DOCTYPE html>
<html>
  <head> 
      <title>Classical Homeo Clinics</title>
  </head>
<body>
	<div class="main-wrapp"> 
	   <div class="container">
   	     
          	 <div class="row">
          	 	
				<div class="col-md-6">
					<div class="contact-form">
						<div class="subtitle">
							  <h4>Have a question?</h4>
						  </div>
						  <?php
							if (isset($success)){ echo "<div id='success-message'>" . $success . "</div>";}
						  ?>
						  <form action="#" method="post" name="contactform">
							  <input type="text" placeholder="Name*" name="name" required>
							  <input type="email" placeholder="Email*" name="email" required>
							  <input type="text" placeholder="Subject" name="subject">
							  <textarea placeholder="Message"  name="message" required></textarea>
							  <input type="submit" value="send message" name="submit">
						  </form>
					</div>    
				</div>
          	 </div>
          </div>
	  </body>
</html>