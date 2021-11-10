<?php include("config.php");
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr"
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add New User</title>
<link rel = "stylesheet" type = "text/css" href = "/layouts/style.css">
</head>
<body>
    	
	<div class="main">
		<h2>Enter Information to Create a New Account:</h2>
    
	
        <form action="addUser.php" method="POST">
			<div style="float:left; position:relative; margin-right:40px">	
				<label for="username"><b>Username:</b></label><br><br>
				<label for="password"><b>Password:</b></label><br><br><br>
				<label for="fname"><b>First Name:</b></label><br><br>
				<label for="lname"><b>Last Name:</b></label><br><br>
				<label for="email"><b>E-mail:</b></label><br><br>				
			</div>
            
            <div style="float:center; margin-left:40px"> 
           		<input type="text" id="username" name="username" value="" required><a> <i>*required</i></a> <br><br>
				<input type="password" id="password" name="password" required><a> <i>*required</i></a><br><br><br>
               	<input type="text" id="fname" name="fname" required><a> <i>*required</i></a><br><br>
               	<input type="text" id="lname" name="lname" required><a> <i>*required</i></a><br><br>
               	<input type="text" id="email" name="email" required><a> <i>*required</i></a><br><br>
               	<input type="submit" value="Create Account">
			</div>
		</form>
	</div>
	
		
		<?php
		if(isset($_POST['fname'])) {
			$fname = $_POST['fname'];
		} else {
			$fname = '';
		}
		if(isset($_POST['lname'])) {
			$lname = $_POST['lname'];
		} else {
			$lname = '';
		}
		if(isset($_POST['email'])) {
			$email = $_POST['email'];
		} else {
			$email = '';
		}
		if(isset($_POST['username'])) {
			$username = $_POST['username'];
		} else {
			$username = '';
		}
		if(isset($_POST['password'])) {
			$password = $_POST['password'];
		} else {
			$password = '';
		}
		if($fname != '' AND $lname != '' AND $email != '' AND $username != '' AND $password != '') {
        try {

			
            // execute the stored procedure
            $sql = $pdo->prepare('CALL af_db.proc_new_user(?,?,?,?,?)');
            // call the stored procedure
            $sql->bindParam(1, $fname, PDO::PARAM_STR, 100);
			$sql->bindParam(2, $lname, PDO::PARAM_STR, 100);
			$sql->bindParam(3, $email, PDO::PARAM_STR, 120);
			$sql->bindParam(4, $username, PDO::PARAM_STR, 50);
			$sql->bindParam(5, $password, PDO::PARAM_STR, 30);

			// call the stored procedure
			$sql->execute();
			$sql->closeCursor();
			
			
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
		
		try {
			$sql_check = $pdo->prepare('SELECT af_db.fnc_validate_user(?)');
			
			$sql_check->bindParam(1, $username, PDO::PARAM_STR, 120);
			
			$sql_check->execute();
			$result = $sql_check->fetch();			
		
			if($result[0] == 1) {
				echo 'New Account Created Successfully';
			} else {
				echo 'Account not created';
			}
			
			$sql_check->closeCursor();
		} catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }

		} else {
			#DO NOTHING UNTIL FIELDS ARE COMPLETED
		}
		?>
		</div>
	
	
	</div>        
</body>
</html>