<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("MAX_PASSWORD_SIZE_", 8);
define('ADD_QUANTITY', 0);
define('DEL_QUANTITY', 1);



class Customer_Model extends CI_Model {
	

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

	public function saveCustomerProfile($userHash, $userJSONDataObject) {

		$first_name = $userJSONDataObject["first_name"];
		$last_name = $userJSONDataObject["last_name"];
		$tel1 = $userJSONDataObject["tel1"];
		$tel2 = $userJSONDataObject["tel2"];

		$query = "SELECT credentials_id FROM customer_profile WHERE credentials_id = '".$userHash."';";

		$test = $this->db->query($query);


		if(!$test || $test->num_rows() == 0){
					
			$q = "INSERT INTO customer_profile(credentials_id, first_name, last_name, tel1, tel2, data_created, data_modified) 
			VALUES('".$userHash."','".$first_name."','".$last_name."','".$tel1."','".$tel2."',NOW(), NOW())";

			$res = $this->db->query($q);

			if (!$res) {
				return FALSE;
			}

			return $userHash;
		} else {

			$q = "UPDATE customer_profile SET first_name='".$first_name."', last_name='".$last_name."', tel1='".$tel1."', tel2='".$tel2."', data_modified= NOW() WHERE credentials_id = '".$userHash."';";

			$res = $this->db->query($q);

			if (!$res) {
				return FALSE;
			}

			return $userHash;

		}

	}

	public function saveCompanyProfile($userHash, $userJSONDataObject) {

		$address = $userJSONDataObject["address"];
		$address2 = $userJSONDataObject["address2"];
		$city = $userJSONDataObject["city"];
		$zip = $userJSONDataObject["zip"];
		$country = $userJSONDataObject["country"];
		$tel1 = $userJSONDataObject["tel1"];
		$tel2 = $userJSONDataObject["tel2"];
		$company_name = $userJSONDataObject['company_name'];
		$registration_number = $userJSONDataObject['registration_number'];
		$unique_number = $userJSONDataObject['unique_number'];
		$tax_number = $userJSONDataObject['tax_number'];
		$iban_code = $userJSONDataObject['iban_code'];
		$bank_name = $userJSONDataObject['bank_name'];
		$bank_address = $userJSONDataObject['bank_address'];
		$bank_account = $userJSONDataObject['bank_account'];
		$swift = $userJSONDataObject['swift'];
		$companyLogo = ((isset($userJSONDataObject['company_logo']))?$userJSONDataObject['company_logo']:FALSE);

		//die(var_dump($userJSONDataObject));

		$query = "SELECT id FROM customer_company_profile WHERE credentials_id = '".$userHash."';";

		$test = $this->db->query($query);


		if(!$test || $test->num_rows() == 0){

			$companyID = sha1(time().rand(999,9999).$userHash.$company_name.rand(999,9999));
			$q = FALSE;

			if ($companyLogo) {
				$q = "INSERT INTO customer_company_profile(id, credentials_id, company_name, address, address2, city, zip, country, tel1, tel2, iban_code, bank_name, registration_number, unique_number, tax_number, bank_address, bank_account, swift, company_logo, data_created, data_modified) 
			VALUES('".$companyID."','".$userHash."','".$company_name."','".$address."','".$address2."','".$city."','".$zip."','".$country."','".$tel1."','".$tel2."', '".$registration_number."','".$unique_number."','".$tax_number."','".$iban_code."', '".$bank_name."', '".$bank_address."', '".$bank_account."', '".$swift."','".$companyLogo."',NOW(), NOW())";	
			} else {
				$q = "INSERT INTO customer_company_profile(id, credentials_id, company_name, address, address2, city, zip, country, tel1, tel2, iban_code, bank_name, registration_number, unique_number, tax_number, bank_address, bank_account, swift, data_created, data_modified) 
			VALUES('".$companyID."','".$userHash."','".$company_name."','".$address."','".$address2."','".$city."','".$zip."','".$country."','".$tel1."','".$tel2."', '".$registration_number."','".$unique_number."','".$tax_number."','".$iban_code."', '".$bank_name."', '".$bank_address."', '".$bank_account."', '".$swift."',NOW(), NOW())";	
			}	

			$res = $this->db->query($q);

			if (!$res) {
				return FALSE;
			}

			return $companyID;
		} else {

			$row = $test->row();

			$q = FALSE;

			if ($companyLogo) {
				$q = "UPDATE customer_company_profile SET company_name='".$company_name."', address='".$address."', address2='".$address2."', city='".$city."', zip='".$zip."', country='".$country."', tel1='".$tel1."', tel2='".$tel2."', iban_code='".$iban_code."', bank_name='".$bank_name."', registration_number='".$registration_number."', unique_number='".$unique_number."', tax_number='".$tax_number."', bank_address='".$bank_address."', bank_account='".$bank_account."', swift='".$swift."', company_logo='".$companyLogo."', data_created= NOW(), data_modified= NOW() WHERE id='".$row->id."' AND credentials_id = '".$userHash."';";
			} else {
				$q = "UPDATE customer_company_profile SET company_name='".$company_name."', address='".$address."', address2='".$address2."', city='".$city."', zip='".$zip."', country='".$country."', tel1='".$tel1."', tel2='".$tel2."', iban_code='".$iban_code."', bank_name='".$bank_name."', registration_number='".$registration_number."', unique_number='".$unique_number."', tax_number='".$tax_number."', bank_address='".$bank_address."', bank_account='".$bank_account."', swift='".$swift."', data_created= NOW(), data_modified= NOW() WHERE id='".$row->id."' AND credentials_id = '".$userHash."';";
			}

			$res = $this->db->query($q);

			if (!$res) {
				return FALSE;
			}

			return $row->id;

		}

	}

	public function getCompanyProfileData($userHash) {

		$query = "SELECT * FROM customer_company_profile WHERE credentials_id = '".$userHash."'; ";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();
   			
      		$resultsAll = array(
      						"company_id" => $row->id,	
							"company_name" => $row->company_name,
      						"address" => $row->address, 
      						"address2" => $row->address2, 
      						"city" => $row->city, 
      						"zip" => $row->zip, 
      						"country" => $row->country, 
      						"tel1" => $row->tel1,  
      						"tel2" => $row->tel2, 
      						"registration_number" => $row->registration_number, 
      						"unique_number" => $row->unique_number,
      						"tax_number" => $row->tax_number, 
      						"iban_code" => $row->iban_code, 
      						"bank_name" => $row->bank_name, 
      						"bank_address" => $row->bank_address, 
      						"bank_account" => $row->bank_account,
      						"swift" => $row->swift,
      						"company_logo" => $row->company_logo);
      			
		}

