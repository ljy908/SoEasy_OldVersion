<?php
// DB�� ����Ǿ��ִ� ǥ ������ �о�´�.
	$fpTableColor		=	fopen("/var/www/project_os/DB/homepage/tableColor", "r");
	$TableColorResult	=	fread($fpTableColor, 255);
	$imageLocation		=	"/project_os/DB/homepage/image";

// DB�� ����Ǿ� �ִ� ����ȭ�� �׸��� �ҷ��´�.
	$fpImageDown		=	fopen("/var/www/project_os/DB/homepage/image/imageWhere/down", "r");
	$fpImageResult		=	fread($fpImageDown, 255);
	$imageResult		=	$imageLocation . "/" . $fpImageResult;

	$imageSearch		=		strpos($imageResult, ".jpg");
	$imageResult		=		substr($imageResult, 0, $imageSearch + 4);

	echo "<body background	=	'$imageResult'>";

	echo "<form action=new_variable_ok.php method=post> ";

	echo "<br>";	
	echo "<table border ='1' frame = hsides align = center width = '330' cellpadding='3' cellspacing='0' bordercolor='silver' bordercolorlight='white' bgcolor = white><tr align='center' bgcolor = $TableColorResult>";
	echo "<td align = 'center' colspan = 2><font size=4 color = white><b>�� ���� �߰��ϱ�</font></b></td></tr>";
	echo "<tr><td align = 'center'>���� �̸�</td><td><input type=edit name = name value=0 size = 30></td></tr><tr><td align = 'center'>�ʱ�ȭ ��</td><td><input type=edit name = initValue value=0  size = 30></td></tr>";

	echo "</table>";
	echo "<p align = center><input type ='submit' value=' O K ' onClick='checkSolution(sb.onoff)'></form>"; 
?> 
