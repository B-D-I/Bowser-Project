<?php
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="../global/global.css" type="text/css">
    <link rel="stylesheet" href="home.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
    <!--google maps api-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <title>Water Bowser</title>

</head>

<body>

<!---html anchor to return to top of page-->
<p id="back_to_top"></p>

<div class="container">
    <div class="nav-wrapper">
        <div class="left-side">
            <div class="nav-link-wrapper active-nav-link">
                <a class="text-focus-in" href="index.php">Home</a>
            </div>

            <div class="nav-link-wrapper active-nav-link">
                <a class="text-focus-in" href="../maintenance/maintenance.html">Maintenance</a>
            </div>

            <div class="nav-link-wrapper active-nav-link">
                <a class="text-focus-in" href="../operations/operations.html">Operations</a>
            </div>


            <div class="nav-link-wrapper">
                <a class="text-focus-in" id="link" href="#reportModal" data-bs-toggle="modal" >Report</a>

                <!-- Modal -->
                <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reportModalLabel">Report Form</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="row">

                                    <div class="col">
                                        <p>Report Type: </p>
                                    </div>

                                    <div class="col">
                                        <div class="select">
                                            <select name="Report_Type" id="select">
                                                <option value="Water Refill">Water Refill</option>
                                                <option value="Faults / Damage">Faults / Damage</option>
                                                <option value="Complaint">Complaint</option>
                                                <option value="Complaint">Something Else</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Description" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Description</label>
                            </div>

                            <div class="modal-footer">
                                <p>You must login before sending a report. <br /><br />For assistance please contact us at: example@email.com
                                </p><br /><br />
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Send Report</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="middle">
            <h2 class="text-focus-in">Bowser Hub</h2>
        </div>

        <div class="right-side">
            <div class="nav-link-wrapper">
                <a class="text-focus-in" id="loginLink" href="#loginModal" data-bs-toggle="modal" >Login</a>

                <!-- Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col">
                                        <form method="post" id="login_form">
                                            <div class="mb-3">
                                                <label for="loginInputEmail1" class="form-label">Email address</label>
                                                <input type="email" class="form-control" id="loginInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="loginInputPassword1" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="loginInputPassword1">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav-link-wrapper">
                    <a class="text-focus-in" id="registerLink" href="#registerModal" data-bs-toggle="modal" >Registration</a>

                    <!-- Modal -->
                    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="registerModalLabel">Registration</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">

                                            <form method="post" id="formUserRegistration">
                                                <div class="mb-3">
                                                    <input type="email" class="form-control" placeholder="Email" id="registerInputEmail" aria-describedby="emailHelp">
                                                </div>

                                                <div class="mb-3">
                                                    <input type="password" class="form-control" placeholder="Password" id="password_create">
                                                </div>

                                                <div class="mb-3">
                                                    <input type="password" class="form-control" placeholder="Repeat Password" id="password_confirm">
                                                </div>

                                                <button type="submit" id="registerAccountSubmit" class="btn btn-primary">Submit</button>
                                                <hr>
                                            </form>

                                            <br /><br />

                                            <p>Please check you email inbox for registration confirmation</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="upperPage">
        <div class="shadow-sm p-3 mb-5 bg-body rounded">
            <div class="row">
                <div class="col">

                    <ul class="notification-list">
                        <h2> Notifications and Alerts</h2>
                        <br /><br />
                        <li> 13.10 - Water bowser 001 now refilled.
                        </li>
                        <br />
                        <li> 13.00 - Current maintenance work at water bowser 010 </li>
                        <br />
                        <li> 12.25 - Water bowser 009 out of order </li>
                        <br />
                        <li> 12.20 - Water bowser 001 empty </li>
                        <br />
                        <li> 12.00 - Water bowser 006 repaired </li>
                        <br />
                        <li> 11.40 - Water bowser 006 out of order </li>
                        <br />
                        <li> 11.30 - Water bowser 007 out of repaired </li>
                        <br />
                        <li> 11.30 - Water bowser 008 out of repaired </li>
                        <br />
                    </ul>
                    <br />
                </div>


                <div class="col">
                    <div class="text_area">
                        <h2>Bowser Map</h2>
                        <br />
                        <p> Find local bowsers using the map below </p>
                        <br />

                        <!--div to display map--->
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        <br /><br /><br /><br /><br />

        <!-- Link back to top of page -->
        <p><a id="top_link" href="#back_to_top" >RETURN TO TOP</a></p>
        <br />  <br />

        <script src="home.js"></script>
        <script src="login.js"></script>
        <script src="register.js"></script>

        <script src ="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization&callback=initMap" async defer> </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


</body>

</html>
?>