<?php 
	if (isset($_POST['lifetech_email_uname'])){
		ob_end_clean();
			if ($_POST['lifetech_email_uname']==''){
                echo'Enter your Email or Username';
                exit();
            }else if ($_POST['lifetech_password']==''){
                echo'Enter your Password';
                exit();
            }else{
            
        
                $email =  $_POST['lifetech_email_uname'];
                $lpassword =$_POST['lifetech_password'];
				$formtype = 'lifetech_user_data';

			 
$table_name= 'registrations';     $where ="(field_name = 'lifetech_email' or field_name= 'lifetech_username') and  field_value= '$email'"; 
$ah = lifetech_db_select($table_name, $fields, $where, $order);

if($ah['response'] =='success'){ 
$ah = $ah['results']; 
while ($row = $ah->fetch()){

$uid = htmlspecialchars($row->uid); 
$table_name= 'registrations';     $wheree ="uid=$uid and field_name = 'salt'"; 
$saltPass1 = lifetech_db_select($table_name, $fields, $wheree, $order);
		$saltPass1 = $saltPass1['results'];  $saltPass=$saltPass1->fetch();
		$salt = htmlspecialchars($saltPass->field_value); 
					$lpassword = $lpassword . $salt;
					$encrypt = hash('sha256',$lpassword);
$table_name= 'registrations';     $where1 ="uid=$uid and field_name = 'lifetech_password'"; 
$saltPass1 = lifetech_db_select($table_name, $fields, $where1, $order);
		$saltPass1 = $saltPass1['results'];  $saltPass=$saltPass1->fetch();
					$password = htmlspecialchars($saltPass->field_value);
											 
 

	if ( ($password == $encrypt) ){
	
	 
		 $table_name= 'registrations';     $where1 ="uid=$uid and field_name = 'lifetech_role'"; 
$saltPass1 = lifetech_db_select($table_name, $fields, $where1, $order);
		$saltPass1 = $saltPass1['results'];  $saltPass=$saltPass1->fetch();
					$urid=   htmlspecialchars($saltPass->field_value);
		
				
$_SESSION['lifetech_urid'] = $urid; 
$_SESSION['lifetech_uid'] = $uid; 	

echo "success";
 
										exit();
									}
									else{
										echo 'username or password is not correct'; exit();
									}


} echo 'username or password is not correct';///kkkjk
						
                exit();

}else{
echo $ah['results'];
exit();

}

				
						 
					 
            }

    }





?>

<html>
 <script>
	$(function(){
		$('#submit').click(function(){
			event.preventDefault();
			let values = $('#login').serialize();
			$.ajax({
				type: 'post',
				data: values,
				dataType: 'text',
				success: function(response){
					if (response ==='success') {
						alert('Login Successfully');
						//$("#login")[0].reset();
                                                window.location="Dashboard.php";

					} else if (response === 'available') {
						alert('Unable to Login');
					} else {
						//alert('Unable to Login')
						alert('' + response);
					} 
				},
				
			});
			console.log(values);
		});
	})
 
 </script>

<br><br>
<h1> User Login ddd</h1>
<form   id="login"   enctype="multipart/form-data" >
	<fieldset>
		<legend><b>USER LOGIN</b></legend>
	<div class="input-holder">	
         <input type="Email" id="email" name="lifetech_email_uname" placeholder="Enter Email"  required><br><br>
</div>
		<input type="password" id="password" name="lifetech_password" placeholder="Enter Password"  required><br><br>

		<div >
			<input type="submit" id="submit" name="login" value="Login"> 
		</div
	
	></fieldset>



</form>