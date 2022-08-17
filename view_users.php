<?php 	
     
 
 

if (isset($_POST['surname_UPDATE'])) {
					ob_end_clean();
					$surname = $_POST['surname_UPDATE'];
					$firstname = $_POST['firstname'];
					$othername = $_POST['othername'];
					$username = $_POST['username'];	
					$email = $_POST['email'];	
					$phone_no = $_POST['phone_no'];	
                    $account_no = $_POST['account_no'];	
                    $uid = $account_no;
					
                   $field_name='lifetech_surname,lifetech_firstname,lifetech_othername,lifetech_username,lifetech_email,lifetech_phone_number'; 
				   $field_values= "'$surname','$firstname','$othername','$username','$email','$phone_no'";	
				   $akjeg=	lifetech_registrations_update($uid, $field_name, $field_values);
					   if ($akjeg['response']=='success'){
						   echo  $akjeg['results'];
										 exit(); 
					   }else{
						   echo  $akjeg['results'];
										 exit(); 
					   }
				   
			}
			?>

<!--Middle Man Execution--> 
<html>

<script>
$(document).ready(function (){
 $('#editUser').on('click', '#update', function(){
    if($('#UPDATEemail').val()== ''){
 alert("Enter Your Email");
 }if($('#UPDATEusername').val()== ''){
 alert("Enter Your Username");
 }else{
      // Reset form
     
 var ajaxRequest;
    /* Stop form from submitting normally */
 event.preventDefault();

    /* Clear result div*/
    $("#results").html('');

    /* Get from elements values */
   var values = $("#editUser").serialize();
   
     ajaxRequest= $.ajax({
           
            type: "post",
            data: values 
        });

    /*  Request can be aborted by ajaxRequest.abort() */

    ajaxRequest.done(function (response, textStatus, jqXHR){
         // Show successfully for submit message
         $("#results").html(response);
    });

    /* On failure of request this function will be called  */
    ajaxRequest.fail(function (){

        // Show error
        $("#results").html('There is error while submit');
    }); 
  
  }
  
  
});
  
});
</script>

	
 


<?php 

    if(isset($_GET['update'])){
        
        $uid = $_GET['update'];
$akkk=lifetech_get_registrations_value($uid); 
$ara=json_decode($akkk['results']); 
//then u will call on your field_names e.g $ara[username];


?>
<div id="results"></div>
<br>

<h2>Update User</h2>
	<form id="editUser">			
		<label>Surname</label> 
        <input id="surname" name="surname_UPDATE" value="<?php 
                //Get Surname
echo $ara->lifetech_surname;   
            ?>" type="text"/> 

		<label>Firstname</label> 
		<input id="firstname" name="firstname" value="<?php 
                //Get Surname
				echo $ara->lifetech_firstname; 
              
            ?>" type="text"/> 

		Othername
		<input id="othername" name="othername" value="<?php 
                //Get Surname
				echo $ara->lifetech_othername; 
                 
        
            ?>" type="text"/> 
		
		<label>Username</label> 
		<input id="UPDATEusername" name="username" value="<?php 
                //Get Surname
				echo $ara->lifetech_username; 
              
        
            ?>" type="text"/> 

		<label>Email</label> 
		<input id="UPDATEemail" name="email" value="<?php 
                //Get Surname
				echo $ara->lifetech_email; 
                 
        
            ?>" type="text"/> 
		
		<label>Phone Number</label> 
		<input id="phone_no" name="phone_no" value="<?php 
                //Get Surname
				echo $ara->lifetech_phone_number; 
               
        
            ?>" type="text"/> 
        
	 
		<input id="account_no" name="account_no" value="<?php 
                //Get Surname
				echo $ara->lifetech_account_number; 
                 
        
            ?>" type="hidden"/> 

		<input type="button" name="update" id="update"  value="Update"/>
	</form>
</div>

<?php   } ?>
<h2>View Data</h2>
<table style="border-collapse: collapse;" width="100%">
		 
				<thead>
					<th>surname</th>
					<th>firstname </th>
					<th>othername</th>
					<th>username</th>
					<th>email</th>
					<th>phone_number</th>
					<th>account no</th>
					<th>edit</th>
					<th>delete</th>
				</thead>

                    <?php 

$tb='registrations'; $where_value="field_name='form_type' AND field_value='lifetech_user_data'";
$sel=lifetech_db_select($tb,$fields_name, $where_value, $orderby);
		if($sel['response'] != 'success'){
		echo $sel['results'];
		}else{
						$selvalue=$sel['results'];
                        while ($row =$selvalue->fetch() ) {
                        $uid = $row->uid;  
						{ 
                                            $akkk=lifetech_get_registrations_value($uid); 
						$ara=json_decode($akkk['results']);
 
                    ?>

					<tr id=''>
							<td ><?php echo $ara->lifetech_surname; ?></td>
							<td><?php echo $ara->lifetech_firstname;	 ?></td>
					        <td ><?php echo $ara->lifetech_othername;	 ?></td>
                            <td><?php echo $ara->lifetech_username;  ?></td>
                            <td><?php  echo $ara->lifetech_email;  ?></td>
                            <td><?php  echo $ara->lifetech_phone_number; ?></td>
                            <td><?php echo $ara->lifetech_account_number ; ?></td>
                            <td>
	<a data-role="updateUser" data-id="<?php echo($row->uid) ?>" href=""> edit </a> 
							</td>
							<td>
								 <a href=""> delete</a>
							</td>
						</tr>
                <?php  
                    }
                }    } 
				?>
				</table>





				
                <?php 

                   if(isset($_GET['delete'])){

                        $delete_user_id = $_GET['delete']; 
						$tabl='registrations'; $whered="uid ='$delete_user_id'";
						$dell=lifetech_db_delete($tabl,$whered);
						  if ($dell['response']='success'){
						     echo "<script>alert('deleted')</script>"; 
                                                     echo "<script language ='javascript'> window.location.href='?'; </script>"; 
						   }else{
						     $del=$dell['results'];   echo "<script>alert($del)</script>";
						   }
                      }
                 ?>

			