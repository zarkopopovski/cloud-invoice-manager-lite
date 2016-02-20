<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require('tfpdf.php');

class InvoiceTemplateNo1 extends tFPDF
{

	public $invoiceTitles = FALSE;
	public $companyDataFrom = FALSE;
	public $companyDataTo = FALSE;
	public $invoiceData = FALSE;

	function __construct($orientation='P', $unit='mm', $size='A4')
	{
		// Call parent constructor
		parent::__construct($orientation,$unit,$size);
	}
	
	function Header()
	{
		$this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);

		if (isset($this->companyDataFrom["logo"]) && $this->companyDataFrom["logo"]) {
			// Logo
	    	$this->Image("./uploads/".$this->companyDataFrom["logo"],10,6,30);
		}
	    // Arial bold 15
	    //$this->SetFont('Arial','B',10);
	    $this->SetFont('DejaVu','',10);
	    // Move to the right
	    $this->Cell(70);
	    // Title
	    $this->Cell(120,5,$this->companyDataFrom["company_name"],0,1,'R');
	    //$this->SetFont('Arial','',10);
	    $this->SetFont('DejaVu','',10);
	    $this->Cell(70);
	    $this->Cell(120,5,$this->companyDataFrom["company_address"],0,1,'R');
	    $this->Cell(70);
	    $this->Cell(120,5,$this->companyDataFrom["zip"]." ".$this->companyDataFrom["city"],0,1,'R');
	    $this->Cell(70);
	    $this->Cell(120,5,$this->invoiceTitles["pib"].' '.$this->companyDataFrom["pib"],0,1,'R');
	    //$this->SetFont('Arial','',8);
	    $this->SetFont('DejaVu','',8);
	    $this->Cell(70);
	    $this->Cell(120,5,$this->invoiceTitles["unique_number"].' '.$this->companyDataFrom["unique_number"].' '.$this->invoiceTitles["reg_number"].' '.$this->companyDataFrom["reg_number"],0,1,'R');
	    $this->Cell(70);
	    $this->Cell(120,5,$this->invoiceTitles["tel"].' '.$this->companyDataFrom["tel1"].' '.$this->companyDataFrom["tel2"],0,1,'R');
	    $this->Cell(70);
	    $this->Cell(120,5,$this->invoiceTitles["account"].' '.$this->companyDataFrom["account"],0,1,'R');
	    $this->Line(10,45,200,45);
		
		$this->Ln(7);
		$this->SetFillColor(181,181,181);
		//$this->SetDrawColor(0,0,0);
		$this->Rect(10,54,80,12);
		$this->Rect(90,54,110,12,"DF");
		//$this->SetFont('Arial','B',16);
		$this->SetFont('DejaVu','',16);
	    $this->Cell(95,15,$this->invoiceData["invoice_title"],0,0,'L');
	    $this->SetFont('DejaVu','',10);
	    //$this->SetFont('Arial','',10);
	    $this->Ln(3);
	    $this->Cell(90);
	    $this->Cell(100,5,$this->invoiceTitles["invoice_no"]." ".$this->invoiceData["invoice_no"],0,1,"R");
	    $this->Cell(90);
	    $this->Cell(100,5,$this->invoiceTitles["invoice_date"]." ".$this->invoiceData["invoice_date"],0,0,"R");
	    // Line break
	    $this->Ln(10);

	    $this->Cell(30,5,$this->invoiceTitles["company_to"].' ',0,1,'L');
	    $this->Rect(10,75,30,6);
	    $this->Rect(40,75,160,6);
	    $this->Rect(10,81,30,12);
	    $this->Rect(40,81,160,12);

	    $this->Cell(30,6,$this->invoiceTitles["company"],0,0,'L');
	    $this->Cell(160,6,$this->companyDataTo["company_name"],0,1,'L');
	    $this->Cell(30,10,$this->invoiceTitles["address"],0,0,'L');
	    $this->Cell(160,5,$this->companyDataTo["zip"].' '.$this->companyDataTo["city"].','.$this->companyDataTo["company_address"],0,1,'L');
	    $this->Cell(30);
	    $this->Cell(160,5,$this->invoiceTitles["pib"].$this->companyDataTo["pib"]." ".$this->invoiceTitles["dok"]." ".$this->companyDataTo["dok"],0,1,'L');

