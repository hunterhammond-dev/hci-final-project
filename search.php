<?php include("config.php");
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr"
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Find Figure</title>
<link rel = "stylesheet" type = "text/css" href = "/layouts/style.css">
</head>
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
        <table border=”1 | 0”>
            <tr>
				<th>Toy ID</th>
                <th>Character Name</th>
				<th>Manufacturer</th>
				<th>Product Line</th>
				<th>Series</th>
				<th>UPC</th>
				<th>DPCI</th>				
            </tr>
            <?php while ($r = $sql->fetch()): ?>
                <tr>
                    <td><?php echo $r['toy_id'] ?></td>
					<td><?php echo $r['character_name'] ?></td>
					<td><?php echo $r['company_name'] ?></td>
					<td><?php echo $r['line_name'] ?></td>
					<td><?php echo $r['series_name'] ?></td>
					<td><?php echo $r['upc'] ?></td>
					<td><?php echo $r['dpci'] ?></td>
                </tr>
            <?php endwhile; ?>
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
	
	
	</div>        
</body>
</html>