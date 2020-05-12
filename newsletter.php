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
                        $phone_number = $Other_Areas = "";
                        $firstnameErr = $lastnameErr = $emailErr = "";
                        $phone_number_err = "";
                     
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

                            if (empty(filter_input(INPUT_POST, "Other_Areas"))) {
                                $_SESSION['Other_Areas'] = "";
                            }else {
                                $_SESSION['Other_Areas'] = test_input(filter_input(INPUT_POST, "Other_Areas"));
                                $Other_Areas = test_input(filter_input(INPUT_POST, "Other_Areas"));
                            }

                            if($valid){
                                header("location:php_process_page.php");
                                exit();
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

                    <h2>Register for SDSU NHM Newsletter</h2>

                    <h3>Please fill out this form and click Submit when finished</h3>
                    <p><span class="required">*</span> Required fields</p>

                    <form name="newsletter" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                        <fieldset>
                            <legend>Personal Information:</legend>

                            <label for="firstname">First name<span class="required">*</span>:</label><br />
                            <input type="text" name="firstname" id="firstname" size="40"  maxlength="60" value="<?php echo $firstname; ?>" ><span class = "error"><?php echo " " . $firstnameErr;?></span><br /><br />

                            <label for="lastname">Last name<span class="required">*</span>:</label><br />
                            <input type="text" name="lastname" id="lastname" size="40"  maxlength="60" value="<?php echo $lastname; ?>" ><span class = "error"><?php echo " " . $lastnameErr;?></span><br /><br />

                            <label for="addresses">Address: </label><br />
                            <input type="text" name="addresses" id="addresses" size="80" maxlength="255" value="<?php echo $addresses; ?>" ><br /><br />

                            <label for="phone_number">Phone Number:</label><br />
                            <input type="text" name="phone_number" id="phone_number" size="23" maxlength="20" value="<?php echo $phone_number; ?>" ><span class = "error"><?php echo " " . $phone_number_err;?></span><br /><br />

                            <label for="email">Email Address<span class="required">*</span>:</label><br />
                            <input type="email" name="email" id="email" size="60"  maxlength="100" value="<?php echo $email; ?>" ><span class = "error"><?php echo " " . $emailErr;?></span><br /><br />
                        </fieldset>

                        <fieldset>
                            <legend>Interested Events</legend>

                            <label for="Other_Areas">What events/news would you like to see?</label><br />
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