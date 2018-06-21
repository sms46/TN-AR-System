
    <?php include 'headers.php';?>

    <body xmlns="http://www.w3.org/1999/html">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    </body>
</br>

    </br>
    <div class="container" style="width:1260px;">
        <legend><h3>STUDENT INFORMATION</h3></legend>
        <form action="index.php?page=accounts&action=create" method="post">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="studentName">Student's Full Name</label>
                    <input type="text" class="form-control" id="studentName" placeholder="Enter Student's Full Name" name="studentName">
                </div>

                 <div class="form-group col-md-6">
                     <label for="email">Email</label>
                     <input type="email" class="form-control" id="email" placeholder="Enter Email Address " name="email">
                </div>

                <div class="form-group col-md-6">
                    <label for="parentName">Parent/Guardian Name</label>
                    <input type="text" class="form-control" id="parentName" placeholder="Enter Parent/Guardian Name" name="parentName">
                </div>

                <div class="form-group col-md-6">
                    <label for="highSchool">High School</label>
                    <input type="text" class="form-control" id="highSchool" placeholder="Enter High School" name="highSchool">
                </div>

            </div>

            <br>
            <legend><h3>ADDRESS</h3></legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="streetAddress">Street Address</label>
                    <input type="text" class="form-control" id="streetAddress" placeholder="Enter Street Address" name="streetAddress">
                </div>

                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" placeholder="Enter City" name="city">
                </div>

                <div class="form-group col-md-6">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" placeholder="Enter State" name="state">
                </div>

                <div class="form-group col-md-6">
                    <label for="zipCode">Zip Code</label>
                    <input type="text" class="form-control" id="zipCode" placeholder="Enter Zip Code" name="zipCode">
                </div>

            </div>

            <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>

        </br>
        <div class="container" style="width:1260px;" align="center">
            <form action="https://test.secure.touchnet.net:8443/C20146test_upay/web/index.jsp" method="POST">
                <button type="submit" name="proceed_to_payment" class="btn btn-warning">Checkout</button>
                <input type="hidden" name="UPAY_SITE_ID" value="8">
                <input type="hidden" name="AMT" value="400">
                <input type="hidden" name="EXT_TRANS_ID" value="123">
            </form>
        </div>


    </div>

    <?php include 'footer.php';?>