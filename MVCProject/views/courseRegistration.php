<!DOCTYPE html>
<html>

<?php
    //Included header tag
    include 'headers.php';
?>

<body class="bg-light">

<div class="wrapper">

    <!-- Navigation Side bar-->
    <?php include 'navSideBar.php';?>

    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-default">
                    <i class="fas fa-align-justify"></i>
                </button>

                 <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <i class="fas fa-align-justify"></i>
                 </button>

                <h2><strong>&nbsp;&nbsp;&nbsp;College of Architecture and Design </strong></h2>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                    </ul>
                </div>
            </div>
        </nav>

        <h3 class="text-danger".text-danger align="center"><strong>COURSE REGISTRATION</strong></h3><hr></br>

        <!--Added courses navbar-->
             <nav class="navbar navbar-inverse" style="background:#FFFFFF;">
                    <div class="container-fluid pull-left"  style="width:200px;">
                         <div class="navbar-header"> <a class="navbar-brand text-primary" href="#" style="color:black;">COURSES ADDED</a> </div>
                    </div>
                 <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="index.php?page=courseRegistration&action=empty" class="btn btn-info btn-rounded mb-4">Empty cart</a></div>
             </nav>

        <!-- Table that will show the list of courses added by the user-->
            <?php $total = 0;
            if(!empty($_SESSION['cart_item'])):?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <?php foreach($_SESSION['cart_item'] as $key=>$item):?>
                        <tr>
                            <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["id"]; ?></strong></td>
                            <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["Description"]; ?></td>
                            <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["StartDate"]; ?></td>
                            <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["EndDate"]; ?></td>
                            <td style="text-align:left;border-bottom:#F0F0F0 1px solid;">$<?php echo $item["Price"]; ?></td>
                            <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><a href="index.php?page=courseRegistration&action=remove&code=<?php echo $item["id"]; ?>" class="btn btn-danger">Remove</a></td>
                        </tr>
                        <?php $total = $total+$item['Price'];?>
                    <?php endforeach;?>

                    <form action="index.php?page=studentRegistration&action=register" method="POST">
                        <tr>
                            <td colspan="4" align="center">
                                <select class="btn btn-default shadow-lg p-3 mb-3 bg-white rounded" id="paymentTypeSelect" name="paymentTypeSelect" required>
                                    <option value="">Select Payment Type</option>
                                    <option value="Deposit">Deposit</option>
                                    <option value="Full Payment">Full Payment</option>
                                </select>
                            </td>
                            <td colspan="5" align="left"><h4>Total: $<?php print $total?></h4></td>
                        </tr>
                        <tr>
                            <td colspan="10" align="center"><button type="submit" name="proceed_to_payment" class="btn btn-success">Proceed to Payment</button></td>
                            <input type="hidden"  name="totalAmt" value= "<?php print $total ?>" >
                        </tr>
                    </form>
                </table>
            <?php endif;?>

        <!--Courses navbar-->
            <nav class="navbar navbar-inverse" style="background:#FFFFFF;">
                <div class="container-fluid pull-left"  style="width:200px;">
                    <div class="navbar-header"> <a class="navbar-brand text-primary" href="#" style="color:black;">COURSES</a> </div>
                </div>
                <div class="pull-right" style="margin-top:7px;margin-right:7px;"><span class="btn btn-info">Total - <?php print count($data)?></span></div>
            </nav>

        <!--Display list of courses in a card-->
            <div class="row">
                    <?php
                    $product_array = $data;
                    foreach($product_array as $key=>$value):?>
                        <div class="col-md-4">
                            <div class="card shadow-lg p-3 mb-1 bg-white rounded">
                                <figure class="card-body">
                                    <form method="post" action="index.php?page=courseRegistration&action=add&code=<?php echo $product_array[$key]["id"]; ?>">
                                        <p style="text-align:center; color: black" class="card-title"><strong><?php echo $product_array[$key]["Description"];?></strong></p>
                                        <p style="text-align:center;" class="card-subtitle mb-2 text-muted"><b><?php echo $product_array[$key]["StartDate"];?> - <?php echo $product_array[$key]["EndDate"];?> </b></p>
                                        <p style="text-align:center;" class="card-text">
                                            <select class="btn btn-default dropdown-toggle shadow-lg p-3 mb-2 bg-white rounded" id="priceType" name="priceType">
                                                <option>Residential Amount</option>
                                                <option>Commuter Amount</option>
                                            </select>
                                        </p>
                                        <p style="text-align:center; color:red" class="card-text"><strong> Seats Available: <?php echo $product_array[$key]["SeatAvailable"];?></strong></p>
                                        <p style="text-align:center;color:#04B745;" class="card-text">
                                            <button type="submit" name="add_to_cart" class="btn btn-warning btn-rounded"id="myBtn">Add To Cart</button>
                                            <input type="hidden" name="description" value="<?php echo $product_array[$key]["Description"];?>">
                                            <input type="hidden" name="startDate" value="<?php echo $product_array[$key]["StartDate"];?>">
                                        </p>
                                    </form>
                                </figure>
                            </div>
                        </div>
                    <?php endforeach;?>
            </div>
    </div>
</div>

<!--Included javascript code for event click-->
<?php include 'footer.php';?>

</body>
</html>