<!DOCTYPE HTML>
<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>No Title</title>
<meta name="generator" content="Namo WebEditor">
<base target="detail">
</head>

<body bgcolor="white" text="black" link="blue" vlink="purple"
	alink="red">

	<form action=test.php method=post>
		<script>
        	function newFile()
        	{
        		var newFileResult = prompt("Input New File name");
        		var newFileResultURL = 'newSourceFile.php?newFile=' + newFileResult;
        		if (newFileResult != null)
        		{
        			location.assign(newFileResultURL);
        		}
        	}
		</script>
		


<?php
$fileArray = array();
$fileLocation = "/var/www/project_os/web/";
$fileFp = dir($fileLocation);

$fileArraySize = sizeof($fileLocation);

$fpTableColor = fopen("/var/www/project_os/DB/homepage/tableColor", "r");
$TableColorResult = fread($fpTableColor, 255);

while (($fileResult = $fileFp->read()) == true) {
    $fileArray[$i ++] = $fileResult;
}
$fileArraySize = sizeof($fileArray);

echo "<table width = 100%  border = 1 cellpadding='1' cellspacing='1' frame = 'void' align = center><tr bgcolor=$TableColorResult >";
echo "<td align = center>	<font color = white size = 2><b>Code List</b></font></td>";
echo "<tr><td align = center> <input type=button style=\"width:100%\" value=NewFile onClick=newFile()></input> <br></tr>";

while ($j < $fileArraySize) {
    if (strcmp($fileArray[$j], ".") == 0 || strcmp($fileArray[$j], "..") == 0) {
        $j ++;
        continue;
    }
    
    // $searchResult = stripos($fileArray[$j], "php");
    // $fileStrlen = strlen($fileArray[$j]);
    // if($searchResult == $fileStrlen - 1)
    // {
    $fileLocationResult = $fileLocation . "$fileArray[$j]";
    $number = $j + 1;
    echo "<tr><td align = left> $number <a href = sourceEdit.php?test=$fileLocationResult>$fileArray[$j]</a></td></tr>";
    // }
    $j ++;
}

?>



</body>

</html>
