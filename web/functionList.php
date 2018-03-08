<?php

/****************** The external function is saved. ********************/

// Read the table colors stored in DB.
function fileList($list, $size)
{
    $i = 0;
    $j = - 1;
    $fileList = array();
    $fileFp = dir($list);
    
    // Read the list of files in the directory from the beginning.
    while (($fileResult = $fileFp->read()) == true) {
        $fileList[$i ++] = $fileResult;
    }
    echo "<br>";
    // Start table
    echo "<table width = $size border = 1 cellpadding='3' cellspacing='1' frame = 'void'>";
    
    $fileListSize = sizeof($fileList);
    
    // end file pointer
    $fileFp->close();
    
    // Print in the table. (There are errors to fix)
    while ($j ++ <= $fileListSize) {
        // This will be the current folder and the previous folder will be output like Linux. (Needs revision)
        if ($fileList[$j] == "." | $fileList[$j] == ".." | $fileList[$j] == "") {
            continue;
        }
        
        echo "<tr><td bgcolor = white><p align = center><b><a href = modify_web_variable.php?name=$fileList[$j]&counter=0>$fileList[$j]</a></b></p></td>";
        echo "<td bgcolor = white><p align = center><b><a href = web_variable_ok.php?name=$fileList[$j]>Run</a></b></p></td></tr>";
    }
    
    // End table
    echo "</table>";
}

function bgColor()
{
    // Read the table colors stored in DB.
    $fpTableColor = fopen("/var/www/project_os/DB/homepage/tableColor", "r");
    $TableColorResult = fread($fpTableColor, 255);
    
    return $TableColorResult;
}

function tableList($size)
{
    // Read the table colors stored in DB.
    // $fpTableColor = fopen("/var/www/project_os/DB/homepage/tableColor", "r");
    // $TableColorResult = fread($fpTableColor, 255);
    $configLocation = "/var/www/project_os/DB/gpio_config_DB/";
    $pairLocation = "/var/www/project_os/DB/gpio_pair/";
    
    // Read the table colors stored in DB.
    // $fpTableColor = fopen("/var/www/project_os/DB/homepage/tableColor", "r");
    // $TableColorResult = fread($fpTableColor, 255);
    
    $TableColorResult = bgColor();
    
    echo "<br>";
    
    // main Homepage: width = 800, new Homepage 330
    echo "<table width = $size border = 1 cellpadding='3' cellspacing='1' frame = 'void' align = center><tr><td align = center bgcolor = $TableColorResult colspan = 2>
			<font color = white><b>Current PinMode</b></font></td></tr>";
    
    if ($size == 800) {
        echo "<tr><td bgcolor = white><font size = 1>
            <img src = off.png width = 10 height = 10> &nbsp 11, 12, 13, 15, 16, 18, 22, 7 : Digital Port(0~7)) <br> 
            <img src = off.png width = 10 height = 10> &nbsp 29, 31, 33, 35, 37, 32, 36, 38, 40  : Digital Port(21~29) <br> 
			<img src = off.png width = 10 height = 10> &nbsp NONE : Analog Port <br> 
			<img src = off.png width = 10 height = 10> &nbsp 10 : UART0_RX <br> 
			<img src = off.png width = 10 height = 10> &nbsp 8 : UART0_TX <br> 
			<img src = off.png width = 10 height = 10> &nbsp 12, 32, 33 ,35 : PWM</td>";
    }
    echo "<td width = 400 bgcolor = white>";
    
    for ($j = 0; $j < 20; $j ++) {
        $configLocationResult = $configLocation . $j;
        $fp = fopen($configLocationResult, "r");
        $fpConfig = fread($fp, 255);
        
        $pairLocationResult = $pairLocation . $j;
        $fp = fopen($pairLocationResult, "r");
        $fpRead = fread($fp, 255);
        
        if ($fpConfig != 0) {
            if ($fpConfig == "1") {
                $config = "Output";
            } else if ($fpConfig == "2") {
                $config = "Input";
            } else if ($fpConfig == "3") {
                $config = "Output";
            } else if ($fpConfig == "4") {
                $config = "Analog";
            } else if ($fpConfig == "5") {
                $config = "PWM";
            }
            echo "<font size = 2>$j : <font size = 1><b>$config</b></font> <font size = 1><b>(PAIR $fpRead)</b></font><br></font>";
        }
    }
    
    echo "</td></tr></table>";
}
?>