	    $this->Ln(14);
	    
	}

	// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    //$this->SetFont('Arial','I',8);
	    $this->SetFont('DejaVu','',8);
	    // Page number
	    $this->Cell(0,10,$this->invoiceTitles["page"].' '.$this->PageNo().'/{nb}',0,0,'C');
	}
	// Load data
	function LoadData($file)
	{
		// Read file lines
		$lines = file($file);
		$data = array();
		foreach($lines as $line)
			$data[] = explode(';',trim($line));
		return $data;
	}

	// Colored table
	function FancyTable($header, $data)
	{
		// Colors, line width and bold font
		$this->SetFillColor(181,181,181);
		$this->SetTextColor(255);
		$this->SetDrawColor(0,0,0);
		//$this->SetLineWidth(.3);
		//$this->SetFont('','B', 6);
		$this->SetFont('DejaVu','',6);

		$lastLine = 0;
		// Header
		//$w = array(40, 35, 40, 45);
		for($i=0;$i<count($header);$i++) {
			$this->Cell($header[$i][1],7,$header[$i][0],1,0,'C',true);
			$lastLine += $header[$i][1];
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		
		$fill = false;
		$counter = 0;
		$rowNum = 1;
		foreach($data as $row)
		{	
			if ($counter == 26) {
				$this->Cell($lastLine,0,'','T');
				$this->AddPage();
				$counter = 0;

				$this->SetFillColor(181,181,181);
				$this->SetTextColor(255);
				$this->SetDrawColor(0,0,0);

				for($i=0;$i<count($header);$i++) {
					$this->Cell($header[$i][1],7,$header[$i][0],1,0,'C',true);
				}

				$this->Ln();
				// Color and font restoration
				$this->SetFillColor(224,235,255);
				$this->SetTextColor(0);
				$this->SetFont('');
			}
			$this->Cell($header[0][1],6,$rowNum,'LR',0,'C',$fill);
			$this->Cell($header[1][1],6,$row[0],'LR',0,'C',$fill);
			$this->Cell($header[2][1],6,$row[1],'LR',0,'C',$fill);
			$this->Cell($header[3][1],6,$row[2],'LR',0,'C',$fill);
			$this->Cell($header[4][1],6,$row[3],'LR',0,'C',$fill);
			$this->Cell($header[5][1],6,$row[4],'LR',0,'C',$fill);
			$this->Cell($header[6][1],6,$row[5],'LR',0,'C',$fill);
			$this->Cell($header[7][1],6,$row[6],'LR',0,'C',$fill);
			$this->Cell($header[8][1],6,$row[7],'LR',0,'C',$fill);
			$this->Cell($header[9][1],6,$row[8],'LR',0,'C',$fill);
			$this->Ln();
			$fill = !$fill;
			$counter++;
			$rowNum++;
		}
		
		$this->Cell($lastLine,0,'','T');

		$this->Ln(8);

	}

	function DrawTaxTable($tax, $total)
	{

		if ($this->GetY() > 240) {
			$this->AddPage();
		}

		$this->SetFont('DejaVu','',8);

		$taxDraw = FALSE;

		foreach ($tax as $taxLine) {
			if (!$taxDraw) {
				$this->Cell(160,5,$this->invoiceTitles["tax"].": ",0,0,'R');
				$taxDraw = TRUE;
			} else {
				$this->Cell(160);
			}
	    	$this->Cell(30,5,$taxLine[0]."%  ".$taxLine[1],0,1,'L');
		}

		$this->Ln(8);

		$this->Cell(70);
		$this->Cell(120,5,$this->invoiceTitles["subtotal"]." ".$total[0]." ".$this->invoiceTitles["gst"]." ".$total[1]." ".$this->invoiceTitles["total"]." ".$total[2],0,1,'R');

		$this->Ln(8);
	}

	function DrawCommentBox($comment)
	{
		if ($this->GetY() > 210) {
			$this->AddPage();
		}

		$this->SetFont('DejaVu','',12);
		$this->Cell(120,5,$this->invoiceTitles["comment"]."",0,1,'L');

		$boxY = $this->GetY()+2;
		
		$this->SetFont('DejaVu','',10);
		$this->Rect(10,$boxY,190,40);
		$this->Ln(2);

		
		$this->MultiCell(190,5,$this->invoiceData["comment"],0,'L',false);

		$this->Line(10,$boxY + 65,80,$boxY + 65);
		$this->Line(130,$boxY + 65,200,$boxY + 65);

		$this->Ln(62);

		$this->Cell(70,5,$this->companyDataFrom["company_name"],0,0,'C');
		$this->Cell(170,5,$this->companyDataTo["company_name"],0,1,'C');


	}

}


?>
