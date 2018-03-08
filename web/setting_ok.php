<?php

/* ***************** This is a page for entering data on setting page. ******************* */
$title = $_POST['title'];
$tableColor = $_POST['tableColor'];
$refreshTime = $_POST['refreshTime'];
$initUpBackground = $_POST['initUpBackground'];
$initDownBackground = $_POST['initDownBackground'];
$outside = $_POST['outside'];

// background
$whereImage = $_POST['whereImage'];
$backgroundImage = $_POST['backgroundImage'];

$titleLocation = "/var/www/project_os/DB/homepage/title";
$colorLocation = "/var/www/project_os/DB/homepage/tableColor";
$refreshLocation = "/var/www/project_os/DB/homepage/refreshTime";
$imageLocation = "/var/www/project_os/DB/homepage/image/imageWhere";
$outsideLocation = "/var/www/project_os/DB/outside_library/";

if ($outside != NULL) {
    $outsideLocation = $outsideLocation . $outside;
    echo "$outsideLocation";
    $outsideFp = dir($fp_config);
    
    // Read all the files in the folder.
    while (NULL != ($fileResult = $outsideFp->read())) {
        echo "$fileResult";
    }
    
    // end file pointer
    $outsideFp->close();
}

if ($initUpBackground == 1) {
    $imageLocationUp = $imageLocation . "/up";
    $fp = fopen($imageLocationUp, "w");
    fputs($fp, $refreshTime);
}

if ($initDownBackground == 1) {
    $imageLocationDown = $imageLocation . "/down";
    $fp = fopen($imageLocationDown, "w");
    fputs($fp, $refreshTime);
}

if ($refreshTime != NULL) {
    $fp = fopen($refreshLocation, "w");
    fputs($fp, $refreshTime);
}

if ($title != NULL) {
    
    $fp = fopen($titleLocation, "w");
    fputs($fp, $title);
}

if ($tableColor != NULL) {
    $fp = fopen($colorLocation, "w");
    fputs($fp, $tableColor);
}

if ($whereImage != NULL && $backgroundImage != NULL) {
    if ($whereImage == "up") {
        $imageLocationResult = $imageLocation . "/" . "up";
        $fp = fopen($imageLocationResult, "w");
        fputs($fp, $backgroundImage);
    } else if ($whereImage == "down") {
        $imageLocationResult = $imageLocation . "/" . "down";
        $fp = fopen($imageLocationResult, "w");
        fputs($fp, $backgroundImage);
    }
}

echo "<meta http-equiv = 'Refresh' content='0; URL=setting.php'>";
?> 
