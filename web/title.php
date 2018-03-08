<style type="text/css">
A:link {
	COLOR: black;
	TEXT-DECORATION: none
}

A:visited {
	COLOR: blue;
	TEXT-DECORATION: none
}

A:hover {
	COLOR: orange;
	TEXT-DECORATION: underline
}

body {
	margin-left: 1;
	margin-right: 1;
	margin-bottom: 0;
}

h1 {
	padding-bottom: 15px;
	text-align: center;
}
</style>

<?php
$imageLocation = "/project_os/DB/homepage/image";
$fpImageUP = fopen("/var/www/project_os/DB/homepage/image/imageWhere/up", "r");
$fpImageUPResult = fread($fpImageUP, strlen("/var/www/project_os/DB/homepage/image/123.jpg"));

$imageResult = $imageLocation . "/" . $fpImageUPResult;

$imageSearch = strpos($imageResult, ".jpg");
$imageResult = substr($imageResult, 0, $imageSearch + 4);

$titleLocation = "/var/www/project_os/DB/homepage/title";

$fp = fopen($titleLocation, "r");
$title = fread($fp, 255);

echo "<body background	=	$imageResult>";
echo "<h1>$title</h1>";

?>
