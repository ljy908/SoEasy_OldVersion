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
		<input type=button value=NewFile onClick=newFile()></input>


<?php
$fileArray = array();
$fileLocation = "/var/www/project_os/web/";
$fileFp = dir($fileLocation);

$fileArraySize = sizeof($fileLocation);

while (($fileResult = $fileFp->read()) == true) {
    $fileArray[$i ++] = $fileResult;
}
$fileArraySize = sizeof($fileArray);

echo "<br>";

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
    echo "-> <a href = sourceEdit.php?test=$fileLocationResult>$fileArray[$j]</a>";
    
    echo "<br>-------------<br>";
    // }
    $j ++;
}

?>


</body>

</html>
