<?php include("config.php");
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr"
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Search Collection</title>
<link rel = "stylesheet" type = "text/css" href = "/layouts/style.css">
</head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        //Assign Click event to Button.
        $("#btnGet").click(function () {
            var message;
 
            //Loop through all checked CheckBoxes in GridView.
            $("#Table1 input[type=checkbox]:checked").each(function () {
                var row = $(this).closest("tr")[0];
                message += row.cells[1].innerHTML;
                //message += "   " + row.cells[2].innerHTML;
                //message += "   " + row.cells[3].innerHTML;
                message += "\n";
            });
 
            //Display selected Row data in Alert Box.
            alert(message);
            return message;
        });
    });
</script>



<body>
    	
	<div class="main">
		<div class="search">
			<form action="searchCollection.php" method="GET">
				<input type="text" placeholder="Search.."id="search" name="search">
				<input type="submit" value="SEARCH">
			</form>
		</div>
		<div class="result">
		<?php
        try {
			if(isset($_GET['search'])) {
				$query = $_GET['search'];
			} else if ($_SESSION['logged_in_user_name'] != '') {
				$query = $_SESSION['logged_in_user_name'];
			} else {
				$query = '';
			}
			
			#DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE
            // execute the stored procedure
            $sql = $pdo->prepare('CALL af_db.proc_find_figure_collection(?)');
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
        <form action="searchCollection.php" method="GET">
			<table id="Table1" border=”1 | 0”>
				<thead>
					<tr>
						<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">&nbsp;</th>
						<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Toy ID</th>
						<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Character Name</th>
						<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manufacturer</th>
						<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Line</th>
						<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Series</th>
						<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UPC</th>
						<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purchase Price</th>
						<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purchase Date</th>
						<th scope="col"
						class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Status</th>
					</tr>
				</thead>
				
					
						<?php while ($r = $sql->fetch()): ?>
							<tr>
								<td>
									<input type="checkbox" name="toy" id="toy">
								</td>
								<td class="text-sm text-gray-900 p-2"><?php echo $r['toy_id'] ?></td>
								<td class="text-sm text-gray-900 p-2"><?php echo $r['character_name'] ?></td>
								<td class="text-sm text-gray-900 p-2"><?php echo $r['company_name'] ?></td>
								<td class="text-sm text-gray-900 p-2"><?php echo $r['line_name'] ?></td>
								<td class="text-sm text-gray-900 p-2"><?php echo $r['series_name'] ?></td>
								<td class="text-sm text-gray-900 p-2"><?php echo $r['upc'] ?></td>
								<td class="text-sm text-gray-900 p-2"><?php echo $r['purchase_price'] ?></td>
								<td class="text-sm text-gray-900 p-2"><?php echo $r['purchase_date'] ?></td>
								<td class="text-sm text-gray-900 p-2"><?php echo $r['item_status'] ?></td>
							</tr>
						<?php endwhile; ?>
						
				
			</table>
			<br>
			<input id = "btnGet" type="submit" value="Remove Selected From Collection">
		</form>
		
		
		<?php
		} else {
			echo 'NO RESULTS FOUND';
		}
		} else {
			#Do nothing if no search has been submitted
		}
		?>
		</div>
	
	
	</div>        
</body>
</html>