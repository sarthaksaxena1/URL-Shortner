<?php
// Create connection
$conn = new mysqli("localhost","admin_CXURI","","admin_CXURI");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
else{
$murl=$_GET['murl'];

// You should create your own salt (hand-typed), and
// ideally, it should be the same length as the hash
// (e.g. for SHA512, it should be 512 chars long).
// $salt = 'ilovecyberxploresomuchyoucantima';
//$murl means main url
function GenSurl($murl) {
    $random = hash('md5', mt_rand() . microtime() . mt_rand() . $murl);
    $pup= substr($random,0,8); //Post Short Url Part 
    if(is_numeric($pup))
    {
        $random = hash('md5', mt_rand() . microtime() . mt_rand() . $murl);
        return $random;
    }
    else
    {
        return $pup;
    }
  }
$parsed = parse_url($murl);
if (empty($parsed['scheme'])) {
    $murl = 'http://' . ltrim($murl, '/');
}
 
$surl=GenSurl($murl);

$sql = "INSERT INTO CXURI (murl, surl) VALUES ('$murl','$surl')";

if ($conn->query($sql) === TRUE) {
 $finalurl="https://cxurl.cyberxplore.com/?done=https://cxurl.cyberxplore.com/CX.php?url=".$surl;
  header("Location: ".$finalurl);
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}













?>
