<?php include("config.php");
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr"
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Find Figure</title>
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
			<form action="search.php" method="GET">
				<input type="text" placeholder="Search.."id="search" name="search">
				<input type="submit" value="SEARCH">
			</form>
		</div>
		<div class="result">
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
        <form action="search.php" method="GET">
			<table id="Table1" border=???1 | 0???>
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Toy ID</th>
						<th>Character Name</th>
						<th>Manufacturer</th>
						<th>Product Line</th>
						<th>Series</th>
						<th>UPC</th>
						<th>DPCI</th>
						<th>Release Date</th>
					</tr>
				</thead>
				
						<?php 
							$i = 0;
							while ($r = $sql->fetch()): ?>
							<tr>
								<td>
									<?php echo '<input type="checkbox" name="toy[]" value="'.$i.'" id="toy">'?>
								</td>
								<td style="text-align:center"><?php echo $r['toy_id'] ?></td>
								<td name="char" ><?php echo $r['character_name'] ?></td>
								<td><?php echo $r['company_name'] ?></td>
								<td><?php echo $r['line_name'] ?></td>
								<td><?php echo $r['series_name'] ?></td>
								<td><?php echo $r['upc'] ?></td>
								<td><?php echo $r['dpci'] ?></td>
								<td><?php echo $r['release_date'] ?></td>
							</tr>
						<?php 
							$i++;
						endwhile; ?>
						
				
			</table>
			<br>
			<input type="submit" value="Add Selected to Collection">
			<?php echo '<input type="text" value="'.$_GET['toy']['char'].'"/>' ?>
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