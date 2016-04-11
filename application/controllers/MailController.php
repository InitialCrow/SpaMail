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
	
 
	public function save()
	{
		if($this->session->userdata('logged_in')){

	   		$dest_list = $this -> db -> select('*')->from('liste_destinataire');
			$data['dest_list'] = $dest_list->get()->result();
			$data['dest_test'] = $dest_list->from('liste_destinataire')->where('libelle','test')->get()->result();

	   		$data['dest_mail'] = $this->input->post('dest');
	   		$data['test'] = $this->input->post('receive_test');
			$data['mail_subject'] = $this->input->post('subject');
			$data['mail_sender'] = $this->input->post('expediant');
			$data['mail_sender_email'] = $this->input->post('email-exped');
			$data['mail_files'] = $this->input->post('files');
			$data['mail_text'] = $this->input->post('editor1');

			$this->load->view('front/index-saved', $data );	
	    }
	   else
	   {
			//If no session, redirect to login page
			redirect('/', 'refresh');
	   }
	}
}
