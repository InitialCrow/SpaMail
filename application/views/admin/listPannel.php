<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  	<div class="dashboardListPannel wrapper">
  		  <header>
          <h1 class="title"> Dashboard envoiMail v-- 0.2 </h1>  
        </header>
        <?php include('./application/views/partials/partial.nav.php'); ?>
        <form class="adminListPannelForm" method='post' enctype='multipart/form-data' action="<?php echo base_url('dashboard/list/add')?>"  >
              <h2>ajouter des destinataires</h2>
              <label for="libelle">nom de la liste</label>
              <input type="text" name="libelle" class="form-control libelle"></input>



              <div class="row">
                
                <div class="col-xs-4 center-block title">prenom</div>
                <div class="col-xs-4 center-block title">nom</div>
                <div class="col-xs-4 center-block title">email</div>
             
                
              </div>

              <div class="row">

                <div class="col-xs-4 center-block rowData">
                  
                  <input name="prenom" class="form-control prenom"></input>
                </div>
                <div class="col-xs-4 center-block rowData">
               
                  <input name="nom" class="form-control nom"></input>

                </div>
                <div class="col-xs-4 center-block rowData">
                 
                  <input name="email" type="email" class="form-control email"></input>
                </div>
              </div>

            

              
              
              
              <button class="btn btn-default" type="submit">Ajouter</button>

        </form>
        
 
		
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url('public/js/jquery-1.11.2.min.js');?>"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('vendor/twbs/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

     
    <script src="<?php echo base_url('public/js/plugin/ckeditor/ckeditor.js')?>"></script>
    <script src="<?php echo base_url('public/js/main.js')?>"></script>
  </body>
</html>