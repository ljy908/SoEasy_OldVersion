<?php
/****************** pinCompare �����Ѵ�. ********************/
$number = $_GET['number'];
$index = $_GET['index'];

// pinCompare ���� ������
$fp = "/var/www/project_os/DB/gpio_compare/";
$fp .= $number;
$fp = fopen($fp, "r");

$variableIndex = 0;
$k = 0;
$i = 0;

// ������ �ִ� ������ ��� ���ǿ� ���� ���� �� �� ������.
while (($test = fread($fp, 8)) != NULL) {
    if ($variableTemp == 0) {
        if ($i == $index) {
            $i ++;
            continue;
        }
        $variableIndex .= $test;
    }
    $i ++;
}

// pinCompare ���� ������
$fp = "/var/www/project_os/DB/gpio_compare/";
$fp .= $number;
$fp = fopen($fp, "w");

fputs($fp, $variableIndex);

fclose($fp);

echo "<meta http-equiv = 'Refresh' content='1; URL=modify.php?number=$number'>";

?>
