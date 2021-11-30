<?php include("config.php");
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr"
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel = "stylesheet" type = "text/css" href = "/layouts/style.css">
</head>
<body>
    	
	<div class="main">
		<div class="login">
			<form action="login.php" method="GET">
				<label for="username"><b>Username</b></label><br>
				<input type="text" placeholder="Username"id="username" name="username"><br><br>
				<label for="password"><b>Password</b></label><br>
				<input type="password" placeholder="Password"id="password" name="password">
				<input type="submit" value="Login">
			</form>
		</div>
		<div class="result">
		<?php
        try {
			if(!empty($_GET)){
			
				#DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE
				// execute the stored procedure
				$sql_login = $pdo->prepare('SELECT af_db.fnc_log_in(?,?)');
				// call the stored procedure
				$sql_login->bindParam(1, $_GET['username'], PDO::PARAM_STR, 50);
				$sql_login->bindParam(2, $_GET['password'], PDO::PARAM_STR, 20);

				// call the stored procedure
				$sql_login->execute();
				#$sql_login->store_result();
				#$sql_login->bind_result($result);
				
				echo $sql_login->num_rows;
				
				while($sql_login->fetch()){
					echo $result;
				}
				
				if($result = 1) {
					echo 'Login Successful';
				} else {
					echo 'Login FAILED';
				}
			}
			
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
		
		<?php
		/**
		if(!empty($_GET)) {
			if($sql_login->rowCount() > 0) {?>
				<?php while ($r = $sql->fetch()):
					echo $r['result']
				endwhile;
			} else {
				echo 'NO RESULTS FOUND';
			}
		} else {
			#Do nothing if no search has been submitted
		}**/
		?>
		</div>	
	</div>        
</body>
</html>