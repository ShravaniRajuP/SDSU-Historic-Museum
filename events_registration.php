<?php
session_start();
?>
<!DOCTYPE html>

<!-- 
Shravani Raju Pathapati
823370204
CS 545 - Cyndi Chie
Index Assigment 2 
-->

<html lang='en'>
    <head>
    	<title>SDSU Natural History Museum</title>
    	<meta charset="utf-8" />
    	<link rel="stylesheet" type="text/css" href="nhm_responsive.css">
        <script src="validate.js"></script>
    </head>
    <body onload="updatePage(); browserProperty();" oncontextmenu="return false;">
        <div class="wrapper">
            <header class="header">
                <div class="first">
                    <h2 class="header-text">
                        <label for="lastUpdated" id="lastUpdated" class="topright"></label> 
                    </h2>
                    
                    <a href="https://www.sdsu.edu" target="_blank"><img class="fltleft" src="images/SDSUwLSH_3Color_RV.png" alt="San Diego State university: Leadership Starts Here" width="245" height="217" /></a>
                    <h1>San Diego State University <br>Natural History Museum</h1>
                </div>
              
                <nav class="clrflt">
                    <ul class="HNav1">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About the Museum</a></li>
                        <li><a href="exhibits.html">Exhibits</a></li>
                        <li><a href="events.html">Events</a></li>
                        <li><a href="science.html">Science</a></li>
                        <li><a href="involve.html">Get Involved</a></li>
                        <li><a href="donate.html">Donate</a></li>
                    </ul>
                </nav>
            </header>

            <section class="flex-container">
                <div class="main">
                    <?php
                        // define variables and set to empty values
                        $firstname = $lastname = $email = "";
                        $phone_number = $interest1 = "";
                        $attendees_under5 = $attendees_5_12 = "";
                        $attendees_13_17 = $attendees_over18 = "";
                        $Other_Areas = "";
                        $event_name = array("Training & Trap Deployment", 
                            "Mid-point trap check", 
                            "Collect, Transport & Analyze Traps", 
                            "Shot Hole Borer Citizen Science Project");
                        $firstnameErr = $lastnameErr = $emailErr = "";
                        $event_name_err = $phone_number_err = "";
                        $attendeesErr_5 = $attendeesErr_5_12 = "";
                        $attendeesErr_13_17 = $attendeesErr_18 = "";
                        $total_attendees = $total_attendeesErr = "";
                     
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $valid = true;

                            if (empty(filter_input(INPUT_POST, "firstname"))) {
                                $valid = false;
                                $firstnameErr = "&emsp;&emsp;First name is required";
                            }else {
                                $_SESSION['firstname'] = test_input(filter_input(INPUT_POST, "firstname"));
                                $firstname = test_input(filter_input(INPUT_POST, "firstname"));
                            }
                            
                            if (empty(filter_input(INPUT_POST, "lastname"))) {
                                $valid = false;
                                $lastnameErr = "&emsp;&emsp;Last name is required";
                            }else {
                                $_SESSION['lastname'] = test_input(filter_input(INPUT_POST, "lastname"));
                                $lastname = test_input(filter_input(INPUT_POST, "lastname"));
                            }
                            
                            if (empty(filter_input(INPUT_POST, "email"))) {
                                $valid = false;
                                $emailErr = "&emsp;&emsp;Email is required";
                            }else {
                                $_SESSION['email'] = test_input(filter_input(INPUT_POST, "email"));
                                $email = test_input(filter_input(INPUT_POST, "email"));
                               
                                // check if e-mail address is well-formed 
                                if (!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)) {
                                    $valid = false;
                                    $emailErr = "&emsp;&emsp;Invalid email format, please enter a valid email"; 
                                }
                            }

                            if (empty(filter_input(INPUT_POST, "addresses"))) {
                                $_SESSION['addresses'] = "";
                            }else {
                                $_SESSION['addresses'] = test_input(filter_input(INPUT_POST, "addresses"));
                                $addresses = test_input(filter_input(INPUT_POST, "addresses"));
                            }

                            if (empty(filter_input(INPUT_POST, "phone_number"))) {
                                $_SESSION['phone_number'] = "";
                            }else {
                                $_SESSION['phone_number'] = test_input(filter_input(INPUT_POST, "phone_number"));
                                $phone_number = test_input(filter_input(INPUT_POST, "phone_number"));

                                // check if phone number is well-formed    
                                if(is_numeric($phone_number)){
                                    if (!validate_phone_number($phone_number)) {
                                        $valid = false;
                                        $phone_number_err = "&emsp;Invalid phone number format. Please enter a VALID Phone Number"; 
                                    }
                                }
                                else  {
                                    $valid = false;
                                    $phone_number_err = "&emsp;Invalid phone number format. Please enter a VALID Phone Number"; 
                                }
                            }

                            if (isset($_POST['event_name']) && $_POST['event_name'] == "") {
                                $valid = false;
                                $event_name_err = "&emsp;&emsp;Event name is required";
                            }else {
                                $_SESSION['event_name'] = test_input(filter_input(INPUT_POST, "event_name"));
                                $event_name = test_input(filter_input(INPUT_POST, "event_name"));
                            }

                            if ($_POST['attendees_under5'] === '') {
                                $valid = false;
                                $attendeesErr_5 = "&emsp;&emsp;Please select a number of attendees (0 to 10)";
                            }else {
                                $_SESSION['attendees_under5'] = test_input(filter_input(INPUT_POST, "attendees_under5"));
                                $attendees_under5 = test_input(filter_input(INPUT_POST, "attendees_under5"));
                            }

                            if ($_POST['attendees_5_12'] === '') {
                                $valid = false;
                                $attendeesErr_5_12 = "&emsp;&emsp;Please select a number of attendees (0 to 50)";
                            }else {
                                $_SESSION['attendees_5_12'] = test_input(filter_input(INPUT_POST, "attendees_5_12"));
                                $attendees_5_12 = test_input(filter_input(INPUT_POST, "attendees_5_12"));
                            }

                            if ($_POST['attendees_13_17'] === '') {
                                $valid = false;
                                $attendeesErr_13_17 = "&emsp;&emsp;Please select a number of attendees (0 to 10)";
                            }else {
                                $_SESSION['attendees_13_17'] = test_input(filter_input(INPUT_POST, "attendees_13_17"));
                                $attendees_13_17 = test_input(filter_input(INPUT_POST, "attendees_13_17"));
                            }

                            if ($_POST['attendees_over18'] === '') {
                                $valid = false;
                                $attendeesErr_18 = "&emsp;&emsp;Please select a number of attendees (0 to 10)";
                            }else {
                                $_SESSION['attendees_over18'] = test_input(filter_input(INPUT_POST, "attendees_over18"));
                                $attendees_over18 = test_input(filter_input(INPUT_POST, "attendees_over18"));
                            }

                            if (empty(filter_input(INPUT_POST, "interest1"))) {
                                $_SESSION['interest1'] = "";
                            }else {
                                $_SESSION['interest1'] = test_input(filter_input(INPUT_POST, "interest1"));
                            }

                            if (empty(filter_input(INPUT_POST, "Other_Areas"))) {
                                $_SESSION['Other_Areas'] = "";
                            }else {
                                $_SESSION['Other_Areas'] = test_input(filter_input(INPUT_POST, "Other_Areas"));
                                $Other_Areas = test_input(filter_input(INPUT_POST, "Other_Areas"));
                            }

                            if($_SESSION['total_attendees'] != null){
                                $_SESSION['total_attendees'] = test_input(filter_input(INPUT_POST, "total_attendees"));
                                $total_attendees = test_input(filter_input(INPUT_POST, "total_attendees"));
                                if($valid){
                                    header("location:submit_page.php");
                                    exit();
                                }
                            } else if($_SESSION['total_attendees'] == 0) {
                                $valid = false;
                                $_SESSION['total_attendees'] = "Number of Attendees cannot be 0";
                                $total_attendeesErr = "Number of Attendees must be at least 1 (one).";
                            }
                        }

                        function test_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        } 

                        function validate_phone_number($phone){
                            // Allow +, - and . in phone number
                            $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
                            // Remove "-" from number
                            $phone_to_check = str_replace("-", "", $filtered_phone_number);

                            // Check the lenght of number
                            // This can be customized if you want phone number from a specific country
                            if (strlen($phone_to_check) < 9 || strlen($phone_to_check) > 13) {
                                return false;
                            } else {
                               return true;
                            }
                        }
                    ?>

                    <h2>Register for Upcoming Events at SDSU NHM</h2>

                    <h3>Please fill out this form and click Submit when finished</h3>
                    <p><span class="required">*</span> Required fields</p>

                    <form name="newsletter" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                        <fieldset>
                            <legend>Personal Information:</legend>

                            <label for="firstname">First Name<span class="required">*</span>:</label><br />
                            <input type="text" name="firstname" id="firstname" size="40" maxlength="60" value="<?php echo $firstname; ?>" ><span class = "error"><?php echo " " . $firstnameErr;?></span><br /><br />

                            <label for="lastname">Last Name<span class="required">*</span>:</label><br />
                            <input type="text" name="lastname" id="lastname" size="40"  maxlength="60" value="<?php echo $lastname; ?>" ><span class = "error"><?php echo " " . $lastnameErr;?></span><br /><br />

                            <label for="addresses">Address: </label><br />
                            <input type="text" name="addresses" id="addresses" size="80" maxlength="255" value="<?php echo $addresses; ?>" ><br /><br />

                            <label for="phone_number">Phone Number:</label><br />
                            <input type="text" name="phone_number" id="phone_number" size="23" maxlength="20" value="<?php echo $phone_number; ?>" onchange="phone_validate();"><span class = "error"><?php echo " " . $phone_number_err;?></span><br /><br />

                            <label for="email">Email Address<span class="required">*</span>:</label><br />
                            <input type="email" name="email" id="email" size="60"  maxlength="100" value="<?php echo $email; ?>" ><span class = "error"><?php echo " " . $emailErr;?></span><br /><br />
                        </fieldset>

                        <fieldset>
                            <legend>Event Registration:</legend>

                            <label for="event_name">Which Event would you like to register for?<span class="required">*</span></label><br />
                            <select name="event_name" id="event_name" value="<?php echo $event_name ?>">
                                <option value="">Please Select</option>
                                <?php 
                                $event_name = array("Training & Trap Deployment", 
                                    "Mid-point trap check", 
                                    "Collect, Transport & Analyze Traps", 
                                    "Shot Hole Borer Citizen Science Project");
                                foreach ($event_name as $value) {
                                    if($_POST['event_name'] == $value) echo '<option value="'.$value.'" selected>'.$value.'</option>';
                                    else echo '<option value="'.$value.'">'.$value.'</option>';
                                }?> 
                            </select><span class = "error"><?php echo " " . $event_name_err;?></span><br /><br />

                            <label for="total_attendees">Total Number of Attendees<span class="required"></span>: </label><input type="text" name="total_attendees" id="total_attendees" placeholder="0" size = "1" value="" onchange="updateTotal()" readonly><span class = "error"><?php echo "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;" . $total_attendees; ?></span><br /><br />


                            <p><span class="required">**</span>Required fields, Maximum Number of Attendees per age group may vary<br /></p>

                            <label for="attendees_under5">Number of Attendees under 5 years<span class="required">**</span>: </label><br />
                            <input type="number" name="attendees_under5" id="attendees_under5" min="0" max="10" step="1" placeholder="(0 - 10)" value="<?php echo $attendees_under5; ?>" onchange="updateTotal()"><span class = "error"><?php echo " " . $attendeesErr_5;?></span><br /><br />

                            <label for="attendees_5_12">Number of Attendees 5 - 12 years<span class="required">**</span>: </label><br />
                            <input type="number" name="attendees_5_12" id="attendees_5_12" min="0" max="50" step="1" placeholder="(0 - 50)" value="<?php echo $attendees_5_12; ?>" onchange="updateTotal()"><span class = "error"><?php echo " " . $attendeesErr_5_12;?></span><br /><br />

                            <label for="attendees_13_17">Number of Attendees 13 - 17 years<span class="required">**</span>: </label><br />
                            <input type="number" name="attendees_13_17" id="attendees_13_17" min="0" max="50" step="1" placeholder="(0 - 50)" value="<?php echo $attendees_13_17; ?>" onchange="updateTotal()"><span class = "error"><?php echo " " . $attendeesErr_13_17;?></span><br /><br />

                            <label for="attendees_over18">Number of Attendees 18 years & above<span class="required">**</span>: </label><br />
                            <input type="number" name="attendees_over18" id="attendees_over18" min="0" max="50" step="1" placeholder="(0 - 50)" value="<?php echo $attendees_over18; ?>" onchange="updateTotal()"><span class = "error"><?php echo " " . $attendeesErr_18;?></span><br /><br />

                            <input type="checkbox" name="interest1" id="interest1" value="interest1" checked> 
                            <label for="interest1">Signup for Newsletter</label><br />
                        </fieldset>

                        <fieldset>
                            <legend>Interested Events</legend>

                            <label for="Other_Areas">What other events would you like to see?</label><br />
                            <textarea name="Other_Areas" id="Other_Areas" rows="5" cols="60"><?php echo $Other_Areas; ?></textarea>
                        </fieldset>
                            
                        <input type="submit" value="Submit">
                        <input type="reset" value="Reset">
                    </form>

                    <h4 id="browserProperties"></h4>
                </div>
            </section>

            <footer class="footer">
                <div class="fcolumn1">
                    <address>
                        San Diego State University<br />
                        Natural History Museum<br />
                        San Diego, CA 92182-0000<br />
                        (619) 594-5200<br />
                        <a href="mailto:nhmuseum@sdsu.edu">nhmuseum@sdsu.edu</a>
                    </address>
                </div>
                
                <div class="fcolumn2">
                    <p>Museum Hours<br />
                    Daily 10:00am to 5:00pm<br />
                    Closed when the campus is closed<br />
                    Hours subject to change<br />
                    </p>
                </div>

                <div class="fcolumn3">
                    <ul class="footerbuttons">
                        <li><a href="involve.html">Join/Volunteer</a></li>
                        <li><a href="donate.html">Donate</a></li>
                        <li><a href="events_registration.php">Events</a></li>
                        <li><a href="newsletter.php">Subsrcibe</a></li>
                    </ul>
                </div>
            </footer>
        </div>
    </body>
</html>