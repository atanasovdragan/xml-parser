<?php
$loader = require __DIR__ . '/vendor/autoload.php';

//require factory pattern moment for listing data in the tables bellow
require_once('includes/database_connection.php');

//require upload file needed for the file upload
require_once('includes/upload.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Dragan Atanasov">

    <title>XML Parser</title>

    <!-- Bootstrap core CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="public/css/starter-template.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <div class="navbar-brand">XML Parser</div>
        </div>
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <?php
                if(!empty($errorMessages)) {
                ?>
                <div class="alert alert-danger">
                    <?php
                    foreach($errorMessages as $message) {
                        echo $message;
                    ?>
                        <br>
                    <?php
                    }
                    ?>
                </div>
                <?php
                }
                ?>
                <?php
                if($successMessage != "") {
                    ?>
                    <div class="alert alert-success">
                        <?=$successMessage?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="jumbotron">
                    <h3>Upload File</h3>
                    <form action="index.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="xmlFile">Select XML file</label>
                            <input type="file" id="xmlFile" name="xml_file">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Upload">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Top 5 departments with most employees</h3>
                <?php
                $topDepartments = $dbConnect::getTopDepartments();
                if (count($topDepartments)) {
                ?>
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Department</th>
                            <th>Number of Employees</th>
                        </tr>
                        <?php
                        for ($i=0; $i<count($topDepartments); $i++) {
                        ?>
                            <tr>
                                <td><?=$i+1?></td>
                                <td><?=$topDepartments[$i]['dep_name']?></td>
                                <td><?=$topDepartments[$i]['emp_count']?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <p>No records</p>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>All departments</h3>
                <?php
                $allDepartments = $dbConnect::getAllDepartments();
                if (count($allDepartments)) {
                ?>
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Department</th>
                            <th>Number of Employees</th>
                            <th>Maximum salary paid</th>
                            <th>Most paid employee</th>
                        </tr>
                        <?php
                        for ($i=0; $i<count($allDepartments); $i++) {
                        ?>
                            <tr>
                                <td><?=$i+1?></td>
                                <td><?=$allDepartments[$i]['name']?></td>
                                <td><?=$allDepartments[$i]['emp_count']?></td>
                                <td><?=$allDepartments[$i]['max_salary']?></td>
                                <td><?=$allDepartments[$i]['emp_name']?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <p>No records</p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="public/js/bootstrap.min.js"></script>
</body>
</html>
