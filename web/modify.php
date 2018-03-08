<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php

/**
 * ***************** Page to modify pinData *****************
 */
$number = $_GET['number'];
$listNumber = $_GET['listNumber'];
$counter = $_GET['counter'];
$fp_config = "/var/www/project_os/DB/gpio_variable/";

if ($number == 14 || $number == 15 || $number == 16) {
    // Analog settings
    $analogLocation = "/var/www/project_os/DB/gpio_analog/";
    
    $analogLocationResult = $analogLocation . $number;
    
    $analogSetting = fopen($analogLocationResult, "r");
    $analogResult = fread($analogSetting, 255);
}

$j = 0;
$i = 0;

// gpioCompare value(array)
$gpioCompareSize = array();
$insertData = array();
$gpioCompareNumber = array();
$area = array();
$dataResultIndex = array();
$deleteIndex = array();

// An array to read the list of files in the path
$fileList = array();
$gpioList = array(
    0,
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    9,
    10,
    11,
    12,
    13,
    14,
    15,
    16,
    17,
    18,
    19,
    20
);


//***********************S E T T I N G*********************************

// file pointer
$imageLocation = "/var/www/project_os/DB/homepage/image";

// Load the desktop picture saved in DB.
$fpImageDown = fopen("/var/www/project_os/DB/homepage/image/imageWhere/down", "r");
$fpImageResult = fread($fpImageDown, 255);
$imageResult = $imageLocation . "/" . $fpImageResult;

$imageSearch = strpos($imageResult, ".jpg");
$imageResult = substr($imageResult, 0, $imageSearch + 4);

echo "<body background	=	'$imageResult'>";

// gpioCompare file pointer
$fp = "/var/www/project_os/DB/gpio_compare/";
$fp .= $number;
$fp = fopen($fp, "r");

// Read the table colors stored in DB.
$fpTableColor = fopen("/var/www/project_os/DB/homepage/tableColor", "r");
$TableColorResult = fread($fpTableColor, 255);

//***********************S E T T I N G*********************************

$i = 0;
$k = 0;
$counter_test = 0;
$counter_condition = 0;

// Open the file in the folder, distinguish it by the condition and save it.
while (($test = fread($fp, 1)) != NULL) {
    $deleteIndex[$k] .= $test;
    
    if ($variableTemp == 0) {
        if ($test == " ") {
            $counter_test ++;
            $counter_condition = 1;
        }
        
        if ($counter_test == 2 && $counter_condition == 0) {
            $variableName[$i] .= $test;
            $variableTemp = 1;
        } else if ($counter_test == 1 && $counter_condition == 0) {
            switch ($test) {
                case 0:
                    $test = "When same";
                    break;
                case 1:
                    $test = "When it is bigger";
                    break;
                case 2:
                    $test = "When greater than or equal to";
                    break;
                case 3:
                    $test = "When it is smaller";
                    break;
                case 4:
                    $test = "When smaller or equal";
                    break;
                default:
                    break;
            }
            
            $dataResultIndex[$i] .= "Comparison condition = " . $test;
        } else if ($counter_test == 0 && $counter_condition == 0) {
            $dataResultIndex[$i] = "GPIO # = " . $test . "&nbsp&nbsp";
        }
        $counter_condition = 0;
    } else if ($variableTemp == 1) {
        $variableIndex[$i] .= $test;
        
        if ($test == "\n") {
            $k ++;
            $i ++;
            $variableTemp = 0;
        }
    }
}

// First time
if ($counter == 0) {
    $test = sizeof($variableName);
    $listNumber = $test;
} // When you add the number
else {
    $listNumber = $listNumber + 1;
}

echo "<form action=modify_ok.php?number=$number method=post> ";
echo "<br>";

include_once "./topTitle.php";

// Start GPIO Settings Table
echo "<table border ='1' frame = hsides align = center width = '330' cellpadding='3' cellspacing='0' bordercolor='silver' bordercolorlight='white'><tr align='center'>";
echo "<td align = 'center' colspan = 2  bgcolor = $TableColorResult><font size=4 color = white><b>'$number' GPIO Set</font></b></td></tr>";

