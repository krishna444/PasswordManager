<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Admin extends CI_Controller {
	function __construct() {
		parent::__construct ();
		session_start ();
	}
	public function index() {
		if (isset ( $_SESSION ['username'] )) {
			redirect ( 'passwords' );
		}
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_rules ( 'email_address', 'Email Address', 'required|valid_email' );
		$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[4]' );
		
		if ($this->form_validation->run () != false) {
			// validation passed. Get from the db
			$this->load->model ( 'admin_model' );
			$res = $this->admin_model->verify_user ( $this->input->post ( 'email_address' ), $this->input->post ( 'password' ) );
			if ($res != false) {
				// Person has an account
				$_SESSION ['username'] = $this->input->post ( 'email_address' );
				$_SESSION ['key'] = $this->input->post ( 'password' );
				redirect ( 'passwords' );
			}
		}
		$data ['view'] = "login_view";
		$this->load->vars ( $data );
		$this->load->view ( 'master', $data );
		// $this->load->view ( 'login_view' );
	}
	public function logout() {
		session_destroy ();
		redirect ( 'welcome' );
	}
}
