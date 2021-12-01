<?php include("config.php");
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr"
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add New User</title>
<link rel = "stylesheet" type = "text/css" href = "/layouts/style.css">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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

	<div class="SQL">
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
		if(isset($_POST['password2'])) {
			$password2 = $_POST['password2'];
		} else {
			$password2 = '';
		}
		if(isset($_FILES['image'])){
			$errors= array();
			$file_name = $_FILES['image']['name'];
			$file_size =$_FILES['image']['size'];
			$file_tmp =$_FILES['image']['tmp_name'];
			$file_type=$_FILES['image']['type'];
		  
			$tmp = explode('.',$_FILES['image']['name']);
			$file_ext=strtolower(end($tmp));
			$sqlFile = 'img/profile/'.$username .'.' .$file_ext;		  

		  
		  $extensions= array("jpeg","jpg","png");
		  
		  if(in_array($file_ext,$extensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  }
		  
		  if($file_size > 2097152){
			 $errors[]='File size must be excately 2 MB';
		  }
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp, $sqlFile);
			 
			 #echo "Success";
		  }else{
			 print_r($errors);
		  }
		} else {
			$sqlFile = '';
		}
		
		#echo 'File variable is: ' ;
		#echo $sqlFile;
			 
		
		if($fname != '' AND $lname != '' AND $email != '' AND $username != '' AND $password != '' AND $password2 != '') {
			if($password == $password2) {
        try {

			
            // execute the stored procedure
            $sql = $pdo->prepare('CALL af_db.proc_new_user(?,?,?,?,?,?)');
            // call the stored procedure
            $sql->bindParam(1, $fname, PDO::PARAM_STR, 100);
			$sql->bindParam(2, $lname, PDO::PARAM_STR, 100);
			$sql->bindParam(3, $email, PDO::PARAM_STR, 120);
			$sql->bindParam(4, $username, PDO::PARAM_STR, 50);
			$sql->bindParam(5, $password, PDO::PARAM_STR, 30);
			$sql->bindParam(6, $sqlFile, PDO::PARAM_STR, 200);

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
			}else {
				echo 'PASSWORDS DO NOT MATCH';
			}

		} else {
			#DO NOTHING UNTIL FIELDS ARE COMPLETED
		}
		?>

	</div>


<body class="bg-gray-100 font-sans leading-normal tracking-normal">	
	<div style="margin-top:20%" class="main w-1/2 mx-auto bg-white shadow rounded text-center py-10">
	<div class="mx-auto flex">
			<img class="w-40 h-40 mx-auto" src="img/logo.svg" />
		</div>
		<h2 class="text-3xl mt-2">Sign Up</h2>
		<div class="mt-2">
        <form action="myCollection.php" method="POST" enctype="multipart/form-data">
            <div style="float:center; margin-left:40px">
				<label for="username"><b>Username:</b></label><br>
           		<input class="w-1/2 my-2 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="username" name="username" value="" required><a></a><br>
				<label for="password"><b>Password:</b></label><br>
				<input class="w-1/2 my-2 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="password" id="password" name="password" required placeholder="Enter Password"><a></a><br>
				<input class="w-1/2 my-2 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="password" id="password2" name="password2" required placeholder="passwords must match"><a></a><br>
				<label for="fname"><b>First Name:</b></label><br>
               	<input class="w-1/2 my-2 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="fname" name="fname" required><a></a><br>
				<label for="lname"><b>Last Name:</b></label><br>
               	<input class="w-1/2 my-2 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="lname" name="lname" required><a></a><br>
				<label for="email"><b>E-mail:</b></label><br>
               	<input class="w-1/2 my-2 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="email" name="email" required><a></a><br>
				<label for="image"><b>Upload Profile Picture:</b></label><br>
				<input class="hidden w-1/2 my-2 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="file" name="image" /><br>
               	<input class="mx-auto my-6 bg-gray-100 cursor-pointer text-center text-sm text-gray-800 border-2 border-orange-600 hover:border-green-600 rounded py-2 px-6 appearance-none leading-normal" type="submit" value="Create Account">
			</div>
			<?php $_SESSION['logged_in_user_name'] = $_POST['username'];?>
		</form>
		</div>
	</div>
</body>
</html>