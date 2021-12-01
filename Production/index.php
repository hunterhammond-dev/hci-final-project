<?php include("config.php");
session_start();?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse | Figbase</title>
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
                            class="block py-1 md:py-3 pl-1 align-middle text-green-600 no-underline hover:text-gray-900 border-b-2 border-orange-600 hover:border-green-600">
                            <i class="fas fa-home fa-fw mr-3 text-green-600"></i><span
                                class="pb-1 md:pb-0 text-sm">Browse</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="myCollection.php"
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-green-500">
                            <i class="fa fa-envelope fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">My Collection</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="figureRequest.php"
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-green-500">
                            <i class="fas fa-chart-area fa-fw mr-3"></i><span
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
                    <h1 class="py-4">
					<?php
						
						if(is_null($_SESSION['logged_in_user_name']))
						{
							echo 'Welcome!';
						}
						else {
							echo 'Welcome, ' . $_SESSION['logged_in_user_name'] . '!';
						}
						?>
					</h1>
                </div>
            </div>
            <div class="flex">
                <div class="w-full mx-4 bg-white rounded shadow mt-4">
                    <div class="relative py-2 px-4 ">
                        <div class="search w-1/2 mx-auto">
			<form action="index.php" method="GET">
				<input class="w-3/4 border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" placeholder="Search.."id="search" name="search">
				<input type="submit" value="Search" class="bg-gray-100 cursor-pointer text-center text-sm text-gray-800 border-2 border-orange-600 hover:border-green-600 rounded py-2 px-6 appearance-none leading-normal">
			</form>
		</div>
                    </div>
                </div>
            </div>
			
			<div class="hidden md:block result w-full">
		<?php
        try {
			if(isset($_GET['search'])) {
				$query = $_GET['search'];
			} else {
				$query = '';
			}
			
			#DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE
            // execute the stored procedure
            $sql = $pdo->prepare('CALL af_db.proc_find_figure(?)');
            // call the stored procedure
            $sql->bindParam(1, $query, PDO::PARAM_STR, 150);
			#$sql->bindParam(2, $upc, PDO::PARAM_INT);
			#$sql->bindParam(3, $dcpi, PDO::PARAM_INT);

			// call the stored procedure
			$sql->execute();
			
			
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
		
		<?php
		if($query != '') {
		if($sql->rowCount() > 0) { ?>
        <table class="w-full">
			<thead>
				<tr>
					<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						&nbsp;
					</th>
					<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Character Name
					</th>
					<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Manufacturer
					</th>
					<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Product Line
					</th>
					<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Series
					</th>
					<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						UPC
					</th>
					<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Release Date
					</th>
				</tr>
			</thead>
			<tbody class="bg-white shadow">
            <?php while ($r = $sql->fetch()): ?>
                <tr class="">
					<div class="">
						<td class="text-sm text-gray-900 p-2"><?php echo '<input type="checkbox" id="toy">'?></td>
						<td class="text-sm text-gray-900 p-2"><?php echo $r['character_name'] ?></td>
						<td class="text-sm text-gray-900 p-2"><?php echo $r['company_name'] ?></td>
						<td class="text-sm text-gray-900 p-2"><?php echo $r['line_name'] ?></td>
						<td class="text-sm text-gray-900 p-2"><?php echo $r['series_name'] ?></td>
						<td class="text-sm text-gray-900 p-2"><?php echo $r['upc'] ?></td>
						<td class="text-sm text-gray-900 p-2"><?php echo $r['release_date'] ?></td>
					</div>
                </tr>
            <?php endwhile; ?>
			</tbody>
        </table>
		
		<?php
		} else {
			echo 'NO RESULTS FOUND';
		}
		} else {
			#Do nothing if no search has been submitted
		}
		?>
		</div>
		
		<div class="block md:hidden">
		<?php
        try {
			if(isset($_GET['search'])) {
				$query = $_GET['search'];
			} else {
				$query = '';
			}
			
			#DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE
            // execute the stored procedure
            $sql = $pdo->prepare('CALL af_db.proc_find_figure(?)');
            // call the stored procedure
            $sql->bindParam(1, $query, PDO::PARAM_STR, 150);
			#$sql->bindParam(2, $upc, PDO::PARAM_INT);
			#$sql->bindParam(3, $dcpi, PDO::PARAM_INT);

			// call the stored procedure
			$sql->execute();
			
			
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
		
		<?php
		if($query != '') {
		if($sql->rowCount() > 0) { ?>
		<?php while ($r = $sql->fetch()): ?>
			<div class="w-full flex flex-wrap">
			<div class="w-1/2 shadow rounded bg-white text-center">
				<p><?php echo $r['toy_id'] ?></p>
				<p><?php echo $r['character_name'] ?></p>
				<p><?php echo $r['company_name'] ?></p>
				<p><?php echo $r['line_name'] ?></p>
				<p><?php echo $r['series_name'] ?></p>
				<p><?php echo $r['upc'] ?></p>
				<p><?php echo $r['release_date'] ?></p>
			</div>
			</div>
		<?php endwhile; ?>
		<?php
		} else {
			echo 'NO RESULTS FOUND';
		}
		} else {
			#Do nothing if no search has been submitted
		}
		?>
		</div>
		<div class="w-full text-center">
		<?php 
		if(isset($_GET['search'])) {
			echo '<input class="bg-gray-100 mt-4 cursor-pointer text-center text-sm text-gray-800 border-2 border-orange-600 hover:border-green-600 rounded py-2 px-6 appearance-none leading-normal" type="submit" value="Add Selected to Collection">';
		}
		?>
		</div>
			
            <!--Divider-->
            <hr class="border-b-2 border-gray-400 my-8 mx-4">
            <div class="flex">
                <div class="w-full mx-4 flex">
                    <div class="w-1/2 mr-2 bg-white text-center text-2xl rounded shadow">
                        <h2 class="py-4">Collection Quick Navigation</h1>
                    </div>
                    <div class="w-1/2 ml-2 bg-white text-center text-2xl rounded shadow">
                        <h1 class="py-4">Most Recently Added</h1>
						<div class="main">
							<?php
							try {
								// execute the stored procedure
								$sql = 'CALL af_db.proc_most_recent_figure()';
								// call the stored procedure
								$q = $pdo->query($sql);
								$q->setFetchMode(PDO::FETCH_ASSOC);
							} catch (PDOException $e) {
								die("Error occurred:" . $e->getMessage());
							}
							?>
							<table>
								<?php while ($r = $q->fetch()): ?>
									<tr>
										<div class="w-4/5 mx-auto flex py-3">
											<div class="w-1/4">
												<?php echo '<img class="w-20 mx-auto" src="' .$r['file_path'] .'" alt="' .$r['character_name'].'" />' ?>
											</div>
											<div class="w-3/4 my-auto">
												<div class="text-base font-light italic">
													<?php 
														echo '<p>Added On: '.$r['date_added'].'</p>'; 
													?>
												</div>
												<div class="text-xl">
													<?php echo $r['character_name'] ?>
												</div>
												<div class="text-base font-light">
													<?php 
														echo $r['company_name'];
														echo '<br>';
														echo $r['line_name'];
														echo '<br>';
														echo $r['series_name'];
													?>
												</div>
											</div>
										</div>
									</tr>
								<?php endwhile; ?>
							</table>
						</div> 	     
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
    </script>

</body>

</html>