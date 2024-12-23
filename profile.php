<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['id'])) {
  header("Location: login.php"); // Redirect to login if not logged in
  exit;
}
  $id = $_SESSION['id'];
  
  $sql = "SELECT * FROM profiles WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
  } else {
    $row = array('name' => '', 'city' => '');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
</head>
<body>
  <h1>User Profile</h1>
  <p>Name: <?php echo htmlspecialchars($row['name']); ?></p>
  <p>City: <?php echo htmlspecialchars($row['city']); ?></p>
</body>
</html>




