<?php
/******************* Timer ���� �޾Ƽ� �����ͺ��̽��� �����ϱ����� ������ ******************/

// POST ����� ���� ������ ���� �޾ƿ´�.
$timerList = $_POST['timerList'];
// timer �����ͺ��̽� ���
$fp = "/var/www/project_os/DB/Time_DB/timer";

// timer �����ͺ��̽��� ���� �Է��Ѵ�.
$fp = fopen($fp, "r+");
fputs($fp, $timerList);
fclose($fp);

echo "<meta http-equiv = 'Refresh' content='0; URL=test.php'>";
?>
