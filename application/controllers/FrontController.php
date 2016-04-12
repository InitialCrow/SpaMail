<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontController extends CI_Controller {

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
		$this->load->model('my_multupload');
	}
 
	public function index()
	{
		if($this->session->userdata('logged_in'))
	   {

			$session_data = $this->session->userdata('logged_in');
			$data['identifiant'] = $session_data['identifiant'];
			
			
			$dest_list = $this -> db -> select('*')->from('liste_destinataire');
			$data['dest_list'] = $dest_list->get()->result();
			$data['dest_test'] = $dest_list->from('liste_destinataire')->where('libelle','test')->get()->result();




			$this->load->view('front/index', $data );
	   }
	   else
	   {
	     //If no session, redirect to login page
	     redirect('/', 'refresh');
	   }
	}

	public function save(){
		
		

		if($this->session->userdata('logged_in')){
			 

			$dest_list = $this -> db -> select('*')->from('liste_destinataire');
			$data['dest_list'] = $dest_list->get()->result();
			$data['dest_test'] = $dest_list->from('liste_destinataire')->where('libelle','test')->get()->result();

			$data['dest_mail'] = $this->input->post('dest');
	   		$data['test'] = $this->input->post('receive_test');
			$data['mail_subject'] = $this->input->post('subject');
			$data['mail_sender'] = $this->input->post('expediant');
			$data['mail_sender_email'] = $this->input->post('email-expediant');
			
			
			$data['mail_text'] = $this->input->post('editor1');
			$data['mail_type'] = $this->input->post('mail_type');
			
			$data['upload_file'] = $this->my_multupload->do_upload('./public/uploads/pieces_jointes','pieces');
			
			
			$token = "";
			$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
			$max = count($characters) - 1;
			for ($i = 0; $i < 15; $i++) {
				$rand = mt_rand(0, $max);
				$token .= $characters[$rand];
			}
			
			$dataDB = array(
			   'type' => $data['mail_type'],
			   'sujet' => $data['mail_subject'],
			   'status' => 0,
			   'email' =>$data['mail_sender_email'],
			   'nom' =>$data['mail_sender'],
			   'token'=> $token,
			   'corps_mail' => $data['mail_text']

			);
			$data['token'] = $token;
			$this->session->set_userdata($data);
			
			$this->db->insert('mail', $dataDB); 
			redirect('saved_mail/'.$token);

		}

	}
	public function rdyToSend($token){
		if($this->session->userdata('logged_in')){
			$data['token'] = $token;
			$mail = $this -> db -> select('*')->from('mail')->where('token',$token)->get();
			$mail = $mail->result();
			
			$dest_list = $this -> db -> select('*')->from('liste_destinataire');
			$data['dest_list'] = $dest_list->get()->result();
			$data['dest_test'] = $dest_list->from('liste_destinataire')->where('libelle','test')->get()->result();

			$data['dest_mail'] = $this->input->post('dest');
	   		$data['test'] = $this->input->post('receive_test');
			$data['mail_subject'] = $mail[0]->sujet;
			$data['mail_sender'] = $mail[0]->nom;
			$data['mail_sender_email'] = $mail[0]->email;
			
			$data['mail_text']= $mail[0]->corps_mail;
			
			$data['mail_type'] = $this->input->post('mail_type');
			
			$data['upload_file']= $this->session->userdata('upload_file');
			
			var_dump($this->session->userdata('upload_file'));
		
		
			$this->load->view('front/index', $data );

		}
	}
	public function edit($token){

		if($this->session->userdata('logged_in')){
			
			
			$data['token'] = $token;
			$data['dest_mail'] = $this->input->post('dest');
			$data['test'] = $this->input->post('receive_test');
			$data['mail_subject'] = $this->input->post('subject');
			$data['mail_sender'] = $this->input->post('expediant');
			$data['mail_sender_email'] = $this->input->post('email-expediant');
			
			
			$data['mail_text'] = $this->input->post('editor1');
			$data['mail_type'] = $this->input->post('mail_type');
			

			$data['upload_file'] = $this->my_multupload->do_upload('./public/uploads/pieces_jointes','pieces');
			// $this->my_multupload->do_upload('./public/uploads/import_html','import');
			
			$this->session->set_userdata($data);



			$dataDB = array(
			   'type' => $data['mail_type'],
			   'sujet' => $data['mail_subject'],
			   'email' =>$data['mail_sender_email'],
			   'nom' =>$data['mail_sender'],
			   'corps_mail' => $data['mail_text']

			);

			$this->db->where('token', $token);
			$this->db->update('mail', $dataDB);

		
			redirect('saved_mail/'.$data['token']);

		}
	}
}
