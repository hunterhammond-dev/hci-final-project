<?php include("config.php");
session_start();?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A Basic HTML5 Template</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav id="header" class="bg-white fixed w-full z-10 top-0 shadow">


        <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

            <div class="w-1/2 pl-2 md:pl-0">
                <a class="text-gray-900 text-base xl:text-xl no-underline hover:no-underline font-bold" href="#">
                    HCI Final Project
                </a>
            </div>
            <div class="w-1/2 pr-0">
                <div class="flex relative inline-block float-right">

                    <div class="relative text-sm">
                        <button id="userButton" class="flex items-center focus:outline-none mr-3">
                            <img class="w-8 h-8 rounded-full mr-4" src="http://i.pravatar.cc/300" alt="Avatar of User">
                            <span class="hidden md:inline-block">Hi, User</span>
                            <svg class="pl-2 h-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"
                                xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                <g>
                                    <path
                                        d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                                </g>
                            </svg>
                        </button>
                        <div id="userMenu"
                            class="bg-white rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                            <ul class="list-reset">
                                <li><a href="#"
                                        class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">My
                                        account</a></li>
                                <li><a href="#"
                                        class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">Notifications</a>
                                </li>
                                <li>
                                    <hr class="border-t mx-2 border-gray-400">
                                </li>
                                <li><a href="#"
                                        class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">Logout</a>
                                </li>
                            </ul>
                        </div>
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
                            <i class="fa fa-envelope fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Browse</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="myCollection.html"
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-green-500">
                            <i class="fa fa-envelope fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">My Collection</span>
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
    <div class="container w-full mx-auto pt-20">
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
               	<input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="retail_price" name="retail_price">
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

    <footer class="bg-white border-t border-gray-400 shadow">
        <div class="container max-w-md mx-auto flex py-8">

            <div class="w-full mx-auto flex flex-wrap">
                <div class="flex w-full md:w-1/2 ">
                    <div class="px-8">
                        <h3 class="font-bold font-bold text-gray-900">About</h3>
                        <p class="py-4 text-gray-600 text-sm">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus
                            commodo nec id erat. Suspendisse consectetur dapibus velit ut lacinia.
                        </p>
                    </div>
                </div>

                <div class="flex w-full md:w-1/2">
                    <div class="px-8">
                        <h3 class="font-bold font-bold text-gray-900">Social</h3>
                        <ul class="list-reset items-center text-sm pt-3">
                            <li>
                                <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:underline py-1"
                                    href="#">Add social link</a>
                            </li>
                            <li>
                                <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:underline py-1"
                                    href="#">Add social link</a>
                            </li>
                            <li>
                                <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:underline py-1"
                                    href="#">Add social link</a>
                            </li>
                        </ul>
                    </div>
                </div>
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
    </script>

</body>

</html>