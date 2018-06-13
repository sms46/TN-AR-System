
<?php include 'headers.php';?>

<body xmlns="http://www.w3.org/1999/html">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <h2 align="center">COURSE SELECTION</h2>
<div class="container">

            <form action="index.php?page=accounts&action=showProfile&id=<?php echo $data->id; ?>" method="POST">

            <div class="dropdown">

                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Browse Courses
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?page=accounts&action=selectArchitectureCourses">Architecture and Interiors</a>
                        <a class="dropdown-item" href="index.php?page=accounts&action=selectDesignCourses">Design + Make</a>
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
            print utility\htmlTable::genarateTableForCourseSelection($data);
            ?>

            </form>
</div>

<?php include 'footer.php';?>
