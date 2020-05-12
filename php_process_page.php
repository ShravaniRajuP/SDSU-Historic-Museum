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
                <div class="column2_1">
                    <?php
                        $firstname = $_SESSION['firstname'];
                        $lastname = $_SESSION['lastname'];
                        $addresses = $_SESSION['addresses'];
                        $phone_number = $_SESSION['phone_number'];
                        $email = $_SESSION['email'];
                        $event_name = $_SESSION['event_name'];
                        $attendees_under5 = $_SESSION['attendees_under5'];
                        $attendees_5_12 = $_SESSION['attendees_5_12'];
                        $attendees_13_17 = $_SESSION['attendees_13_17'];
                        $attendees_over18 = $_SESSION['attendees_over18'];
                        $total_attendees = $attendees_under5 + $attendees_5_12 + $attendees_13_17 + $attendees_over18;
                        $interest1 =  $_SESSION['interest1'];
                        $Other_Areas = $_SESSION['Other_Areas'];
                    ?>

                    <h2>Successfully Registered for<?php echo " " . $event_name . " "?></h2>

                    <h3><?php 
                            if ($interest1 != null) {
                                echo "Thank you for subscribing to our newsletter, " . $firstname . "! You will now receive future updates right in your inbox!";
                            }
                            else 
                                echo "";
                        ?>
                    </h3><br /><br />

                    <?php 
                        echo "Name:&emsp;&emsp;&emsp;" . $firstname . " " . $lastname . "<br><br>";

                        if($addresses != null) {
                            echo "Address:&emsp;&emsp;" . $addresses . "<br><br>";
                        }

                        if($phone_number != null) {
                            echo "Phone Number:&emsp;&emsp;&emsp;" . $phone_number . "<br><br>";
                        }

                        echo "Email:&emsp;&emsp;&emsp;" . $email . "<br><br><br><br>";

                        if (strlen(trim($Other_Areas))) {
                            echo "Other Events Interested in:&emsp;&emsp;" . $Other_Areas . "<br><br><br>"; 
                        }
                    ?>
                    <br>

                    <button onclick="window.location.href = 'https://edoras.sdsu.edu/~cssc0220/index.html';">Confirm</button>
                    <button onclick="window.location.href = 'https://edoras.sdsu.edu/~cssc0220/newsletter.php';">Try Again</button>
                </div>

                <aside>
                    <h2 style="text-align: center">SDSU NHM</h2>
                    <h3>Address</h3>

                    <address>
                        San Diego State University<br />
                        Natural History Museum<br />
                        San Diego, CA 92182-0000<br />
                        (619) 594-5200<br />
                        <a href="mailto:nhmuseum@sdsu.edu">nhmuseum@sdsu.edu</a>
                    </address>

                    <h3>Our Mission</h3>

                    <ul>
                        <li>Interpret the natural world through research, education and exhibits</li>
                        <li>Promote understanding of the evolution and diversity of southern California and the peninsula of Baja California</li>
                        <li>Train and grow our future leaders in research and conservation</li>
                        <li>Inspire in all a respect for nature and the environment</li>
                    </ul>

                    <h3>Event Registration</h3>
                    <p>Want to attend an upcoming Event at SDSU NHM? <a href="events_registration.php">Click Here</a> to register for an event.</p>

                    <h3>Subscribe to our Newsletter</h3>
                    <p>Want to know all the latest information about SDSU NHM? <a href="newsletter.php">Click Here</a> & Subscribe to our newsletter to get weekly updates!</p>
                </aside>
                
                <h4 id="browserProperties"></h4>
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