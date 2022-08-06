<?php include("header.php"); ?>	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.card {
    z-index: 0;
    background-color: #ECEFF1;
    padding-bottom: 20px;
    margin-top: 90px;
    margin-bottom: 90px;
    border-radius: 10px;
}

.top {
    padding-top: 40px;
    padding-left: 13% !important;
    padding-right: 13% !important;
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px;
}

#progressbar li {
    list-style-type: none;
    font-size: 13px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400;
}

#progressbar .step0:before {
    font-family: FontAwesome;
    content: "\f10c";
    color: #fff;
}

#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    background: #C5CAE9;
    border-radius: 50%;
    margin: auto;
    padding: 0px;
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 12px;
    background: #C5CAE9;
    position: absolute;
    left: 0;
    top: 16px;
    z-index: -1;
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%;
}

#progressbar li:nth-child(2):after,
#progressbar li:nth-child(3):after {
    left: -50%;
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    position: absolute;
    left: 50%;
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #39f;
}

#progressbar li.active:before {
    font-family: FontAwesome;
    content: "\f00c";
}

.icon-content {
    padding-bottom: 20px;
}

@media screen and (max-width: 992px) {
    .icon-content {
        width: 50%;
    }
}
</style>
<?php
	if(isset($_GET["view"])){
		$number = $_GET['trackNum'];

        $delivery_res = mysqli_query($connect, "SELECT * FROM shipping WHERE tracking_number='$number'");
        $delivery_row = mysqli_fetch_assoc($delivery_res);
    }
?>
<div class="container px-1 px-md-4 py-5 mx-auto">
    <div class="card">
        <div class="row d-flex justify-content-between px-3 top">
            <div class="d-flex">
                <h5>INVOICE <span style="font-weight:bold; color:#39f;">#<?php echo $delivery_row['payment_code'];?></span></h5>
            </div>
            <?php
                $Date = $delivery_row['payment_date'];
            ?>
            <div class="d-flex flex-column text-sm-right">
                <p class="mb-0">Expected Arrival: <span style="font-weight:bold;"><?php echo date('d-m-Y', strtotime($Date. ' + 14 days'));?></span></p>
                <p>Tracking Number: <span class="font-weight-bold"><?php echo $delivery_row['tracking_number'];?></span></p>
            </div>
        </div> <!-- Add class 'active' to progress -->

        <?php
        if($delivery_row['delivery_status'] == 0){
        ?>
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <ul id="progressbar" class="text-center">
                        <li class="active step0"></li>
                        <li class="step0"></li>
                        <li class="step0"></li>
                        <li class="step0"></li>
                    </ul>
                </div>
            </div>
        <?php
        }
        else if($delivery_row['delivery_status'] == 1){
        ?>
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <ul id="progressbar" class="text-center">
                        <li class="active step0"></li>
                        <li class="active step0"></li>
                        <li class="step0"></li>
                        <li class="step0"></li>
                    </ul>
                </div>
            </div>
        <?php
        }
        else if($delivery_row['delivery_status'] == 2){
        ?>
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <ul id="progressbar" class="text-center">
                        <li class="active step0"></li>
                        <li class="active step0"></li>
                        <li class="active step0"></li>
                        <li class="step0"></li>
                    </ul>
                </div>
            </div>
        <?php
        }
        else{
        ?>
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <ul id="progressbar" class="text-center">
                    <li class="active step0"></li>
                    <li class="active step0"></li>
                    <li class="active step0"></li>
                    <li class="active step0"></li>
                </ul>
            </div>
        </div>
        <?php
        }
        ?>
        <div class="row justify-content-between top">
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/9nnc9Et.png" style="width: 60px; height: 60px; margin-right: 15px">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>Received</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/u1AzR7w.png" style="width: 60px; height: 60px; margin-right: 15px">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>Shipped Out</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png" style="width: 60px; height: 60px; margin-right: 15px"> 
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>On Delivering</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png" style="width: 60px; height: 60px; margin-right: 15px">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>Arrived</p>
                </div>
            </div>
        </div>
    </div>
    <a href="index-login.php" class="btn btn-primary" style="float:right;">Back to Home</a>
</div>
<?php include("footer.php"); ?>