
<?php
  $conn = new mysqli("localhost","admin_CXURI","","admin_CXURI");

  if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
  }

  $shortUtl = $_GET['url'];

  $sql = "SELECT murl FROM CXURI WHERE surl='$shortUtl'";
  $result = $conn->query($sql);
  if ($result->num_rows == 0) {
    echo "This Short Url Is Available For Use OR Something Went Wrong";
    exit();
  }

  $originalUrl = $result->fetch_assoc()['murl'];
  header("Location: " . $originalUrl); 
