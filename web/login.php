<?php
$email = "";
$pass = "";

if(isset($_POST["pass"]))   { $pass = $_POST["pass"]; }
if(isset($_POST["email"]))  { $email = $_POST["email"]; }

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "root", "", "cinema_classic");
$query = "SELECT * FROM users WHERE Email = '" . $email . "' AND Password = '" . $pass . "'";

if($result = mysqli_query($link, $query)){
    foreach($result as $row){
        echo "id: " . $row['ID']. " - Name: " . $row['First_name']. " " . $row['Last_name']. "\r\n";
        session_start();
        $_SESSION['id_user'] = $row['ID'];
        $_SESSION['First_name'] = $row['First_name'];
        $_SESSION['Last_name'] = $row['Last_name'];
        $_SESSION['Img_src'] = $row['Img_src'];
    }
}else {
  echo "0 results";
}

mysqli_close($link);
?>