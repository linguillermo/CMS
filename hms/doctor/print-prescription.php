<?php

  include_once 'FPDF/fpdf.php';
    require "include/aes256.php";
  $pdf = new FPDF('P','mm','Letter');
  $pdf->AddPage();
  

  $pdf->SetFont("Arial","B",9);
      $pdf->SetFillColor(19, 41, 16);
        $pdf->SetTextColor(255);
        $pdf->Cell(0, 5, "", 0, 1, 'C', true);

   $pdf->SetFont("Times","B",16);
  $pdf->SetFillColor(19, 41, 16);

    $pdf->Cell(0, 10, "CLINICA ABELEDA", 0, 1, 'C', true);

$pdf->SetFont("Arial","B",10);
    $pdf->SetFillColor(19, 41, 16);

      $pdf->Cell(0, 5, "MA. ROCHELLE A. DE GUZMAN - ABELEDA, MD.", 0, 1, 'C', true);

      $pdf->SetFont("Times","BI",10);
          $pdf->SetFillColor(19, 41, 16);

            $pdf->Cell(0, 5, "FELLOW, PHILIPPINE ACADEMY OF CLINICAL AND COSMETIC DERMATOLOGY", 0, 1, 'C', true);

            $pdf->SetFont("Arial","B",9);
                $pdf->SetFillColor(19, 41, 16);

                  $pdf->Cell(0, 5, "An Affiliate Society of the Philippine Medical Association", 0, 1, 'C', true);
                  $pdf->Cell(0, 5, "", 0, 1, 'C', true);




$pdf->SetFillColor(255);
$pdf->SetTextColor(19, 41, 16);
$pdf->SetFont("Arial","B",9);
$pdf->Ln(5);
$pdf->Cell(130, 5, "CLINIC DETAILS", 0, 0 );
$pdf->Cell(59, 5, "CLINIC HOURS", 0, 1 );

$pdf->SetFont("Arial","",9);
$pdf->Cell(130, 5, "    Burgos Ave., Cabanatuan City", 0, 0 );
$pdf->Cell(59, 5, "   Mon. to Sat (9:30 am - 6:00 pm)", 0, 1 );
$pdf->Cell(0, 5, "    Tel: (044) 463-0893", 0, 1 );
$pdf->Cell(0, 5, "    Mobile: 0929-297-8560 (SMART)", 0, 1 );
$pdf->Cell(0, 5, "                 0929-297-8560 (GLOBE)", 0, 1 );

// Body start:

 $conn = new mysqli('localhost', 'u949229776_admin', 'CMA_adm1n', 'u949229776_hms');
	  
	  
	  if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error); }


      $vid=$_GET['viewid'];
     $select = "SELECT * FROM tblpatient where ID='$vid'";
     $result = $conn->query($select);

  //$pdf = new FPDF('P','mm','Letter');
  //$pdf->AliasNbPages();
  //$pdf->AddPage();
  
  while($row = $result->fetch_object()){
	 
  $pname = $row->PatientName;
  $paddress = $row->PatientAdd;
  $pphone = $row->PatientContno;
  $date = $row->CreationDate;
  
$pdf->Ln(5);
$pdf->Cell(0, 5, "", 'T', 0, 'C');
$pdf->Cell(5, 10, "", 'T', 0, 'C');


$pdf->Ln(5);
$pdf->SetFont("Arial","",12);
$pdf->Cell(90, 5,$decryptSample = decryptthis( $pname, key), 0, 1 );


$pdf->SetFont("Arial","",10);

	
$pdf->Cell(90, 5,$decryptSample = decryptthis( $paddress, key), 0, 1 );

$pdf->Cell(90, 5,$decryptSample = decryptthis( $pphone, key), 0, 1 );

$pdf->Ln();

  //}





$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(130, 5, "Rx", 0, 0 );
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, $date, 0, 1 );
}

