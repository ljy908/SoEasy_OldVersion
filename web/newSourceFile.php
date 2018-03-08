<?php
	$fileName = $_GET['newFile'];

	$fp = fopen("$fileName", "w");

	fclose($fp);
	echo "<meta http-equiv = 'Refresh' content=5; URL=test.php'>";
?>
