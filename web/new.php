<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php

/*** ***************** New pin added ******************/


//***********************S E T T I N G*********************************

require ("./functionList.php");

// Read the table colors stored in DB.
$fpTableColor = fopen("/var/www/project_os/DB/homepage/tableColor", "r");
$TableColorResult = fread($fpTableColor, 255);

$imageLocation = "/var/www/project_os/DB/homepage/image";

// Load the desktop image saved in DB.
$fpImageDown = fopen("/var/www/project_os/DB/homepage/image/imageWhere/down", "r");
$fpImageResult = fread($fpImageDown, 255);
$imageResult = $imageLocation . "/" . $fpImageResult;

$imageSearch = strpos($imageResult, ".jpg");
$imageResult = substr($imageResult, 0, $imageSearch + 4);

echo "<body background	=	'$imageResult'>";

//***********************S E T T I N G*********************************

//Strart funtion
echo "<form action=new_ok.php method=post> ";

// include topTitle.php
include_once "./topTitle.php";

// Start table
echo "<table border ='1' frame = hsides align = center width = '330' cellpadding='3'	cellspacing='0' bordercolor='silver' bordercolorlight='white' bgcolor = white>";

echo "<tr align= 'center' bgcolor = $TableColorResult>";
echo "<td align = 'center' colspan = 4><font size=3 color = white><b>New Pin</font></b></td></tr>";

echo "<tr><td align = 'center'>Pin #</td><td><input type=edit name = number value=0></td></tr>
	<tr><td align = 'center'>PinMode</td><td><input type=edit name = setting value=0></td></tr>";

echo "</table>";

tableList(330);

echo "<table border ='1' frame = hsides align = center width = '330' cellpadding='3'	cellspacing='0' bordercolor='silver' bordercolorlight='white' bgcolor = white>";
echo "<tr align = center bgcolor = $TableColorResult>";
echo "<td align = center colspan = 4><font size = 3 color = white><b>Pin Mode</font></b></td></tr>";
echo "<tr align = center><td><font size = 1>0</font></td><td><font size = 1>None</font></td></tr>";
echo "<tr align = center><td><font size = 1>1</font></td><td><font size = 1>Digital Output</font></td></tr>";
echo "<tr align = center><td><font size = 1>2</font></td><td><font size = 1>Digital Input</font></td></tr>";
echo "<tr align = center><td><font size = 1>3</font></td><td><font size = 1>Analog Input</font></td></tr>";
echo "<tr align = center><td><font size = 1>4</font></td><td><font size = 1>PWM Output</font></td></tr>";
echo "<tr align = center><td><font size = 1>5</font></td><td><font size = 1>UART RX</font></td></tr>";
echo "<tr align = center><td><font size = 1>6</font></td><td><font size = 1>UART TX</font></td></tr>";
echo "</table>";

echo "<p align = center><input type ='submit' value = 'ok' onClick='checkSolution(sb.onoff)'></form>";
?> 