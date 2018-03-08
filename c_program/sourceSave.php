<script>
	alert("Done!");
</script>

<?php
	$sourceCode = $_POST['sourceCode'];
	$sourceLocation = $_POST['sourceLocation'];

	$fpLocation = fopen($sourceLocation, "w");
	fwrite($fpLocation, $sourceCode);
?>
echo "<meta http-equiv = 'Refresh' content='0; URL=sourceEdit.php'>";