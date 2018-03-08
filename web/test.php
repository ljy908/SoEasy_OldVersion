
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<!-- main page -->
<head>
<style>
A:link {
	COLOR: black;
	TEXT-DECORATION: none
}

A:visited {
	COLOR: blue;
	TEXT-DECORATION: none
}

A:hover {
	COLOR: orange;
	TEXT-DECORATION: underline
}
</style>
</head>

<script>
	// If your device is mobile, go to the mobile page.
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ){
	   window.location = "m_test.php";
	}
</script>

<?php
$i = 0;
$imageLocation = "/var/www/project_os/DB/homepage/image";

// Load the desktop image saved in DB.
$fpImageDown = fopen("/var/www/project_os/DB/homepage/image/imageWhere/down", "r");
$fpImageResult = fread($fpImageDown, 255);
$imageResult = $imageLocation . "/" . $fpImageResult;

$imageSearch = strpos($imageResult, ".jpg");
$imageResult = substr($imageResult, 0, $imageSearch + 4);

echo "<body background	=	'$imageResult'>";

// Read the refresh interval time stored in DB.
$fpRefreshTime = fopen("/var/www/project_os/DB/homepage/refreshTime", "r");
$refreshTimeResult = fread($fpRefreshTime, 255);

// Read the table colors stored in DB.
$fpTableColor = fopen("/var/www/project_os/DB/homepage/tableColor", "r");
$TableColorResult = fread($fpTableColor, 255);

// Analog setting
$analogLocation = "/var/www/project_os/DB/gpio_analog/";

// Get the php for which the variable (table) is output.
require ('./functionList.php');

echo "<p align = center>";
echo "<form action=modify_ok.php?no=$no method=post> ";

// Start the menu table.
echo "<table width = 800 height = 40 align = center><tr bgcolor= $TableColorResult>";
echo "<td><p align = center><a href = 'setting.php'  width = 10>	<font color = white size = 2>Setting<br></font></a></p></td>";
echo "<td><p align = center><a href = 'new.php'  width = 10>		<font color = white size = 2>New<br></a></font></p></td>";
echo "<td><p align = center><a href = 'new_numorus.php'>			<font color = white size = 2>GroupControl<br></font></a></p></td>";
echo "<td><p align = center><a href = 'new_timer.php'>			<font color = white size = 2>Timer<br></font></a></p></td>";
echo "<td><p align = center><a href = 'sourceSelect.html'><font color = white size = 2>Source Code Modify<br></a></p></font></td></tr></table>";

tableList(800);

// Start GPIO table

echo "<table width = 800  border = 1 cellpadding='3' cellspacing='1' frame = 'void' align = center><tr bgcolor=$TableColorResult >";
echo "<td align = center>	<font color = white size = 2><b>#</b></font></td>";
echo "<td align = center>	<font color = white size = 2><b>PinData</b></font></td>";
echo "<td align = center>	<font color = white size = 2><b>Control</b></font></td></tr><tr>";
echo "<br>";

// The while statement runs from 0 to 13 (add: analog)
while ($i < 41) {
    
    // Read GPIO setting value.
    $fp_config = "/var/www/project_os/DB/gpio_config_DB/";
    $fp_config .= $i;
    
    // GPIO settings text file 'fopen'
    $config_open = fopen($fp_config, "r+");
    $config_index = fread($config_open, 1);
    
    // Setting value is 0: Disabled :: No output
    if ($config_index == 0) {
        $i ++;
        continue;
    }
    
    // Read GPIO data value.
    $fp_gpio = "/var/www/project_os/DB/gpio/";
    $fp_gpio .= $i;
    
    $gpio_open = fopen($fp_gpio, "r+");
    $gpio_index = fread($gpio_open, 255);
    
    // Edit link
    echo "<td bgcolor=white><p align = center><a href = 'modify.php?number=$i'>$i</a></p></td>";
    echo "<td bgcolor=white><p align = center>";
    
    // The Galileo board is digital up to 13 and thereafter the number is analog.
    if ($i <= 40) {
        // If setting value is 4, PWM
        if ($config_index == 4) {
            
            $config_open = fopen($fp_gpio, "r+");
            $gpio_index_temp = $gpio_index / 200000; // 1v = 1000000
            
            echo "$gpio_index_temp V</p></td>";
        }        // 4, the digital GPIO
        else {
            echo "$gpio_index</p></td>";
        }
    } else {
        $analogLocationResult = $analogLocation . $i;
        
        $analogSetting = fopen($analogLocationResult, "r");
        $test = fread($analogSetting, 255);
        
        echo "$gpio_index $test</p></td>";
    }
    
    echo "<td bgcolor=white>";
    
    // For output
    if ($config_index == 1) {
        
        // When the GPIO state is HIGH
        if ($gpio_index == 1) {
            echo "<p align = center><a href = 'control.php?power=off&number=$i'>OFF</a></p>";
        }   // When the GPIO state is Low
        else {
            echo "<p align = center><a href = 'control.php?power=on&number=$i'>ON</a></p>";
        }
    }    
    // If setting value is 4, PWM
    else if ($config_index == 4) {
        echo "<p align = center><a href = 'modify_pwm.php?condition=sub&number=$i'>Decrease</a>  <a href = 'modify_pwm.php?condition=plus&number=$i'>Increase</a></p>";
    }
    
    echo "</td></tr>";
    
    $i ++;
}

echo "</table>";
echo "<p align = center>";

// Read the GroupControl table.
fileList("/var/www/project_os/DB/web_variable", 800);

echo "</body>";
echo "<meta http-equiv = 'Refresh' content=$refreshTimeResult; URL=test.php'>";
?>
