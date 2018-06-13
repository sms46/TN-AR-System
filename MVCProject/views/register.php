
    <?php include 'headers.php';?>

    <body xmlns="http://www.w3.org/1999/html">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    </body>
</br>
<h2 align="center">COURSE REGISTRATION</h2>

    </br>
    <div class="container">
        <h4>Student Information</h4>
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
            <h4>Address</h4>

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
            <button type="submit" class="btn btn-success" class="btn btn-default">Submit</button>
        </form>
    </div>

    <?php include 'footer.php';?>