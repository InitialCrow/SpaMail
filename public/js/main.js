'use strict'; // use strict mode of js
$(document).ready(function(){

	
	switchForm('.indexForm','.add_receive_button','add_receive.php');//form, button, url
	switchForm('.indexForm','.sav_mail','saved_mail');

	
	

	checkDelete('.delete');
	checkDelete('.deleteAd');
	

	editAdress();
	addListPannel('.add_list_button');
	addListPannel('.add_adress_button',true);
	sendMessage();
	
	
});
function sendMessage(){
	$('.send-button').on('click',function(evt){
		evt.preventDefault();
		var $form = $('.indexForm')
		var $token = $('.main-header').attr('data-token');

		if($token != undefined && $token !=null ){
			$form.attr('action','send_test/'+$token);
			$form.submit();
		}
		
	})
}
//change action form, button, url
function switchForm(form, button, newUrl){
	var url = window.location.href;
	var part = url.split("/");
	var edit_mode = false;
	var $token = $('.main-header').attr('data-token');

	var $form = $(form);
	var $button = $(button);
	

	if(part[4] === $token ){
		edit_mode = true;
	}
	$button.on('click',function(){//when we click on  button we change action url form
		if(edit_mode === false){
			$form.attr('action',newUrl);
			
		}
		else{
			$form.attr('action', window.location.href + '/edit');
		}
	});

}


function checkDelete(idButton){
	var $button = $(idButton);
	var confirmMsg = '<p>êtes vous sure de vouloir supprimer cette élément</p>';
	var choice = '<button class="btn btn-default" id="deleteYes" type="submit">oui</button><button class="btn btn-default" id="deleteNo" >non</button>';
	var $msg = '<div id="confirmMsg">'+confirmMsg+choice+'</div>';
	var $id =null;
	var $url = null;


	$button.on('click', function(evt){
		evt.preventDefault();
		
		var $id_html = $(this).attr('class').split(' ');
		$id = $(this).attr('data-token');
		var $type = $(this).attr('data-type');

		if($msg !=undefined && $msg!= null && $msg!=""){

			$(this).css('display','none')
			$(this).after($msg);
			var $confirmMsg = $('#confirmMsg');
			var $yes = $('#deleteYes');
			var $no = $('#deleteNo');

			$no.on('click',function(evt){
				
				evt.preventDefault();
				$confirmMsg.remove();
				$button.css('display','block')
			});
			$yes.on('click', function(evt){
				evt.preventDefault();
				if( $id_html[$id_html.length-1] ==='delete'){
					$url = 'dashboard/adress/'+$id+'/delete/'+$type;
					// $('.adminForm').attr('action','dashboard/'+$id+'/delete/'+$type);
				}
				if( $id_html[$id_html.length-1] === 'deleteAd'){
					$url = $id+'/delete/'+$type;

					// $('.adminForm').attr('action', $id+'/delete/'+$type);
				}
				$.ajax({
					url: $url,
					type:'POST',
					data: $('.adminForm').serialize(),
					success: function(msg)
					{
						document.location.reload();
					},
					error : function(msg) {
						console.log(msg);
					}
    				});
			});
			
		}
		else{
			alert('script error');
		}
	})
}
function editAdress(){

	var $elem = $('.editable');
	var check = false;

	$elem.on('click',function(){
		var newVal = null;
		newVal = prompt('entrer votre nouvelle valeur');

		if(newVal !== null && newVal !== "" && newVal !== " "){
			$(this).find('input').val(newVal);
			check = true;

			
		}


		if(check === true){
			$('.editFormAdress').submit();
		}
		else{
			//message de non coformité de formulaire ici..
		}
	
		
	});
}
function addListPannel(button, submit_mode){
	var $button = $(button);
	var $prenomContainer = $('.prenom_input');
	var $nomContainer = $('.nom_input');
	var $emailContainer = $('.email_input');
	var i = 0; 
	
	if(submit_mode === true){
		var $optionContainer = $('.option_input');
		$button.on('click',function(evt){
			evt.preventDefault();
			

			var prenomInput =  "<input name=\"prenom["+i+"]\" type=\"text\" class=\" form-control prenom\"placeholder=\"jhon\"></input>"
			var nomInput =  "<input name=\"nom["+i+"]\" type=\"text\" class=\" form-control nom\"placeholder=\"Do\"></input>"
			var emailInput =  "<input name=\"email["+i+"]\" type=\"email\" class=\" form-control email\"placeholder=\"jhondo@hotmail.fr\"></input>"
			var optionInput =  "<button type=\"submit\" class=\"add-new-adress btn btn-default\">ajouter à la liste</burron>"
			$emailContainer.append(emailInput);
			$nomContainer.append(nomInput);
			$prenomContainer.append(prenomInput);
			 $optionContainer.append(optionInput);

			$('.add-new-adress').on('click',function(evt){

				evt.preventDefault();

			
				$.ajax({
					url: 'add/index',
					type:'POST',
					data: $('.adminForm').serialize(),
					success: function(msg)
					{
						document.location.reload();
					},
					error : function(msg) {
						console.log(msg);
					}
    			});
			});
		i++;	
		})

	}
	else{
		$button.on('click',function(evt){
			evt.preventDefault();
			i++;
			var prenomInput =  "<input name=\"prenom["+i+"]\" type=\"text\" class=\"form-control prenom\"placeholder=\"jhon\"></input>"
			var nomInput =  "<input name=\"nom["+i+"]\" type=\"text\" class=\"form-control nom\"placeholder=\"Do\"></input>"
			var emailInput =  "<input name=\"email["+i+"]\" type=\"email\" class=\"form-control email\"placeholder=\"jhondo@hotmail.com\"></input>"
			
			
			 $prenomContainer.append(prenomInput);
			 $nomContainer.append(nomInput);
			 $emailContainer.append(emailInput);
		})
	}
	
}



















