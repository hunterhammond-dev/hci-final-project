<?php include("config.php");
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr"
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Most Recent</title>
<link rel = "stylesheet" type = "text/css" href = "/layouts/style.css">
</head>

<body>
    	
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
            <tr>
                <th>&nbsp;</th>
				<th>Charcter Name</th>
            </tr>
            <?php while ($r = $q->fetch()): ?>
                <tr>
					<td><?php echo '<img src="' .$r['file_path'] .'" alt="' .$r['character_name'].'"' ?></td>
                    <td><?php echo $r['character_name'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
	
	
	</div>        
</body>
</html>