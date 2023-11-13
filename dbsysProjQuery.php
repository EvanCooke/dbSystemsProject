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
				<input type="submit" value="Show Table">
			</form>
			<br>
			<br>
			<form action="dbsysProjQuery.php" method="post">
				<p>
					<label for='mileage'>Show sales made on cars </label>
					<select name="overunder" id='mileage'>
						<option value="over">over</option>
						<option value="under">under</option>
					</select>
					<input type="number" name="miles" id='mileage'>
					<label>miles.</label>
				</p>
				<input type="submit" value="Run Query">
			</form>
		</center>
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
//		echo "<center><form action='dbsysProjQuery.php' method='post'><p><label for='storeid'>Store ID: </label><input type='text' name='storeID' id='storeid'></p><p><label for='loc'>Location (Lat/Lon): </label><input type='text' name='storeLocation' id='loc'></p><p><label for='address'>Address: </label><input type='text' name='storeAddress' id='address'></p><p><label for='state'>State: </label><input type='text' name='storeState' id='state'></p><input type='submit' value='Submit'></form></center>";
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
//		echo"<center><form action='dbsysProjQuery.php' method='post'><p><label for='employeeid'>Employee ID: </label><input type='text' name='empID' id='employeeid'></p><p><label for='name'>Name: </label><input type='text' name='empName' id='name'></p><p><label for='dob'>Date of Birth: </label><input type='text' name='empDoB' id='dob'></p><p><label for='role'>Role: </label><input type='text' name='empRole' id='role'></p><p><label for='salary'>Salary: </label><input type='text' name='empSalary' id='salary'></p><p><label for='email'>Email: </label><input type='text' name='empEmail' id='email'></p><p><label for='phone'>Phone Number: </label><input type='text' name='empPhone' id='phone'></p><p><label for='store'>Store ID: </label><input type='text' name='empStore' id='store'></p><input type='submit' value='Submit'></form></center>";
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
//		echo "<center><form action='dbsysProjQuery.php' method='post'><p><label for='saleid'>Sale ID: </label><input type='text' name='saleID' id='saleid'></p><p><label for='date'>Date (yyy-mm-dd): </label><input type='text' name='saleDate' id='date'></p><p><label for='money'>Money: </label><input type='text' name='saleMoney' id='money'></p><p><label for='employee'>Employee ID: </label><input type='text' name='saleEmp' id='employee'></p><p><label for='customer'>Customer Email: </label><input type='text' name='saleCust' id='customer'></p><p><label for='car'>Car VIN: </label><input type='text' name='saleCar' id='car'></p><p><label for='payment'>Payment Method: </label><input type='text' name='salePayMeth' id='payment'></p><input type='submit' value='Submit'></form></center>";
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
//		echo"<center><form action='dbsysProjQuery.php' method='post'><p><label for='vin'>VIN: </label><input type='text' name='carVIN' id='vin'></p><p><label for='status'>Current Status: </label><input type='text' name='carStatus' id='status'></p><p><label for='make'>Make: </label><input type='text' name='carMake' id='make'></p><p><label for='model'>Model: </label><input type='text' name='carModel' id='model'></p><p><label for='mileage'>Mileage: </label><input type='text' name='carMileage' id='mileage'></p><p><label for='year'>Year: </label><input type='text' name='carYear' id='year'></p><p><label for='color'>Color: </label><input type='text' name='carColor' id='color'></p><p><label for='store'>Store ID: </label><input type='text' name='carStore' id='store'></p><p><label for='email'>Recent Renter Email: </label><input type='text' name='carEmail' id='email'></p><p><label for='plate'>License Plate: </label><input type='text' name='carPlate' id='plate'></p><p><label for='state'>State: </label><input type='text' name='carState' id='state'></p><input type='submit' value='Submit'></form></center>";
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
//		echo"<center><form action='dbsysProjQuery.php' method='post'><p><label for='email'>Email: </label><input type='text' name='custEmail' id='email'></p><p><label for='car'>Current Car Rented: </label><input type='text' name='custCar' id='car'></p><p><label for='license'>License No: </label><input type='text' name='custLicense' id='license'></p><p><label for='name'>Name: </label><input type='text' name='custName' id='name'></p><p><label for='phone'>Phone Number: </label><input type='text' name='custPhone' id='phone'></p><p><label for='dob'>Date of Birth: </label><input type='text' name='custDoB' id='dob'></p><p><label for='address'>Address: </label><input type='text' name='custAddress' id='address'></p><p><label for='state'>State: </label><input type='text' name='custState' id='state'></p><p><label for='weight'>Weight: </label><input type='text' name='custWeight' id='weight'></p><p><label for='height'>Height: </label><input type='text' name='custHeight' id='height'></p><p><label for='sex'>Sex: </label><input type='text' name='custSex' id='sex'></p><p><label for='eye'>Eye Color: </label><input type='text' name='custEye' id='eye'></p><input type='submit' value='Submit'></form></center>";
	}
	$overunder = $_REQUEST['overunder'];
	$miles = $_REQUEST['miles'];
	if($miles){
		if ($overunder == "over"){
			$query2 = "SELECT a.* FROM Sales a, Cars b WHERE a.CarVIN = b.VIN AND b.Mileage >= " . $miles;
		} elseif ($overunder =="under"){
			$query2 = "SELECT a.* FROM Sales a, Cars b WHERE a.CarVIN = b.VIN AND b.Mileage <= " . $miles;
		}
		$result = mysqli_query($conn, $query2);
		if($result){
			echo "<h3>Sales</h3>";
			echo "<h3>Sale ID..........Date..................Money..................Employee ID...........Customer Email............Car VIN............................Payment Method</h3>";
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo " " . $row["SaleID"]. "........................." . $row['Date'] . "............" . $row["Money"]. "...................." . $row['EmployeeID']. "....................................." . $row['CustomerEmail']. "..................." . $row['CarVIN'] . ".................." . $row['PaymentMethod'] . "<br>";
				}
			}
		} else{
			echo "Invalid Query";
		}
	}
} else {
	echo "MySQL error : ".mysqli_error();
}
mysqli.close($conn);
?>
