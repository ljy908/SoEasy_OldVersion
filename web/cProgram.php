<?php

/****************** This page is used to execute or exit the Control Program from the Web page. ********************/

$power = $_GET['power'];

// File path, command
$fileLocation = "/var/www/project_os/c_program/add  > /dev/null &";
$gpioLocation = "/var/www/project_os/DB/gpio/";
$turnOff = "ps -ef | grep /var/www/project_os/c_program/add";
$killProcess = "kill ";

// When input is on
if ($power == "on") {
    // Execute the file using the PHP function.
    $t = exec($turnOff, $output);
    $turnOffLocation = $output[0];
    $turnOffLocation = explode(" ", $turnOffLocation);
    
    // When executing a file from the Web, the user name is "www-data".
    if ($turnOffLocation[0] == "www-data") // "www-data" means that it is executed if it exists.
    {
        $t = exec($fileLocation, $output);
        echo "<script>alert('The program has been launched!')</script>";
    } else {
        echo "<script>alert('The program is running!')</script>";
    }
} else if ($power == "off") {
    $t = exec($turnOff, $output);
    $turnOffLocation = $output[0];
    $turnOffLocation = explode(" ", $turnOffLocation);
    
    if ($turnOffLocation[0] == "www-data") {
        echo "<script>alert('The program is not running')</script>";
    } else {
        // Initialize the database when you exit the program.
        for ($j = 0; $j <= 20; $j ++) {
            $gpioLocationResult = $gpioLocation . $j;
            $result = fopen($gpioLocationResult, "w+");
            fputs($result, "0");
        }
        
        // Kill the process
        $turnOffLocation = $output[0];
        $turnOffLocation = explode(" ", $turnOffLocation);
        $killProcess .= $turnOffLocation[6];
        $t = exec($killProcess, $output);
        
        echo "<script>alert('The program has ended.')</script>";
    }
}
echo "<meta http-equiv = 'Refresh' content='0; URL=setting.php'>";
?>
