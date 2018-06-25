<?php
session_start(); // DO CALL ON TOP OF BOTH PAGES
$_SESSION['array'] = $data;
?>

<?php include 'headers.php';?>

<body xmlns="http://www.w3.org/1999/html">

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">About</a>
    <a href="#">Services</a>
    <a href="#">Clients</a>
    <a href="#">Contact</a>
</div>

<div id="main">
    <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776; College of Architecture and Design</span>
</div>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "white";
    }

</script>
</body>

<div class="container" style="width:1260px;">

    <legend><h3 class="text-danger".text-danger>Pricing Information and Dates for 2018</h3></legend></br>

    <div class="dropdown">

            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Browse Courses
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="index.php?page=homepage&action=show">Architecture and Interiors</a>
                    <a class="dropdown-item" href="index.php?page=homepage&action=showDesign">Design + Make</a>
                </div>
            </div>

    </div>
    <br>

    <h4 class="text-danger".text-danger> <?php

    foreach ($data as $row) {
        echo $row['Description'];
        break;
    }?> </h4>

    <?php
        print utility\htmlTable::genarateTableForCourses($data);
    ?>

    </br>
    <a class="btn btn-primary" href="index.php?page=homepage&action=registerArchitecture" role="button">Register for Courses</a>

</div>

</html>
