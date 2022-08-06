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

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

if(isset($_GET["pdf"])){
    $pay_code = $_GET["code"];

    $result = mysqli_query($connect, "SELECT * FROM cart WHERE payment_code='$pay_code'");
    $row = mysqli_fetch_assoc($result);
    
    $ship_res = mysqli_query($connect,"SELECT * FROM shipping WHERE payment_code='$pay_code'");
    $ship_row = mysqli_fetch_assoc($ship_res);
    
    $pay_res = mysqli_query($connect,"SELECT * FROM payment WHERE payment_code='$pay_code'");
    $pay_row = mysqli_fetch_assoc($pay_res);
}

$pdf->SetFont('Times','',12);

$date_time = $row['payment_date'];
$date = date("d/m/Y",strtotime($date_time));

if(!empty($ship_row['tracking_number'])){
    $html = "<p>INVOICE: &nbsp;<b>".$pay_row['payment_code']."</b></p>
            <p>Date: &nbsp;<b>".$date."</b></p>
            <p>Sold to:<br><b>".$ship_row['receiver_name']."<br>".$ship_row['contact_phone'].
            "<br><br>".$ship_row['address'].",<br>".$ship_row['city'].", ".$ship_row['state'].",<br>".$ship_row['post_code'].", Malaysia.</b>
            </p><br><p>Tracking Number: <b>".$ship_row['tracking_number']."</b></p>";
    $pdf->WriteHTMLCell(190,0,5,'',$html,0);
    $pdf->Ln(75);
}
else{
    $html = "<p>INVOICE: &nbsp;<b>".$pay_row['payment_code']."</b></p>
            <p>Date: &nbsp;<b>".$date."</b></p>
            <p>Sold to:<br><b>".$ship_row['receiver_name']."<br>".$ship_row['contact_phone'].
            "<br><br>".$ship_row['address'].",<br>".$ship_row['city'].", ".$ship_row['state'].",<br>".$ship_row['post_code'].", Malaysia.</b>
            </p>";
    $pdf->WriteHTMLCell(190,0,5,'',$html,0);
    $pdf->Ln(70);
}

$pdf->SetFont('Times','',12);
$table = <<<EOD
<table>
    <tr style="font-weight:bold;">
        <th width="30px">NO</th>
        <th width="220px">PRODUCT NAME</th>
        <th width="100px">COLOR</th>
        <th width="80px">PRICE</th>
        <th width="50px">QTY</th>
        <th width="80px">SUBTOTAL</th>
    </tr><br>
EOD;

$i = 1;
$prod_res = mysqli_query($connect,"SELECT * FROM cart JOIN product ON cart.product_code=product.product_code WHERE payment_code='$pay_code'");
while($prod_row = mysqli_fetch_assoc($prod_res)){
    $detail = $prod_row['product_detail_code'];
    $pcode = $prod_row['product_code'];
    $detail_res = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_detail_code='$detail'");
    $detail_row = mysqli_fetch_assoc($detail_res);
    $img_res = mysqli_query($connect,"SELECT * FROM product_image WHERE product_code='$pcode'");
    $img_row = mysqli_fetch_assoc($img_res);
    if(empty($detail_row['product_capacity'])){
        $cap = "";
    }
    else{
        $cap = "(".$detail_row['product_capacity'].")";
    }
        $table .= "<tr>
        <td>".$i."</td>
        <td>".$prod_row['product_name']." ".$cap."</td>
        <td>".$prod_row['product_color']."</td>
        <td>RM ".$prod_row['product_price']."</td>
        <td>".$prod_row['quantity']." unit</td>
        <td>RM ".$prod_row['cart_subtotal']."</td>
    </tr>";
    $i++;
}
$table .= <<<EOD
<br><br>
<tr>
    <td colspan="5" style="text-align:right; font-weight:bold;">Grandtotal : &nbsp;</td>
    <td style="font-weight:bold; border-bottom-style:double; border-top-style:double;">
EOD;
$table .= "RM ".$pay_row['payment_total']."";

$table .= <<<EOD
</td>
</tr>
</table>
<style>
    th{border-top:1px solid black;
       border-bottom:1px solid black;}
</style>
EOD;

$pdf->WriteHTMLCell(200,0,5,'',$table,0);
$pdf->Output();
?>

