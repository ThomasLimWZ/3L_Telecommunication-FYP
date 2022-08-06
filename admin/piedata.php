<?php
   include('connection.php');
 
    //$cat = array();
 
    //for Samsung
    $sql="SELECT * FROM product INNER JOIN brand ON product.brand_name=brand.brand_name WHERE product.cat_name = 'Phone' AND product.product_status=1 AND brand.brand_status=1";
    $query=$connect->query($sql);
    $phone = $query->num_rows;
 
    //for tablet
    $sql="SELECT * FROM product INNER JOIN brand ON product.brand_name=brand.brand_name WHERE product.cat_name = 'Tablet' AND product.product_status=1 AND brand.brand_status=1";
    $aquery=$connect->query($sql);
    $tablet = $aquery->num_rows;
 
    //for watch
    $sql="SELECT * FROM product INNER JOIN brand ON product.brand_name=brand.brand_name WHERE product.cat_name = 'Watch' AND product.product_status=1 AND brand.brand_status=1";
    $vquery=$connect->query($sql);
    $watch = $vquery->num_rows;
 
    //for audio
    $sql="SELECT * FROM product INNER JOIN brand ON product.brand_name=brand.brand_name WHERE product.cat_name = 'Audio' AND product.product_status=1 AND brand.brand_status=1";
    $squery=$connect->query($sql);
    $audio = $squery->num_rows;
 
    //for accessories
    $sql="SELECT * FROM product INNER JOIN brand ON product.brand_name=brand.brand_name WHERE product.cat_name = 'Accessories' AND product.product_status=1 AND brand.brand_status=1";
    $nquery=$connect->query($sql);
    $accessories = $nquery->num_rows;
 
?>