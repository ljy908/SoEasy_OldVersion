<?php
$name = $_GET['name'];
$variableName = array();
$variableIndex = array();
$variableTemp = 0;
$i = 0;
$fpGpio = "/var/www/project_os/DB/gpio/";

$fp = "/var/www/project_os/DB/web_variable/";

$fp .= $name;
$fp = fopen($fp, "r");

// Read data from beginning to end. Save 'variableTemp' values alternately with 0 and 1.
while (($test = fread($fp, 1)) != NULL) {
    if ($variableTemp == 0) {
        $variableName[$i] .= $test;
        // If it is a space
        if ($test == ' ') {
            $fpGpioResult = $fpGpio;
            $fpGpioResult .= $variableName[$i];
            $fpGpioResult = trim($fpGpioResult);
            $fpGpioResult = fopen($fpGpioResult, "r+");
            
            $variableTemp = 1;
        }
    } else if ($variableTemp == 1) {
        // End of file or newline character
        if ($test == "\n" | $test == "\0") {
            $t = fwrite($fpGpioResult, $variableIndex[$i]);
            
            $variableTemp = 0;
            $i ++;
        } else {
            $variableIndex[$i] .= $test;
        }
    }
}
fclose($fp);

echo "<meta http-equiv = 'Refresh' content='0; URL=test.php'>";

?>
