<?php
        // Get the Application name based on site id
    if(isset($_REQUEST['id'])){
        $appId = $_REQUEST['id'];
        $appOut = appConfig::getAppName($appId);
        $titleName = $appOut[0]->app_name;
    }else{
        $appId = $_REQUEST['app_id'];
        $appOut = appConfig::getAppName($appId);
        $titleName = $appOut[0]->app_name;
    }
?>

<!DOCTYPE html>
<html>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <!-- Suppressed the sideNav-->
        <!--<button type="button" id="sidebarCollapse" class="btn btn-default">
            <i class="fas fa-align-justify"></i>
        </button>-->

        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <a style="font-size: xx-large" href="index.php?page=homepage&action=redirectToProduct&id=<?php print $appId?>"><h1>&nbsp;&nbsp;&nbsp;<?php print $titleName;?></h1></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">

                <li class="nav-item active">
                    <a class="btn btn-outline-primary" href="#" data-toggle="modal" data-target="#modalCheckBalance">Check Balance Due</a>
                    <br>
                </li>

            </ul>

            <!-- Check Balance Due Modal -->
            <div class="modal" id="modalCheckBalance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Check Balance Due</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="index.php?page=homepage&action=checkBalance" method="post">
                            <div class="modal-body">

                                <!--Student's Full Name: <input type="text" class="form-control" name="studentName" placeholder="Enter Student's Full Name" value="" required><br/>-->
                                <!--Email Address:  <input type="email" class="form-control" name="email" placeholder="you@example.com" required/><br/>-->
                                Order Number:<input type="text" class="form-control" name="orderNo" placeholder="Enter your Order Number" required/><br/>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" value="Check" name="checkBalance" class="btn btn-success"/>
                                <input type="hidden" name="app_id" value= "<?php print $_REQUEST["app_id"]?>" >
                                <input type="hidden" name="app_id" value= "<?php print $_REQUEST["id"]?>" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>

</html>