		return $resultsAll;

	}

	public function getProfileData($userHash) {

		$query = "SELECT first_name,last_name,tel1,tel2 FROM customer_profile WHERE credentials_id = '".$userHash."'; ";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();
   			
      		$resultsAll = array(
      						"first_name" => $row->first_name, 
      						"last_name" => $row->last_name, 
      						"tel1" => $row->tel1,  
      						"tel2" => $row->tel2);
      			
		}

		return $resultsAll;

	}

	public function getProfileDataWithCredentials($userHash) {


		$query = "SELECT c.email,cp.*, ccp.* FROM credentials c RIGHT JOIN customer_profile cp ON
		c.id = '".$userHash."' AND c.id=cp.credentials_id 
		INNER JOIN customer_company_profile ccp
		ON c.id=ccp.credentials_id; ";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();
   			
      		$resultsAll = array("email"=>$row->email, "first_name" => $row->first_name, "last_name" => $row->last_name, "address" => $row->address, "address2" => $row->address2, "city" => $row->city, "zip" => $row->zip, "country" => $row->country, "tel1" => $row->tel1,  "tel2" => $row->tel2, "company_name" => $row->company_name, "registration_number" => $row->registration_number, "iban_code" => $row->iban_code, "bank_name" => $row->bank_name, "bank_address" => $row->bank_address, "swift" => $row->swift );

      			
		}

		return $resultsAll;


	}

	public function getCategories($userHash, $companyID) {

		$query = "SELECT * FROM product_category WHERE deleted = '0' AND company_id = '".$companyID."'";
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array("id" => $row->id, "credentials_id" => $row->credentials_id, "name" => $row->name, "description" => $row->description);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;
	}

	public function getCategoriesName($userHash, $companyID) {

		$query = "SELECT id, name FROM product_category WHERE deleted = '0' AND company_id = '".$companyID."'";
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array("id" => $row->id, "name" => $row->name);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;

	}

	public function getCategoryByID($categoryID) {

		$query = "SELECT id, name FROM product_category WHERE deleted = '0' AND id = '".$categoryID."'";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet && $resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();

			$resultsAll = array("id" => $row->id, "name" => $row->name);
		}

		return $resultsAll;

	}

	public function addCategory($userJSONDataObject) {

		$this->name = $userJSONDataObject["name"];
		$this->description = $userJSONDataObject["description"];
	
		$userHash = $userJSONDataObject["userHash"];
		$companyID = $userJSONDataObject["company_id"];

		$categoryID = sha1(rand(100,999).$this->name.$this->magicKey.$this->description.rand(100,999));

							
		$q = "INSERT INTO product_category(id, credentials_id, company_id, name, description, deleted, date_created, date_modified) 
		VALUES('".$categoryID."', '".$userHash."','".$companyID."','".$this->name."','".$this->description."','0', NOW(), NOW())";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $userHash;

	}

	public function deleteCategory($id) {

		$q = "UPDATE product_category SET deleted='1' WHERE id = '".$id."';";

		$resultSet = $this->db->query($q);

		return $resultSet;
	}

	public function getCategoryForEdit($id) {

		$query = "SELECT * FROM product_category WHERE deleted = '0' AND id = '".$id."' ";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();

      		$resultsAll = array("id" => $row->id, "credentials_id" => $row->credentials_id, "name" => $row->name, "description" => $row->description);

      			
   			
		}

		return $resultsAll;

	}

	public function updateCategory($userJSONDataObject) {

		$name = $userJSONDataObject["name"];
		$description = $userJSONDataObject["description"];
		$id = $userJSONDataObject["id"];
		

		$q = "UPDATE product_category SET name='".$name."', description='".$description."', date_modified=NOW() WHERE id = '".$id."';";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $userHash;

		
	}

	public function addClientGroup($userJSONDataObject) {

		$this->name = $userJSONDataObject["name"];
		$this->description = $userJSONDataObject["description"];
	
		$userHash = $userJSONDataObject["userHash"];
		$companyID = $userJSONDataObject["company_id"];

		$categoryID = sha1(rand(100,999).$this->name.$this->magicKey.$this->description.rand(100,999));

							
		$q = "INSERT INTO clients_groups(id, credentials_id, company_id, group_name, group_description, deleted, date_created, date_modified) 
		VALUES('".$categoryID."', '".$userHash."','".$companyID."','".$this->name."','".$this->description."','0', NOW(), NOW())";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $userHash;

	}

	public function deleteClientGroup($id) {

		$q = "UPDATE clients_groups SET deleted='1' WHERE id = '".$id."';";

		$resultSet = $this->db->query($q);

		return $resultSet;
	}

	public function getClientGroupForEdit($id) {

		$query = "SELECT * FROM clients_groups WHERE deleted = '0' AND id = '".$id."' ";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();

      		$resultsAll = array("id" => $row->id, "credentials_id" => $row->credentials_id, "name" => $row->group_name, "description" => $row->group_description);

      			
   			
		}

		return $resultsAll;

	}

	public function updateClientGroup($userJSONDataObject) {

		$name = $userJSONDataObject["name"];
		$description = $userJSONDataObject["description"];
		$id = $userJSONDataObject["id"];
		

		$q = "UPDATE clients_groups SET group_name='".$name."', group_description='".$description."', date_modified=NOW() WHERE id = '".$id."';";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $userHash;

		
	}

	public function getClientGroups($userHash, $companyID) {

		$query = "SELECT * FROM clients_groups WHERE deleted = '0' AND company_id = '".$companyID."'";
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array("id" => $row->id, "credentials_id" => $row->credentials_id, "name" => $row->group_name, "description" => $row->group_description);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;
	}

	public function getClientGroupName($userHash, $companyID) {

		$query = "SELECT id, group_name FROM clients_groups WHERE deleted = '0' AND company_id = '".$companyID."'";
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array("id" => $row->id, "name" => $row->group_name);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;

	}

	public function getClientGroupByID($categoryID) {

		$query = "SELECT id, group_name FROM clients_groups WHERE deleted = '0' AND id = '".$categoryID."'";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet && $resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();

			$resultsAll = array("id" => $row->id, "name" => $row->group_name);
		}

		return $resultsAll;

	}

	public function addClient($userJSONDataObject, $selfClient = FALSE) {

		$name = $userJSONDataObject["name"];
		$address = $userJSONDataObject["address"];
		$address2 = $userJSONDataObject["address2"];
		$city = $userJSONDataObject["city"];
		$zip = $userJSONDataObject["zip"];
		$country = $userJSONDataObject["country"];
		$email = $userJSONDataObject["email"];
		$tel1 = $userJSONDataObject["tel1"];
		$tel2 = $userJSONDataObject["tel2"];
		$registration_number = $userJSONDataObject["registration_number"];
		$unique_number = $userJSONDataObject["unique_number"];
		$tax_number  = $userJSONDataObject["tax_number"];

		$companyID = $userJSONDataObject["company_id"];

		$clientGroup = $userJSONDataObject["client_group"];

		$userHash = $userJSONDataObject["userHash"];

		$clientID = sha1(rand(100,999).$name.$this->magicKey.$email.rand(100,999));;

		if ($selfClient) {
			$clientID = $companyID;	
		}
							
		$q = "INSERT INTO clients(id, credentials_id, company_id, name, address, address2, city, zip, country, email, tel1, tel2, registration_number, unique_number, tax_number, self_client, deleted, date_created, date_modified) 
		VALUES('".$clientID."', '".$userHash."', '".$companyID."', '".$name."','".$address."','".$address2."',
			'".$city."','".$zip."','".$country."','".$email."','".$tel1."','".$tel2."', '".$registration_number."', '".$unique_number."', '".$tax_number."', '".(($selfClient)?"YES":"NO")."', '0', NOW(), NOW())";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		$groupData = array("userHash"=>$userHash, "company_id"=>$companyID, "client_id"=>$clientID, "client_group"=>$clientGroup);

		$res2 = $this->addClientToGroup($groupData);

		return $userHash;

	}

	public function getClients($userHash, $companyID) {

		$query = "SELECT * FROM clients WHERE deleted = '0' AND company_id = '".$companyID."'";
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array("id" => $row->id, "credentials_id" => $row->credentials_id, "name" => $row->name, "city" => $row->city, "email" => $row->email);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;
	}

	public function deleteClient($id) {

		$q = "UPDATE clients SET deleted='1' WHERE id = '".$id."';";

		$resultSet = $this->db->query($q);

		return $resultSet;
	}

	public function getClientForEdit($id) {

		$query = "SELECT clients.*, cg.id AS cgroup_id, cg.group_name FROM clients INNER JOIN clients_groups cg INNER JOIN clients_in_groups cig 
		ON clients.id=cig.client_id AND cg.id=cig.group_id AND clients.deleted=0 AND clients.id = '".$id."' ";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();

      		$resultsAll = array("id" => $row->id, "credentials_id" => $row->credentials_id, "name" => $row->name, 
      			"address" => $row->address, "address2" => $row->address2, "city" => $row->city, "zip" => $row->zip, 
      			"country" => $row->country, "email" => $row->email, "tel1" => $row->tel1, "tel2" => $row->tel2,
      			"registration_number" => $row->registration_number, "unique_number" =>$row->unique_number, "tax_number" =>$row->tax_number,
      			"group_id"=>$row->cgroup_id, "group_name"=>$row->group_name);

      			
   			
		}

		return $resultsAll;

	}

	public function updateClient($userJSONDataObject) {

		$id = $userJSONDataObject["id"];
		$name = $userJSONDataObject["name"];
		$address = $userJSONDataObject["address"];
		$address2 = $userJSONDataObject["address2"];
		$city = $userJSONDataObject["city"];
		$zip = $userJSONDataObject["zip"];
		$country = $userJSONDataObject["country"];
		$email = $userJSONDataObject["email"];
		$tel1 = $userJSONDataObject["tel1"];
		$tel2 = $userJSONDataObject["tel2"];
		$registration_number = $userJSONDataObject["registration_number"];
		$unique_number = $userJSONDataObject["unique_number"];
		$tax_number  = $userJSONDataObject["tax_number"];

		$userHash = $userJSONDataObject["userHash"];
		$companyID = $userJSONDataObject["company_id"];
		$clientGroup = $userJSONDataObject["client_group"];

		$q = "UPDATE clients SET name='".$name."', address='".$address."', address2='".$address2."', city='".$city."', 
		zip='".$zip."', country='".$country."', email='".$email."', tel1='".$tel1."', tel2='".$tel2."', 
		registration_number='".$registration_number."', unique_number='".$unique_number."', tax_number='".$tax_number."',date_modified=NOW() WHERE id = '".$id."';";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		if ($clientGroup) {
			$groupData = array("userHash"=>$userHash, "company_id"=>$companyID, "client_id"=>$id, "client_group"=>$clientGroup);

			$res2 = $this->addClientToGroup($groupData);
		}

		return $userHash;

	}

	public function addClientToGroup($groupData) {

		$userHash = $groupData["userHash"];
		$companyID = $groupData["company_id"];
		$clientID = $groupData["client_id"];
		$groupID = $groupData["client_group"];

		$groupRecordID = sha1(rand(1000,9999).time().$userHash.$companyID.$clientID.$groupID);

		$q = "INSERT INTO clients_in_groups VALUES('".$groupRecordID."','".$userHash."','".$companyID."','".$clientID."','".$groupID."',0,NOW(), NOW())";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return TRUE;

	}

	public function getLastClientGroup($queryData) {

		$clientID = $queryData["client_id"];
		$companyID = $queryData["company_id"];

		$query = "SELECT cg.id, cg.group_name FROM clients_groups cg INNER JOIN clients_in_groups cig ON cg.id=cig.group_id 
		AND cig.company_id = '".$companyID."' AND cig.client_id='".$clientID."' ORDER BY cig.date_created DESC LIMIT 1";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();

      		$resultsAll = array("id" => $row->id, "name" => $row->group_name);
      				
		}

		return $resultsAll;

	}

	public function addProducts($userJSONDataObject) {

		$userHash = $userJSONDataObject["userHash"];
		$name = $userJSONDataObject["name"];
		$product_code = $userJSONDataObject["product_code"];
		$description = $userJSONDataObject["description"];
		$category_id = $userJSONDataObject["category_id"];
		$tax = $userJSONDataObject["tax"];
		$unit = $userJSONDataObject["unit"];

		$inputPrice = $userJSONDataObject["input_price"];
		$outputPrice = $userJSONDataObject["output_price"];

		$companyID = $userJSONDataObject["company_id"];

		$isManageable = $userJSONDataObject["manageable"];

		$productsID = sha1(rand(100,999).$name.$this->magicKey.$description.rand(100,999));

		$productsPriceID = sha1(rand(100,999).$productsID.$this->magicKey.$inputPrice.$outputPrice.rand(100,999));

							
		$q = "INSERT INTO products(id, credentials_id, company_id, name, product_code, description, category_id, tax, unit, input_price, output_price, current_price_id, deleted, date_created, date_modified) 
		VALUES('".$productsID."', '".$userHash."', '".$companyID."', '".$name."', '".$product_code."', '".$description."', '".$category_id."', '".$tax."', '".$unit."','".$inputPrice."','".$outputPrice."','".$productsPriceID."', 0, NOW(), NOW())";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return array("productID"=>$productsID, "productsPriceID"=>$productsPriceID);

	}
	
	public function addProductsPrice($userJSONDataObject) {

		$userHash = $userJSONDataObject["userHash"];
		$product_id = $userJSONDataObject["product_id"];
		$input_price = $userJSONDataObject["input_price"];
		$output_price = $userJSONDataObject["output_price"];
		$tax = $userJSONDataObject["tax"];
		$productsPriceID = $userJSONDataObject["product_price_id"];

		$companyID = $userJSONDataObject["company_id"];
				
		if (!$productsPriceID) {
			$productsPriceID = sha1(rand(100,999).$product_id.$this->magicKey.$input_price.$output_price.$tax.rand(100,999));	
		}
							
		$q = "INSERT INTO products_price(id, credentials_id, company_id, product_id, input_price, output_price, tax, deleted, date_created, date_modified) 
		VALUES('".$productsPriceID."', '".$userHash."', '".$companyID."', '".$product_id."', '".$input_price."', '".$output_price."', '".$tax."', 0, NOW(), NOW())";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $userHash;

	}

	public function getProducts($companyID) {

		$query = "SELECT products.id, products.name AS product_name, products.product_code, products.description, products.product_type_id, products.input_price, products.output_price, products.current_price_id AS price_id,
		products.category_id, products.tax, products.unit, product_category.name AS category_name 
		FROM products 
		INNER JOIN product_category 
		ON products.category_id=product_category.id 
		AND products.credentials_id = product_category.credentials_id 
		AND products.deleted = 0 
		AND products.company_id = '".$companyID."';";
		
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
  			$newRow = array(
  						"id" => $row->id, 
  						"product_name" => $row->product_name, 
  						"product_code" => $row->product_code, 
  						"description" => $row->description, 
  						"product_type_id" =>$row->product_type_id, 
  						"price_id" => $row->price_id, 
  						"input_price" => $row->input_price, 
  						"output_price" => $row->output_price, 
  						"category_id" => $row->category_id, 
  						"tax" => $row->tax, 
  						"unit" => $row->unit, 
  						"category_name" => $row->category_name);
		
  			$resultsAll[] = $newRow;
   			}

		}

		return $resultsAll;
	}

	public function deleteProducts($id) {

		$q = "UPDATE products SET deleted=1 WHERE id='".$id."';";

		$resultSet = $this->db->query($q);

		return $resultSet;
	}

	public function getProductsForEdit($id) {

		$query = "SELECT p.* FROM products p WHERE id='".$id."';";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();

      		$resultsAll = array(
      						"id" => $row->id, 
      						"name" => $row->name, 
      						"product_code" => $row->product_code, 
      						"description" => $row->description, 
      						"product_type_id" =>$row->product_type_id, 
      						"input_price" => $row->input_price, 
      						"output_price" => $row->output_price, 
      						"category_id" => $row->category_id, 
      						"tax" => $row->tax, 
      						"unit" => $row->unit);

		}

		return $resultsAll;

	}

	public function updateProducts($userJSONDataObject) {

		$userHash = $userJSONDataObject["userHash"];
		$product_id = $userJSONDataObject["product_id"];
		$name = $userJSONDataObject["name"];
		$product_code = $userJSONDataObject["product_code"];
		$description = $userJSONDataObject["description"];
		$category_id = $userJSONDataObject["category_id"];
		$tax = $userJSONDataObject["tax"];
		$unit = $userJSONDataObject["unit"];

		$inputPrice = $userJSONDataObject["input_price"];
		$outputPrice = $userJSONDataObject["output_price"];
		
		$productsPriceID = FALSE;
		$q = "UPDATE products SET name='".$name."', product_code='".$product_code."', description='".$description."', category_id='".$category_id."', unit='".$unit."',date_modified=NOW() WHERE id='".$product_id."' ;";

		if ((is_bool($outputPrice) && $outputPrice != FALSE) || (!is_bool($outputPrice) && $outputPrice >= 0)) {
			$productsPriceID = sha1(rand(100,999).$product_id.$this->magicKey.$inputPrice.$outputPrice.rand(100,999));
			$q = "UPDATE products SET name='".$name."', product_code='".$product_code."', description='".$description."', category_id='".$category_id."', tax='".$tax."', unit='".$unit."', input_price='".$inputPrice."', output_price='".$outputPrice."', current_price_id='".$productsPriceID."', date_modified=NOW() WHERE id='".$product_id."' ;";
		}

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return array("productID"=>$product_id, "productsPriceID"=>$productsPriceID);

	}

	public function saveInvoice($userJSONDataObject) {

		$clientId = $userJSONDataObject["client_id"];
		$invoiceNumber = $userJSONDataObject["invoiceNumber"];
		$dueDate = $userJSONDataObject["dueDate"];
		$userHash = $userJSONDataObject["userHash"];
		$invoice_sum = $userJSONDataObject['invoice_sum'];
		$invoice_tax_sum = $userJSONDataObject["invoice_tax_sum"];
		$invoice_subtotal = $userJSONDataObject["invoice_subtotal"];
		$comment = $userJSONDataObject["comment"];
		$invoice_type = $userJSONDataObject["invoice_type"];
		$shopID = $userJSONDataObject["shop_id"];

		$inventoryID = $userJSONDataObject["inventory_id"];

		$companyID = $userJSONDataObject["company_id"];

		$taxVisible = $userJSONDataObject["tax_visible"];
		$taxCalculate = $userJSONDataObject["tax_calculate"];
		
		$invoiceID = sha1(rand(100,999).$clientId.$this->magicKey.$invoiceNumber.rand(100,999));

		$q = "INSERT INTO invoice(id, credentials_id, company_id, clients_id, location_id, inventory_id, invoice_number, invoice_sum, invoice_tax_sum, invoice_subtotal, due_date, show_tax, calculate_tax, status, store_status, confirmed, comment, invoice_type, imported, deleted, date_created, date_modified) 
		VALUES('".$invoiceID."', '".$userHash."','".$companyID."','".$clientId."','".$shopID."', '".$inventoryID."', '".$invoiceNumber."', '".$invoice_sum."', '".$invoice_tax_sum."', '".$invoice_subtotal."',  '".$dueDate."', ".$taxVisible.", ".$taxCalculate.", 'NOTPAID','STORED','NO', '".$comment."', '".$invoice_type."', 'NO' ,0, NOW(), NOW())";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $invoiceID;

	}

	public function saveInvoiceProducts($userHash, $companyID, $invoicesProducts, $invoiceId, $inventoryID = FALSE) {

		$numberOfProducts = sizeof($invoicesProducts);

	    $res = TRUE;
	    if ($numberOfProducts > 0) {
		    $q = "INSERT INTO invoice_products(id, credentials_id, company_id, invoice_id, product_id, product_price_id, quantity, discount, deleted, date_created, date_modified) VALUES";
		 
		    for($i = 0; $i < $numberOfProducts; $i++) {
			     $product = $invoicesProducts[$i];
			     $productData = $product['product'];
			 
			     $id = sha1(time().rand(1000,9999).$invoiceId.$productData['id']);
			 
			     $q .= "('".$id."','".$userHash."','".$companyID."','".$invoiceId."','".$productData['id']."','".$productData['price_id']."','".$product['quantity']."','".$product['discount']."',0,NOW(),NOW())";
			 
			     if ($i < ($numberOfProducts - 1)) {
			      	$q .= ",";
			     }
		    }

		    $res = $this->db->query($q);
	    }

	   return $res;

	}

	public function getInvoices($companyID) {

		$query = "SELECT invoice.id, invoice.credentials_id, invoice.clients_id, invoice.invoice_number, invoice.invoice_sum, invoice.invoice_tax_sum, invoice.invoice_subtotal, invoice.due_date, invoice.paid_date, invoice.status, invoice.confirmed, invoice.invoice_type, clients.name FROM invoice INNER JOIN clients ON invoice.clients_id = clients.id  AND invoice.company_id = '".$companyID."' AND invoice.deleted = '0';";
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			if($row->invoice_type != 'DELIVERY' && $row->invoice_type != 'RECEIVED'){
	      			$newRow = array("id" => $row->id, "credentials_id" => $row->credentials_id, "invoice_number" => $row->invoice_number, "invoice_sum" => $row->invoice_sum, "invoice_tax_sum" =>$row->invoice_tax_sum, "invoice_subtotal" =>$row->invoice_subtotal, "due_date" => $row->due_date, "paid_date" => $row->paid_date, "status" => $row->status, "confirmed" =>$row->confirmed, "invoice_type" => $row->invoice_type, "name" => $row->name,);

	      			$resultsAll[] = $newRow;
      			}
   			}
		}

		return $resultsAll;

	}

	public function getInvoicesNotPaid($companyID, $invoiceType=FALSE) {

		$query = "";

		if ($invoiceType) {
			$query = "SELECT invoice.id, invoice.credentials_id, invoice.clients_id, invoice.invoice_number, invoice.invoice_sum, invoice.invoice_tax_sum, invoice.invoice_subtotal, invoice.due_date, invoice.paid_date, invoice.status, invoice.invoice_type, clients.name FROM invoice INNER JOIN clients ON invoice.clients_id = clients.id  AND invoice.company_id = '".$companyID."' AND invoice.deleted = '0' AND status = 'NOTPAID' AND invoice_type='".$invoiceType."';";
		} else {
			$query = "SELECT invoice.id, invoice.credentials_id, invoice.clients_id, invoice.invoice_number, invoice.invoice_sum, invoice.invoice_tax_sum, invoice.invoice_subtotal, invoice.due_date, invoice.paid_date, invoice.status, invoice.invoice_type, clients.name FROM invoice INNER JOIN clients ON invoice.clients_id = clients.id  AND invoice.company_id = '".$companyID."' AND invoice.deleted = '0' AND status = 'NOTPAID';";
		}

		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array("id" => $row->id, "credentials_id" => $row->credentials_id, "invoice_number" => $row->invoice_number, "invoice_sum" => $row->invoice_sum, "due_date" => $row->due_date, "invoice_type" => $row->invoice_type, "name" => $row->name,);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;

	}

	//TODO: firstDate and lastDate to be set as function params
	public function getInvoicesCounting($companyID, $credentialsID=FALSE, $dateFrom=FALSE, $dateTO=FALSE) {

		$inNumber = 0;
		$inSumAll = 0;
		$inSumCurrent = 0;

		$inNumPaid = 0;
		$inNumNotPaid = 0;
		$inSumPaid = 0;
		$inSumNotPaid = 0;

		$outNumber = 0;
		$outSumAll = 0;
		$outSumCurrent = 0;

		$outNumPaid = 0;
		$outNumNotPaid = 0;
		$outSumPaid = 0;
		$outSumNotPaid = 0;

		$firstDayUTS = mktime (0, 0, 0, date("m"), 1, date("Y"));
		$lastDayUTS = mktime (0, 0, 0, date("m"), date('t'), date("Y"));

		$firstDay = date("Y-m-d", $firstDayUTS);
		$lastDay = date("Y-m-d", $lastDayUTS);

		$query = FALSE;

		if ($credentialsID) {
			$query = "SELECT id, credentials_id, invoice_sum, invoice_tax_sum, due_date, status, invoice_type, date_created FROM invoice WHERE company_id = '".$companyID."' AND credentials_id = '".$credentialsID."' AND deleted = '0';";
		} else {
			$query = "SELECT id, credentials_id, invoice_sum, invoice_tax_sum, due_date, status, invoice_type, date_created FROM invoice WHERE company_id = '".$companyID."' AND deleted = '0';";
		}

		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
   				
   				if($row->invoice_type == 'OUTPUT' && strtotime($row->date_created) >= strtotime($firstDay) && strtotime($row->date_created) <= strtotime($lastDay)){

   					$outNumber++;
   					$outSumAll+=$row->invoice_sum;   					
   					$outSumCurrent+=$row->invoice_sum;
   					

   					if($row->status == 'PAID'){
   						$outNumPaid++;
   						$outSumPaid+=$row->invoice_sum;
   					} else{
   						$outNumNotPaid++;
   						$outSumNotPaid+=$row->invoice_sum;
   					}

   				}
   			}

   			$resultsAll = array(
   								'inNumber' => $inNumber , 
   								'inSumAll' => $inSumAll , 
   								'outNumber' => $outNumber ,
   								'outSumAll' => $outSumAll ,
   								'inSumCurrent' => $inSumCurrent ,
   								'inNumPaid' => $inNumPaid ,
								'inNumNotPaid' => $inNumNotPaid ,
								'inSumPaid' => $inSumPaid ,
								'inSumNotPaid' => $inSumNotPaid ,
								'outSumCurrent' => $outSumCurrent ,
								'outNumPaid' => $outNumPaid ,
								'outNumNotPaid' => $outNumNotPaid ,
								'outSumPaid' => $outSumPaid ,
								'outSumNotPaid' => $outSumNotPaid 
								);
		}

		return $resultsAll;

	}

	public function getClientInvoices($id, $userHash) {

		$query = "SELECT * FROM invoice WHERE clients_id = '".$id."' AND deleted = '0';";
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array("id" => $row->id, "credentials_id" => $row->credentials_id, "invoice_number" => $row->invoice_number, "invoice_sum" => $row->invoice_sum, "confirmed" => $row->confirmed, "due_date" => $row->due_date, "paid_date" => $row->paid_date, "status" => $row->status);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;

	}

	public function getInvoiceForEdit($id, $userHash) {

		$query = "SELECT invoice.id, invoice.credentials_id, invoice.clients_id, invoice.inventory_id, invoice.invoice_number, invoice.invoice_sum, invoice.invoice_tax_sum, invoice.invoice_subtotal, invoice.due_date, invoice.status, invoice.confirmed, invoice.comment, invoice.invoice_type, invoice.date_created,
		clients.name, clients.address,clients.address2,clients.city,clients.zip,clients.country,clients.email, clients.tel1,clients.tel2 FROM invoice INNER JOIN clients ON invoice.clients_id = clients.id  AND invoice.id = '".$id."';";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();

      		$resultsAll = array(
      						"id" => $row->id, 
      						"credentials_id" => $row->credentials_id, 
      						"clients_id" =>$row->clients_id, 
      						"inventory_id" => $row->inventory_id,
      						"invoice_number" => $row->invoice_number, 
      						"invoice_sum" => $row->invoice_sum, 
      						"invoice_tax_sum" => $row->invoice_tax_sum, 
      						"invoice_subtotal" => $row->invoice_subtotal, 
      						"due_date" =>$row->due_date, 
      						"status" =>$row->status, 
      						"confirmed" => $row->confirmed,
      						"comment" => $row->comment, 
      						"invoice_type" => $row->invoice_type, 
      						"name" =>$row->name,
      						"address" => $row->address,
      						"address2" => $row->address2,
      						"city" => $row->city,
      						"zip" => $row->zip,
      						"country" => $row->country,
      						"email" => $row->email,
      						"tel1" => $row->tel1,
      						"tel2" => $row->tel2,
      						"date_created" => $row->date_created);
   			
		}

		return $resultsAll;

	}

	public function getInvoiceProducts($id, $userHash, $inventoryID = FALSE) {

		$query = "SELECT invoice_products.id, invoice_products.invoice_id, invoice_products.product_id, invoice_products.quantity, invoice_products.discount, products.product_code, products.name, products.description, products_price.tax, products.unit, products_price.input_price, products_price.output_price";

		if ($inventoryID && $inventoryID != "") {
			$query .= ", invp.id AS iproduct_id, invp.quantity AS invp_quantity";			
		}

		$query .= " FROM invoice_products INNER JOIN products ON invoice_products.product_id=products.id AND invoice_products.deleted =0 AND invoice_products.invoice_id = '".$id."' INNER JOIN products_price ON products_price.product_id = invoice_products.product_id AND products_price.id=invoice_products.product_price_id";

		if ($inventoryID && $inventoryID != "") {
			$query .= " INNER JOIN inventory_products invp ON products.id=invp.product_id AND invp.inventory_id='".$inventoryID."'";
		}
		
		$query .= ";";

		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array(
      						"id" => $row->id, 
      						"invoice_id" => $row->invoice_id, 
      						"product_id" => $row->product_id, 
      						"quantity" => $row->quantity, 
      						"discount" => $row->discount, 
      						"product_code" => $row->product_code, 
      						"name" =>$row->name, 
      						"description" =>$row->description, 
      						"tax" => $row->tax, 
      						"unit" => $row->unit,
      						"input_price" => $row->input_price, 
      						"output_price" => $row->output_price);

      			if ($inventoryID) {
      				$newRow["iproduct_id"] = $row->iproduct_id;
      				$newRow["invp_quantity"] = $row->invp_quantity;
      			}

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;

	}

	public function getInputInvoiceData($invoice_id, $userHash) {

		$query = "SELECT ip.id, ip.invoice_id, ip.product_id, ip.quantity, ip.discount, p.product_code, p.name, p.input_price, p.tax, p.unit 
		FROM invoice_products ip INNER JOIN products p 
		ON ip.product_id=p.id AND ip.deleted=0 AND ip.invoice_id = '".$invoice_id."';";
		
		$resultSet = $this->db->query($query);


		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array(
      						"id" => $row->id, 
      						"invoice_id" => $row->invoice_id, 
      						"product_id" => $row->product_id, 
      						"quantity" => $row->quantity, 
      						"discount" => $row->discount, 
      						"product_code" =>$row->product_code, 
      						"name" =>$row->name,  
      						"input_price" => $row->input_price,
      						"tax" => $row->tax, 
      						"unit" =>$row->unit);

      			$resultsAll[] = $newRow;
   			}
		}


		return $resultsAll;

	}

	public function deleteInvoiceProduct($id, $userHash) {

		$q = "UPDATE invoice_products SET deleted=1 WHERE id = '".$id."';";

		$resultSet = $this->db->query($q);

		return $resultSet;

	}

	public function updateInvoice($userJSONDataObject) {

		$clientId = $userJSONDataObject["clientId"];
		$invoiceNumber = $userJSONDataObject["invoiceNumber"];
		$due_date = $userJSONDataObject["dueDate"];
		$userHash = $userJSONDataObject["userHash"];
		$invoice_sum = $userJSONDataObject['invoice_sum'];
		$invoiceID = $userJSONDataObject["invoiceID"];
		$comment = $userJSONDataObject["comment"];
		$confirmed = $userJSONDataObject["confirmed"];
		$subTotal = $userJSONDataObject["subTotal"];

		$q = "UPDATE invoice SET  clients_id='".$clientId."', invoice_sum='".$invoice_sum."', invoice_subtotal='".$subTotal."', due_date='".$due_date."', status='NOTPAID', store_status='STORED', confirmed='".$confirmed."', comment='".$comment."',  deleted='0', date_modified= NOW() WHERE id='".$invoiceID."' AND  credentials_id='".$userHash."' ";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $invoiceID;

	}

	public function updateInvoiceStatus($id, $userHash, $companyID) {

		$q = "UPDATE invoice SET status='PAID',paid_date=NOW(),date_modified=NOW() WHERE id='".$id."'";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $id;

	}

	public function updateInvoiceProduct($userJSONDataObject) {

		//$userHash = $userJSONDataObject["userHash"];
		$companyID = $userJSONDataObject["company_id"];
		$id = $userJSONDataObject['invoiceProductID'];
		$quantity = $userJSONDataObject["newQuantity"];
		$discount = $userJSONDataObject["discount"];

		$q = "UPDATE invoice_products SET quantity=".$quantity.", discount=".$discount." WHERE id='".$id."' AND  company_id='".$companyID."' ";
						
		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $res;

	}

	public function updateInvoiceProductQuantity($userJSONDataObject) {

		//$userHash = $userJSONDataObject["userHash"];
		$companyID = $userJSONDataObject["company_id"];
		$id = $userJSONDataObject['invoiceProductID'];
		$quantity = $userJSONDataObject["newQuantity"];

		$q = "UPDATE invoice_products SET quantity=".$quantity." WHERE id='".$id."' AND  company_id='".$companyID."' ";
						
		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $res;

	}

	public function updateInvoiceProductDiscount($userJSONDataObject) {

		$userHash = $userJSONDataObject["userHash"];
		$id = $userJSONDataObject['invoiceProductID'];
		$discount = $userJSONDataObject["newDiscount"];

		$q = "UPDATE invoice_products SET  discount=".$discount." WHERE id='".$id."' AND  credentials_id='".$userHash."' ";
						
		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $res;

	}

	public function deleteInvoice($id) {

		$q = "UPDATE invoice SET deleted='1' WHERE id = '".$id."';";

		$resultSet = $this->db->query($q);

		return $resultSet;

	}

	public function deleteInvoiceProducts($id) {

		$q = "UPDATE invoice_products SET deleted='1' WHERE invoice_id = '".$id."';";

		$resultSet1 = $this->db->query($q);

		return $resultSet1;

	}

	public function updateSettings($userJSONDataObject) {

		$userHash = $userJSONDataObject["userHash"];
		$default_language = $userJSONDataObject["default_language"];
		$default_currency = $userJSONDataObject["default_currency"];
		$tax_visible = $userJSONDataObject["tax_visible"];
		$tax_calculate = $userJSONDataObject["tax_calculate"];

		$outputInvoiceNo = $userJSONDataObject["output_invoice_no"];
		$outputInvoiceNumberFormat = $userJSONDataObject["output_invoice_no_format"];
		$outputInvoicePrefix = $userJSONDataObject["output_invoice_no_pre"];

		$query = "SELECT credentials_id FROM customer_settings WHERE credentials_id = '".$userHash."';";

		$test = $this->db->query($query);


		if(!$test || $test->num_rows() == 0){
					
			$q = "INSERT INTO customer_settings(credentials_id, default_language, default_currency, tax_visible, tax_calculate, date_created, date_modified) 
			VALUES('".$userHash."','".$default_language."','".$default_currency."',".$tax_visible.", ".$tax_calculate.", NOW(), NOW())";

			$res = $this->db->query($q);

			if (!$res) {
				return FALSE;
			}

			return TRUE;

		} else {

			$q = "UPDATE customer_settings SET default_language='".$default_language."', default_currency='".$default_currency."', 
			output_invoice_number=".$outputInvoiceNo.", output_invoice_number_format='".$outputInvoiceNumberFormat."', output_invoice_number_pre='".$outputInvoicePrefix."',
			tax_visible=".$tax_visible.", tax_calculate=".$tax_calculate.", 
			date_modified= NOW() WHERE credentials_id = '".$userHash."';";

			$res = $this->db->query($q);

			if (!$res) {
				return FALSE;
			}

			return TRUE;

		}

	}

	public function getSettingsData($userHash){


		$query = "SELECT * FROM customer_settings WHERE credentials_id = '".$userHash."'; ";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();
   			
      		$resultsAll = array(
      						"default_language" => $row->default_language, 
      						"default_currency" => $row->default_currency, 
      						"invoice_number" => $row->invoice_number, 
      						"tax_visible" => $row->tax_visible,
      						"tax_calculate" => $row->tax_calculate,
      						"input_invoice_no" => $row->invoice_number,
      						"input_invoice_number_format" => $row->invoice_number_format,
      						"input_invoice_number_pre" => $row->invoice_number_pre,
      						"output_invoice_no" => $row->output_invoice_number,
      						"output_invoice_number_format" => $row->output_invoice_number_format,
      						"output_invoice_number_pre" => $row->output_invoice_number_pre,
      						"draft_invoice_no" => $row->draft_invoice_number,
      						"draft_invoice_number_format" => $row->draft_invoice_number_format,
      						"draft_invoice_number_pre" => $row->draft_invoice_number_pre,
      						"request_no" => $row->request_number,
      						"delivery_note_no" => $row->delivery_note_number,
      						"received_note_no" => $row->received_note_number);

      			
		}

		return $resultsAll;

	}

	public function getInvoiceNumbers($companyID) {

		$query = "SELECT * FROM invoice WHERE invoice_type='INPUT' AND imported='NO' AND deleted = '0' AND company_id = '".$companyID."'";
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array("id" => $row->id, "credentials_id" => $row->credentials_id, "invoice_number" => $row->invoice_number);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;
	}

	public function addClientAddress($userJSONDataObject) {

		$locationID = $userJSONDataObject["loc_id"];
		$clientID = $userJSONDataObject["client_id"];
		$name = $userJSONDataObject["name"];
		$address = $userJSONDataObject["address"];
		$city = $userJSONDataObject["city"];
		$zip = $userJSONDataObject["zip"];
		$tel = $userJSONDataObject["tel"];

		$userHash = $userJSONDataObject["userHash"];
		$companyID = $userJSONDataObject["company_id"];

		$locationID = sha1(rand(100,999).$clientID.$name.$this->magicKey.$address.rand(100,999));
							
		$q = "INSERT INTO shops_locations(id, credentials_id, company_id, type, client_id, name, address, city, zip, tel, deleted, date_created, date_modified) 
		VALUES('".$locationID."', '".$userHash."','".$companyID."', 'CLIENT', '".$clientID."', '".$name."','".$address."', '".$city."', '".$zip."', '".$tel."', 0, NOW(), NOW())";
		
		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return TRUE;

	}

	public function updateClientAddress($userJSONDataObject) {

		$locationID = $userJSONDataObject["loc_id"];
		$clientID = $userJSONDataObject["client_id"];
		$name = $userJSONDataObject["name"];
		$address = $userJSONDataObject["address"];
		$city = $userJSONDataObject["city"];
		$zip = $userJSONDataObject["zip"];
		$tel = $userJSONDataObject["tel"];

		$userHash = $userJSONDataObject["userHash"];
		$companyID = $userJSONDataObject["company_id"];

		$categoryID = sha1(rand(100,999).$name.$this->magicKey.$location.rand(100,999));
							
		$q = "UPDATE shops_locations SET name='".$name."', address='".$address."', city='".$city."', zip='".$zip."', tel='".$tel."', date_modified=NOW() WHERE id='".$locationID."'";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return TRUE;

	}

	public function deleteClientAddress($id) {

		$q = "UPDATE shops_locations SET deleted=1 WHERE id = '".$id."';";

		$resultSet = $this->db->query($q);

		return $resultSet;
	}

	public function getAllClientAddresses($clientID) {

		$query = "SELECT * FROM shops_locations WHERE type='CLIENT' AND deleted = 0 AND client_id = '".$clientID."'";
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array(
      						"id" => $row->id, 
      						"name" => $row->name, 
      						"address" => $row->address,
      						"city" => $row->city,
      						"zip" => $row->zip,
      						"tel" => $row->tel);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;

	}

	public function getClientAddressForEdit($id) {

		$query = "SELECT * FROM shops_locations WHERE deleted = 0 AND id = '".$id."'";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();

      		$resultsAll = array(
      						"id" => $row->id, 
      						"name" => $row->name, 
      						"address" => $row->address,
      						"city" => $row->city,
      						"zip" => $row->zip,
      						"tel" => $row->tel);

		}

		return $resultsAll;

	}

	public function checkProducts($userHash, $id) {

		$query = "SELECT * FROM invoice_products WHERE deleted = '0' AND product_id = '".$id."' LIMIT 1;";
		
		$resultSet = $this->db->query($query);

		if ($resultSet && $resultSet->num_rows() > 0)
		{
   			return TRUE;
   			
		} 
		
		return FALSE;
		
	}

	public function checkClients($userHash, $id) {

		$query = "SELECT * FROM invoice WHERE deleted = '0' AND clients_id = '".$id."' LIMIT 1;";
		
		$resultSet = $this->db->query($query);

		

		if ($resultSet && $resultSet->num_rows() > 0)
		{
   			return TRUE;
   			
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

		$q = "SELECT cr.id, cr.parent_id, cr.full_name, cr.is_child, cr.email, cr.type, cr.status, cr.password, 
		cs.default_language, cs.default_currency, cs.invoice_number, cs.output_invoice_number, 
		cs.draft_invoice_number, cs.invoice_number_format, cs.invoice_number_pre, cs.output_invoice_number_format,
		cs.output_invoice_number_pre, cs.draft_invoice_number_format, cs.draft_invoice_number_pre,
		cs.request_number, cs.delivery_note_number, cs.received_note_number, cs.incoming_order_number, cs.outgoing_order_number, cs.tax_visible, cs.tax_calculate,
		ds.invoice_number AS current_invoice_no, ds.output_invoice_number AS current_output_invoice_no, 
		ds.draft_invoice_number AS current_draft_invoice_no, ds.incoming_order_number AS current_incoming_order_no, 
		ds.outgoing_order_number AS current_outgoing_order_no, ds.delivery_note_number as current_delivery_note_no, 
		ds.received_note_number as current_received_note_no, co.id AS company_id 
		FROM credentials cr INNER JOIN customer_settings cs 
		ON cr.id=cs.credentials_id 
		AND cr.email='".$email."' 
		AND cr.password='".sha1($password)."' 
		LEFT JOIN customer_company_profile co
		ON cr.id=co.credentials_id
		LEFT JOIN documents_stats ds ON
		co.id=ds.company_id
		AND cr.deleted=0 
		AND cr.status='ENABLE' 
		AND cs.deleted=0";
		
		$res = $this->db->query($q);
		
		if (!$res || $res->num_rows() == 0) {
			return FALSE;
		}

		return $res->row();

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

	public function createTempPasswordForUser($userEmail) {

		$randomPassword = $this->createRandomPassword(MAX_PASSWORD_SIZE_);

		$id = sha1(rand(100,999).$userEmail.$randomPassword.time());

		$q = "INSERT INTO users_temp_passwords(id, email, temp_password, valid, date_created, date_modified) 
				VALUES ('".$id."', '".$userEmail."', '".$randomPassword."', 0, NOW(), NOW())";

		if (!$this->checkExistingUserByEmail($userEmail)) {
			return FALSE;
		}

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return $id;

	}

	public function checkTempPasswordRequest($userToken) {

		$q = "SELECT id, email FROM users_temp_passwords WHERE id='".$userToken."'";

		$res = $this->db->query($q);

		$data = FALSE;

		if ($res && $res->num_rows() > 0) {

			$data = array("id"=>$res->row()->id, "email"=>$res->row()->email);
		} 

		return $data;

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

	public function setTempPasswordAsInvalid($hiddenToken) {

		$q = "UPDATE users_temp_passwords SET valid=1 WHERE id='".$hiddenToken."'";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return TRUE;

	}

	public function updateCustomersPasswordByTempID($hiddenToken, $password) {

		$customersEmail = $this->checkTempPasswordRequest($hiddenToken);

		if (!$customersEmail) {
			return FALSE;
		}

		$q = "UPDATE users_credentials SET password='".sha1($password)."' WHERE email='".$customersEmail["email"]."'";

		$tempPasswordInvalidate = $this->setTempPasswordAsInvalid($hiddenToken);

		if (!$tempPasswordInvalidate) {
			return FALSE;
		}

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return TRUE;

	}

	public function createClientRelation($userHash, $clientHash) {

		$relationID = sha1(time().rand(999,9999).$userHash.$clientHash.rand(999,9999));

		$q = "INSERT INTO customer_relations(id, credentials_id, client_credentials_id, related, deleted, date_created, date_modified) VALUE('".$relationID."','".$userHash."','".$clientHash."','YES',0,NOW(),NOW());";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return TRUE;

	}

	public function removeClientRelation($relationID) {

		$q = "UPDATE customer_relations SET related='NO',date_modified=NOW() WHERE id='".$relationID."'";

		$res = $this->db->query($q);

		if (!$res) {
			return FALSE;
		}

		return TRUE;

	}

	public function getClientsInRelations($userHash) {

		$query = "SELECT c.id,c.email,cp.first_name,cp.last_name,ccp.company_name,ccp.city FROM credentials c 
					INNER JOIN customer_relations cr 
					ON c.id=cr.client_credentials_id
					LEFT JOIN customer_profile cp 
					ON c.id=cp.credentials_id
					INNER JOIN customer_company_profile ccp
					ON c.id=ccp.credentials_id
					AND cr.credentials_id='".$userHash."' 
					AND cr.related='YES' 
					AND c.deleted = '0'";

		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet && $resultSet->num_rows() > 0)
		{
			$resultsAll = array();

   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array(
      						"id" => $row->id, 
      						"first_name" => $row->first_name,
      						"last_name" => $row->last_name, 
      						"company_name" => $row->company_name,
      						"city" => $row->city, 
      						"email" => $row->email);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;
	}

	public function getUserInvoices($id) {

		$query = "SELECT invoice.id, invoice.credentials_id, invoice.clients_id, invoice.invoice_number, invoice.invoice_sum, invoice.invoice_tax_sum, invoice.invoice_subtotal, invoice.due_date, invoice.paid_date, invoice.status, invoice.invoice_type, clients.name FROM invoice INNER JOIN clients ON invoice.clients_id = clients.id  AND invoice.credentials_id = '".$id."' AND invoice.deleted = '0';";
		$resultSet = $this->db->query($query);

		$resultsAll = array();

		if ($resultSet->num_rows() > 0)
		{
   			foreach ($resultSet->result() as $row)
   			{
      			$newRow = array("id" => $row->id, "credentials_id" => $row->credentials_id, "invoice_number" => $row->invoice_number, "invoice_sum" => $row->invoice_sum, "invoice_tax_sum" =>$row->invoice_tax_sum, "invoice_subtotal" =>$row->invoice_subtotal, "due_date" => $row->due_date, "paid_date" => $row->paid_date, "status" => $row->status, "invoice_type" => $row->invoice_type, "name" => $row->name,);

      			$resultsAll[] = $newRow;
   			}
		}

		return $resultsAll;

	}

	public function getUserData($id) {

		$query = "SELECT * FROM credentials WHERE deleted = '0' AND id = '".$id."' ";
		$resultSet = $this->db->query($query);

		$resultsAll = FALSE;

		if ($resultSet->num_rows() > 0)
		{
			$row = $resultSet->row();

      		$resultsAll = array("id" => $row->id,"full_name" => $row->full_name, 
      			"email" => $row->email, "status" => $row->status);

      			
		}

		return $resultsAll;

	}

	public function getCurrentDocumentsNumbers($companyID) {

		$q = "SELECT * FROM documents_stats WHERE company_id='".$companyID."'";

		$res = $this->db->query($q);

		$data = FALSE;

		if ($res && $res->num_rows() > 0) {
			$row = $res->row();

			$data = array(
						"current_output_invoice_no"=>$row->output_invoice_number);
		}

		return $data;

	}

	public function saveOrUpdateDocumentsNumbers($companyID, $documentType, $currentNo) {

		
		$columnForUpdate = "";

		switch($documentType) {
			case "OUTPUT_INVOICE":
				$columnForUpdate = "output_invoice_number";
				break;
			default: break;
		}
		
		$res = $this->getCurrentDocumentsNumbers($companyID);

		if ($res) {
			$documentsNumbersQuery = "UPDATE documents_stats SET ".$columnForUpdate."=".$currentNo.",date_modified=NOW() WHERE company_id='".$companyID."'";
		} else {
			$documentsNumbersQuery = "INSERT INTO documents_stats(company_id,".$columnForUpdate.",deleted,date_created,date_modified) 
			VALUES('".$companyID."',".$currentNo.",0,NOW(),NOW())";
		}

		$res = $this->db->query($documentsNumbersQuery);


		if (!$res) {
			return FALSE;
		}

		return TRUE;
	}

}


?>