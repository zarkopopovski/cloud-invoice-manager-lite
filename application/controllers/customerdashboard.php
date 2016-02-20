<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("PARAM_CLIENT", "CLIENT");
define("PARAM_PRODUCT", "PRODUCT");
define("PARAM_INVOICE", "INVOICE");
define("PARAM_EXPENSE", "EXPENSE");
define('PARAM_PURCHASE', 'PURCHASE');
define('PARAM_SALES', 'SALES');
define('PARAM_REQUEST', 'REQUEST');
define('PARAM_NOTES', 'NOTE');

class CustomerDashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model("customer_model");
		$this->load->library('session');
		$this->load->library("PHPMailer");
		$this->load->library("InvoiceTemplateNo1");
		$this->load->helper("url"); 
		$this->load->helper('form');
		$this->load->helper('language');
		$this->load->helper('basic');

		$langValue = $this->session->userdata("language_value");

		$this->lang->load('app_data', (isset($langValue))?$langValue:"english");

		if (!$this->session->userdata("loggedin")) {
  			 redirect("/login");
  		} else if ($this->session->userdata("loggedin") && $this->session->userdata("type") == "ADMIN") {
   			redirect("/admindashboard");
 		} 

	}

	public function index()
	{

		$userHash = $this->session->userData('id');
		
		$userEmail = $this->session->userData('email');

		$companyID = $this->session->userData('company_id');

		$getInvoices = $this->customer_model->getInvoicesNotPaid($companyID);

		$invoicesCounter = $this->customer_model->getInvoicesCounting($companyID);
		
		$data = array();

		$data["user_id"] = $userHash;
		$data["user_email"] = $userEmail;
		
		$data["getInvoices"] = $getInvoices;
		
		if ($invoicesCounter) {
			$data["invoicesCounter"] = $invoicesCounter;			
		}

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/customerdashboard", $data);
		$this->load->view('templates/footer');
	}

	public function profile() {

		$userHash = $this->session->userData('id');
		$email = $this->session->userData('email');

		$results = $this->customer_model->getProfileData($userHash);
		$data["results"] = $results;
		$data["email"] = $email;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/profile", $data);
		$this->load->view('templates/footer');

	}

	public function edit_profile() {

		$userHash = $this->session->userData('id');

		$first_name = $this->input->post("first_name");
		$last_name = $this->input->post("last_name");
		$tel1 = $this->input->post("tel1");
		$tel2 = $this->input->post("tel2");

		$dataArray = array(
						"first_name"=>$first_name, 
						"last_name"=>$last_name, 
						"tel1"=>$tel1, 
						"tel2"=>$tel2);

		$res = $this->customer_model->saveCustomerProfile($userHash, $dataArray);

		if (!$res) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/profile");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/settings");		
		}

	}

	public function company_profile() {

		$userHash = $this->session->userData('id');

		$results = $this->customer_model->getCompanyProfileData($userHash);
		$data["results"] = $results;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/company_profile", $data);
		$this->load->view('templates/footer');

	}

	public function edit_company_profile() {

		$userHash = $this->session->userData('id');

		$company_name = $this->input->post("company_name");
		$address = $this->input->post("address");
		$address2 = $this->input->post("address2");
		$city = $this->input->post("city");
		$zip = $this->input->post("zip");
		$country = $this->input->post("country");
		$tel1 = $this->input->post("tel1");
		$tel2 = $this->input->post("tel2");
		$registration_number = $this->input->post("registration_number");
		$unique_number = $this->input->post("unique_number");
		$tax_number = $this->input->post("tax_number");
		$bank_account = $this->input->post("bank_account");
		$iban_code = $this->input->post("iban_code");
		$bank_name = $this->input->post("bank_name");
		$bank_address = $this->input->post("bank_address");
		$swift = $this->input->post("swift");

		$oldCompanyLogo = $this->input->post("old_logo");

		$dataArray = array(
						"company_name"=>$company_name, 
						"address"=>$address, 
						"address2"=>$address2, 
						"city"=>$city, 
						"zip"=>$zip, 
						"country"=>$country, 
						"tel1"=>$tel1, 
						"tel2"=>$tel2, 
						"registration_number"=>$registration_number, 
						"unique_number"=>$unique_number,
						"tax_number"=>$tax_number,
						"iban_code"=>$iban_code, 
						"bank_name"=>$bank_name, 
						"bank_address"=>$bank_address, 
						"bank_account"=>$bank_account,
						"swift"=>$swift);

		if (isset($_FILES["userfile"]["name"]) && $_FILES["userfile"]["name"] != "") {

			if (isset($oldCompanyLogo) && $oldCompanyLogo != "") {
				unlink("./uploads/".$oldCompanyLogo);
			}


			$fileName = $_FILES["userfile"]["name"];
			$hashedFileName = sha1(time().$fileName.time()).$fileName;

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '500';
			$config['file_name'] = $hashedFileName;

			$this->load->library('upload', $config);
				
			if ( ! $this->upload->do_upload("userfile")) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				// $uploadData =  $this->upload->data();
				// //var_dump($uploadData);
				// $fileNameWithPath = $uploadData["full_path"];
	
				// $config = NULL;
	
				// $config['image_library'] = 'gd';
				// $config['source_image'] = $fileNameWithPath;
				// $config['create_thumb'] = TRUE;
				// $config['maintain_ratio'] = TRUE;
				// $config['width'] = 240;
				// $config['height'] = 320;
	
				// $this->load->library('image_lib', $config);
	
				// $this->image_lib->resize();
	
				// $mediaId = sha1(time().$hashedFileName.time());
	
				// $thumbnailNameArray = explode(".", $hashedFileName);
	
				// $fileName = $thumbnailNameArray[0];
				// $fileExtension = $thumbnailNameArray[1];
	
				// $thumbnailName = $fileName."_thumb.".$fileExtension;

				$dataArray["company_logo"] = $hashedFileName;
			}
		}


		$res = $this->customer_model->saveCompanyProfile($userHash, $dataArray);

		if (!$res) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/company_profile");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/company_profile");		
		}

	}

	public function categories(){

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$results = $this ->customer_model->getCategories($userHash, $companyID);
		$data["results"] = $results;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/categories", $data);
		$this->load->view('templates/footer');


	}
	
	public function addCategory() {

		$name = $this->input->post("name");
		$description = $this->input->post("description");
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$dataArray = array("userHash"=>$userHash, "name"=>$name, "description"=>$description, "company_id"=>$companyID);

		$res = $this->customer_model->addCategory($dataArray);

		if (!$res) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/categories");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/categories");		
		}

	}

	public function delete_category() {

		$id = $this->input->get('id');
		$res = $this->customer_model->deleteCategory($id);

		if (!$res) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/categories");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/categories");		
		}

	}

	public function edit_category() {

		$id = $this->input->get('id');
		$results = $this ->customer_model->getCategoryForEdit($id);
		$data["results"] = $results;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$permissionMap = $this->session->userData('permissionMap');
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/edit_category", $data);
		$this->load->view('templates/footer');


	}

	public function update_category() {

		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$description = $this->input->post("description");

		$dataArray = array("id"=>$id, "name"=>$name, "description"=>$description);

		$res = $this->customer_model->updateCategory($dataArray);

		if (!$res) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/categories");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/categories");		
		}


	}

	public function client_groups(){

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$results = $this ->customer_model->getClientGroups($userHash, $companyID);
		$data["results"] = $results;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/client_groups", $data);
		$this->load->view('templates/footer');


	}

	public function add_group() {

		$name = $this->input->post("name");
		$description = $this->input->post("description");
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$dataArray = array("userHash"=>$userHash, "name"=>$name, "description"=>$description, "company_id"=>$companyID);

		$res = $this->customer_model->addClientGroup($dataArray);

		if (!$res) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/client_groups");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/client_groups");		
		}

	}

	public function clients(){

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$results = $this->customer_model->getClients($userHash, $companyID);
		$data["results"] = $results;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/clients", $data);
		$this->load->view('templates/footer');


	}

	public function create_client(){

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$email = $this->session->userData('email');
		$isChild = $this->session->userData('is_child');
		$parentID = $this->session->userData('parent_id');

		$results = $this ->customer_model->getClientGroups($userHash, $companyID);

		$data = array();

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$data["is_child"] = $isChild;
		$data["parent_id"] = $parentID;
		$data["user_id"] = $userHash;
		$data["user_email"] = $email;
		$data["groups"] = $results;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/create_client", $data);
		$this->load->view('templates/footer');

	}

	public function addClient() {
		
		$name = $this->input->post("name");
		$address = $this->input->post("address");
		$address2 = $this->input->post("address2");
		$city = $this->input->post("city");
		$zip = $this->input->post("zip");
		$country = $this->input->post("country");
		$email = $this->input->post("email");
		$tel1 = $this->input->post("tel1");
		$tel2 = $this->input->post("tel2");
		$registration_number = $this->input->post("registration_number");
		$unique_number = $this->input->post("unique_number");
		$tax_number  = $this->input->post("tax_number");

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$clientGroup = $this->input->post("client_group");
		

		$dataArray = array("userHash"=>$userHash, "name"=>$name, "address"=>$address, "address2"=>$address2, "city"=>$city, 
			"zip"=>$zip,"country"=>$country, "email"=>$email, "tel1"=>$tel1, "tel2"=>$tel2, "company_id"=>$companyID, 
			"registration_number"=>$registration_number, "unique_number"=>$unique_number, "tax_number"=>$tax_number, "client_group"=>$clientGroup);

		$res = $this->customer_model->addClient($dataArray);

		if (!$res) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/clients");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/clients");		
		}

	}

	public function delete_client($id) {

		$res = $this->customer_model->deleteClient($id);

		if (!$res) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/clients");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/clients");		
		}

	}

	public function view_client() {

		$id = $this->input->get("id");

		$userHash = $this->session->userData('id');

		$results = $this ->customer_model->getClientForEdit($id);
		$clientLocations = $this->customer_model->getAllClientAddresses($id);
		$clientInvoices = $this->customer_model->getClientInvoices($id, $userHash);
		
		$data["results"] = $results;
		$data["clientLocations"] = $clientLocations;
		$data["clientInvoices"] = $clientInvoices;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/view_client", $data);
		$this->load->view('templates/footer');

	}

	public function edit_client() {

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$id = $this->input->get("id");
		$groups = $this ->customer_model->getClientGroups($userHash, $companyID);

		if(!isset($id) || $id == FALSE) {

			$id = $this->input->post("id");

		}

		$results = $this ->customer_model->getClientForEdit($id);
		$data["results"] = $results;

		$data["groups"] = $groups;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/edit_client", $data);
		$this->load->view('templates/footer');

	}


	public function update_client() {

		$id = $this->input->post("id");
		$name = $this->input->post("name");
		$address = $this->input->post("address");
		$address2 = $this->input->post("address2");
		$city = $this->input->post("city");
		$zip = $this->input->post("zip");
		$country = $this->input->post("country");
		$email = $this->input->post("email");
		$tel1 = $this->input->post("tel1");
		$tel2 = $this->input->post("tel2");
		$registration_number = $this->input->post("registration_number");
		$unique_number = $this->input->post("unique_number");
		$tax_number  = $this->input->post("tax_number");

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$oldGroupID = $this->input->post("group_id");
		$clientGroupID = $this->input->post("client_group");

		$dataArray = array("userHash"=>$userHash, "id"=>$id, "name"=>$name, "address"=>$address, "address2"=>$address2, "city"=>$city, 
			"zip"=>$zip,"country"=>$country, "email"=>$email, "tel1"=>$tel1, "tel2"=>$tel2, "registration_number"=>$registration_number, 
			"unique_number"=>$unique_number, "tax_number"=>$tax_number, "company_id"=>$companyID);

		$dataArray["client_group"] = FALSE;

		if ($oldGroupID != $clientGroupID) {
			$dataArray["client_group"] = $clientGroupID;
		}


		$res = $this->customer_model->updateClient($dataArray);

		if (!$res) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/clients");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/clients");		
		}

	}

	public function create_clocation() {

		$client = $this->input->get("id");
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');
		$email = $this->session->userData('email');

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;
		$data["client_id"] = $client;
		$dataNav['email'] = $email;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/client_location", $data);
		$this->load->view('templates/footer');

	}

	public function edit_clocation() {

		$locationID = $this->input->get("loc_id");
		$client = $this->input->get("id");

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');
		$email = $this->session->userData('email');

		$mode = "edit";

		$results = $this->customer_model->getClientAddressForEdit($locationID);

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;
		$data["client_id"] = $client;
		$data["results"] = $results;
		$data["mode"] = $mode;
		$dataNav['email'] = $email;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/client_location", $data);
		$this->load->view('templates/footer');

	}

	public function delete_clocation() {

		$id = $this->input->get("loc_id");

		$res = $this->customer_model->deleteClientAddress($id);

		if (!$res) {
			redirect("customerdashboard/clients");
		} else {
			redirect("customerdashboard/clients");
		}

	}

	public function add_client_locations() {

		$location_id = $this->input->post("id");
		$mode = $this->input->post("mode");
		$client = $this->input->post("client_id");
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');
		$email = $this->session->userData('email');

		$name = $this->input->post("name");
		$address = $this->input->post("address");
		$city = $this->input->post("city");
		$zip = $this->input->post("zip");
		$tel = $this->input->post("tel");

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;
		$dataNav['email'] = $email;

		$dataArray = array(
						"loc_id"=>$location_id, 
						"client_id"=>$client, 
						"name"=>$name, 
						"address"=>$address, 
						"city"=>$city, 
						"zip"=>$zip, 
						"tel"=>$tel,
						"userHash"=>$userHash,
						"company_id"=>$companyID);

		$res = FALSE;

		if ($mode == "edit") {
			$res = $this->customer_model->updateClientAddress($dataArray);
		} else {
			$res = $this->customer_model->addClientAddress($dataArray);
		}

		if (!$res) {
			redirect("customerdashboard/clients");
		} else {
			redirect("customerdashboard/clients");		
		}

	}



	public function products(){

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$permissionMap = $this->session->userData('permissionMap');

		$results = $this ->customer_model->getProducts($companyID);
		$data["results"] = $results;
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/products", $data);
		$this->load->view('templates/footer');

	}

	public function create_products(){

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$email = $this->session->userData('email');
		$isChild = $this->session->userData('is_child');
		$parentID = $this->session->userData('parent_id');

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$results = $this ->customer_model->getCategoriesName($userHash, $companyID);
		$data["results"] = $results;

		$data["is_child"] = $isChild;
		$data["parent_id"] = $parentID;
		$data["user_id"] = $userHash;
		$data["user_email"] = $email;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/create_products", $data);
		$this->load->view('templates/footer');

	}

	public function add_products() {

		$name = $this->input->post("name");
		$product_code = $this->input->post("product_code");
		$description = $this->input->post("description");
		$input_price = $this->input->post("input_price");
		$output_price = $this->input->post("output_price");
		$tax = $this->input->post("tax");
		$unit = $this->input->post("unit");
		$category = $this->input->post('category');

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$isManageable = $this->input->post("manageable");

		$dataArray = array("userHash"=>$userHash, "name"=>$name, "product_code"=>$product_code, "description"=>$description, "tax"=>$tax, 
			"unit"=>$unit, "category_id"=>$category, "input_price"=>$input_price, "output_price"=>$output_price, "company_id"=>$companyID,
			"manageable"=>$isManageable);

		$res = $this->customer_model->addProducts($dataArray);

		$priceDataArray = array("userHash"=>$userHash, "company_id"=>$companyID, "product_id"=>$res["productID"], "input_price"=>$input_price, "output_price"=>$output_price, "tax"=>$tax, "product_price_id"=>$res["productsPriceID"]);

		if ($res) {
			$res1 = $this->customer_model->addProductsPrice($priceDataArray);
		}

		if (!$res1) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/products");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/products");		
		}

	}

	public function delete_products() {

		$id = $this->input->get("id");

		$res = $this->customer_model->deleteProducts($id);

		if (!$res) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/products");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/products");		
		}

	}

	public function view_products() {

		$id = $this->input->get("id");
		$cat_id = $this->input->get("cat_id");

		$categories = $this->customer_model->getCategoryByID($cat_id);
		$data["categories"] = $categories;

		$results = $this->customer_model->getProductsForEdit($id);
		$data["results"] = $results;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/view_products", $data);
		$this->load->view('templates/footer');


	}

	public function edit_products() {

		$id = $this->input->get("id");
		$companyID = $this->session->userData('company_id');

		$userHash = $this->session->userData('id');

		if(!isset($id) || $id == FALSE) {

			$id = $this->input->post("id");

		}

		$categories = $this ->customer_model->getCategoriesName($userHash, $companyID);
		$data["categories"] = $categories;

		$results = $this ->customer_model->getProductsForEdit($id);
		$data["results"] = $results;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
	
		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/edit_products", $data);
		$this->load->view('templates/footer');

	}


	public function update_products() {

		$product_id = $this->input->post("product_id");
		$name = $this->input->post("name");
		$product_code = $this->input->post("product_code");
		$description = $this->input->post("description");
		$input_price = $this->input->post("input_price");
		$output_price = $this->input->post("output_price");
		$tax = $this->input->post("tax");

		$old_output_price = $this->input->post("old_output_price");
		$old_tax = $this->input->post("old_tax");

		$category_id = $this->input->post("category");
		$tax = $this->input->post("tax");
		$unit = $this->input->post("unit");

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		if ($old_output_price == $output_price && $old_tax == $tax) {
			$output_price = FALSE;
			$tax = FALSE;
		} else {

			if ($output_price == "" || $output_price == "0") {
				$output_price = "0";
			}

			if ($tax == "" || $tax == "0") {
				$tax = "0";
			}

		}

		$dataArray = array("userHash"=>$userHash, "product_id"=>$product_id, "name"=>$name, "product_code"=>$product_code, "description"=>$description, "category_id"=>$category_id, 
			"tax"=>$tax, "unit"=>$unit, "input_price"=>$input_price, "output_price"=>$output_price);

		$res = $this->customer_model->updateProducts($dataArray);

		if ($res["productsPriceID"]) {
			$priceDataArray = array("userHash"=>$userHash, "company_id"=>$companyID, "product_id"=>$product_id, "input_price"=>$input_price, "output_price"=>$output_price, "tax"=>$tax, "product_price_id"=>$res["productsPriceID"]);

			if ($res) {
				$res1 = $this->customer_model->addProductsPrice($priceDataArray);
			}

			if (!$res1) {
				$this->session->set_userdata("errormsg", "ERROR");
				$this->session->set_userdata("errno", "1");
				redirect("customerdashboard/products");
			} else {
				$this->session->set_userdata("errormsg", "Successful");
				$this->session->set_userdata("errno", "2");	
				redirect("customerdashboard/products");		
			}
		} else {
			if (!$res) {
				$this->session->set_userdata("errormsg", "ERROR");
				$this->session->set_userdata("errno", "1");
				redirect("customerdashboard/products");
			} else {
				$this->session->set_userdata("errormsg", "Successful");
				$this->session->set_userdata("errno", "2");	
				redirect("customerdashboard/products");		
			}
		}

	}

	public function invoices() {

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');		
		$results = $this ->customer_model->getInvoices($companyID);
		$data["results"] = $results;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav['permissionMap'] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/invoices", $data);
		$this->load->view('templates/footer');

	}

	public function draft_invoices() {

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');
		$results = $this ->customer_model->getDraftInvoices($companyID);
		$data["results"] = $results;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/draft_invoices", $data);
		$this->load->view('templates/footer');

	}

	public function create_input_invoices() {

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$results = $this->customer_model->getProducts($companyID);
		$clients = $this->customer_model->getClients($userHash, $companyID);
		$data["results"] = $results;
		$data["clients"] = $clients;
		//$data["results_json"] = json_encode($results);

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$currentDocumentNumbers = $this->customer_model->getCurrentDocumentsNumbers($companyID);

		$currentInvoiceNumber = $this->session->userData('invoice_number');

		if ($currentDocumentNumbers) {
			$currentInvoiceNumberFromDB = $currentDocumentNumbers["current_invoice_no"];

			if ($currentInvoiceNumberFromDB > 0) {
				$currentInvoiceNumber = $currentInvoiceNumberFromDB;
				$currentInvoiceNumber += 1;
			}

		}

		$data["next_invoice_number"] = $currentInvoiceNumber;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$permissionMap = $this->session->userData('permissionMap');
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/create_input_invoices", $data);
		$this->load->view('templates/footer');

	}

	public function create_output_invoices() {

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');
		$formatStyle = $this->session->userData('output_invoice_number_format');
		$invoicePrefix = $this->session->userData('output_invoice_number_pre');

		$results = $this->customer_model->getProducts($companyID);
		$clients = $this->customer_model->getClients($userHash, $companyID);
		$data["results"] = $results;
		$data["clients"] = $clients;

		$data["products_json"] = json_encode($results);

		$currentDocumentNumbers = $this->customer_model->getCurrentDocumentsNumbers($companyID);

		$currentInvoiceNumber = $this->session->userData('output_invoice_number');

		if ($currentDocumentNumbers) {
			$currentInvoiceNumberFromDB = $currentDocumentNumbers["current_output_invoice_no"];

			if ($currentInvoiceNumberFromDB > 0) {
				$currentInvoiceNumber = $currentInvoiceNumberFromDB;
				$currentInvoiceNumber += 1;
			}

		}

		$data["formatted_invoice_number"] =  createDocumentNumberByStyle($currentInvoiceNumber, $formatStyle, $invoicePrefix);
		$data["next_invoice_number"] = $currentInvoiceNumber;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$permissionMap = $this->session->userData('permissionMap');
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/create_output_invoices", $data);
		$this->load->view('templates/footer');

	}

	public function create_draft_invoices() {

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');
		$formatStyle = $this->session->userData('draft_invoice_number_format');
		$invoicePrefix = $this->session->userData('draft_invoice_number_pre');

		$results = $this->customer_model->getProducts($companyID);
		$clients = $this->customer_model->getClients($userHash, $companyID);
		$data["results"] = $results;
		$data["clients"] = $clients;
		//$data["results_json"] = json_encode($results);

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$currentDocumentNumbers = $this->customer_model->getCurrentDocumentsNumbers($companyID);

		$currentInvoiceNumber = $this->session->userData('draft_invoice_number');

		if ($currentDocumentNumbers) {
			$currentInvoiceNumberFromDB = $currentDocumentNumbers["current_draft_invoice_no"];

			if ($currentInvoiceNumberFromDB > 0) {
				$currentInvoiceNumber = $currentInvoiceNumberFromDB;
				$currentInvoiceNumber += 1;
			}

		}

		$data["formatted_invoice_number"] =  createDocumentNumberByStyle($currentInvoiceNumber, $formatStyle, $invoicePrefix);
		$data["next_invoice_number"] = $currentInvoiceNumber;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$permissionMap = $this->session->userData('permissionMap');
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/create_draft_invoices", $data);
		$this->load->view('templates/footer');

	}

	public function create_output_invoices_from_draft() {

		$id = $this->input->get("id");
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');
		$formatStyle = $this->session->userData('output_invoice_number_format');
		$invoicePrefix = $this->session->userData('draft_invoice_number_pre');

		$results = $this->customer_model->getProducts($companyID);
		$clients = $this->customer_model->getClients($userHash, $companyID);

		$invoice = $this->customer_model->getInvoiceForEdit($id, $userHash);
		$products = $this->customer_model->getInvoiceProducts($id, $userHash);
		
		$data = array();

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$currentDocumentNumbers = $this->customer_model->getCurrentDocumentsNumbers($companyID);

		$currentInvoiceNumber = $this->session->userData('draft_invoice_number');

		if ($currentDocumentNumbers) {
			$currentInvoiceNumberFromDB = $currentDocumentNumbers["current_draft_invoice_no"];

			if ($currentInvoiceNumberFromDB > 0) {
				$currentInvoiceNumber = $currentInvoiceNumberFromDB;
				$currentInvoiceNumber += 1;
			}

		}

		$data["formatted_invoice_number"] =  createDocumentNumberByStyle($currentInvoiceNumber, $formatStyle, $invoicePrefix);
		$data["next_invoice_number"] = $currentInvoiceNumber;

		$data["invoice_id_json"] = json_encode($id);
		$data["results"] = $results;
		$data["clients"] = $clients;
		$data["products_json"] = json_encode($products);
		$data["invoice_json"] = json_encode($invoice);
		$data["results_json"] = json_encode($results);

		$dataLoad = "pages/create_output_invoices_from_draft";

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;		
		$permissionMap = $this->session->userData('permissionMap');
		$dataNav["permissionMap"] = $permissionMap;
	
		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view ($dataLoad, $data);
		$this->load->view('templates/footer');

	}

	public function get_client_data() {

		$clientId = $this->input->post('clientId');
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$clientData = $this->customer_model->getClientForEdit($clientId);

		echo json_encode($clientData);

		exit(0);

	}

	public function get_client_shops() {

		$clientId = $this->input->post('clientId');
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$clientData = $this->customer_model->getAllClientAddresses($clientId);

		echo json_encode($clientData);

		exit(0);

	}

	public function save_invoice() {

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');
		$invoicesProducts = $this->input->post('invoicesProducts');
		$clientId = $this->input->post('clientId');
		$invoiceNumber = $this->input->post('invoiceNumber');
		$dueDate = $this->input->post('dueDate');
		$invoice_sum = $this->input->post('invoice_sum');
		$invoice_tax_sum = $this->input->post('invoice_tax_sum');
		$invoice_subtotal = $this->input->post('invoice_subtotal');
		$comment = $this->input->post('comment');
		$invoice_type = $this->input->post('invoice_type');
		$noteFor = $this->input->post("note_for");
		$shopID = $this->input->post("shop_id");
		$inventoryID = $this->input->post("inventory_id");

		$taxVisible = $this->session->userData('tax_visible');
		$taxCalculate = $this->session->userData('tax_calculate');

		$dataArray = array(
						"userHash"=>$userHash, 
						"company_id"=>$companyID, 
						"client_id"=>$clientId, 
						"shop_id"=>$shopID,
						"invoiceNumber"=>$invoiceNumber, 
						"dueDate"=>$dueDate, 
						"invoice_sum"=>$invoice_sum, 
						"invoice_tax_sum"=>$invoice_tax_sum, 
						"invoice_subtotal"=>$invoice_subtotal, 
						"comment"=>$comment, 
						"invoice_type"=>$invoice_type,
						"note_for"=>$noteFor,
						"inventory_id"=>$inventoryID,
						"tax_visible"=>$taxVisible,
						"tax_calculate"=>$taxCalculate);

		$invoiceId = $this->customer_model->saveInvoice($dataArray);

		$returnArray = array();		

		if ($invoiceId) {

			$documentType = "";

			if ($invoice_type == "OUTPUT") {
				$documentType = "OUTPUT_INVOICE";
			} 

			if ($documentType != "INPUT_INVOICE") {
				$this->customer_model->saveOrUpdateDocumentsNumbers($companyID, $documentType, $invoiceNumber);
			}

			$saveProducts = $this->customer_model->saveInvoiceProducts($userHash, $companyID, $invoicesProducts, $invoiceId);

			if ($documentType == "OUTPUT_INVOICE") {	
				$this->customer_model->setBuilkProductsQuantity($userHash, $companyID, FALSE, $inventoryID, $invoicesProducts, 0);
			}

			if ($saveProducts) {				
				$returnArray['ERROR'] = FALSE;
				$returnArray['MESSAGE'] = 'SAVED';
			} else {
				$returnArray['ERROR'] = TRUE;
				$returnArray['MESSAGE'] = 'PRODUCTS NOT SAVED';
			}

		} else {
			$returnArray['ERROR'] = TRUE;
			$returnArray['MESSAGE'] = 'NOT SAVED';
		}

		echo json_encode($returnArray);

		exit(0);
		
	}

	public function save_output_invoice_from_draft() {

		$userHash = $this->session->userData('id');
		$clientId = $this->input->post('clientId');		
		$companyID = $this->session->userData('company_id');
		$invoiceNumber = $this->input->post('invoiceNumber');
		$dueDate = $this->input->post('dueDate');
		$invoice_sum = $this->input->post('invoice_sum');
		$invoice_tax_sum = $this->input->post('invoice_tax_sum');
		$invoice_subtotal = $this->input->post('invoice_subtotal');
		$comment = $this->input->post('comment');
		$draft_id = $this->input->post('draft_id');
		$invoice_type = $this->input->post('invoice_type');


		$dataArray = array("userHash"=>$userHash, "company_id"=>$companyID,  "clientId"=>$clientId, "invoiceNumber"=>$invoiceNumber, "dueDate"=>$dueDate, "invoice_sum"=>$invoice_sum, "invoice_tax_sum"=>$invoice_tax_sum, "invoice_subtotal"=>$invoice_subtotal, "comment"=>$comment, "draft_id"=>$draft_id, "invoice_type"=>$invoice_type);

		$invoiceId = $this->customer_model->saveOutputInvoiceFromDraft($dataArray);
		$updateDraftID = $this->customer_model->updateDraftID($draft_id);
		
		$returnArray = array();

		if ($invoiceId) {

			$documentType = "";

			if ($invoice_type == "INPUT") {
				$documentType = "INPUT_INVOICE";
			} else if ($invoice_type == "OUTPUT") {
				$documentType = "OUTPUT_INVOICE";
			} else if ($invoice_type == "DRAFT") {
				$documentType = "DRAFT_INVOICE";
			}

			$this->customer_model->saveOrUpdateDocumentsNumbers($companyID, $documentType, $invoiceNumber);
		}
			//$saveProducts = $this->customer_model->saveInvoiceProducts($userHash, $companyID, $invoicesProducts, $invoiceId);

			if ($invoiceId) {				
				$returnArray['ERROR'] = FALSE;
				$returnArray['MESSAGE'] = 'SAVED';
			} else {
				$returnArray['ERROR'] = TRUE;
				$returnArray['MESSAGE'] = 'NOT SAVED';
			}

		echo json_encode($returnArray);

		exit(0);
		
	}


	public function edit_invoice() {

		$id = $this->input->get("id");
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$email = $this->session->userData('email');
		$isChild = $this->session->userData('is_child');
		$parentID = $this->session->userData('parent_id');

		//$results = $this->customer_model->getProducts($companyID);
		$clients = $this->customer_model->getClients($userHash, $companyID);

		$invoice = $this->customer_model->getInvoiceForEdit($id, $userHash);
		$inventoryID = $invoice["inventory_id"];

		$results = FALSE;

		$products = $this->customer_model->getInvoiceProducts($id, $userHash, $inventoryID);

		$data["is_child"] = $isChild;
		$data["parent_id"] = $parentID;
		$data["user_id"] = $userHash;
		$data["user_email"] = $email;

		$data["results"] = $results;
		$data["clients"] = $clients;
		$data["is_confirmed"] = $invoice["confirmed"];
		$data["products"] = $products;
		$data["invoice"] = $invoice;
		//$data["results_json"] = json_encode($results);

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$data["taxVisible"] = $this->session->userData('tax_visible');
		$data["taxCalculate"] = $this->session->userData('tax_calculate');

		$dataLoad = "pages/edit_invoice";

		$formatStyle = $this->session->userData('output_invoice_number_format');
		$invoicePrefix = $this->session->userData('output_invoice_number_pre');
		$data["formatted_invoice_number"] = $invoice["invoice_number"];//createDocumentNumberByStyle($invoice["invoice_number"], $formatStyle, $invoicePrefix);

		$dataLoad = "pages/edit_output_invoice";
			
		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;
		
		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view ($dataLoad, $data);
		$this->load->view('templates/footer');

	}

	public function delete_invoice_product() {

		$id = $this->input->post('id');
		$userHash = $this->session->userData('id');

		$results = $this->customer_model->deleteInvoiceProduct($id, $userHash);

		if ($results) {				
			$returnArray['ERROR'] = FALSE;
			$returnArray['MESSAGE'] = 'SAVED';
		} else {
			$returnArray['ERROR'] = TRUE;
			$returnArray['MESSAGE'] = 'PRODUCTS NOT SAVED';
		}
		
		echo json_encode($returnArray);

		exit(0);

	}

	public function update_invoice() {

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');
		$invoicesProducts = $this->input->post('invoicesProducts');

		$invoicesProductsForDelete = $this->input->post('invoicesProductsForDelete');

		$clientId = $this->input->post('clientId');
		$invoiceNumber = $this->input->post('invoiceNumber');
		$dueDate = $this->input->post('dueDate');
		$invoice_sum = $this->input->post('invoice_sum');
		$invoiceID = $this->input->post('invoiceID');
		$comment = $this->input->post('comment');
		$confirmed = $this->input->post('confirmed');

		$invoiceType = $this->input->post('invoice_type');
		$inventoryID = $this->input->post('inventory_id');

		$subTotal = $this->input->post("sub_total");

		$dataArray = array(
						"invoiceID"=>$invoiceID, 
						"userHash"=>$userHash, 
						"clientId"=>$clientId, 
						"invoiceNumber"=>$invoiceNumber, 
						"dueDate"=>$dueDate, 
						"invoice_sum"=>$invoice_sum, 
						"comment"=>$comment, 
						"confirmed"=>$confirmed);


		if ($subTotal) {
			$dataArray["subTotal"] = $subTotal;
		}

	
		$invoiceId1 = $this->customer_model->updateInvoice($dataArray);

		$returnArray = array();

		if ($invoiceId1) {

			$productsForInsert = NULL;
			$productsForUpdate = NULL;

			$saveProducts = FALSE;

			if (isset($invoicesProductsForDelete) && $invoicesProductsForDelete != FALSE && sizeof($invoicesProductsForDelete) > 0) {
			 	foreach ($invoicesProductsForDelete as $productForDelete) {
			 		$productData = $productForDelete["product"];

			 		$invpQuantity = ($invoiceType != "INPUT")?$productData["invp_quantity"]:0;
			 		$quantityResult = $productForDelete["quantity"];

			 		$operation = 0;

			 		$this->customer_model->deleteInvoiceProduct($productData["id"], $userHash);
			 		if ($invoiceType != "INPUT") {
			 			$this->customer_model->updateInventoryProductQuantity($companyID, $inventoryID, $productData["iproduct_id"], $invpQuantity, $quantityResult, $operation);
			 		}
			 	}
			 }

			 foreach ($invoicesProducts as $productForManage) {

			 	if ($productForManage["isFromInventory"] == "false") {
			 		
			 		$productForManageData = $productForManage["product"];

			 		$originalQuantity = $productForManage["originalQuantity"];
			 		$invpQuantity = ($invoiceType != "INPUT")?$productForManageData["invp_quantity"]:0;
			 		$quantity = $productForManage["quantity"];
			 		$discount = $productForManage["discount"];

			 		$quantityResult = 0;
			 		$operation = 0;

			 		if ($originalQuantity != $quantity) {
			 			if ($originalQuantity > $quantity) {
				 			$quantityResult = $originalQuantity - $quantity;
				 			$operation = 0;
				 		} else if ($originalQuantity < $quantity) {
				 			$quantityResult = $quantity - $originalQuantity;
				 			$operation = 1;
				 		}

				 		$productUpdate = array(
				 							"company_id"=>$companyID, 
				 							"invoiceProductID"=>$productForManageData["id"], 
				 							"newQuantity"=>$quantity,
				 							"discount"=>$discount);

				 		$this->customer_model->updateInvoiceProduct($productUpdate);

				 		if ($invoiceType != "INPUT") {
							$this->customer_model->updateInventoryProductQuantity($companyID, $inventoryID, $productForManageData["iproduct_id"], $invpQuantity, $quantityResult, $operation);				 			
				 		}

			 		}

			 	} else {
			 		if ($productsForInsert == NULL) {
			 			$productsForInsert = array();
			 		}

			 		$productsForInsert[] = $productForManage;
			 	}

			 }

			 $saveProducts = TRUE;

			 if ($productsForInsert != NULL) {
			 	$saveProducts = $this->customer_model->saveInvoiceProducts($userHash, $companyID, $productsForInsert, $invoiceID);

			 	if ($saveProducts && $invoiceType != "INPUT") {
			 		$this->customer_model->setBuilkProductsQuantityForNew($userHash, $companyID, FALSE, $inventoryID, $productsForInsert, 0);
			 	}
			 } 

			if ($saveProducts) {				
				$returnArray['ERROR'] = FALSE;
				$returnArray['MESSAGE'] = 'SAVED';
			} else {
				$returnArray['ERROR'] = TRUE;
				$returnArray['MESSAGE'] = 'PRODUCTS NOT SAVED';
			}
		} else {
			$returnArray['ERROR'] = TRUE;
			$returnArray['MESSAGE'] = 'NOT SAVED';
		}

		echo json_encode($returnArray);

		exit(0);

	}



	public function update_invoice_product_quantity() {

		$userHash = $this->session->userData('id');
		$newQuantity = $this->input->post('newQuantity');
		$invoiceProductID = $this->input->post('invoiceProductID');

		$dataArray = array("invoiceProductID"=>$invoiceProductID, "userHash"=>$userHash, "newQuantity"=>$newQuantity);

		$invoiceId1 = $this->customer_model->updateInvoiceProductQuantity($dataArray);

		$returnArray = array();


		if ($invoiceId1) {
			$returnArray['ERROR'] = FALSE;
			$returnArray['MESSAGE'] = 'NEW QUANTITY SAVED';
		} else {
			$returnArray['ERROR'] = TRUE;
			$returnArray['MESSAGE'] = 'NEW QUANTITY NOT SAVED';
		}

		echo json_encode($returnArray);

		exit(0);

	}

	public function update_invoice_product_discount() {

		$userHash = $this->session->userData('id');
		$newDiscount = $this->input->post('newDiscount');
		$invoiceProductID = $this->input->post('invoiceProductID');

		$dataArray = array("invoiceProductID"=>$invoiceProductID, "userHash"=>$userHash, "newDiscount"=>$newDiscount);

		$invoiceId1 = $this->customer_model->updateInvoiceProductDiscount($dataArray);

		$returnArray = array();


		if ($invoiceId1) {
			$returnArray['ERROR'] = FALSE;
			$returnArray['MESSAGE'] = 'NEW DISCOUNT SAVED';
		} else {
			$returnArray['ERROR'] = TRUE;
			$returnArray['MESSAGE'] = 'NEW DISCOUNT NOT SAVED';
		}

		echo json_encode($returnArray);

		exit(0);

	}

	public function delete_invoice() {

		$id = $this->input->get("id");

		$res = $this->customer_model->deleteInvoice($id);

		if($res) {
			$res1 = $this->customer_model->deleteInvoiceProducts($id);
		}		

		if (!$res && !$res1) {
			$this->session->set_userdata("errormsg", "ERROR");
			$this->session->set_userdata("errno", "1");
			redirect("customerdashboard/invoices");
		} else {
			$this->session->set_userdata("errormsg", "Successful");
			$this->session->set_userdata("errno", "2");	
			redirect("customerdashboard/invoices");		
		}


	}
	//FIXME:Unknown logic
	public function view_invoice() {

		$id = $this->input->get("id");
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$formatStyle = FALSE;
		$invoicePrefix = FALSE;

		$results = $this->customer_model->getProducts($companyID);
		$clients = $this->customer_model->getClients($userHash, $companyID);

		$invoice = $this->customer_model->getInvoiceForEdit($id, $userHash);
		
		$products = $this->customer_model->getInvoiceProducts($id, $userHash, $invoice["inventory_id"]);

		$data = array();

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$data["invoice_id"] = $id;
		$data["results"] = $results;
		$data["clients"] = $clients;
		$data["products"] = $products;
		$data["invoice"] = $invoice;
		$data["results"] = $results;

		$dataLoad = "pages/view_invoice";
		
		if($invoice['invoice_type'] == "INPUT"){
			$dataLoad = "pages/view_invoice";
		} else if($invoice['invoice_type'] == "OUTPUT"){
			$dataLoad = "pages/view_output_invoice";
			$formatStyle = $this->session->userData('output_invoice_number_format');
			$invoicePrefix = $this->session->userData('output_invoice_number_pre');
		} else if($invoice['invoice_type'] == "DRAFT"){
			$dataLoad = "pages/view_draft_invoice";
			$formatStyle = $this->session->userData('draft_invoice_number_format');
			$invoicePrefix = $this->session->userData('draft_invoice_number_pre');
		} else if($invoice['invoice_type'] == "DELIVERY"){
			$dataLoad = "pages/view_delivery_note";
		} else if($invoice['invoice_type'] == "RECEIVED"){
			$dataLoad = "pages/view_received_note";
		}
		
		$data["formatted_invoice_number"] =  createDocumentNumberByStyle($invoice["invoice_number"], $formatStyle, $invoice["date_created"], $invoicePrefix);

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;
	
		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view ($dataLoad, $data);
		$this->load->view('templates/footer');

	}

	public function update_invoice_status() {

		$id = $this->input->get("id");
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$invoiceStatus = $this->customer_model->updateInvoiceStatus($id, $userHash, $companyID);

		$permissionMap = $this->session->userData('permissionMap');
		
		$results = FALSE;
		$data = array();

		if($invoiceStatus){
			$results = $this->customer_model->getInvoices($companyID);
			$data["results"] = $results;
			$data["permissionMap"] = $permissionMap;
		}

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/invoices", $data);
		$this->load->view('templates/footer');

	}

	public function update_invoice_status_ajax() {

		$id = $this->input->post("id");
		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$invoiceStatus = $this->customer_model->updateInvoiceStatus($id, $userHash, $companyID);

		$data = FALSE;

		if ($invoiceStatus) {
			$data = array("status"=>"OK");			
		} else {
			$data = array("status"=>"ERROR");
		}

		echo json_encode($data);

		exit(0);

	}

	public function settings(){

		$userHash = $this->session->userData('id');
		$isChild = $this->session->userData('is_child');
		$results = $this->customer_model->getSettingsData($userHash);

		$data["results_json"] = json_encode($results);
		$data["is_child"] = $isChild;

		$permissionMap = $this->session->userData('permissionMap');
		$data["permissionMap"] = $permissionMap;

		$email = $this->session->userData('email');
		$dataNav['email'] = $email;
		$dataNav["permissionMap"] = $permissionMap;

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation', $dataNav);
		$this->load->view("pages/settings", $data);
		$this->load->view('templates/footer');

	}

	public function update_settings(){

		$default_currency = $this->input->post('default_currency');
		$default_language = $this->input->post('default_language');
		$tax_visible = $this->input->post("tax_visible");
		$tax_calculate = $this->input->post("tax_calculate");
		$userHash = $this->session->userData('id');

		$default_language1 = $this->session->userData('default_currency');

		$inputInvoiceNo = $this->input->post("input_invoice_no");
		$inputInvoiceNumberFormat = $this->input->post("input_invoice_no_format");
		$inputInvoicePrefix = $this->input->post("input_invoice_no_pre");
		$outputInvoiceNo = $this->input->post("output_invoice_no");
		$outputInvoiceNumberFormat = $this->input->post("output_invoice_no_format");
		$outputInvoicePrefix = $this->input->post("output_invoice_no_pre");
		$draftInvoiceNo = $this->input->post("draft_invoice_no");
		$draftInvoiceNumberFormat = $this->input->post("draft_invoice_no_format");
		$draftInvoicePrefix = $this->input->post("draft_invoice_no_pre");
		$requestNo = $this->input->post("request_no");
		$deliveryNoteNo = $this->input->post("delivery_note_no");
		$ReceivedNoteNo = $this->input->post("received_note_no");

		if (!isset($inputInvoiceNo) || $inputInvoiceNo == "") {
			$inputInvoiceNo = 0;
		}
		
		if (!isset($outputInvoiceNo) || $outputInvoiceNo == "") {
			$outputInvoiceNo = 0;
		}

		if (!isset($draftInvoiceNo) || $draftInvoiceNo == "") {
			$draftInvoiceNo = 0;
		}

		if (!isset($requestNo) || $requestNo == "") {
			$requestNo = 0;
		}

		if (!isset($deliveryNoteNo) || $deliveryNoteNo == "") {
			$deliveryNoteNo = 0;
		}

		if (!isset($ReceivedNoteNo) || $ReceivedNoteNo == "") {
			$ReceivedNoteNo = 0;
		}

		$dataArray = array(
						"userHash"=>$userHash,
						"default_language"=>$default_language, 
						"default_currency"=>$default_currency, 
						"tax_visible"=>$tax_visible,
						"tax_calculate"=>$tax_calculate,
						"input_invoice_no"=>$inputInvoiceNo,
						"input_invoice_no_format"=>$inputInvoiceNumberFormat,
						"input_invoice_no_pre"=>$inputInvoicePrefix,
						"output_invoice_no"=>$outputInvoiceNo,
						"output_invoice_no_format"=>$outputInvoiceNumberFormat,
						"output_invoice_no_pre"=>$outputInvoicePrefix,
						"draft_invoice_no"=>$draftInvoiceNo,
						"draft_invoice_no_format"=>$draftInvoiceNumberFormat,
						"draft_invoice_no_pre"=>$draftInvoicePrefix,
						"request_no"=>$requestNo,
						"delivery_note_no"=>$deliveryNoteNo,
						"received_note_no"=>$ReceivedNoteNo);


		$res = $this->customer_model->updateSettings($dataArray);

		$returnArray = array();

		if ($res) {
			$returnArray['ERROR'] = FALSE;
			$returnArray['MESSAGE'] = 'NEW QUANTITY SAVED';
		} else {
			$returnArray['ERROR'] = TRUE;
			$returnArray['MESSAGE'] = 'NEW QUANTITY NOT SAVED';
		}

		echo json_encode($returnArray);

		exit(0);

	}

}
