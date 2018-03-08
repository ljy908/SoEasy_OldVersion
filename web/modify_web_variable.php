<?php

/**
 * ***************** Page for modifying GroupControl  *****************
 */
$name = $_GET['name'];
$listNumber = $_GET['listNumber'];
$counter = $_GET['counter'];

$variableName = array();
$variableIndex = array();
$variableTemp = 0;
$i = 0;


//***********************S E T T I N G*********************************

$imageLocation = "/var/www/project_os/DB/homepage/image";

// Load the desktop picture saved in DB.
$fpImageDown = fopen("/var/www/project_os/DB/homepage/image/imageWhere/down", "r");
$fpImageResult = fread($fpImageDown, 255);
$imageResult = $imageLocation . "/" . $fpImageResult;

$imageSearch = strpos($imageResult, ".jpg");
$imageResult = substr($imageResult, 0, $imageSearch + 4);

echo "<body background	=	'$imageResult'>";

$fp = "/var/www/project_os/DB/web_variable/";
$fp .= $name;
$fp = fopen($fp, "r");

// Read the table colors stored in DB.
$fpTableColor = fopen("/var/www/project_os/DB/homepage/tableColor", "r");
$TableColorResult = fread($fpTableColor, 255);

//***********************S E T T I N G*********************************

while (($test = fread($fp, 1)) != NULL) {
    if ($variableTemp == 0) {
        $variableName[$i] .= $test;
        
        if ($test == " ") {
            $variableTemp = 1;
        }
    } else if ($variableTemp == 1) {
        $variableIndex[$i] .= $test;
        
        if ($test == "\n") {
            $i ++;
            $variableTemp = 0;
        }
    }
}

if ($counter == 0) {
    $test = sizeof($variableName);
    $listNumber = $test;
} else {
    $listNumber = $listNumber + 1;
}

fclose($fp);

echo "<form action=modify_web_variable_ok.php method=post> ";
echo "<br>";

include_once "./topTitle.php";

echo "<table border ='1' frame = hsides align = center width = '330' cellpadding='3' cellspacing='0' bordercolor='silver' bordercolorlight='white'><tr align='center' bgcolor = $TableColorResult>";
echo "<td align = 'center' colspan = 2><font size=4 color=white><b>GroupControl Modify</font></b><font size = 2><a href = modify_web_variable.php?name=$name&listNumber=$listNumber&counter=1><br>ADD</a>
	<a href = modify_web_variable_delete.php?name=$name>&nbspDELETE</a></td></tr>";
echo "<tr><td align = 'center' colspan = 2>Name<input type=edit name = name value= $name><br></tr>";

for ($j = 0; $j < $listNumber; $j ++) {
    echo "<tr><td align = 'center' colspan = 2>Pin Number<input type=edit name = variableName[] value=$variableName[$j]><br>Pin Data<input type=edit name = variableIndex[] value=$variableIndex[$j]></tr>";
}

echo "</table>";
echo "<p align = center><input type ='submit' onClick='checkSolution(sb.onoff)'></form>";
?> 
