<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Passwords extends CI_Controller {
	private $fromAddress = "pm.service4u@gmail.com";
	public function __construct() {
		session_start();
		parent::__construct();

		if (!isset($_SESSION['username'])) {
			redirect('admin');
		}
		$this -> load -> library('encrypt');
		$this -> encrypt -> set_cipher(MCRYPT_RIJNDAEL_256);
	}

	public function index() {
		$this -> load -> model('password_model');
		$this -> load -> model('admin_model');
		$userId = $this -> admin_model -> getId($_SESSION['username']);
		$data['result'] = $this -> password_model -> getAll($userId);
		$data['view'] = 'passwords_view';
		$this -> load -> vars($data);
		$this -> load -> view('master', $data);
	}

	public function delete($id) {
		$this -> load -> model('password_model');
		$retuls = $this -> password_model -> deletePassword($id);
		if ($result == "OK") {
			$data['message'] = "Successfully deleted!";
		} else {
			$data['message'] = $message;
		}
		redirect('passwords');
	}

	public function edit($id) {
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('service', 'Service', 'trim|required');
		$this -> form_validation -> set_rules('user_name', 'User Name', 'trim|required');
		$this -> form_validation -> set_rules('password', 'Password', 'trim|min_length[4]');
		$this -> form_validation -> set_rules('remarks', 'Ramarks', 'trim');

		$this -> load -> model('password_model');
		if ($this -> form_validation -> run() != false) {
			$data = array();
			if ($this -> input -> post('password') == '') {
				$data = array('service' => $this -> input -> post('service'), 'user_name' => $this -> input -> post('user_name'), 'remarks' => $this -> input -> post('remarks'), 'updated_at' => date("Y-m-d H:i:s"));
			} else {
				$data = array('service' => $this -> input -> post('service'), 'user_name' => $this -> input -> post('user_name'), 'password' => $this -> encrypt -> encode($this -> input -> post('password'), $_SESSION['key']), 'remarks' => $this -> input -> post('remarks'), 'updated_at' => date("Y-m-d H:i:s"));
			}

			$result = $this -> password_model -> updatePassword($id, $data);

			if ($result == "OK") {
				$data['message'] = "Successfully updated!";
				redirect('passwords');
			} else {
				$data['error'] = "Could not udpate your information. Please, consult your administrator!";
			}
		}

		$password = $this -> password_model -> getPassword($id);
		$data['password'] = $password;
		$data['decrypted_password'] = $this -> encrypt -> decode($password -> password, $_SESSION['key']);
		$data['view'] = 'password_edit_view';
		$this -> load -> vars($data);
		$this -> load -> view('master', $data);
	}

	public function create() {
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('service', 'Service', 'trim|required');
		$this -> form_validation -> set_rules('user_name', 'User Name', 'trim|required');
		$this -> form_validation -> set_rules('password', 'Password', 'trim|reduired|min_length[4]');
		$this -> form_validation -> set_rules('remarks', 'Ramarks', 'trim');

		$this -> load -> model('password_model');
		if ($this -> form_validation -> run() != false) {
			$this -> load -> model('admin_model');
			$userId = $this -> admin_model -> getId($_SESSION['username']);
			$data = array('user_id' => $userId, 'service' => $this -> input -> post('service'), 'user_name' => $this -> input -> post('user_name'), 'password' => $this -> encrypt -> encode($this -> input -> post('password'), $_SESSION['key']), 'remarks' => $this -> input -> post('remarks'), 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => '0000-00-00 00:00:00');
			$result = $this -> password_model -> insertPassword($data);
			if ($result == "OK") {
				$data['message'] = "Successfully added!";
				redirect('passwords');
			} else {
				$data['error'] = "Could not udpate your information. Please, consult your administrator!";
			}
		}

		$data['view'] = 'password_add_view';
		$this -> load -> vars($data);
		$this -> load -> view('master', $data);
	}

	public function send($id) {
		$this -> load -> library('email');
		$this -> email -> from($this -> fromAddress);
		$this -> load -> model('password_model');
		$password = $this -> password_model -> getPassword($id);

		if ($password != false) {
			$this -> email -> to($_SESSION['username']);
			$this -> email -> subject("Secret: Your password is here.");
			$this -> email -> message("<b>Dear " . $_SESSION['username'] . ",</b><br><br>Upon your request, we have sent you the password information as follows:
					<br><br><b>Service:</b>" . $password -> service . "<br><b>User Name:</b>" . $password -> user_name . 
					"<br><b>Password:</b><font size='5' color='#ffffff'>" . $this -> encrypt -> decode($password -> password, $_SESSION['key']) . 
					"</font><br><br><br>Thanks<br><br><strong>Password Manager Team<strong>");
			$result = $this -> email -> send();
			if (!$result) {
				$data['error'] = "Email sending is NOT success! Please consult your administrator.";
			} else {
				$data['message'] = 'Your password is successfully send. Please check your email.';
			}
		} else {
			$data['error'] = "Unknown Error. Seems like you data does not exist in our server.";
		}

		$this -> load -> model('admin_model');
		$userId = $this -> admin_model -> getId($_SESSION['username']);
		$data['result'] = $this -> password_model -> getAll($userId);
		$data['view'] = 'passwords_view';
		$this -> load -> vars($data);
		$this -> load -> view('master', $data);
	}

	private function encrypt($message) {
		return $this -> encrypt -> encode($message, $_SESSION['key']);
	}

	public function viewXml() {
	}

	/**
	 * Test function for email
	 */
	public function sendTestEmail() {
		$message = 'Thisi sitest';
		$this -> load -> library('email');
		$this -> email -> set_newline("\r\n");
		$this -> email -> from('pm.serssfasdvice4u@gmail.com');
		// change it to yours
		$this -> email -> to('krishna444@gmail.com');
		// change it to yours
		$this -> email -> subject('Resume from JobsBuddy for your Job posting');
		$this -> email -> message($message);
		if ($this -> email -> send()) {
			echo 'Email sent.';
		} else {
			show_error($this -> email -> print_debugger());
		}
	}

}
