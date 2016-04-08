<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>


	<?php echo validation_errors(); ?>
	<?php echo form_open('checkLogController'); ?>
		<label for="identifiant">identifiant</label>
		<input type="text" id="identifant" name= "identifiant"></input>
		<label for="mdp">mdp</label>
		<input type="password" id="mdp" name= "mdp"></input>
		<button type="submit">connection</button>
	</form>

</body>
</html>