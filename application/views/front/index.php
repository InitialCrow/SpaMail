<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
     
        <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>">


    </head>
    <body>
    	<div class="home">
	    	<div class="wrapper">
	    		<header class="main-header" data-token ="<?php if(!empty($token)) echo "$token"; ?>"> 
	    			<div class="wrapper">
			        	<h1 id="title">Envoi<span class="blue">Mail@</span></h1>
					</div>
		        </header>
		        <form class="indexForm" method='post' enctype='multipart/form-data' action='' >
			        <section class="dest">
			        	<div class="wrapper">
				        	<h2 class="title-form">Destinataires</h2><div class="container">
				        		<label for="dest">listes des destinataires</label>				        		
								<select name="dest" class="field">
									<?php  
					        			if(!empty($dest_list) || isset($dest_list)){
					        				
					        				foreach ($dest_list as $dest) {
					        					if($dest->libelle === $dest_mail){
					        						echo "<option value=\"$dest->adresse_id\" selected = 'selected' >$dest->libelle </option>";
					        					}
					        					echo "<option value=\"$dest->libelle\">$dest->libelle</option>";
											}
					        			}
					        			else {
					        				echo "pas de destinataire enregistré";
					        			}
									?>
									
								</select></div>
				        	<button type="submit" class="add_receive_button">+</button>

				        </div>	
			        </section>
			        <section class="test">
				        <div class="wrapper">
				        	<h2 class="title-form">Test</h2><div class="container">
				        	<label for="receive-test">Destinataires pour le test</label>
				        	<select name="receive-test" class="field">
								<?php  
					        			if(!empty($dest_test) || isset($dest_test)){
					        				foreach ($dest_test as $dest) {
					        					if($dest->libelle === $dest_mail){
					        						echo "<option value=\"$dest->adresse_id\" selected = 'selected' >$dest->libelle </option>";
					        					}
					        					echo "<option value=\"$dest->adresse_id\">$dest->libelle</option>";
					        					
				
											}
					        			}
					        			else {
					        				echo "pas de destinataire test enregistré";
					        			}
								?>
							</select></div>
						</div>
			        </section>
			        <section class="header">
				        <div class="wrapper">
				        	<h2 class="title-form">En tête</h2><div class="container">
				        	<label for="subject">sujet de l'email</label>
							<input type="text" class="field" id="subject" name="subject" placeholder="ex: Demande de mission" <?php if(!empty($mail_subject)) echo "value=\" $mail_subject\"" ?>>
							<label for="expediant">Nom de l'expediteur</label>
							<input type="text" class="field" id="expediant" name="expediant" placeholder="ex: Mr John Doe" <?php if(!empty($mail_sender)) echo "value=\" $mail_sender\"" ?>>
							<label for="email-expediant">Email de l'expediteur</label>
							<input type="text" class="field" id="email-expediant" name="email-expediant" placeholder="ex: johndoe@test.com"<?php if(!empty($mail_sender_email)) echo "value=\" $mail_sender_email\"" ?>></div>
						</div>
			        </section>
			        <section class="mail-type">
			        	<div class="wrapper">
				        	<h2 class="title-form">Type de mail</h2><div class="container">
				        	<label for="mail_type" class="hidden">importer ou écrire un mail</label>
							<input type="radio" value="html" name="mail_type" class="type" >importer html
							<input type="radio" value="text" name="mail_type" class="type" >ecrire le mail
							<p class="warning">Si le mail html comportedes variables (publipostage) <b>Attention</b>- les champs doivent êtres en UTF-8 Les variables doivent être mises entre balises <..> dans le texte html</p></div>
						</div>

			        </section>
			        <section class="mail">
			        	<div class="wrapper">
				        	<h2 class="title-form">Mail</h2><div class="container">
				        	<label for="import" class="import">corps du mail</label>
							<input type="file" class="file import" name="import" >

						

				        	<label for="file">Pièces Jointes</label>
							<input type="file" class="file " name=" pieces[]" multiple>
							<?php 
								

								if(!empty($upload_file) || isset($upload_file)){
									
										
									foreach ($upload_file['name'] as $file_name) {
										
										echo "<img width=\"100px\" height=\"100px\"src=".base_url('public/uploads/pieces_jointes').'/'.$file_name." alt=\"image en apreçu des pièces jointes\"><p>".$file_name ."</p>";
									}
									
									
									
								}

							 ?>
							
							
							</div>
							<textarea name='editor1' class='editor1 fade'><?php if(!empty($mail_text)||isset($mail_text)) echo $mail_text; ?></textarea>
							<button type="submit" class="validate sav_mail">valider</button>
						</div>
			        </section>
			        <section class="mail-renderer">
			        	<div class="wrapper">
				        	<h2 class="title-form">Prévisualisation</h2><div class="container">
				        	<div class="renderer">
				        	<?php 
				        		if(!empty($mail_text) || isset($mail_text)){
				        			echo $mail_text;
				        		}
				        	 ?>
				        		
				        	</div>
				        	<div class="info">
				        		<p>Fichier coprs du mail</p>
				        		<p>Images</p>
				        		<p> <?php if(!empty($upload_file) || isset($upload_file)){
									echo count($upload_file['name'])."Pièces jointes";
				        				}
				        				else {echo "Pas de pièces jointes";} 
				        			?></p>
				        	</div></div>
				        </div>
			        </section>
			        <section class="send-test">
			       	 	<div class="wrapper">
				        	<h2 class="title-form">Envoi test</h2><div class="container">
				        	<p>liste dest <span class="under">(nb enregistremnt)</span> </p>
				        	
				        	<button type="submit">Valider</button></div>
				        </div>
			        </section>
			        <section class="send">
			        	<div class="wrapper">
				        	<h2 class="title-form">Envoi</h2><div class="container">
				        	<p>liste dest<span class="under">(nb enregistremnt)</span> </p>
				        	<button type="submit">Valider</button></div>
				        </div>
			        </section>
			        <section class="send-renderer">
			        	<div class="wrapper">
				        	<h2 class="title-form">Compte rendu d'envoi</h2><div class="container">
				        	<p>nb enregistrements</p>
				        	<p>nb envoyés</p>
				        	<p>nb error</p></div>
				        </div>
				    </section>
				</form>
			</div>
		</div>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <script src="<?php echo base_url('public/js/jquery-1.11.2.min.js')?>"></script>

     
        <script src="<?php echo base_url('public/js/plugin/ckeditor/ckeditor.js')?>"></script>
        <script src="<?php echo base_url('public/js/main.js')?>"></script>
    </body>
</html>
