<?php

/****************** GroupControl �߰��ϱ� ���� ������ ********************/

	$name			= $_POST['name'];
	$initValue		= $_POST['initValue'];

	$fp				= "/var/www/project_os/DB/web_variable/";
	$fp			   .= $name;
	$fp				= fopen($fp, "w+");

	$test			= fwrite($fp , $initValue);

	fclose($fp);

	echo "<meta http-equiv = 'Refresh' content='0; URL=test.php'>";

?>
