<?php include 'headers.php';?>

<body xmlns="http://www.w3.org/1999/html">

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>

<div class="container" style="width:1260px;">
    <nav class="navbar navbar-inverse" style="background:#FFFFFF;">
        <div class="container-fluid pull-left"  style="width:200px;">
            <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:black;">List of Courses Added</a> </div>
        </div>
        <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="index.php?page=homepage&action=empty" class="btn btn-info">Empty cart</a></div>
    </nav>

    <?php if(!empty($_SESSION['cart_item'])):?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Session</th>
                    <th>Description</th>
                    <th>StartDate</th>
                    <th>Action</th>
                </tr>
            </thead>

            <?php foreach($_SESSION['cart_item'] as $key=>$item):?>
                <tr>
                    <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["Session"]; ?></strong></td>
                    <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["Description"]; ?></td>
                    <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["StartDate"]; ?></td>
                    <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><a href="index.php?page=homepage&action=remove&code=<?php echo $item["Session"]; ?>" class="btn btn-info">Remove Course</a></td>
                </tr>
            <?php endforeach;?>
        </table>
    <?php endif;?>
</div>

<div class="container" style="width:1260px;">

<nav class="navbar navbar-inverse" style="background:#FFFFFF;">
    <div class="container-fluid">
        <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:black;">Courses</a> </div>
    </div>
</nav>

<div class="row">
    <div class="container" style="width:1020px;">
        <?php
        $product_array = $data;
        foreach($product_array as $key=>$value):?>
            <div class="col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        <form method="post" action="index.php?page=homepage&action=add&code=<?php echo $product_array[$key]["Session"]; ?>">
                            <p style="text-align:center;"><?php echo $product_array[$key]["Description"];?></p>
                            <p style="text-align:center;"><b><?php echo $product_array[$key]["StartDate"];?></b></p>
                            <p style="text-align:center;color:#04B745;">
                                <button type="submit" name="add_to_cart" class="btn btn-warning">Add To Cart</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>

</div>

<div class="container" style="width:1260px;">

    <legend><h4>Select Payment Type:</h4></legend>
    <select class="btn btn-default dropdown-toggle" id="paymentTypeSelect" name="paymentTypeSelect">
        <option>Deposit</option>
        <option>Full Payment</option>
    </select>
</div>

</br>
<div class="container" style="width:1260px;" align="center">
    <form action="index.php?page=accounts&action=register" method="POST">
        <button type="submit" name="proceed_to_payment" class="btn btn-success">Proceed to Payment</button>
    </form>
</div>

</html>
