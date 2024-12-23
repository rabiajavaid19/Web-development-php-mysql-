<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<?php
?>
<form action="" method="post">
  <label>Username:</label>
  <input type="text" name="username"><br><br>
  <label>Password:</label>
  <input type="password" name="password"><br><br>
  <label>Email:</label>
  <input type="email" name="email"><br><br>
  <input type="submit" name="register" value="Register">
</form>

<?php
if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  // Input validation
  if (empty($username) || empty($password) || empty($email)) {
    $error = "Please fill in all fields.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email address.";
  } else {
    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert into users table
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password_hash', '$email')";
    if (mysqli_query($conn, $sql)) {
      header("Location: login.php");
      exit;
    } else {
      $error = "Registration failed.";
    }
  }
}
?>







