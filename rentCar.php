<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Rent Car to Customer</title>
    </head>
	<body>
        <form action="rentCar.php" method="post">
            <label for="email">Customer Email:</label><br>
            <input type="text" id="email" name="email"><br><br>
            
            <label for="vin">VIN Number:</label><br>
            <input type="text" id="vin" name="vin"><br><br>
            
            <input type="submit" value="Submit">
        </form>
    </body>
</html>

<?php
    $conn = new mysqli("localhost", "root", "", "carRentalDatabase") or die("Connect failed: %s\n". $conn -> error);
    echo "Connected Successfully";

    if($_SERVER["REQUEST_METHOD"] === "POST"){ // only run following code after HTML form has been submitted
        // retrieve HTML form data
        $email = $_POST["email"];
        $vin = $_POST["vin"];

        // ensure entries are formatted correctly
        if(strlen($vin) !== 17){
            echo "Error: VIN must be 17 characters long";
            include("rentCar.php");
        } else if (strpos($email, '@') === false){
            echo "Error: Please enter a valid email address ";
            include("rentCar.php");
        }else{
            
            // ensure email is registered and customer is not already renting
            $sql = "SELECT CurrentCarRented FROM Customers WHERE Email = '$email'";
            $result = $conn->query($sql);

            if ($result === false) {
                echo "Error: Query to Cusomters failed";
            } else {
                if ($result->num_rows === 0) {
                    echo "Error: Email not found";
                } else {
                    $row = $result->fetch_assoc();
            
                    if ($row['CurrentCarRented'] !== 'none') {
                        echo "Error: Customer is already renting a car";
                    }
                }
            }

            // ensure car exist and is avaliable for renting
            $sql = "SELECT CurrentStatus FROM Cars WHERE VIN = '$vin'";
            $result = $conn->query($sql);

            if ($result === false) {
                echo "Error: Query to Cars failed";
            } else {
                if ($result->num_rows === 0) {
                    echo "Error: Car not found";
                } else {
                    $row = $result->fetch_assoc();
            
                    if ($row['CurrentStatus'] !== 'Rented') {
                        echo "Error: Car is already rented by another customer";
                    }
                    if ($row['CurrentStatus'] !== 'In Repair') {
                        echo "Error: Car is currently in repair";
                    }
                }
            }

            // update tables if all conditions are met

            // update Car's CurrentStatus to 'Rented'
            $sql = "UPDATE Cars SET CurrentStatus = 'Rented' WHERE VIN = '$vin'";
            if ($conn->query($sql) === TRUE) {
                echo "Car $vin has been marked 'Rented'";
            } else {
                echo "Error updating status: " . $conn->error;
            }

            // update Car's MostRecentRenterEmail
            $sql = "UPDATE Cars SET MostRecentRenterEmail = '$email' WHERE VIN = '$vin'";
            if ($conn->query($sql) === TRUE) {
                echo "Car's Most Recent Renter Email has been updated";
            } else {
                echo "Error updating Car's Most Recent Renter Email: " . $conn->error;
            }

            // update Customer's current car rented
            $sql = "UPDATE Customers SET CurrentCarRented = '$vin' WHERE email = '$email'";
            if ($conn->query($sql) === TRUE) {
                echo "Customers current car rented has been updated";
            } else {
                echo "Error updating Customers current car rented: " . $conn->error;
            }
        }
    }
    $conn->close(); // close connection to database in case of query failure
?>