<!DOCTYPE HTML>
<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>sourceEdit</title>
<meta name="generator" content="Namo WebEditor">


<body bgcolor="white" text="black" link="blue" vlink="purple"
	alink="red">

	<script>
	function setAlert(result)
    	{
    		alert(result);
    	}


	</script>

	
        <?php
        $fpTableColor = fopen("/var/www/project_os/DB/homepage/tableColor", "r");
        $TableColorResult = fread($fpTableColor, 255);
        
        echo "<form action=sourceSave.php method=POST>";
        
        $test = $_GET['test'];
        
        if ($test != "") {
            $fpTest = fopen($test, "r+");
            $fpResultList;
            
            while (($fpResult = fread($fpTest, 1)) != NULL) {
                $fpResultList = $fpResultList . $fpResult;
            }
            $fpResultList = trim($fpResultList);
            
            echo "<table width = 100%  border = 1 cellpadding='1' cellspacing='1' frame = 'void' align = center><tr bgcolor=$TableColorResult >";
            echo "<td align = center>	<font color = white size = 2><b>Code List</b></font></td>";
            echo "<tr><td align = left> <input type ='submit' onClick=setAlert(aa) value=SAVE style=\"width:100%\"></td></tr>";
            echo "<tr><td align = left> <textarea cols = 100 rows = 50 name = sourceCode position=relative> $fpResultList</textarea></td></tr>";
            echo "<input type = 'hidden' name = sourceLocation value = $test></input></form>";
        }
        ?>
	


</body>
</html>
