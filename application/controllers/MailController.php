<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MailController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_senderEmail');
	}
 
 
	public function sendMail($token)
	{
		if($this->session->userdata('logged_in')){
			$data['list_select'] = $this->input->post('dest');
	   		$mail = $this -> db -> select('*')->from('mail')->where('token',$token)->get();
	   		$mail = $mail->result();

	   		$destinataire = $this -> db -> select('*')->from('liste_destinataire')->where('libelle',$data['list_select'])->get();
	   		$destinataire = $destinataire->result();

	   		$adresse = $this -> db -> select('*')->from('adresse')->where('liste_destinataire_id',$destinataire[0]->id)->get();
	   		$adresse = $adresse->result();

	   		$fichier = $this -> db -> select('*')->from('fichier')->where('mail_id',$mail[0]->id)->get();
	   		$fichier = $fichier->result();

	   		$data['mail_sended'] = $mail;
	   		$i=0;
	   		foreach ($adresse as $key => $value) {
	   			$i++;
	   			
	   			$dataDB= array(
	   				'mail_id'=>$mail[0]->id,
	   				'envoi'=> $i
	   			);
	   			$this->db->insert('log_envoi', $dataDB);
	   			
	   			$this->my_senderEmail->send($mail[0]->email, $value->email, $mail[0]->nom, $mail[0]->sujet, $mail[0]->corps_mail, $fichier);
	   		}
	   		
	   		
	   		redirect('saved_mail/'.$token);
	    }
	   else
	   {
			//If no session, redirect to login page
			redirect('/', 'refresh');
	   }
	}

}
