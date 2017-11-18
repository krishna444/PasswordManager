<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User extends CI_Controller {
	public function index() {
	}
	public function register() {
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_rules ( 'first_name', 'First Name', 'trim|required' );
		$this->form_validation->set_rules ( 'last_name', 'Last Name', 'trim|required' );
		$this->form_validation->set_rules ( 'email_address', 'Email Address', 'trim|required|valid_email|is_unique[users.email_address]' );
		$this->form_validation->set_rules ( 'password', 'Password', 'trim|reduired|min_length[4]' );
		$this->form_validation->set_rules ( 'password_confirm', 'Confirm Password', 'trim|required' );
		
		if ($this->form_validation->run () != false) {
			// Check password confirmation
			if ($this->input->post ( 'password' ) == $this->input->post ( 'password_confirm' )) {
				$this->load->model ( 'admin_model' );
				if ($this->admin_model->emailExists ( $this->input->post ( 'email_address' ) )) {
					$data ['message'] = "Email already registered in our database.";
				} else {
					$result = $this->admin_model->add_user ( $this->input->post ( 'email_address' ), $this->input->post ( 'password' ), $this->input->post ( 'first_name' ), $this->input->post ( 'last_name' ) );
					if ($result == false) {
						$data ['error'] = 'Registration Failure!.';
					} else {
						// SUCCESS.
						// Send activation link
						$activate_link = base_url ( "/user/activate/" . $result );
						$this->load->library ( 'email' );
						$fromAddress = "no-reply@password-manager.com";
						$this->email->from ( $fromAddress );
						$this->email->to ( $this->input->post ( 'email_address' ) );
						$this->email->subject ( "Your activation link" );
						$this->email->message ( "Dear customer \r\n Here is the activation link \r\n" . $activate_link );
						$result = $this->email->send ();
						if ($result) {
							$data ['message'] = 'An activation link has been sent to your email.';
						} else {
							$data ['error'] = "There is problem while sending activation link. Please try again.";
						}
					}
				}
			} else {
				$data ['error'] = 'The provided passwords do not match. Please try again.';
			}
			// Store in database
			// Send confirmation email.
		}
		
		$data ['view'] = 'register_view';
		$this->load->vars ( $data );
		$this->load->view ( 'master', $data );
	}
	public function edit($id) {
	}
	public function delete($id) {
	}
	public function activate($id) {
		$this->load->model ( 'admin_model' );
		$result = $this->admin_model->activate ( $id );
		if ($result == "OK") {
			$data ['message'] = "Successfully Activated";
		} else {
			$data ['error'] = $result;
		}
		
		$this->load->view ( 'master', $data );
	}
}
?>