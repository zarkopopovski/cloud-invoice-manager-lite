<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("MAX_PASSWORD_SIZE", 8);
define("OPERATION_PLUS", 0);
define("OPERATION_MINUS", 1);

class User_Model extends CI_Model {
	
	//var $userHash = "";
	var $magicKey = "Un!@73Pa77v0R5";

	var $email = "";
	var $password = "";
	var $userType = "";
	var $loginType = "";
	var $fullName = "";
	var $currencyId = 0;

	function __construct() {
		parent::__construct();
	}

	public function saveUserAccount($userJSONDataObject) {

		$this->email = $userJSONDataObject["email"];
		$this->password = $userJSONDataObject["password"];
		$this->userType = $userJSONDataObject["userType"];
		$this->userStatus = $userJSONDataObject["userStatus"];

		$parentID = FALSE;

		$userHash = sha1(rand(100,999).$this->email.$this->magicKey.$this->password.rand(100,999));

		if (!$this->checkExistingUserByEmail($this->email)) {

			$q = "";

			if ($parentID) {
				$q = "INSERT INTO credentials(id, parent_id, email, password, type, status, deleted, data_created, data_modified) 
			VALUES('".$userHash."','".$parentID."','".$this->email."','".sha1($this->password)."','".$this->userType."','".$this->userStatus."', 0, NOW(), NOW())";
			} else {
				$q = "INSERT INTO credentials(id, email, password, type, status, deleted, data_created, data_modified) 
			VALUES('".$userHash."','".$this->email."','".sha1($this->password)."','".$this->userType."','".$this->userStatus."', 0, NOW(), NOW())";
			}
					
			$res = $this->db->query($q);

			if (!$res) {
				return FALSE;
			}

			$settingsQuery = "INSERT INTO customer_settings(credentials_id, default_currency, default_language, tax_visible, deleted, date_created, date_modified)
							VALUES('".$userHash."','USD',0,0,0,NOW(),NOW())";

			$res2 = $this->db->query($settingsQuery);

			if (!$res2) {
				return FALSE;
			}

			return $userHash;

		} 

		return FALSE;

	}

	public function removeUserByID($userHash) {

		$q = "UPDATE credentials SET deleted=1 WHERE id='"+$userHash+"'";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return TRUE;

	}

	public function findUserCredentialsByEmailAndPass($email, $password) {

		$q = $this->db->query("SELECT id, email, password, type FROM credentials  
			WHERE email='".$email."' AND password='".sha1($password)."' AND deleted=0 AND status='ENABLE' ");

		if (!$q || $q->num_rows() == 0) {
			return FALSE;
		}

		return $q->row();

	}

	public function findUserByCredentials($email, $password) {

		$q = "SELECT u.id, u.email, u.type FROM credentials u 
			WHERE u.email='".$email."' AND u.password='".sha1($password)."'";
		
		$res = $this->db->query($q);

		$data = FALSE;

		if ($res && $res->num_rows() > 0) {
			$row = $res->row();

			$data = array("token"=>$row->id);	
		}

		return $data;

	}

	public function findAllCustomers() {

		$q = "SELECT id, full_name FROM credentials WHERE type='CUSTOMER'";

		$res = $this->db->query($q);

		$data = FALSE;

		if ($res && $res->num_rows() > 0) {

			$data = array();
			
			foreach ($res->result() as $row) {

				$data[] = array("id"=>$row->id, "name"=>$row->full_name);

			}

		}

	}

	public function checkExistingUserByEmail($email) {

		$q = $this->db->query("SELECT id FROM credentials WHERE email='".$email."'");

		if (!$q || $q->num_rows() == 0) {
			return FALSE;
		}

		return TRUE;

	}

	public function checkExistingUserByEmailAndReturnID($email) {

		$q = $this->db->query("SELECT id FROM credentials WHERE email='".$email."'");

		if (!$q || $q->num_rows() == 0) {
			return FALSE;
		}

		$row = $q->row();

		return $row->id;

	}

	public function checkExistingUserByHash($userHash) {

		$q = $this->db->query("SELECT email FROM credentials WHERE id='".$userHash."'");

		if (!$q || $q->num_rows() == 0) {
			return FALSE;
		}

		return array("email"=>$q->row()->email);

	}

	public function createRandomPassword($maxNumber) {

	    $chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

	    srand((double)microtime()*1000000);

	    $i = 0;

	    $pass = '' ;

	    while ($i <= $maxNumber) {

	        $num = rand() % 33;

	        $tmp = substr($chars, $num, 1);

	        $pass = $pass . $tmp;

	        $i++;

	    }

	    return $pass;

	}

}


?>