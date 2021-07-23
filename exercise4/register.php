<html>
<head><title>Registration</title></head>
<body>

<?php
ini_set('display_errors', 1);

session_start();
require("login_info.php");

// check if already logged in
if (is_logged_in()) {
	header("Location: index.php"); // Redirect if already logged in
	exit(0);
}

$success = false;
// Registration attempt
if (isset($_POST["username"]) && isset($_POST["password"])) {
	require("../db.php");
	$user = mysqli_real_escape_string($conn, $_POST["username"]);
	$query = "SELECT COUNT(*) FROM users WHERE USERNAME='$user'";
	$result = $conn->query($query);
	$row = mysqli_fetch_array($result);
	if ($row["COUNT(*)"] != 0) {
		echo "The user already exists!<br />";
	}
	else {
		$pass = mysqli_real_escape_string($conn, $_POST["password"]);
		$pass = password_hash($pass, PASSWORD_BCRYPT);
		$phone = mysqli_real_escape_string($conn, $_POST["phone"]);
		$query = "INSERT INTO users VALUES ('$user', '$pass', '$phone')";
		$conn->query($query);
		echo "Registration for $user was successful <br /><br />";
		$success = true;
	}
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

<a href="index.php">Home</a><br />
<a href="login.php">Click here to login</a>
</body>
</html>


