<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Query Database</title>
	</head>
	<body>
		<center>
			<h1>Select Filters</h1>
			<form action="dbsysProjQuery.php" method="post">
				<p>
					<label for="Table">Select Table: </label>
					<select name="table" id="Table">
						<option value="Store">Store</option>
						<option value="Employee">Employee</option>
						<option value="Sale">Sale</option>
						<option value="Car">Car</option>
						<option value="Customer">Customer</option>
					</select>
				</p>
				<input type="submit" value="Confirm">
			</form>
		</center
	</body>
</html>

<?php
$conn = mysqli_connect("localhost", "evansam", "dbsys", "carRentalDatabase");
if ($conn) {
	$table = $_REQUEST['table'];
	if ($table == "Store"){
		$query = mysqli_query($conn, "SELECT * FROM Store");
		if($query){
			echo "<h3>Stores</h3>";
			echo "<h3>Store ID......Location............................Address............................State</h3>";
			if ($query->num_rows > 0) {
				while ($row = $query->fetch_assoc()) {
					echo " " . $row["StoreID"]. "......................" . $row["Location"]. "..........." . $row['Address']. "..........." . $row['State']. "<br>";
				}
			}
		} else {
			echo "Invalid Query";
		}
	} elseif ($table == "Employee"){
		$query = mysqli_query($conn, "SELECT * FROM Employees");
		if($query){
			echo "<h3>Employees</h3>";
			echo "<h3>ID........Name..........Date of Birth..........Role.................Salary...............Email............................................PhoneNumber............Store ID</h3>";
			if ($query->num_rows > 0) {
				while ($row = $query->fetch_assoc()) {
					echo " " . $row["ID"]. "............." . $row['Name'] . "........" . $row["DateOfBirth"]. "...................." . $row['Role']. "..................." . $row['Salary']. "................" . $row['Email'] . ".........................." . $row['PhoneNumber'] . "......................" . $row['StoreID'] . "<br>";
				}
			}
		} else {
			echo "Invalid Query";
		}
		echo "<center><form action='dbsysProjQuery.php' method='post'><p><label for='DoB'>Date of Birth: </label><select name='dob' id='DoB'><option value='before'>Before 2000</option> </p><input type='submit' value='Submit'> </form></center>";
	} elseif ($table == "Sale"){
		$query = mysqli_query($conn, "SELECT * FROM Sales");
		if($query){
			echo "<h3>Sales</h3>";
			echo "<h3>Sale ID..........Date..................Money..................Employee ID...........Customer Email............Car VIN............................Payment Method</h3>";
			if ($query->num_rows > 0) {
				while ($row = $query->fetch_assoc()) {
					echo " " . $row["SaleID"]. "........................." . $row['Date'] . "............" . $row["Money"]. "...................." . $row['EmployeeID']. "....................................." . $row['CustomerEmail']. "..................." . $row['CarVIN'] . ".................." . $row['PaymentMethod'] . "<br>";
				}
			}
		} else {
			echo "Invalid Query";
		}
	} elseif ($table == "Car"){
		$query = mysqli_query($conn, "SELECT * FROM Cars");
		if($query){
			echo "<h3>Cars</h3>";
			echo "<h3>VIN..............................Current Status..........Make......................Model..........................Mileage...................Year........................Color.................Store ID...............Recent Renter Email.........License Plate...........................State</h3>";
			if ($query->num_rows > 0){
				while ($row = $query->fetch_assoc()) {
					echo " " . $row["VIN"]. ".........." . $row['CurrentStatus'] . "................................" . $row["Make"]. "........................." . $row['Model']. "............................." . $row['Mileage']. "................................" . $row['Year'] . "............................." . $row['Color'] . ".............................." . $row['StoreID'] . "............................." . $row['MostRecentRenterEmail'] . "........................" . $row['LicensePlate'] . ".........................." . $row['State'] . "<br>";
				}
			}
		} else {
			echo "Invalid Query";
		}
	} elseif ($table == "Customer"){
		$query = mysqli_query($conn, "SELECT * FROM Customers");
		if($query){
			echo "<h3>Customers</h3>";
			echo "<h4>Email.........................Current Car Rented............License No......................................................Name................................Phone Number...........................Date of Birth........................Address.......................................State.........Weight.............Height...........Sex..........Eye Color</h4>";
			if ($query->num_rows > 0){
				while ($row = $query->fetch_assoc()){
					echo " " . $row["Email"]. "........." . $row['CurrentCarRented'] . "........................................." . $row["LicenseNumber"]. "..............................." . $row['Name']. "............................." . $row['PhoneNumber']. "................................" . $row['DateOfBirth'] . "....................." . $row['Address'] . "................." . $row['State'] . ".................." . $row['Weight'] . "........." . $row['Height'] . "........." . $row['Sex'] . "............." . $row['EyeColor'] . "<br>";
				}
			}
		} else {
			echo "Invalid Query";
		}
	}
} else {
	echo "MySQL error : ".mysqli_error();
}
mysqli.close($conn);
?>