$pdf->Ln(5);
 
  
$pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(245, 245, 245);

    $pdf->SetTextColor(85, 85, 85);
    $pdf->SetDrawColor(221, 221, 221);
 
	
    $pdf->Ln(9);
    $pdf->Cell(50, 19, "Medication", 1, 0, 'C', true);
	$pdf->Cell(15, 19, "Quantity", 1, 0, 'C', true);
	$pdf->Cell(20, 10, "Morning", 1, 0, 'C', true);
	$pdf->Cell(20, 10, "Afternoon", 1, 0, 'C', true);
	$pdf->Cell(20, 10, "Night", 1, 0, 'C', true);
	$pdf->Cell(20, 19, "Duration", 1, 0, 'C', true);
	$pdf->Cell(55, 19, "Instructions", 1, 0, 'C', true);
	
	
	
	$pdf->Ln(9);
	 $pdf->Cell(30, 20, "", 0, 0);
	$pdf->Cell(35, 20, "", 0, 0);
	$pdf->Cell(10, 10, "BM", 1, 0, 'C', true);
	$pdf->Cell(10, 10, "AM", 1, 0, 'C', true);
	$pdf->Cell(10, 10, "BM", 1, 0, 'C', true);
	$pdf->Cell(10, 10, "AM", 1, 0, 'C', true);
	$pdf->Cell(10, 10, "BM", 1, 0, 'C', true);
	$pdf->Cell(10, 10, "AM", 1, 0, 'C', true);
	
	
	$pdf->Ln(10);
	$pdf->SetFont('Arial', 'B', 9);

	
	 $prescid=$_GET['prescid'];
			$select="select * from tblprescription where prescID='$prescid'";
			$result = $conn->query($select);
			
	while($row = $result->fetch_object()){
				
		   $pmed = $row->Medication;
           $pquant = $row->Quantity;
		   $pinst = $row->instructions;
		   $mbm = $row->morningBM;
		   $mam = $row->morningAM;
		   $abm = $row->afternoonBM;
		   $aam = $row->afternoonAM;
		   $ebm = $row->eveningBM; 
		   $eam = $row->eveningAM;
		   $dur = $row->duration;
		  
		   
		  
		   $y = $pdf->GetY();
  		 $pdf->MultiCell(50, 5, $decryptSample = decryptthis( $pmed, key), 1,1,);
  		 $pdf->SetXY(60,$y);
		    
	        $pdf->Cell(15, 10, $decryptSample = decryptthis( $pquant, key),1, 0, 'C');
	        $pdf->Cell(10, 10, $decryptSample = decryptthis( $mbm, key), 1, 0, 'C');
	        $pdf->Cell(10, 10, $decryptSample = decryptthis( $mam, key), 1, 0, 'C');
			$pdf->Cell(10, 10, $decryptSample = decryptthis( $abm, key), 1, 0, 'C');
			$pdf->Cell(10, 10, $decryptSample = decryptthis( $aam, key), 1, 0, 'C');
			$pdf->Cell(10, 10, $decryptSample = decryptthis( $ebm, key), 1, 0, 'C');
			$pdf->Cell(10, 10, $decryptSample = decryptthis( $eam, key), 1, 0, 'C');
			$pdf->Cell(20, 10, $decryptSample = decryptthis( $dur, key), 1, 0, 'C');
			
			
			 $pdf->SetX(155);
			$pdf->MultiCell(55, 10, $decryptSample = decryptthis( $pinst, key), 1,2,);
			 
			 
			
				 
	
	
	
  
	}






//End of Body








$pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(19, 41, 16);
    $pdf->SetXY(10,-50);
  //  $pdf->Cell(0, 5, "", 'T', 0, 'C');
    
    $pdf->Cell(110, 6, "Next Appointment:", 0, 0 );
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(69, 6, "Maria Rochelle A. De Guzman-Abeleda, MD", 0, 1 );

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(110, 6, "Please confirm your appointment before coming.", 0, 0 );
    $pdf->Cell(69, 6, "License No.: 76500", 0, 1 );

    $pdf->Cell(110, 6, "Thank you.", 0, 0 );
    $pdf->Cell(69, 6, "PTR No.: ", 0, 1 );

    $pdf->Cell(110, 6, "", 0, 0 );
    $pdf->Cell(69, 6, "S2: ", 0, 1 );

  $pdf->Output();

 ?>