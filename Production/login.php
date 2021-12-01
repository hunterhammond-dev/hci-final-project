<?php include("config.php");
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr"
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel = "stylesheet" type = "text/css" href = "/layouts/style.css">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    	
	<div style="margin-top:20%" class="main w-1/2 mx-auto bg-white shadow rounded text-center py-10">
		<div class="mx-auto flex">
			<img class="w-40 h-40 mx-auto" src="img/logo.svg" />
		</div>
	 <h1 class="text-3xl mt-2">Login</h1>
		<div class="login mt-2">
			<form action="index.php" method="POST">
				<label for="username"><b>Username</b></label><br>
				<input class="w-1/2 my-2 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" placeholder="Username"id="username" name="username"><br>
				<label for="password"><b>Password</b></label><br>
				<input class="w-1/2 my-2 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="password" placeholder="Password"id="password" name="password"><br>
				<input class="mx-auto my-6 bg-gray-100 cursor-pointer text-center text-sm text-gray-800 border-2 border-orange-600 hover:border-green-600 rounded py-2 px-6 appearance-none leading-normal" type="submit" value="Login">
			</form>
		</div>
		<div class="goto">
			<form action="addUser.php" method="GET">
				<input class="mx-auto bg-gray-100 cursor-pointer text-center text-sm text-gray-800 border-2 border-orange-600 hover:border-green-600 rounded py-2 px-6 appearance-none leading-normal" type="submit" value="Sign Up">
			</form>
		</div>
		<div class="result">
		<?php
        try {
			if(!empty($_POST)){
			
				#DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE
				// execute the stored procedure
				$sql_login = $pdo->prepare('SELECT af_db.fnc_log_in(?,?)');
				// call the stored procedure
				$sql_login->bindParam(1, $_POST['username'], PDO::PARAM_STR, 50);
				$sql_login->bindParam(2, $_POST['password'], PDO::PARAM_STR, 20);

				// call the stored procedure
				$sql_login->execute();
				#$sql_login->store_result();
				#$sql_login->bind_result($result);
				
				#$results = $sql_login->rowCount();
				
				while ($r = $sql_login->fetch()):

					if($r[0] == 1) {
						echo 'Login Successful';
						$_SESSION['logged_in_user_name'] = $_POST['username'];
						
					} else {
						echo 'Login FAILED';
						$_SESSION['logged_in_user_name'] = '';
					}
				endwhile;
			}
			
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
		#echo 'Session username stored';
		#echo $_SESSION['logged_in_user_name'];
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