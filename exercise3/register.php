<html>
<head><title>Registration</title></head>
<body>

<?php
ini_set('display_errors', 1);

$success = false;
// Check if registration data is present.
if (isset($_POST["username"]) && isset($_POST["password"])) {
	// establish DB connection
	require("../db.php");

	$user = mysqli_real_escape_string($conn, $_POST["username"]);
	$query = "SELECT COUNT(*) FROM users WHERE USERNAME='$user'";
	$result = $conn->query($query);

	$row = mysqli_fetch_array($result);

	// Check if user already exist in DB.
	if ($row["COUNT(*)"] != 0) {
		echo "The user already exists!<br />";
	}
	else {
		$pass = mysqli_real_escape_string($conn, $_POST["password"]);
		// Create Password hash.
		$pass = password_hash($pass, PASSWORD_BCRYPT);
		$phone = mysqli_real_escape_string($conn, $_POST["phone"]);

		// Create record for user
		$query = "INSERT INTO users VALUES ('$user', '$pass', '$phone')";
		$conn->query($query);
		echo "Registration for $user was successful <br /><br />";
		$success = true;
	}

?>
	<a href="login.php">Click here to login</a>

<?php
}
if (!$success) {
?>
	<h1>Registration</h1><br />
	<form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />
		Phone: <input type="text" name="phone" /><br />
		<input type="submit" />
	</form>


<?php } ?>


</body>
</html>


