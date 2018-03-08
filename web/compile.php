<?php

/**************Compile*****************/

// Compile command
$fileLocation = "gcc -o add uart_test.c gpioCompare.c filepointer.c main.c init.c output_DB.c programExec. output_analog.c insert_DB.c wiringSerial.c";
// Functions for executing commands
$t = exec($fileLocation, $output);

echo "<meta http-equiv = 'Refresh' content='0; URL=setting.php'>";
?>
