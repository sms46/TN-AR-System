<?php include 'headers.php';?>

<body xmlns="http://www.w3.org/1999/html">

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>

<div id="shopping-cart" class="table-responsive">
    <div class="txt-heading">Courses Added <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a></div>
    <?php
    if(isset($_SESSION["cart_item"])){
    //$item_total = 0;
    ?>
    <table cellpadding="10" cellspacing="1" class="table table-striped">
        <tbody class="thead-dark">
        <tr>
            <th style="text-align:left;"><strong>Session</strong></th>
            <th style="text-align:left;"><strong>Description</strong></th>
            <th style="text-align:right;"><strong>Start Date</strong></th>
        </tr>
        <?php
        foreach ($_SESSION["cart_item"] as $item){
        ?>
        <tr>
            <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["Session"]; ?></strong></td>
            <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["Description"]; ?></td>
            <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["StartDate"]; ?></td>
            <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="index.php?page=homepage&action=remove&code=<?php echo $item["Session"]; ?>" class="btnRemoveAction">Remove Item</a></td>
        </tr>
        <?php
        //$item_total += ($item["price"]*$item["quantity"]);
        }
        ?>
        </tbody>
    </table>
    <?php
    }
    ?>
</div>


<div id="product-grid">
    <div class="txt-heading">Courses</div>

    <?php
        $product_array = $data;
        if (!empty($product_array)) {
             foreach($product_array as $key=>$value){
    ?>
                    <div class="product-item">
                            <form action="index.php?page=homepage&action=add&code=<?php echo $product_array[$key]["Session"]; ?>" method="post">
                                    <div><strong><?php echo $product_array[$key]["Description"]; ?></strong></div>
                                    <div><strong><?php echo $product_array[$key]["StartDate"]; ?></strong></div>
                                    <div><input type="submit" value="Add to cart" class="btnAddAction" /></div>
                            </form>
                    </div>
            <?php
            }
        }
            ?>
</div>

</html>
