 <?php

/****************** Page for increasing and decreasing PWM ********************/

	$condition			= $_GET['condition'];
	$number				= $_GET['number'];

	
	//***********************S E T T I N G*********************************
	
	$imageLocation		=	"/var/www/project_os/DB/homepage/image";

	// Load the desktop picture saved in DB.
	$fpImageDown		=	fopen("/var/www/project_os/DB/homepage/image/imageWhere/down", "r");
	$fpImageResult		=	fread($fpImageDown, 255);
	$imageResult		=	$imageLocation . "/" . $fpImageResult;

	$imageSearch		=		strpos($imageResult, ".jpg");
	$imageResult		=		substr($imageResult, 0, $imageSearch + 4);

	echo "<!-- <body background	=	'$imageResult'> -->";

	//***********************S E T T I N G*********************************
	
	// PWM variation value
	$fp_pwm		= "/var/www/project_os/DB/gpio_pwm/";
	$fp_pwm	   .= $number;

	// PWM current value
	$fp_gpio	= "/var/www/project_os/DB/gpio/";
	$fp_gpio	.= $number;

	// Read the value stored in PWM DB.
	$gpioData		= fopen($fp_gpio, "r+");
	$gpioData		= fread($gpioData , 255);

	// If the current PWM value is less than 5V (for Galileo Gen1, 1000000 (5V) is the maximum).
	if($gpioData <= 1000000)
	{
		$config_open	= fopen($fp_pwm, "r+");
		$config_index	= fread($config_open , 255);
		
		if($condition == "sub")
		{
			$gpioData = $gpioData - $config_index;
		    //$gpioData = $gpioData - 100000;
			// (PWM value - PWM variation value) <0, output error message
			if($gpioData < 0)
			{
				echo "Alert!";
				echo "<meta http-equiv = 'Refresh' content='1; URL=test.php'>";
				return;
			}
					
		}
		else if($condition == "plus")
		{
			$gpioData = $gpioData + $config_index;
		    //$gpioData = $gpioData + 100000;
			// Outputs an error message if (PWM value - PWM variation value)> 5V
			if($gpioData > 1000000)
			{
				echo "Alert!";
				echo "<meta http-equiv = 'Refresh' content='1; URL=test.php'>";
				return;
			}
		}

		$fp	= "/var/www/project_os/DB/gpio/";
		$fp	.= $number;

		$fp = fopen($fp, "w+");
		fputs($fp , $gpioData);

		fclose($fp);
	}
	else
	{
		echo "Alert!";
	}

	echo "<meta http-equiv = 'Refresh' content='1; URL=test.php'>";
?>
