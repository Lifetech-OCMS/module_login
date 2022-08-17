<?php 								
		
	if (isset($_POST['lifetech_surnameGOOD'])){
		ob_end_clean();

		  if ($_POST['lifetech_usernameGOOD']==''){
			echo'Enter your username';
			exit();
		}else{
		
		
            $sname =  $_POST['lifetech_surnameGOOD'];
            $fname = $_POST['lifetech_firstname'];
            $oname =  $_POST['lifetech_othername'];
            $uname =  $_POST['lifetech_usernameGOOD'];
            $email =  $_POST['lifetech_email'];
            $pnum =   $_POST['lifetech_phone'];
            $formtype = 'lifetech_user_data';

			$password =   $_POST['lifetech_password'];
			if ($password == ''){
				$password = 12345;
			}else{
				$password=$_POST['lifetech_password'];
			}

			$confirm =   $_POST['lifetech_confirm'];
			if ($confirm == ''){
				$confirm = 12345;
			}else{
				$confirm=$_POST['lifetech_confirm'];
			}

			if ($password == $confirm){

				 $salt = lifetech_salt_encryption();
				$password = $password . $salt;

			} else{

				echo 'password and confirm password is not correct';
				exit();
			}
			$encrypt = hash('sha256', $password);
			//  $where ="(field_name = 'lifetech_email' or field_name= 'lifetech_username') and  field_value= '$email'"; 
            $cemail=lifetech_check_email($email);
			if($cemail['response']!='success'){					  
						echo'Email Already in Use Provide Another Email';
			           exit(); 	} 				 
			$cemail=lifetech_check_email($uname);			
					if($cemail['response']!='success'){
					 		echo'Username Already in Use Provide Another Username';		exit(); 
						 }
				else {
				
$form_categoryname='lifetech_user_data'; $acctno='11073';  $loginable='Yes';
 $field_names = 'lifetech_surname,lifetech_firstname, lifetech_othername, lifetech_username, lifetech_email, lifetech_phone_number,lifetech_password, salt';
 $field_values = "'$sname','$fname','$oname','$uname','$email','$pnum','$encrypt','$salt'";
$addd= lifetech_registrations_insert($acctno, $form_categoryname, $loginable, $field_names, $field_values );
                      if($addd['response'] == 'success' ){ echo("success");
                            exit();	  }else{
					  echo  $addd['results'];
					  }
					 
					 
            	}

		}
		exit();
    }





?>
<html>
<script>
	$(function(){
		$('#register').click(function(){
			event.preventDefault();
			let values = $('#registration').serialize();
			$.ajax({
				type: 'post',
				data: values,
				dataType: 'text',
				// beforeSend: function(){
				// 	setTimeout(function(){
				// 		$('#submit').value('Loading....')
				// 	}, 3000)
				// },
				success: function(response){
					if (response ==='success') {
						alert('Registration Successful');
						$("#registration")[0].reset();
					} else if (response === 'available') {
						alert('Account Already Available');
					} else {
						alert('' + response);
					} 
				},
				
			});
			console.log(values);
		});
	})
 
 </script>



<form   id="registration"   enctype="multipart/form-data">
	<fieldset>
		<legend><b>USER REGISTRATION PAGE</b></legend>
		<input type="text" id="surname" name="lifetech_surnameGOOD" placeholder="Enter Your Surname" ><br><br>
		<input type="text" id="firstname" name="lifetech_firstname" placeholder="Enter Your Firstname"  ><br><br>
		<input type="text" id="othername" name="lifetech_othername" placeholder="Enter Your Othername" ><br><br>
		<input type="text" id="username" name="lifetech_usernameGOOD" placeholder="Enter Your Username"  ><br><br>
		<input type="email" id="email" name="lifetech_email" placeholder="Enter Your Email"  ><br><br>
		<input type="number" id="phone" name="lifetech_phone" placeholder="Enter Your Phone No." ><br><br>
		<input type="password" id="password" name="lifetech_password" placeholder="Enter Password" ><br><br>
		<input type="password" id="confirm" name="lifetech_confirm" placeholder="Confirm Password"><br /><br />

		<div>
			<input type="submit" id="register" name="register" value="Register"> 
		</div
	
	></fieldset>




</form>