<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("PARAM_INVOICE", "INVOICE");

class DocumentsService extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model("customer_model");
		
		$this->load->library('session');
		$this->load->library("PHPMailer");
		$this->load->helper("url"); 
		$this->load->helper('form');
		$this->load->helper('language');
		$this->load->helper('basic');

		$langValue = $this->session->userdata("language_value");

		$this->lang->load('app_data', (isset($langValue))?$langValue:"english");

		if (!$this->session->userdata("loggedin")) {
  			 redirect("/login");
  		}
	}

	public function index()
	{
		
	}

	public function print_invoice_in_pdf() {

		$this->load->library("InvoiceTemplateNo1");

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');

		$formatStyle = FALSE;
		$invoicePrefix = FALSE;

		$invoiceID = $this->input->get("invoice_id");

		$profileData = $this->customer_model->getProfileData($userHash);
		$companyProfileData = $this->customer_model->getCompanyProfileData($userHash);

		$invoice = $this->customer_model->getInvoiceForEdit($invoiceID, $userHash);
		$products = $this->customer_model->getInvoiceProducts($invoiceID, $userHash);

		$invoiceType = $invoice["invoice_type"];

		$invoiceTitles = array(
			"pib"=>lang('invoice_short_tax_id'),
			"unique_number"=>lang('invoice_unique_number'),
			"reg_number"=>lang('invoice_reg_number'),
			"tel"=>lang('invoice_tel'),
			"invoice_no"=>lang('invoice_invoice_no'),
			"invoice_date"=>lang('invoice_invoice_date'),
			"company_to"=>lang('invoice_company_to'),
			"company"=>lang('invoice_company'),
			"address"=>lang('invoice_address'),
			"dok"=>lang('invoice_dok'),
			"page"=>lang('invoice_page'),
			"comment"=>lang('invoice_comment'),
			"account"=>lang('invoice_account'),
			"tax"=>lang('invoice_tax'),
			"subtotal"=>lang('invoice_subtotal'),
			"gst"=>lang('invoice_gst'),
			"total"=>lang('invoice_total')
			);

		// Column headings
		$header = array(
					array(lang("invoice_no"),12), 
					array(lang("invoice_code"),20), 
					array(lang("invoice_article"),50), 
					array(lang("invoice_unit_id"),10), 
					array(lang("invoice_quantity"),14), 
					array(lang("invoice_price"),20), 
					array(lang("invoice_tax"),8),
					array(lang("invoice_discount"),16),
					array(lang("invoice_tax_sum"),20), 
					array(lang("invoice_sum"),20));

		$companyDataFrom = FALSE;
		$companyDataTo = FALSE;

		$currentInvoiceNumber = $invoice["invoice_number"];

		$companyDataFrom = array(
		"logo"=>$companyProfileData["company_logo"],
		"full_name"=>$profileData["first_name"]." ".$profileData["last_name"],
		"company_name"=>$companyProfileData["company_name"],
		"company_address"=>$companyProfileData["address"]." ".$companyProfileData["address2"],
		"zip"=>$companyProfileData["zip"],
		"city"=>$companyProfileData["city"],
		"pib"=>$companyProfileData["tax_number"],
		"unique_number"=>$companyProfileData["unique_number"],
		"reg_number"=>$companyProfileData["registration_number"],
		"tel1"=>$companyProfileData["tel1"],
		"tel2"=>$companyProfileData["tel2"],
		"account"=>$companyProfileData["bank_account"]);

		$companyDataTo = array(
		"company_name"=>$invoice["name"],
		"company_address"=>$invoice["address"]." ".$invoice["address2"],
		"zip"=>$invoice["zip"],
		"city"=>$invoice["city"],
		"pib"=>"-",
		"dok"=>"-");
		
		$invoiceTitle = "";

		$invoiceTitle = lang("invoice_title_output");
		$formatStyle = $this->session->userData('output_invoice_number_format');
		$invoicePrefix = $this->session->userData('output_invoice_number_pre');
		 

		if ($formatStyle) {
			$currentInvoiceNumber =  createDocumentNumberByStyle($currentInvoiceNumber, $formatStyle, $invoicePrefix);
		}

		$invoiceData = array(
			"invoice_title"=>$invoiceTitle,
			"invoice_no"=>$currentInvoiceNumber,
			"invoice_date"=>$invoice["date_created"],
			"comment"=>$invoice["comment"]);

		$data = array();

		$invoiceSum = 0;
		$taxSum = 0;
		$subTotal = 0;

		$invoiceTax = array();

		foreach ($products as $product) {

			$productPrice = ($invoiceType == "INPUT")?$product["input_price"]:$product["output_price"];

			$sumBasic = $productPrice * $product["quantity"];

			$discountPrice = $sumBasic / 100 * $product["quantity"];
			$sumAll = $sumBasic - $discountPrice;

			$taxPrice = $sumAll / 100 * $product["tax"];

			$lineTotal = $sumAll + $taxPrice;

			$taxDiferent = 0;
			$taxSumDiferent = 0;

			$invoiceSum+=$lineTotal;
			$taxSum+=$taxPrice;
			$subTotal += $sumAll;

			if (sizeof($invoiceTax) == 0) {

				$invoiceTax[] = array($product["tax"], $taxPrice);							

			} else {

				for ($j = 0; $j < sizeof($invoiceTax); $j++) {
					if ($invoiceTax[$j][0] == $product["tax"]) {
						$invoiceTax[$j][1]+=$taxPrice;									
					} else {
						$invoiceTax[] = array($product["tax"], $taxPrice);							
						break;
					}
				}

			} 

			$data[] = array(
						$product["product_code"], 
						$product["name"], 
						$product["unit"],
						$product["quantity"],
						$productPrice,
						$product["tax"],
						$product["discount"],
						$taxPrice,
						$lineTotal
						);

		}

		$tax = $invoiceTax;

		$total = array($subTotal, $taxSum, $invoiceSum);

		//$pdf = new PDF();
		$this->invoicetemplateno1->companyDataFrom = $companyDataFrom;
		$this->invoicetemplateno1->companyDataTo = $companyDataTo;
		$this->invoicetemplateno1->invoiceData = $invoiceData;
		$this->invoicetemplateno1->invoiceTitles = $invoiceTitles;

		$this->invoicetemplateno1->AliasNbPages();
		$this->invoicetemplateno1->SetAutoPageBreak(true, 20);
		$this->invoicetemplateno1->AddPage();
		$this->invoicetemplateno1->FancyTable($header,$data);
		$this->invoicetemplateno1->DrawTaxTable($tax, $total);
		$this->invoicetemplateno1->DrawCommentBox("-");

		$this->invoicetemplateno1->Output("invoice.pdf","D");

	}

	public function mail_invoice_to_client() {

		$this->load->library("InvoiceTemplateNo1");

		$userHash = $this->session->userData('id');
		$companyID = $this->session->userData('company_id');
		$userEmail = $this->session->userData('email');
		$invoiceID = $this->input->post("invoice_id");

		$formatStyle = FALSE;

		$emailAddress = $this->input->post("email_address");
		$emailSubject = $this->input->post("email_subject");
		$emailBody = $this->input->post("email_body");

		$profileData = $this->customer_model->getProfileData($userHash);
		$companyProfileData = $this->customer_model->getCompanyProfileData($userHash);

		$invoice = $this->customer_model->getInvoiceForEdit($invoiceID, $userHash);
		$products = $this->customer_model->getInvoiceProducts($invoiceID, $userHash);

		$invoiceType = $invoice["invoice_type"];

		$invoiceTitles = array(
			"pib"=>lang('invoice_short_tax_id'),
			"unique_number"=>lang('invoice_unique_number'),
			"reg_number"=>lang('invoice_reg_number'),
			"tel"=>lang('invoice_tel'),
			"invoice_no"=>lang('invoice_invoice_no'),
			"invoice_date"=>lang('invoice_invoice_date'),
			"company_to"=>lang('invoice_company_to'),
			"company"=>lang('invoice_company'),
			"address"=>lang('invoice_address'),
			"dok"=>lang('invoice_dok'),
			"page"=>lang('invoice_page'),
			"comment"=>lang('invoice_comment'),
			"account"=>lang('invoice_account'),
			"tax"=>lang('invoice_tax'),
			"subtotal"=>lang('invoice_subtotal'),
			"gst"=>lang('invoice_gst'),
			"total"=>lang('invoice_total')
			);

		// Column headings
		$header = array(
					array(lang("invoice_no"),12), 
					array(lang("invoice_code"),20), 
					array(lang("invoice_article"),50), 
					array(lang("invoice_unit_id"),10), 
					array(lang("invoice_quantity"),14), 
					array(lang("invoice_price"),20), 
					array(lang("invoice_tax"),8),
					array(lang("invoice_discount"),16),
					array(lang("invoice_tax_sum"),20), 
					array(lang("invoice_sum"),20));

		$companyDataFrom = FALSE;
		$companyDataTo = FALSE;

		$currentInvoiceNumber = $invoice["invoice_number"];

		$companyDataFrom = array(
		"logo"=>$companyProfileData["company_logo"],
		"full_name"=>$profileData["first_name"]." ".$profileData["last_name"],
		"company_name"=>$companyProfileData["company_name"],
		"company_address"=>$companyProfileData["address"]." ".$companyProfileData["address2"],
		"zip"=>$companyProfileData["zip"],
		"city"=>$companyProfileData["city"],
		"pib"=>$companyProfileData["tax_number"],
		"unique_number"=>$companyProfileData["unique_number"],
		"reg_number"=>$companyProfileData["registration_number"],
		"tel1"=>$companyProfileData["tel1"],
		"tel2"=>$companyProfileData["tel2"],
		"account"=>$companyProfileData["bank_account"]);

		$companyDataTo = array(
		"company_name"=>$invoice["name"],
		"company_address"=>$invoice["address"]." ".$invoice["address2"],
		"zip"=>$invoice["zip"],
		"city"=>$invoice["city"],
		"pib"=>"-",
		"dok"=>"-");
		
		$invoiceTitle = "";

		$invoiceTitle = lang("invoice_title_output");
		$formatStyle = $this->session->userData('output_invoice_number_format');

		if ($formatStyle) {
			$currentInvoiceNumber =  createDocumentNumberByStyle($currentInvoiceNumber, $formatStyle);
		}

		$invoiceData = array(
			"invoice_title"=>$invoiceTitle,
			"invoice_no"=>$currentInvoiceNumber,
			"invoice_date"=>$invoice["date_created"],
			"comment"=>$invoice["comment"]);

		$data = array();

		$invoiceSum = 0;
		$taxSum = 0;
		$subTotal = 0;

		$invoiceTax = array();

		foreach ($products as $product) {

			$productPrice = ($invoiceType == "INPUT")?$product["input_price"]:$product["output_price"];

			$sumBasic = $productPrice * $product["quantity"];

			$discountPrice = $sumBasic / 100 * $product["quantity"];
			$sumAll = $sumBasic - $discountPrice;

			$taxPrice = $sumAll / 100 * $product["tax"];

			$lineTotal = $sumAll + $taxPrice;

			$taxDiferent = 0;
			$taxSumDiferent = 0;

			$invoiceSum+=$lineTotal;
			$taxSum+=$taxPrice;
			$subTotal += $sumAll;

			if (sizeof($invoiceTax) == 0) {

				$invoiceTax[] = array($product["tax"], $taxPrice);							

			} else {

				for ($j = 0; $j < sizeof($invoiceTax); $j++) {
					if ($invoiceTax[$j][0] == $product["tax"]) {
						$invoiceTax[$j][1]+=$taxPrice;									
					} else {
						$invoiceTax[] = array($product["tax"], $taxPrice);							
						break;
					}
				}

			} 

			$data[] = array(
						$product["product_code"], 
						$product["name"], 
						$product["unit"],
						$product["quantity"],
						$productPrice,
						$product["tax"],
						$product["discount"],
						$taxPrice,
						$lineTotal
						);

		}

		$tax = $invoiceTax;

		$total = array($subTotal, $taxSum, $invoiceSum);

		//$pdf = new PDF();
		$this->invoicetemplateno1->companyDataFrom = $companyDataFrom;
		$this->invoicetemplateno1->companyDataTo = $companyDataTo;
		$this->invoicetemplateno1->invoiceData = $invoiceData;
		$this->invoicetemplateno1->invoiceTitles = $invoiceTitles;

		$this->invoicetemplateno1->AliasNbPages();
		$this->invoicetemplateno1->SetAutoPageBreak(true, 20);
		$this->invoicetemplateno1->AddPage();
		$this->invoicetemplateno1->FancyTable($header,$data);
		$this->invoicetemplateno1->DrawTaxTable($tax, $total);
		$this->invoicetemplateno1->DrawCommentBox("-");

		$tempInvoiceFilename = md5(time().rand(999,9999)."invoice.pdf".rand(999,9999))."_invoice.pdf";


		$this->invoicetemplateno1->Output("./uploads/".$tempInvoiceFilename,"F");
		
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
        $mailTo = $emailAddress;
        //$mailCC = $this->input->post("mailcc");     
        //$mailBCC = $this->input->post("mailbcc");       
        $mailSubject = html_entity_decode("Invoice No:".$invoice["invoice_number"]);       
        $mailBody = html_entity_decode("Please check the invoice from the attachment");

        $mailSubject = (isset($emailSubject) && $emailSubject != "")?html_entity_decode($emailSubject):html_entity_decode("Invoice No:".$invoice["invoice_number"]);       
        $mailBody = (isset($emailBody) && $emailBody != "")?html_entity_decode($emailBody):html_entity_decode("Please check the request note from the attachment");

        try {            
            $this->phpmailer->Host = $smtpHost;
            $this->phpmailer->Port = $securePort;
            $this->phpmailer->SMTPAuth = $smtpAuth;
            $this->phpmailer->SMTPSecure = $secure;

            $this->phpmailer->FromName = "Cloud Invoice Manager Lite Mail System";
            $this->phpmailer->From = $smtpUsername;
            
            $this->phpmailer->Username = $smtpUsername; 
            $this->phpmailer->Password = $smtpPassword; 
            
            $this->phpmailer->AddReplyTo($userEmail, $companyProfileData["company_name"]);
            $this->phpmailer->AddAddress($mailTo);
                        
            $this->phpmailer->Subject = $mailSubject;
            $this->phpmailer->Body = $mailBody;
            $this->phpmailer->AddAttachment("./uploads/".$tempInvoiceFilename,"invoice.pdf");
            $this->phpmailer->IsHTML(TRUE);  
            
            $isMailSent = $this->phpmailer->Send();

			echo "Invoice is send successfull";
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); 

			echo "Error sending mail";
        } catch (Exception $e) {
            echo $e->getMessage();

			echo "Error sending mail";
        }

        unlink("./uploads/".$tempInvoiceFilename);

        exit(0);
		
	}

	private function saveEncodedPNGImages($pngData) {

		$encodedPNG = str_replace(' ','+',$pngData);
		
		$encodedPNG =  str_replace('data:image/png;base64,', '', $encodedPNG);

		$imageSHA1String = sha1(time().$encodedPNG.rand(999,9999));

		$fileName = 'chart_'. $imageSHA1String . '.png';

		$decoded=base64_decode($encodedPNG);
		
		if(!file_put_contents('./uploads/' . $fileName,$decoded)){
			return FALSE;
		}

		return $fileName;

	}

}

/* End of file documentsservice.php */
/* Location: ./application/controllers/documentsservice.php */