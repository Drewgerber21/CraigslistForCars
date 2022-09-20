<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexstyles.css">
    <title>Buy Page</title>
</head>

<?php
    $servername = "localhost";
    $user = "root";
    $password = "piWJbQv5Ksd8Yk";
    $dbname = "CarGos";

    $conn = mysqli_connect($servername, $user, $password, $dbname);
    
    if(!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }
?>

<style>  
 
.resize {  
    width: 100px;
    height: auto;  
}  
</style>

<!-- Header Menu of the Page -->
<!-- <header>
        <nav>
            <ul>
            <div id="logo">
                <img class = resize src="CarGos Logo.png" />
            </div>

            <div id="Profile">
                <div> 
                <a href="buy_page.php">  
                    <button type="button" class="profile_button" >
                        <img class = button-container src="Profile.png"/>
                    </button> 
                </a>
                </div>
            </div>
                            
            </ul>
        </nav>  
</header> -->
<!-- To keep track of a user login and states regarding user login, use PHP sessions** -->
<body style="box-sizing: border-box">
    <a href="index.html">
        <button class="back-button">Go back</button>
    </a>
    <h1>Buy Page</h1>   
    <div class="accountButtonDiv">
        <div class="accountButtonArray">
            <!-- Need to figure out how to check if someone is logged in and change button depending on that https://stackoverflow.com/questions/43714563/php-mysql-change-button-text-on-condition-->
            <?php //https://www.w3schools.com/php/php_sessions.asp
            if(!isset($_SESSION["username"])) //Checks to see if there's a variable in the session assigned to username
                echo '<button class="login-button login" onclick="loginPopup()">Login</button>'; //if not then show login button
            else { //else show account info
                echo "Welcome&nbsp;<a href='account_info.php?username=" . $_SESSION["username"] . "'</a> " . $_SESSION["username"] . "!";
            }
            ?>
            <div id="login-popup"> <!-- Use session_destroy() on log out -->
                <form action="buy_page.php" class="login-popup container" method="post">
                    <h1><i>CarGos</i> Login</h1>

                    <label for="usernames"><b>Username</b></label>
                    <input type="text" placeholder="Username" name="user" id="user" required>

                    <label for="pass"><b>Password</b></label>
                    <input type="password" placeholder="Password" name="pass" id="pass" required>

                    <button type="submit" class="login-popup-btn login">Login</button>
                    <?php 
                        $username = $_POST["user"];
                        $password = $_POST["pass"];

                        $findUser = "SELECT * FROM UserInfo WHERE UserName = '" . $username . "' AND UserPass ='" . $password . "';";
                        $result = mysqli_query($conn, $findUser);
                        if(mysqli_num_rows($result) > 0) {
                            $_SESSION["username"] = $username;
                            echo "<meta http-equiv='refresh' content='0'>";
                        } else if (!isset($_SESSION["user"]) && $_SERVER['REQUEST_METHOD'] == "POST") {
                            echo "<script type='text/javascript'>alert('Wrong username or password!');</script>";
                        }
                    ?>
                    <button type="button" class="login-popup-btn cancel" onclick="loginPopdown()">X</button>
                    <a class="createAccLink" href="create_account.php">Create an account!</a>
                </form>
            </div>
            <!-- Create some sort of pop up when login button is clicked? https://www.w3schools.com/howto/howto_js_popup_form.asp-->
        </div>

        <!-- Mockup for grabbing listing data from db -->
        <div class="buyTempDiv">
            <?php
                $selectListing = "SELECT * FROM ListingInfo";
                $result = mysqli_query($conn, $selectListing);
                if(mysqli_num_rows($result) > 0) {
                    echo "<table class=\"listingTable\">
                    <tr><th>Listing Price</th>
                    <th>Listing Year</th>
                    <th>Listing Make</th>
                    <th>Listing Model</th>
                    <th>Listing Description</th>
                    <th>Listing Date</th></tr>";
                }

                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <td>" . $row["ListingPrice"] . "</a></td>" .
                    "<td>" . $row["ListingYear"] . "</td>" .
                    "<td><a href=\"listing_info.php?listingID=" . $row["ListingID"] . "&listingMake=" . $row["ListingMake"] . "&listingModel=" . $row["ListingModel"] . "\">" . $row["ListingMake"] . "</a></td>" .
                    "<td>" . $row["ListingModel"] . "</td" .
                    "<td>" . $row["ListingDesc"] . "</td>" .
                    "<td>" . $row["ListingDate"] . "</td>"
                    . "</tr>";
                }
                echo "</table>";
            ?>
        </div>
    </div>
    <script>
        function loginPopup() {
            document.getElementById("login-popup").style.display = "block";
        }

        function loginPopdown() {
            document.getElementById("login-popup").style.display = "none";
        }

        document.addEventListener('mouseup', function(e) {
            var popup_div = document.getElementById("login-popup");
            if(!popup_div.contains(e.target)) {
                loginPopdown();
            }
        })
    </script>

    <?php
        $conn->close();
    ?>
</body>
</html>