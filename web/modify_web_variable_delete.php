<?php

/****************** GroupControl ���� ********************/

// GroupControl �̸��� �޴´�.
	$name						=	$_GET['name'];

// GroupControl ��� �߰�
	$web_variable_location		=	"/var/www/project_os/DB/web_variable/";
	$web_variable_location	   .=	$name;

// GroupControl ����
	unlink($web_variable_location);

	echo "<meta http-equiv = 'Refresh' content='1; URL=test.php'>";
?>
