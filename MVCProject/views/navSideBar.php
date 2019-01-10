<!DOCTYPE html>
<html>

<!-- Sidebar  -->
<nav id="sidebar">
    <div id="dismiss">
        <!--<i class="fas fa-arrow-left"></i>-->
        <label> <strong>x</strong></label>
    </div>

    <div class="sidebar-header">
        <a style="font-size: medium" href="index.php">College of Architecture and Design</a>
    </div>

    <ul class="list-unstyled components">
        <li class="active">

                <a href="index.php?page=homepage&action=redirectToCoad"  aria-expanded="false">Home</a>

            <!--<ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#">Home 1</a>
                </li>
            </ul>-->

        </li>
        <li>
            <a href="#" data-toggle="modal" data-target="#aboutModal">About</a>
        </li>
        <li>
            <a href="#" data-toggle="modal" data-target="#cancelModal">Cancellation Policy</a>
        </li>
        <li>
            <a href="#">Contact Us</a>
        </li>
    </ul>

</nav>

<!-- About Modal-->
<div class="modal" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">About</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-primary">
                    The College of Architecture and Design offers residential summer programs in a state-of-the-art university setting for exceptional high school students interested in architecture, interior design, and industrial design.
                    The programs offer a week of design exploration on a variety of scales organized around an introduction to each discipline.
                    The College has offered summer programs for over a decade and draws future designers from across the United States and Europe.
                    Alumni of the program have gone on to study design and architecture at prestigious universities with many now employed in top design firms.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Cancellation Policy Modal-->
<div class="modal" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancellation Policy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-primary">
                    The College of Architecture and Design offers residential summer programs in a state-of-the-art university setting for exceptional high school students interested in architecture, interior design, and industrial design.
                    The programs offer a week of design exploration on a variety of scales organized around an introduction to each discipline.
                    The College has offered summer programs for over a decade and draws future designers from across the United States and Europe.
                    Alumni of the program have gone on to study design and architecture at prestigious universities with many now employed in top design firms.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</html>