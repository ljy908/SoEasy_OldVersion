<?php

/****************** Contol to Digital(0, 1) ********************/

$power = $_GET['power']; // Read current 'on' and 'off' status values.
$number = $_GET['number']; // GPIO #
$fp = "/var/www/project_os/DB/gpio/"; // GPIO path
$fp .= $number; // Add # to the GPIO path.
                
// Now, if state is On
if ($power == "off") {
    $fp = fopen($fp, "r+");
    fputs($fp, "0"); // Put 0 into the value and make it LOW.
} // If state is Off
else {
    $fp = fopen($fp, "w+");
    fputs($fp, "1"); // Put 1 into the value and make it HIGH.
}

echo "<meta http-equiv = 'Refresh' content='0.3; URL=test.php'>";
?>
