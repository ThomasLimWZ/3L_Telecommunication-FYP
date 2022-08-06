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
$pdf->Cell(190,10,"3L Telecommunication Product Sales Report",1,1,'C');
$pdf->Ln(10);

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->SetFont('Times','',12);
$html = <<<EOD
<table>
	<tr>
		<th width="25px">No.</th>
		<th width="200px">Order Product</th>
		<th width="80px">Capacity/Size</th>
		<th width="80px">Color</th>
		<th width="80px">Price</th>
		<th width="30px">Qty</th>
		<th width="80px">TOTAL</th>
	</tr>
EOD;

	$i=1;
	$detail_res = mysqli_query($connect,"SELECT cart.product_code,cart.product_detail_code,cart.product_color,cart.product_price,SUM(cart.quantity) AS quantity FROM cart JOIN shipping ON cart.payment_code=shipping.payment_code 
	WHERE cart.cart_status=0 AND shipping.delivery_status=3 GROUP BY product_detail_code,product_color");
	while($detail_row = mysqli_fetch_assoc($detail_res)){
		$pcode = $detail_row['product_code'];
		$detail = $detail_row['product_detail_code'];
		$total = $detail_row['quantity'] * $detail_row['product_price'];
		$prod_res = mysqli_query($connect,"SELECT * FROM product WHERE product_code='$pcode'");
		$prod_row = mysqli_fetch_assoc($prod_res);
		$res = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_detail_code='$detail'");
		$row = mysqli_fetch_assoc($res);

	$html .= "<tr>
				<td>".$i."</td>
				<td>".$prod_row['product_name']."</td>
				<td>".$row['product_capacity']."</td>
				<td>".$detail_row['product_color']."</td>
				<td>RM ".$detail_row['product_price']."</td>
				<td>".$detail_row['quantity']."</td>
				<td>RM ".number_format((float)$total,2)."</td>
			</tr>";
			$i++;
	}
$html .= "</table>
			<style>
			table {border-collapse:collapse; border:1px solid black;
			border-right:1px solid black;}
			th,td {border:1px solid black;}
			table tr th {background-color:white;
						 color:black;
						 font-weight:bold;
						text-align:center;}
			</style>";

$pdf->WriteHTMLCell(205,0,3,'',$html,0);

$pdf->Output();
mysqli_close($connect);
?>

