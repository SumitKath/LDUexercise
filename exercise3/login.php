<html>
<head><title> Login Page </title> </head>
<body>

<?php
ini_set('display_errors', 1);

$success = false;

// Check if login data is present.
if (isset($_POST["username"]) && isset($_POST["password"])) {
	// establish DB connection
	require("../db.php");

	// Fetch the params
	$user = $_POST["username"];
	$pass = $_POST["password"];

	$query = "SELECT PASSWORD_HASH from users WHERE USERNAME='"
		 . mysqli_real_escape_string($conn, $user) . "'";

	$result = $conn->query($query);
	$row = mysqli_fetch_assoc($result);

	// Check if password is correct.
	if (password_verify($pass, $row["PASSWORD_HASH"])) {
		$success = true;
		echo "$user successfully logged in.";
	}
	else {
		echo "Invalid username or password <br />";
	}
}

// not logged in
if (!$success) {	// show form
?>
	<form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />
		<input type="submit" />
	</form>
	<br />
	<br />
	<a href="register.php">Click here to register</a>
<?php }?>
</body>
</html>