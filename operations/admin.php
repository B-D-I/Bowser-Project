<?php
include "../include/config.php";

// retrieve logged in users email
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

<!--    styling and fonts-->
    <link rel="stylesheet" href="../global/global.css" type="text/css">
    <link rel="stylesheet" href="admin.css" type="text/css">
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

         <div class="bowserLoan">
          <h2>Bowser Requests</h2><br />
<!--             form to enable bowser requests to third party organisations -->
            <form method="post" id="formBowserRequest">
                <?php
                $connection = OpenConnection();
                $sql = "SELECT Organisation_Name FROM tbl_company_representative WHERE Email = '$email'";
                $result = mysqli_query($connection,$sql);
                $rows = mysqli_fetch_array($result);
                $company = $rows["Organisation_Name"];
                ?>
                <input type='hidden' name='company' value='<?php echo "$company";?>'/>
<!--                select the transaction type-->
                <div class="mb-3">
                    <div id="transactionID">
                        <label>Transaction Type</label>
                        <div class="select">
                            <select name="Transaction" id="select">
                                <option value='-1' disabled selected>---</option>
                                <option value="Lend">Lend</option>
                                <option value="Loan">Loan</option>
                            </select>
                        </div>
                    </div>
                    <br />
<!--                    select the organisation-->
                    <div id="organisationID">
                        <label>Organisation</label>
                        <div class="select">
                            <select name="Organisation" id="select">
                                <?php
                                $sql = "SELECT * FROM tbl_company_representative WHERE Email != '$email'";
                                $result = mysqli_query($connection,$sql);
                                $rows = mysqli_fetch_array($result);
                                $company = $rows["Organisation_Name"];

                                echo "<option value='-1' disabled selected>---</option>";
                                if ($result->num_rows > 0) {
                                    while ($rows = $result->fetch_assoc()) {
                                        echo "<option value='".$rows['Organisation_Name']."'>".$rows['Organisation_Name']."</option>";
                                    }
                                }
                                CloseConnection($connection);
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <br />
<!--                select bowser capacity-->
                <div id="capacityID">
                    <label>Capacity</label>
                    <div class="select">
                        <select name="Capacity" id="select">
                            <option value='-1' disabled selected>---</option>
                            <option value="500">500L</option>
                            <option value="1000">1000L</option>
                            <option value="5000">5000L</option>
                            <option value="10000">10,000L</option>
                            <option value="15000">15,000L</option>
                        </select>
                    </div>
                </div>
                <br />
<!--                select priority of the request -->
                <div id="loanPriorityID">
                    <label>Priority</label>
                    <div class="select">
                        <select name="Priority" id="select">
                            <option value='-1' disabled selected>---</option>
                            <option value="3">High</option>
                            <option value="2">Medium</option>
                            <option value="1">Low</option>
                        </select>
                    </div>
                </div>
                <br />
<!--                description text area-->
                <div class="form-floating">
                    <textarea class="form-control" name="Reason" placeholder="Reason for Request"style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Reason for Request</label>
                </div>
                <br /><br />
<!--                submit the request -->
                <div id="submitRegiser">
                    <button type="submit" name="requestBowserSubmit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
        </div>
        </div>

        <br />
        <div class="row">
<!--            register a new staff user -->
            <div class="col" id="registerUser">
                <h2>Register New User</h2>
                <form method="post" id="formUserRegistration">
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" id="registerInputEmail" aria-describedby="emailHelp">
                    </div>
                    <div class="col">
                        <div class="select">
                            <select name="user_type" id="select">
<!--                                new user role-->
                                <option value='-1' disabled selected>---</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Operations">Operations</option>
                            </select>
                        </div>
                    </div>
                    <br /><br />
                    <div id="submitRegiser">
                        <button type="submit" name="registerAccountSubmit" class="btn btn-secondary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>

<!--        this section displays all invoices from bowser transactions-->
        <br />
        <div class="row">
            <div class="bowserInvoices">
            <h2>Invoices</h2><br />
                <table id="invoiceTable">
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>Transaction&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>Created By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>Bowser ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>Organisation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>Charge (£)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>
                    <?php
                    $connection = OpenConnection();
                    $sql ="SELECT * FROM `tbl_bowser_invoices`ORDER BY Date DESC LIMIT 25";
                    $result = mysqli_query($connection, $sql);
                    $rows = mysqli_fetch_array($result);

                    if ($result->num_rows > 0) {
                        while ($rows = $result->fetch_assoc()) {
                            $invoiceID = $rows['InvoiceID'];
                            $transaction = $rows['Transaction_Type'];
                            $user = $rows['UserID'];
                            $bowser = $rows['BowserID'];
                            $organisation = $rows['Organisation_Name'];
                            $price = $rows['Price'];
                            echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$rows['InvoiceID']."</td><td>".$rows['Transaction_Type']."</td>
                                            <td>".$rows['UserID']."</td><td>".$rows['BowserID']."</td><td>"
                                .$rows['Organisation_Name']."</td></tr><br />";
                        }
                    }
                    CloseConnection($connection);
                    ?>
                </table>
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