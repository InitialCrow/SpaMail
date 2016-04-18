<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>EnvoiMail 1.0</title>
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
	    		<header class="main-header"> 
	    			<div class="wrapper">
			        	<h1 id="title">Envoi<span class="blue">Mail@</span></h1>
					</div>
		        </header>
		        <form class="indexForm" method='post' enctype='multipart/form-data' action='mail.php' >
			        <section class="dest">
			        	<div class="wrapper">
				        	<h2 class="title-form">Destinataires</h2><div class="container">
				        	<?php var_dump($dataPost['dest_mail']); ?>
				        		<label for="dest">listes des destinataires</label>				        		
								<select name="dest" class="field">
									<?php  
					        			if(!empty($dest_list) || isset($dest_list)){
					        				if(!empty($dataPost) || isset($dataPost)){

					        						echo "<option value=\"$dataPost->dest_mail\">$dataPost->dest_test</option>";
					        					}
					        				foreach ($dest_list as $dest) {

					        					echo "<option value=\"$dest->adresse_id\">$dest->libelle</option>";
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
							<input type="text" class="field" id="subject" name="subject" placeholder="ex: Demande de mission">
							<label for="expediant">Nom de l'expediteur</label>
							<input type="text" class="field" id="expediant" name="expediant" placeholder="ex: Mr John Doe">
							<label for="email-expediant">Email de l'expediteur</label>
							<input type="text" class="field" id="email-expediant" name="email-expediant" placeholder="ex: johndoe@test.com"></div>
						</div>
			        </section>
			        <section class="mail-type">
			        	<div class="wrapper">
				        	<h2 class="title-form">Type de mail</h2><div class="container">
				        	<label for="mail_type" class="hidden">importer ou écrire un mail</label>
							<input type="radio" value="0" name="mail_type" class="type" >importer html
							<input type="radio" value="1" name="mail_type" class="type" >ecrire le mail
							<p class="warning">Si le mail html comportedes variables (publipostage) <b>Attention</b>- les champs doivent êtres en UTF-8 Les variables doivent être mises entre balises <..> dans le texte html</p></div>
						</div>

			        </section>
			        <section class="mail">
			        	<div class="wrapper">
				        	<h2 class="title-form">Mail</h2><div class="container">
				        	<label for="import" class="import">corps du mail</label>
							<input type="file" class="file import" name="import">

						

				        	<label for="file">Pièces Jointes</label>
							<input type="file" class="file " name="files[]">
							
							</div>
							<textarea name='editor1' class='editor1 fade'></textarea>
							<button type="submit" class="validate sav_mail">valider</button>
						</div>
			        </section>
			        <section class="mail-renderer">
			        	<div class="wrapper">
				        	<h2 class="title-form">Prévisualisation</h2><div class="container">
				        	<div class="renderer">
				        		
				        	</div>
				        	<div class="info">
				        		<p>Fichier coprs du mail</p>
				        		<p>Images</p>
				        		<p>Pièce jointes</p>
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