// GPIO # is less than 14 (digital)
if ($number < 14) {
    
    // UART
    if ($number == 0) {
        echo "<tr><td align = 'center' colspan = 2>
						<input type=radio name = config value=0>Not used
						<input type=radio name = config value=2>Input
						<input type=radio name = config value=1>Output
						<input type=radio name = config value=5>UART</tr>";
    } else if ($number == 1) {
        echo "<tr><td align = 'center' colspan = 2>
						<input type=radio name = config value=0>Not used
						<input type=radio name = config value=2>Input
						<input type=radio name = config value=1>Output
						<input type=radio name = config value=6>UART</tr>";
    } // PWM
    else if ($number == 3 || $number == 5 || $number == 6 || $number == 9 || $number == 10 || $number == 11) {
        echo "<tr><td align = 'center' colspan = 2>
						<input type=radio name = config value=0>Not used
						<input type=radio name = config value=2>Input
						<input type=radio name = config value=1>Output
						<input type=radio name = config value=4>PWM</tr>";
        
        echo "<tr><td align = 'center'><font size = 2><b>PWM Reset</b></font></td><td align = 'center' colspan = 2><input type=edit name = pwm value=0></tr>";
        echo "<tr><td align = 'center'><font size = 2><b>PWM Variation</b></font></td><td align = 'center' colspan = 2><input type=edit name = pwm_condition value=0></tr>";
    } // If not PWM
    else {
        echo "<tr><td align = 'center' colspan = 2 bgcolor = 'white'>
						<input type=radio name = config value=0>Not used
						<input type=radio name = config value=2>Input
						<input type=radio name = config value=1>Output</tr>";
    }
} // When the GPIO is analog
else {
    echo "<tr><td align = 'center' colspan = 2 bgcolor = 'white'>
					<input type=radio name = config value=0>Not used<br>
					<input type=radio name = config value=4>Analog Input<br>
					<input type=radio name = config value=5>Analog Output</tr>";
    
    echo "<tr><td align = 'center' colspan = 2 bgcolor = 'white'>unit<input type = edit name = analogUnit value = $analogResult></td></tr>";
}

echo "<tr><td align = 'center'><font size = 2><b>Pin Pair</b></font></td><td align = 'center' colspan = 2 bgcolor = 'white'><input type=edit name = pair value=0  size = 35></tr>";
echo "</table>";
echo "<br>";

// Start GPIO Comparison Table
echo "<table border ='1' frame = hsides align = center width = '330' cellpadding='3' cellspacing='0' bordercolor='silver' bordercolorlight='white'><tr align='center'  bgcolor = $TableColorResult>";
echo "<td align = 'center' colspan = 2><b><font  color = white>GPIO compare</font></b> <a href = modify.php?number=$number&listNumber=$listNumber&counter=1>Add number</a></tr>";

for ($j = 0; $j < $listNumber; $j ++) {
    echo "<tr><td align = 'center' colspan = 2 bgcolor = 'white'><SELECT class = box name = area[] itemname = 'area'>
				  <option value = '' select> Comparison condition</option>
				  <option value = '0' select> ==</option>
				  <option value = '1' select> ></option>
				  <option value = '2' select> >=</option>
				  <option value = '3' select> <</option>
				  <option value = '4' select> <=</option></SELECT>";
    
    echo "<SELECT class = box name = gpioCompareNumber[] itemname = 'Number'> &nbsp&nbsp <option value = '' select> Target GPIO #</option>";
    
    for ($k = 0; $k < 20; $k ++) {
        echo "<option value = $gpioList[$k] select> $gpioList[$k] </option>";
    }
    
    echo "</SELECT>&nbsp&nbsp<a href = 'gpio_compare_delete.php?number=$number&index=$j'><font size = 1>Delete</font></a><br><font size = 1 color = gray>$dataResultIndex[$j]</font></td></tr><tr><td align = center bgcolor = 'white'><font size = 2><b>Comparison value</b></font></td><td> <input type = edit name = gpioCompareSize[] value = $variableName[$j] size = 32></tr><tr><td align = center><font size = 2><b>Input value</b></font></td><td><input type = edit name = insertData[] value = $variableIndex[$j] size = 32></td></tr>";
    echo "</tr>";
}

echo "</table>";

echo "<p align = center><input type ='submit' value = 'Edit' onClick='checkSolution(sb.onoff)'></form>";
?>
