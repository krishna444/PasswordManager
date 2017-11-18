<?php
class Password_model extends CI_Model {
	function getAllPasswords() {
		$query = $this->db->get ( 'passwords' );
		return $query->result ();
	}
	function getAll($userId) {
		$this->db->where ( 'user_id', $userId );
		$query = $this->db->get ( 'passwords' );
		return $query->result ();
	}
	function getPassword($id) {
		$query = $this->db->where ( 'id', $id )->get ( 'passwords' );
		if ($query->num_rows > 0) {
			return $query->row ();
		}
		return false;
	}
	function updatePassword($id, $data) {
		$message = "";
		$this->db->where ( 'id', $id );
		$result = $this->db->update ( 'passwords', $data );
		if ($result) {
			$message = "OK";
		} else {
			$message = "Could not update your password information. Please, consult your administrator.";
		}
		return $message;
	}
	function deletePassword($id) {
		$message = "";
		$this->db->where ( 'id', $id );
		$result = $this->db->delete ( 'passwords' );
		if ($result) {
			$message = "OK";
		} else {
			$message = "Could not delete your password information. Please consult your administrator.";
		}
		return $message;
	}
	function insertPassword($data) {
		$message = "";
		$result = $this->db->insert ( 'passwords', $data );
		if ($result) {
			$message = "OK";
		} else {
			$message = "Could not update your password information. Please, consult your administrator.";
		}
		return $message;
	}
}

?>