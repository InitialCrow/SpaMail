<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link href="<?php echo base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>">
</head>
<body>

	<div class="login wrapper">
		<?php echo validation_errors(); ?>
		<?php echo form_open('checkLogController'); ?>
			

			<label for="identifiant">identifiant</label>
			<input type="text" id="identifant" name= "identifiant" class="form-control"></input>
			<label for="mdp">mdp</label>
			<input type="password" id="mdp" name= "mdp" class="form-control"></input>
			<button type="submit" class="btn btn-default">connection</button>

		</form>
	</div>

</body>
</html>