<?php  
require './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
	Class My_senderEmail extends CI_Model{

		public function send($exp, $dest, $nom, $sujet, $message, $fichier){
			$mail = new PHPMailer;

			//$mail->SMTPDebug = 3;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'localhost';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = false;                               // Enable SMTP authentication
		                          // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 1025;                                    // TCP port to connect to

			$mail->setFrom($exp);
			$mail->addAddress($dest);     
			$mail->addReplyTo($exp);


			if(!empty($fichier)){
				foreach ($fichier as $fich) {
					
					$mail->addAttachment("./public/uploads/pieces_jointes/".$fich->fichier_uri);  
				}
			}

			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = $sujet;
			$mail->Body    = $message;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
		}

		
		
		// public function send( $exp, $dest, $nom, $sujet, $message){
		// 	ini_set('SMTP', 'localhost'); 
		// 	ini_set('smtp_port', 1025); 
			

		// 	$passage_ligne = "\r\n";

		// 			$passage_ligne = "\n";
		
			
		// 	$header = "From:".$nom."<".$exp.">".$passage_ligne;
		// 	$header .= "Reply-to:".$nom."<".$exp.">".$passage_ligne;
		// 	$header .= "MIME-Version: 1.0".$passage_ligne;
		// 	$header .= "Content-Type: multipart/mixed;".$passage_ligne;
			
		// 	$msg = $message;
		// 	$msg .= "Content-type: text/html;charset=utf-8".$passage_ligne;;
		
			
			
		// 	return mail($dest,$sujet,$msg,$header);
		// }
		
	
	}
?>
