<?php 
include("connection.php"); 
ob_end_clean();
require('tcpdf/tcpdf.php');

$pdf = new TCPDF('P','mm','A4');
  
$pdf->setPrintHeader(false);

class MYPDF extends TCPDF {public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf->AddPage();
$pdf->Image('css/logo.jpeg',10,5,33);
$pdf->Cell(40);

$pdf->SetFont('Times','B',25);
$pdf->Cell(120,20,"3L TELECOMMUNICATION",0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Times','',18);
$pdf->Cell(190,10,"3L Telecommunication Yearly Sales Report",1,1,'C');
$pdf->Ln(10);

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->SetFont('Times','',12);
$html = <<<EOD
<table>
	<tr>
		<th>Year</th>
		<th>Total Sales</th>
	</tr>
EOD;
$pay_res=mysqli_query($connect,"SELECT SUM(payment.payment_total) AS total,YEAR(payment.payment_date) AS year FROM payment INNER JOIN shipping ON payment.payment_code=shipping.payment_code 
					 WHERE shipping.delivery_status=3 GROUP BY year(payment.payment_date) ORDER BY year(payment.payment_date)");
while($pay_row = mysqli_fetch_assoc($pay_res)){
	
	$html .= "<tr>
				<td>".$pay_row['year']."</td>
				<td>RM ".$pay_row['total']."</td>
			</tr>";
	
}
$html .= "</table>
			<style>
			table {border-collapse:collapse; border:1px solid black;
			border-right:1px solid black;}
			th,td {border:1px solid black; text-align:center;}
			table tr th {background-color:white;
						 color:black;
						 font-weight:bold;
						text-align:center;}
			</style>";

$pdf->WriteHTMLCell(205,0,3,'',$html,0);

$pdf->Output();
mysqli_close($connect);
?>