/*--------------- obsolete been -----------------------*/

// function addFileInput(){
// 	var $button = $('.add_file_button');
// 	var $input = $('.file');

// 	$button.on('click',function(evt){
		
		
// 		$input.after($input.clone());
// 	})
// };

// var chooseTypeMail = {
// 	'html_mode':false,
// 	'editor_mode':false,
// 	'$listener' : $('.type'),

// 	'$alert_msg':[$('.warning')],
// 	'$editor' : null,
// 	switchHtml : function(){
// 		console.log('showWarning activated')
// 		if(this.html_mode === true){
// 			this.$alert_msg[0].css({
// 				'transition':'opacity, 1s',
// 				'opacity':'1'
// 			});

// 		}
// 		else{
// 			this.$alert_msg[0].css({
// 				'transition':'opacity, 1s',
// 				'opacity':'0'
// 			});
// 		}

// 	},
// 	switchEditor  : function(){

// 		if(this.editor_mode === true){
// 			this.$editor = CKEDITOR.replace( 'editor1' );
// 			this.$editor.id = '#cke_editor1';
			
// 		}
// 		else{
// 			console.log('delete');
// 			if(this.$editor !=null || this.$edior != undefined){

// 				this.$editor.destroy();
// 			}
			
// 		}
// 	},
// 	init : function(){
// 		var self = this;
// 		this.$listener.on('click',function(evt){
		
// 			var type = $(this).val();

// 			console.log(type);
// 			if(type === 'html'){
// 				self.editor_mode = false;
// 				self.html_mode = true;
// 				$('.import').css({
// 					'transition':'opacity, 1s',
// 					'opacity':'1'
// 				})

				
// 			}
// 			if(type === 'text'){
// 				self.html_mode = false;
// 				self.editor_mode = true;
// 				$('.import').css({
// 					'transition':'opacity, 1s',
// 					'opacity':'0'
// 				})
				
// 			}
// 				self.switchHtml();
// 				self.switchEditor();
			
// 		})
// 	}
// }





/*-------------------------been--------------------------*/
