<?php
class Admin_model extends CI_Model {
	function __construct() {
	}
	public function verify_user($email, $password) {
		$q = $this->db->where ( 'email_address', $email )->where ( 'password', sha1 ( $password ) )->where('activated',1)->limit ( 1 )->get ( 'users' );
		
		if ($q->num_rows > 0) {
			return $q->row ();
		}
		return false;
	}
	public function add_user($email, $password, $first_name, $last_name) {
		$created_date = date ( "Y-m-d H:i:s" );
		$updated_date = '0000-00-00 00:00:00';
		$data = array (
				'email_address' => $email,
				'password' => sha1 ( $password ),
				'first_name' => $first_name,
				'last_name' => $last_name,
				'created_at' => $created_date,
				'updated_at' => $updated_date,
				'activated' => FALSE 
		);
		$result = $this->db->insert ( 'users', $data );
		if ($result) {
			return mysql_insert_id ();
		}
		return false;
	}
	
	public function getId($email){
		$query=$this->db->where('email_address',$email)->get('users');
		if($query->num_rows>0){			
			return $query->row()->id;
		}
		return false;
	}
	
	public function emailExists($email) {
		$query = $this->db->where ( 'email_address', $email )->get ( 'users' );
		return $query->num_rows > 0;
	}
	public function accountExists($id) {
		$query = $this->db->where ( 'id', $id )->get ( 'users' );
		return $query->num_rows > 0;
	}
	public function getAccount($id) {
		$query = $this->db->where ( 'id', $id )->get ( 'users' );
		if ($query->num_rows > 0) {
			return $query->row ();
		}
		return false;
	}
	public function activate($id) {
		// check if already activated
		if (! $this->accountExists ( $id )) {
			$message = "Account does not exist";
		} else {
			$user = $this->getAccount ( $id );			
			if ($user->activated) {
				$message = "Account already activated. You can login now.";
			} else {
				// Activation state
				$updated_date = date ( "Y-m-d H:i:s" );
				$data = array (
						'updated_at' => $updated_date,
						'activated' => TRUE 
				);
				$this->db->where ( 'id', $id );
				$result = $this->db->update ( 'users', $data );
				if ($result) {
					$message = "OK";
				} else {
					$message = "Problem while activating database. Ask your administrator.";
				}
			}
		}
		
		return $message;
	}
}

