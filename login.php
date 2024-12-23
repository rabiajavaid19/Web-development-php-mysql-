<?php
?>
<form action="" method="post">
  <label>Username:</label>
  <input type="text" name="username"><br><br>
  <label>Password:</label>
  <input type="password" name="password"><br><br>
  <input type="submit" name="login" value="Login">
</form>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Input validation
  if (empty($username) || empty($password)) {
    $error = "Please fill in all fields.";
  } else {
    // Check if username exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      // Verify password
      if (password_verify($password, $row['password'])) {
        $_SESSION['id'] = $row['id'];
        header("Location: profile.php");
        exit;
      } else {
        $error = "Invalid password.";
      }
    } else {
      $error = "Username does not exist.";
    }
  }
}
?>
