<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model("user_model");
		$this->load->model("customer_model");
		$this->load->library('session');
		$this->load->library("PHPMailer");
		$this->load->helper("url"); 
		$this->load->helper('language');

		$langValue = $this->session->userdata("language_value");

		$this->lang->load('app_data', (isset($langValue))?$langValue:"english");

	}

	public function index()
	{

		$errorNo = $this->session->userdata("errno");
		
		$data = array();

		if ($errorNo && $errorNo == "1") {
			$errorMsg = $this->session->userdata("errormsg");

			$data["errormsg"] = $errorMsg;

			$this->session->unset_userdata("errno");
			$this->session->unset_userdata("errormsg");
		}

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigationlogin');
		$this->load->view("pages/login", $data);
		$this->load->view('templates/footer');
	}

	public function checkforcredentials() {

		$email = $this->input->post("email");
		$pass = $this->input->post("password");

		$res = $this->customer_model->findUserCredentialsByEmailAndPass($email, $pass);
		
		if (!$res) {

			$this->session->set_userdata("errormsg", "Wrong credentials");
			$this->session->set_userdata("errno", "1");

			redirect("/login");

		} else {

			$languageValue = "english";
			$langDataFile = "app_lang";

			$default_language = 0;

			$languageValue = "";

			$companyID = "";
			$childsData = FALSE;

			if ($res->default_language == 0) {
				$languageValue = "macedonian";				
			} else if ($res->default_language == 1) {
				$languageValue = "english";				
			} else if ($res->default_language == 2) {
				$languageValue = "albanian";				
			} else if ($res->default_language == 3) {
				$languageValue = "serbian";				
			}

			$useData = array(
				'id' => $res->id,
				'email' => $res->email,	
				'type' => $res->type,
				'language' => $res->default_language,
				'language_value' => $languageValue,
				'loggedin' => TRUE,
				'default_currency' => $res->default_currency,
				'invoice_number' => $res->invoice_number,
				'invoice_number_format' => $res->invoice_number_format,
				'invoice_number_pre' => $res->invoice_number_pre,
				'output_invoice_number' => $res->output_invoice_number,
				'output_invoice_number_format' => $res->output_invoice_number_format,
				'output_invoice_number_pre' => $res->output_invoice_number_pre,
				'current_invoice_no' => $res->current_invoice_no,
				'current_output_invoice_no' => $res->current_output_invoice_no,
				'tax_visible' => $res->tax_visible,
				'tax_calculate' => $res->tax_calculate
			);			
			
			$this->session->set_userdata( $useData );

			if ($res->type == "CUSTOMER") {

				redirect("customerdashboard");
			
			} else if ($res->type == "ADMIN") {

				redirect("admindashboard");
				
			} 
		}

	}

	public function customerdashboard() {

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation');
		$this->load->view("pages/customerdashboard");
		$this->load->view('templates/footer');
	}


	public function admindashboard() {

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigation');
		$this->load->view("pages/admindashboard");
		$this->load->view('templates/footer');
	}

	public function checkforcredentials_ajax() {

		$email = $this->input->post("email");
		$pass = $this->input->post("password");

		$res = $this->customer_model->findUserCredentialsByEmailAndPass($email, $pass);

		if (!$res) {
			$data["errormsg"] = "Wrong credentials";

			echo json_encode(array("status"=>"error","message"=>"Wrong credentials"));
			
			
		} else {

			$useData = array(
				'id' => $res->id,
				'email' => $res->email,	
				'type' => $res->type,
				'ifolder' => $res->images_folder,
				'loggedin' => TRUE,
				'default_currency' => $res->default_currency
			);
			
			

			if ($res->type == "CUSTOMER") {
				
				echo json_encode(array("status"=>"ok","loc"=>"customerdashboard","user_data"=>$useData));
			
			} else if ($res->type == "ADMIN") {

				echo json_encode(array("status"=>"ok","loc"=>"admindashboard","user_data"=>$useData));
				
			}
		}

	}

	public function savetosessionandredirect() {
		
	}

	public function requestnewpassword() {

		redirect("/login/forgotpassword", "refresh");

	}

	public function forgotpassword() {

		$this->load->view('templates/header');
		$this->load->view("pages/forgotpassword");
		$this->load->view('templates/footer');

	}

	public function generatetemppassword() {

		$email = $this->input->post("email");

		$createRandomPassword = $this->user_model->createTempPasswordForUser($email);

		$data = array("baseURL"=>base_url());

		if (!$createRandomPassword) {

			$data = array("status"=>"error", "errormsg"=>"Error while registering");
			
			$this->load->view('templates/header');
			$this->load->view("pages/forgotpassword", $data);
			$this->load->view('templates/footer');

		} else {

			//TODO:SEND MAIL WITH PASSWORD RESET LINK

			$this->phpmailer->IsSMTP();
	        // $this->phpmailer->SMTPDebug = 1;

	        $userName = "s1.2dmin1231011aa11ab@gmail.com";
	        $smtpHost = "smtp.gmail.com";
	        $secure = "tls"; 
	        $securePort = "587";
	        $smtpUsername = "s1.2dmin1231011aa11ab@gmail.com";
	        $smtpPassword = "testpass01";
	        $smtpAuth = TRUE; 
	        
	        //$mailTo = $this->input->post("mailto");
	        $mailTo = $email;
	        //$mailCC = $this->input->post("mailcc");     
	        //$mailBCC = $this->input->post("mailbcc");       
	        $mailSubject = html_entity_decode("PASSWORD RESET LINK");       
	        $mailBody = html_entity_decode("http://localhost/localspace/MarketApp/index.php/login/resetpassword?token=".$createRandomPassword);

	        try {            
	            $this->phpmailer->Host = $smtpHost;
	            $this->phpmailer->Port = $securePort;
	            $this->phpmailer->SMTPAuth = $smtpAuth;
	            $this->phpmailer->SMTPSecure = $secure;

	            $this->phpmailer->FromName = "Market App Mail System";
	            $this->phpmailer->From = $smtpUsername;
	            
	            $this->phpmailer->Username = $smtpUsername; 
	            $this->phpmailer->Password = $smtpPassword; 
	            
	            $this->phpmailer->AddReplyTo($smtpUsername, "Market App Admin");
	            $this->phpmailer->AddAddress($mailTo);
	                        
	            $this->phpmailer->Subject = $mailSubject;
	            $this->phpmailer->Body = $mailBody;
	            $this->phpmailer->IsHTML(TRUE);  
	            
	            $isMailSent = $this->phpmailer->Send();
	        } catch (phpmailerException $e) {
	            echo $e->errorMessage(); 
	        } catch (Exception $e) {
	            echo $e->getMessage();
	        }

			$this->load->view('templates/header');
			$this->load->view("pages/passwordsend", $data);
			$this->load->view('templates/footer');

		}

	}

	public function goback() {
		redirect("/login", "refresh");
	}	

	public function logout() {
		$this->session->sess_destroy();

		redirect("/login", "refresh");
	}

	public function signup() {

		$errorNo = $this->session->userdata("errno");
		
		$data = array();

		if ($errorNo && ($errorNo == "1" || $errorNo == "2")) {
			$errorMsg = $this->session->userdata("errormsg");

			$data["errormsg"] = $errorMsg;

			$this->session->unset_userdata("errno");
			$this->session->unset_userdata("errormsg");
		}

		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigationlogin1');
		$this->load->view("pages/signup",$data);
		$this->load->view('templates/footer');

	}

	public function resetpassword() {

		$tempPasswordKey = $this->input->get("token");

		$res = $this->user_model->checkTempPasswordRequest($tempPasswordKey);

		$data = array("baseURL"=>base_url());

		if (!$res) {
			$this->load->view('templates/header');
			$this->load->view("pages/wrongtoken", $data);
			$this->load->view('templates/footer');
		} else {

			$data["hiddentoken"] = $res["id"];

			$this->load->view('templates/header');
			$this->load->view("pages/resetpassword", $data);
			$this->load->view('templates/footer');
		}

	}

	public function updatepassword() {

		$password = $this->input->post("password");
		$hiddenToken = $this->input->post("hiddentoken");

		$updatePasswordResult = $this->user_model->updateCustomersPasswordByTempID($hiddenToken, $password);

		$data = array("baseURL"=>base_url());

		if (!$updatePasswordResult) {
			$data["status"] = "error";
			$data["errormsg"] = "Something goes wrong with password update, please contact administrator.";

		}

		$this->load->view('templates/header');
		$this->load->view("pages/passwordupdate", $data);
		$this->load->view('templates/footer');

	}

	public function createuser() {

		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$confirm_password = $this->input->post("confirm_password");
		$company_name = $this->input->post("company_name");
		$userType = "CUSTOMER";
		$userStatus = "ENABLE";
		
		if($password != $confirm_password){
			$data["errormsg"] = "The password and confirmation password do not match.";

			$this->session->set_userdata("errormsg", "Empty fields");
			$this->session->set_userdata("errno", "1");

			redirect("/login/signup");
		} else {

		if ($email == "" && $password == "") {
			$data["errormsg"] = "Empty email and password";

			$this->session->set_userdata("errormsg", "Empty fields");
			$this->session->set_userdata("errno", "1");

			redirect("/login/register");
		} else {

			$dataArray = array("email"=>$email, "password"=>$password, "userType"=>$userType, 
				"userStatus"=>$userStatus);

			$res = $this->user_model->saveUserAccount($dataArray);

			$companyDataArray = array(
						"company_name"=>$company_name, 
						"address"=>"", 
						"address2"=>"", 
						"city"=>"", 
						"zip"=>"", 
						"country"=>"", 
						"tel1"=>"", 
						"tel2"=>"", 
						"registration_number"=>"", 
						"unique_number"=>"",
						"tax_number"=>"",
						"iban_code"=>"", 
						"bank_name"=>"", 
						"bank_address"=>"", 
						"bank_account"=>"",
						"swift"=>"");

			$companyID = $this->customer_model->saveCompanyProfile($res, $companyDataArray);

			$dataArray = array(
						"userHash"=>$res, 
						"name"=>$company_name, 
						"address"=>"", 
						"address2"=>"", 
						"city"=>"", 
						"zip"=>"",
						"country"=>"", 
						"email"=>"", 
						"tel1"=>"", 
						"tel2"=>"", 
						"company_id"=>$companyID, 
						"registration_number"=>"", 
						"unique_number"=>"", 
						"tax_number"=>"", 
						"client_group"=>"");

			$res = $this->customer_model->addClient($dataArray,TRUE);

			if (!$res) {
				//$this->session->set_userdata("errormsg", "ERROR");
				//$this->session->set_userdata("errno", "1");
				redirect("/login/error");
			} else {
				//$this->session->set_userdata("errormsg", "Successful");
				//$this->session->set_userdata("errno", "2");	
				redirect("/login/successful");		
			}


			}

		}

	}

	public function successful() {

		$data["message"] = "You have been successfully registered, please go back and login.";
		
		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigationlogin');
		$this->load->view("pages/register_status", $data);
		$this->load->view('templates/footer');
	}

	public function error() {

		$data["message"] = "There have been an error with registration of your account, please go back and try again.";
		
		$this->load->view('templates/header');
		$this->load->view('templates/horizontalnavigationlogin');
		$this->load->view("pages/register_status", $data);
		$this->load->view('templates/footer');
	}

	private function add_months($months, DateTime $dateObject) 
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }

	private function endCycle($d1, $months)
    {
        $date = new DateTime($d1);

        $newDate = $date->add($this->add_months($months, $date));

        $newDate->add(new DateInterval('P1D')); 

        $dateReturned = $newDate->format('Y-m-d'); 

        return $dateReturned;
    }

	
}
