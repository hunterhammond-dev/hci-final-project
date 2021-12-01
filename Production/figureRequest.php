<?php include("config.php");
session_start();?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Figure Request | Figbase</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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

<body class="bg-gray-100 font-sans leading-normal tracking-normal relative min-h-screen">

    <nav id="header" class="bg-white fixed w-full z-10 top-0 shadow">


        <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

            <div class="w-1/2 pl-2 md:pl-0 flex">
				<img class="w-16 h-16" src="img/logo.svg" alt="Figbase Logo" />
                <a class="mt-4 ml-2 text-gray-900 text-base text-2xl no-underline hover:no-underline font-bold" href="#">
                    Figbase
                </a>
            </div>
            <div class="w-1/2 pr-0">
                <div class="flex relative inline-block float-right">

                    <div class="relative text-sm">
                        <?php
						
						if(is_null($_SESSION['logged_in_user_name']))
						{
							echo '<a href="login.php"><button class="bg-gray-100 cursor-pointer text-center text-sm text-gray-800 border-2 border-orange-600 hover:border-green-600 rounded py-2 px-6 appearance-none leading-normal">Login</button></a>';
						}
						else {
							if(file_exists("img/profile" . $_SESSION['logged_in_user_name'] . "jpg")) {
								imagepng(imagecreatefromstring(file_get_contents("img/profile" . $_SESSION['logged_in_user_name'] . "jpg")), $_SESSION['logged_in_user_name'] . ".png");
							}
							echo '<img class="w-8 h-8 rounded-full mr-4" src="img/profile/'.$_SESSION['logged_in_user_name'].'.png" />';
							echo '<p class="hidden md:inline-block">Hi, '.$_SESSION['logged_in_user_name'].'</p>';
						}
						?>
						</div>

                    <div class="block lg:hidden pr-4">
                        <button id="nav-toggle"
                            class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-teal-500 appearance-none focus:outline-none">
                            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Menu</title>
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>


            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-white z-20"
                id="nav-content">
                <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                    <li class="mr-6 my-2 md:my-0">
                        <a href="index.php"
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-green-500">
                            <i class="fas fa-chart-area fa-fw mr-3"></i><span
                                class="pb-1 md:pb-0 text-sm">Browse</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="myCollection.php"
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-green-500">
                            <i class="fas fa-chart-area fa-fw mr-3"></i><span
                                class="pb-1 md:pb-0 text-sm">My Collection</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="figureRequest.php"
                            class="block py-1 md:py-3 pl-1 align-middle text-green-600 no-underline hover:text-gray-900 border-b-2 border-orange-600 hover:border-green-600">
                            <i class="fas fa-home fa-fw mr-3 text-green-600"></i><span
                                class="pb-1 md:pb-0 text-sm">Figure Request</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <!--Container-->
    <div class="container w-full mx-auto pt-20 mt-8">
        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
            <!--Console Content-->
            <div class="flex">
                <div class="w-full mx-4 bg-white text-center text-4xl rounded shadow">
                    <h1 class="py-4">Welcome, User!</h1>
                </div>
            </div>
			
			<div class="flex mt-4">
			<div class="w-full mx-4 bg-white text-center rounded shadow">
	
	<?php 
	#Prepared Statements mySQL
		$sql_companies = $db->prepare('SELECT company_id, company_name, website, retailer, manufacturer FROM af_db.af_companies WHERE manufacturer = 1');
		
		$sql_companies->execute();
		$sql_companies->store_result();
		$sql_companies->bind_result($company_id, $company_name, $website, $retailer, $manufacturer);
		
		$sql_productLines = $db->prepare('SELECT productLine_id, company_id, line_name FROM af_db.af_product_lines');
		
		$sql_productLines->execute();
		$sql_productLines->store_result() &&
		$sql_productLines->bind_result($productLineID, $productLineCompanyID, $lineName);
		
		$sql_series = $db->prepare('SELECT series_id, series_name, productLine_id FROM af_db.af_series');
		
		$sql_series->execute();
		$sql_series->store_result() &&
		$sql_series->bind_result($seriesID, $seriesName, $lineID);
		
		$sql_scale = $db->prepare('SELECT scale FROM af_db.af_scale;');
		
		$sql_scale->execute();
		$sql_scale->store_result() &&
		$sql_scale->bind_result($scale);

		
	?>

	<div>
	<h2 class="text-2xl my-2">Enter new Action Figure information below:</h2>
    
	
        <form action="addFigure.php" method="POST">
            <div class="w-3/4 mx-auto flex flex-wrap"> 
				<label for="name">Character Name:</label>
           		<input class="w-full my-2 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="name" name="name">
				<label for="manufacturer">Manufacturer:</label>
				<select class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" name="manufacturer" id="manufacturer">
					<?php while($sql_companies->fetch()) {?>
						<option><?php echo $company_name ?></option>
					<?php } ?>
				</select>
				<label for="product_line">Product Line:</label>
				<select class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" name="productLine" id="productLine">
					<?php while($sql_productLines->fetch()) {?>
						<option><?php echo $lineName ?></option>
					<?php } ?>
				</select>
				<label for="series">Series:</label>
				<select class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" name="series" id="series">
					<?php while($sql_series->fetch()) {?>
						<option><?php echo $seriesName ?></option>
					<?php } ?>
				</select>
				<label for="scale">Scale:</label>
				<select class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" name="scale" id="scale">
					<?php while($sql_scale->fetch()) {?>
						<option><?php echo '1:'.$scale ?></option>
					<?php } ?>
				</select>
				<label for="retail_price">Retail Price:</label>
               	<input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="number" min="0.01" step="0.01" id="retail_price" name="retail_price" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="$19.99">
				<label for="upc">UPC:</label>
               	<input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="upc" name="upc">
				<label for="release_date">Release Date:</label>
               	<input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="release_date" name="release_date">
               	<input class="mx-auto my-6 bg-gray-100 cursor-pointer text-center text-sm text-gray-800 border-2 border-orange-600 hover:border-green-600 rounded py-2 px-6 appearance-none leading-normal" type="submit" value="Add to System">
			</div>
		</form>
	</div>
	
	<div style="float:right; position:relative; margin-right:50%">
     </div>
	 <div>
		<?php


			
			try {	
				if(!empty($_POST)){
					if(isset($_POST['name'])) {
						$name = $_POST['name'];
					} else {
						$name = 'google';
					}
					if(isset($_POST['retail_price'])) {
						$price = $_POST['retail_price'];
					} else {
						$price = '';
					}
					if(isset($_POST['upc'])) {
						$upc = $_POST['upc'];
					} else {
						$upc = '';
					}
					if(isset($_POST['release_date'])) {
						$date = $_POST['release_date'];
					} else {
						$date = '';
					}
					if(isset($_POST['series'])) {
						$series = $_POST['series'];
					} else {
						$series = '';
					}			
					
					// execute the stored procedure
					$sql_add = $pdo->prepare('CALL af_db.proc_add_figure(?,?,?,?,?,?)');
					// bind parameters to prepared statement
					$sql_add->bindParam(1, $_POST['name'], PDO::PARAM_STR, 100);
					$sql_add->bindParam(2, $_POST['series'], PDO::PARAM_STR, 150);
					$sql_add->bindParam(3, $scale, PDO::PARAM_INT, 3);
					$sql_add->bindParam(4, $_POST['upc'], PDO::PARAM_STR, 20);
					$sql_add->bindParam(5, $_POST['retail_price'], PDO::PARAM_STR, 20);
					$sql_add->bindParam(6, $_POST['release_date'], PDO::PARAM_STR, 10);

					// call the stored procedure
					$sql_add->execute();
					$sql_add->closeCursor();
				}
			
			
			} catch (PDOException $e) {
				die("Error occurred:" . $e->getMessage());
			}
		
		/**
            // execute the stored procedure
            $sql_find = 'CALL proc_find_figure(?)';
			// bind parameters to prepared statement
			$sql_find->bindParam(1, $upc, PDO::PARAM_STR, 100);
            // call the stored procedure
            $sql_find->execute();
            $sql_find->store_result();

        **/
		?>
	 </div>
