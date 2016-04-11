'use strict'; // use strict mode of js
$(document).ready(function(){
	switchForm('.indexForm','.add_receive_button','add_receive.php');//form, button, url
	switchForm('.indexForm','.sav_mail','saved_mail');

	chooseTypeMail.init();
	
});


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

var chooseTypeMail = {
	'html_mode':false,
	'editor_mode':false,
	'$listener' : $('.type'),

	'$alert_msg':[$('.warning')],
	'$editor' : null,
	switchHtml : function(){
		console.log('showWarning activated')
		if(this.html_mode === true){
			this.$alert_msg[0].css({
				'transition':'opacity, 1s',
				'opacity':'1'
			});

		}
		else{
			this.$alert_msg[0].css({
				'transition':'opacity, 1s',
				'opacity':'0'
			});
		}

	},
	switchEditor  : function(){

		if(this.editor_mode === true){
			this.$editor = CKEDITOR.replace( 'editor1' );
			this.$editor.id = '#cke_editor1';
			
		}
		else{
			console.log('delete');
			if(this.$editor !=null || this.$edior != undefined){

				this.$editor.destroy();
			}
			
		}
	},
	init : function(){
		var self = this;
		this.$listener.on('click',function(evt){
		
			var type = $(this).val();

			console.log(type);
			if(type === 'html'){
				self.editor_mode = false;
				self.html_mode = true;
				$('.import').css({
					'transition':'opacity, 1s',
					'opacity':'1'
				})

				
			}
			if(type === 'texte'){
				self.html_mode = false;
				self.editor_mode = true;
				$('.import').css({
					'transition':'opacity, 1s',
					'opacity':'0'
				})
				
			}
				self.switchHtml();
				self.switchEditor();
			
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






/*-------------------------been--------------------------*/
