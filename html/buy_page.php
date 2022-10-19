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
    <link rel="icon" type="image/x-icon" href="/Favicon/favicon.ico">
</head>

<?php
$servername = "localhost";
$user = "root";
$password = "piWJbQv5Ksd8Yk";
$dbname = "CarGos";

$conn = mysqli_connect($servername, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed " . mysqli_connect_error());
}
?>

<body class="pageBody" style="box-sizing: border-box">
    <body>
        <?php include("nav_bar.php"); ?>
    </body>

    <!-- Mockup for grabbing listing data from db -->
    <div class="buyTempDiv">
        <?php
        $selectListing = "SELECT * FROM ListingInfo";
        $result = mysqli_query($conn, $selectListing);
        if (mysqli_num_rows($result) > 0) {
            echo "<table class=\"listingTable\">
                <tr>
                    <th>Listing Price</th>
                    <th>Listing Year</th>
                    <th>Listing Make</th>
                    <th>Listing Model</th>
                    <th>Listing Description</th>
                    <th>Listing Date</th>
                </tr>";
        }

        while ($row = mysqli_fetch_assoc($result)) {
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
    <?php
    $conn->close();
    ?>
</body>

</html>