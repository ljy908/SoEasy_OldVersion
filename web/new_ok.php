<?php

/****************** Pages that are OK when you add a new page ********************/
$number = $_POST['number'];
$setting = $_POST['setting'];
$number2 = $_GET['number2'];

// When adding, it outputs an error when it goes out of range. Or enter normally.
if ((($number >= 0) && ($number <= 40))) {
    $fp = "/var/www/project_os/DB/gpio_config_DB/";
    $fp .= $number;
    
    $fp = fopen($fp, "r+");
    fputs($fp, $setting);
    fclose($fp);
} else {
    echo "<p align = center>";
    echo "Alert!!";
    echo "Add GPIO(0~40).";
    echo "</p>";
}

echo "<meta http-equiv = 'Refresh' content='0; URL=test.php'>";
?>
