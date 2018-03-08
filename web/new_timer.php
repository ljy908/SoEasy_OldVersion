<body>
	<?php

/* ****** Page for modifying and adding timer ***** */

// ***********************S E T T I N G*********************************
$fpTableColor = fopen("/var/www/project_os/DB/homepage/tableColor", "r");
$TableColorResult = fread($fpTableColor, 255);
$imageLocation = "/var/www/project_os/DB/homepage/image";

$fpImageDown = fopen("/var/www/project_os/DB/homepage/image/imageWhere/down", "r");
$fpImageResult = fread($fpImageDown, 255);

$imageResult = $imageLocation . "/" . $fpImageResult;
$imageSearch = strpos($imageResult, ".jpg");
$imageResult = substr($imageResult, 0, $imageSearch + 4);

// ***********************S E T T I N G*********************************

$fpTimer = fopen("/var/www/project_os/DB/Time_DB/timer", "r+");
$fpTimerResult = fread($fpTimer, 255);

echo "<form action=new_timer_ok.php method=post> ";

// include topTitle.php
include_once "./topTitle.php";

// Timer table starting part
echo "<table border ='1' frame = hsides align = center width = '330' cellpadding='3' cellspacing='0' bordercolor='silver' bordercolorlight='white'><tr align='center'>";
echo "<td align = 'center' colspan = 2  bgcolor = $TableColorResult><font size=4 color = white><b>Timer Setting</font></b></td></tr>";
echo "<tr><td align = 'center' colspan = 2><textarea cols = 40 rows = 30  name = timerList >$fpTimerResult</textarea></td></tr>";
echo "</table>";

// background picture
echo "<body background	=	'$imageResult'>";

echo "<p align = center><input type ='submit' onClick='checkSolution(sb.onoff)'></form>";
?> 
</body>
