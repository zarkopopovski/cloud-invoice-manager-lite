<?php

  function createDocumentNumberByStyle($currentNumber, $numberStyle, $formatPrefix = FALSE, $withYear = FALSE) {

      $number = $currentNumber;

      if ($number < 10) {
        $number = "000000".$number;
      } else if ($number < 100) {
        $number = "00000".$number;
      } else if ($number < 1000) {
        $number = "0000".$number;
      } else if ($number < 10000) {
        $number = "000".$number;
      } else if ($number < 100000) {
        $number = "00".$number;
      } else if ($number < 1000000) {
        $number = "0".$number;
      } else if ($number < 10000000) {
        $number = $number;
      }

      if ($numberStyle == "NUMBER") {
        # code...
      } else if ($numberStyle == "YEARMINUMBER") {
        $currentDate = (!$withYear)?date("Y"):formatYearByStyle($withYear, $numberStyle);
        $number = $currentDate." - ".$number;
      } else if ($numberStyle == "YRMINUMBER") {
        $currentDate = (!$withYear)?date("y"):formatYearByStyle($withYear, $numberStyle);
        $number = $currentDate." - ".$number;
      } else if ($numberStyle == "NUMBERSLYEAR") {
        $currentDate = (!$withYear)?date("Y"):formatYearByStyle($withYear, $numberStyle);
        $number = $number." / ".$currentDate;
      } else if ($numberStyle == "NUMBERSLYR") {
        $currentDate = (!$withYear)?date("y"):formatYearByStyle($withYear, $numberStyle);
        $number = $number." / ".$currentDate;
      }

      if ($formatPrefix) {
        $number = $formatPrefix." ".$number;
      }

      return $number;

  }

  function formatYearByStyle($year, $numberStyle) {

      $explodeByComponents = explode("-", $year);

      $formatedYear = $explodeByComponents[0];

      if ($numberStyle == "YRMINUMBER" || $numberStyle == "NUMBERSLYR") {
        $formatedYear = substr($year, 2, 2);
      }

      return $formatedYear;

  }

	function createCustomeMenuForBaseURL($baseURL, $index, $permissionMap) {
		if (!isset($index)) {
			$index = 0;
		}

		echo"
		<ul class='mainnav'>
        <li ".(($index==0)?"class='active'":"")."><a href='".site_url('customerdashboard')."'><i class='icon-dashboard'></i><span>".lang('menu_dashboard')."</span> </a> </li>";
        
    echo "<li ".(($index==1)?"class='active'":"")."><a href='".site_url('customerdashboard/products')."'><i class='icon-th'></i><span>".lang('menu_products')."</span> </a></li>";
                
    echo "<li ".(($index==2)?"class='active'":"")."><a href='".site_url('customerdashboard/clients')."'><i class='icon-user'></i><span>".lang('menu_clients')."</span> </a> </li>";
                
    echo "<li ".(($index==3)?"class='active'":"")."><a href='".site_url('customerdashboard/invoices')."'><i class='icon-columns'></i><span>".lang('menu_invoices')."</span> </a> </li>";
          
    echo "</ul>";


	}





?>