<?php include("config.php");
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr"
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add Figure</title>
<link rel = "stylesheet" type = "text/css" href = "/layouts/style.css">
</head>
<body>
	<!--<?php include('layouts/nav.html') ?>-->
    	
	<div class="main">
	
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

	<div style="float:left; position:relative">
	<h2>Enter new Action Figure information below:</h2>
    
	
        <form action="addFigure.php" method="POST">
			<div style="float:left; position:relative; margin-right:40px">	
				<label for="name"><b>Character Name:</b></label><br><br>
				<label for="manufacturer"><b>Manufacturer:</b></label><br><br>
				<label for="product_line"><b>Product Line:</b></label><br><br>
				<label for="series"><b>Series:</b></label><br><br>
				<label for="scale"><b>Scale:</b></label><br><br>
				<label for="retail_price"><b>Retail Price:</b></label><br><br>
				<label for="upc"><b>UPC:</b></label><br><br>
				<label for="release_date"><b>Release Date:</b></label><br><br>
			</div>
            
            <div> 
           		<input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="name" name="name"><br><br>
				<select name="manufacturer" id="manufacturer">
					<?php while($sql_companies->fetch()) {?>
						<option><?php echo $company_name ?></option>
					<?php } ?>
				</select><br><br>
				<select name="productLine" id="productLine">
					<?php while($sql_productLines->fetch()) {?>
						<option><?php echo $lineName ?></option>
					<?php } ?>
				</select><br><br>
				<select name="series" id="series">
					<?php while($sql_series->fetch()) {?>
						<option><?php echo $seriesName ?></option>
					<?php } ?>
				</select><br><br>
				<select name="scale" id="scale">
					<?php while($sql_scale->fetch()) {?>
						<option><?php echo '1:'.$scale ?></option>
					<?php } ?>
				</select><br><br>
               	<input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="retail_price" name="retail_price"><br><br>
               	<input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="upc" name="upc"><br><br>
               	<input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" id="release_date" name="release_date"><br><br>
               	<input class="bg-gray-100 cursor-pointer text-center text-sm text-gray-800 border-2 border-orange-600 hover:border-green-600 rounded py-2 px-6 appearance-none leading-normal" type="submit" value="Add to System">
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
</body>
</html>