</div> 
</div>
            
            <!--/ Console Content-->
        </div>
    </div>
    <!--/container-->

    <footer class="w-full bg-white border-t border-gray-400">
        <div class="mx-auto flex py-8 pb-12">
            <div class="w-full mx-auto text-center">
                <h3 class="font-bold text-gray-900 text-center">!&copy; Figbase</h3>
            </div>
        </div>
    </footer>

    <script>
        var userMenuDiv = document.getElementById("userMenu");
        var userMenu = document.getElementById("userButton");

        var navMenuDiv = document.getElementById("nav-content");
        var navMenu = document.getElementById("nav-toggle");

        document.onclick = check;

        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);

            //User Menu
            if (!checkParent(target, userMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, userMenu)) {
                    // click on the link
                    if (userMenuDiv.classList.contains("invisible")) {
                        userMenuDiv.classList.remove("invisible");
                    } else { userMenuDiv.classList.add("invisible"); }
                } else {
                    // click both outside link and outside menu, hide menu
                    userMenuDiv.classList.add("invisible");
                }
            }

            //Nav Menu
            if (!checkParent(target, navMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, navMenu)) {
                    // click on the link
                    if (navMenuDiv.classList.contains("hidden")) {
                        navMenuDiv.classList.remove("hidden");
                    } else { navMenuDiv.classList.add("hidden"); }
                } else {
                    // click both outside link and outside menu, hide menu
                    navMenuDiv.classList.add("hidden");
                }
            }

        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) { return true; }
                t = t.parentNode;
            }
            return false;
        }
		
		// Jquery Dependency

$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "$" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "$" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

    </script>

</body>

</html>