<?php
include "../include/config.php";

session_start();
if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}
?>

<!doctype html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../global/global.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" type="image/x-icon" href="../images/logo/bowserLogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="../global/global.css" type="text/css">

    <title>Water Bowser</title>
</head>

<body>

<!---html anchor to return to top of page-->
<p id="back_to_top"></p>

<div class="upperPage">
    <div class="shadow-sm p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="row">
            </div>

            <div class="col">
                <div class="heatmap">
                    <h2>Reports Heatmap</h2>
                    <div id="map"></div>
                </div>
            </div>

            <div class="col">
                <div class="manageReports">
                    <h2>Manage Reports</h2>

                    <?php
                    $connection = OpenConnection();
                    $sql = "SELECT * FROM `tbl_reports` WHERE Status ='Pending'";
                    $result = mysqli_query($connection, $sql);
                    $rows = mysqli_fetch_array($result);

                    while($rows = mysqli_fetch_assoc($result)) {
                        $reportType = $rows['Report_Type'];
                        $reportID = $rows['Report_ID'];
                        $bowserID = $rows['Bowser_ID'];
                        $description = $rows['Description'];
                        $date = $rows['Date'];
                        // trim date to 10 characters, removing time
                        $date = substr($date, 0,-8);

                        switch($reportType){
                            case 1:
                                $reportString = "Refill";
                                break;
                            case 2:
                                $reportString = "Repair";
                                break;
                            case 3:
                                $reportString = "Complaint";
                                break;
                            case 4:
                                $reportString = "Other";
                                break;
                        }

                        echo '<form method="post" action="actionReportsDAO.php" >';
                        ?>
                        <!--POST VARIABLES--->
                        <input type='hidden' name='reportType' value='<?php echo "$reportType";?>'/>
                        <input type='hidden' name='reportString' value='<?php echo "$reportString";?>'/>
                        <input type='hidden' name='reportID' value='<?php echo "$reportID";?>'/>
                        <input type='hidden' name='bowserID' value='<?php echo "$bowserID";?>'/>
                        <input type='hidden' name='description' value='<?php echo "$description";?>'/>
                        <input type='hidden' name='date' value='<?php echo "$date";?>'/>
                        <?php
                        echo "<h5>Reported: ".$reportString."</h5><br />";
                        echo $date;
                        echo "<br />Bowser: ".$bowserID;
                        echo "<br />Description: <br />".$description;
                        echo '    <br />                      
                       <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                          <button class="btn btn-success me-md-2" type="submit" name="acceptButton" value="Accept">Action</button>
                          <button class="btn btn-danger" type="submit" name="denyButton" value="Deny">Ignore</button>
                        </div>
                ';
                        echo "</form>";
                        echo "<br />";
                    }
                    ?>

                </div>
            </div>

            </div>
        </div>
    </div>
</div>

            <br /><br />
    <script src="operations.js"></script>
    <script src ="https://maps.googleapis.com/maps/api/js?key=AIzaSyAv17Pa1iXPZVBV4q4uGYCtESCD2evyHg8&sensor=false&libraries=visualization&callback=heatMap" async defer> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>