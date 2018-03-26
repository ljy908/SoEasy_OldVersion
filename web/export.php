<html>
<head>
<title>"this is import and export image page"</title>
</head>
<body>

<br>
<br>
<br>
<br>


<table border ='1' frame = hsides align = center width = '400'  cellpadding='3' cellspacing='0' bordercolor='silver' bordercolorlight='white'><tr align='center'>

<tr><td>
<br>
<b>Please insert export's file name</b>
<align = left><input type='text' size=60 maxlength=10 name='yourname'><br><br>
<span style="float:right"><input type ='submit' value=' Cancel ' onClick='checkSolution(sb.onoff)'></span>
<span style="float:right"><input type ='submit' value=' Export ' onClick='checkSolution(sb.onoff)'></span>
<br>
</td></tr>
</table>

<br>
<br>
<br>
<br>

<?php

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

echo "<table border ='1' frame = hsides align = center width = '400'  cellpadding='3' cellspacing='0' bordercolor='silver' bordercolorlight='white'><tr align='center'>";
echo "<td align = 'center' colspan = 2  bgcolor = $TableColorResult><font size=4 color = white><b>Please Export File</font></b></td></tr>";
echo "<tr><td align = 'left' colspan = 1><input type='radio' name='chk_info' value='CSS'>.<br>";
echo "<align = 'left' colspan = 1><input type='radio' name='chk_info' value='CSS'>..<br>";
echo "<align = 'left' colspan = 1><input type='radio' name='chk_info' value='CSS'>RC_CAR<br></td></tr>";
echo "<tr><td align = right><input type ='submit' value=' Import ' onClick='checkSolution(sb.onoff)'></td></tr>";
echo "</table>";

?> 


</body>

</html>