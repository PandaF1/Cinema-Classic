<?php
$first_name = "";
$last_name = "";
$email = "";
$pass = "";
$conf_pass = "";

if(isset($_POST["pass"]))               { $pass = $_POST["pass"]; }
if(isset($_POST["conf_pass"]))          { $conf_pass = $_POST["conf_pass"]; }

if(strcmp($pass,$conf_pass)!="0")
{
    print "Password: [ $pass ] != Confirm Password: [ $conf_pass ]" ;
}
else if($pass != "" && $conf_pass != "")
{
    if($_FILES['upload_file']['size']>0) {
    $namef = $_FILES['upload_file']['name'];
    $sizef = $_FILES['upload_file']['size'];
    echo "Получен файл $namef \r\n Pазмером $sizef байт\r\n";

    if(isset($_POST["first_name"]))     { $first_name = $_POST["first_name"]; }
    if(isset($_POST["last_name"]))      { $last_name = $_POST["last_name"]; }
    if(isset($_POST["email"]))          { $email = $_POST["email"]; }

    $uploaddir = 'images/Users/';
    $uploadfile = $uploaddir . $email . $namef;

    if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $uploadfile)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
        exit();
    }

    echo "first_name: $first_name \r\n last_name: $last_name \r\n email: $email \r\n pass: $pass \r\n";

    $conn = new mysqli("localhost", "root", "", "cinema_classic");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
        exit();
    }

    $sql = "INSERT INTO `users` (First_name, Last_name, Email, Password, Img_src) VALUES ('$first_name', '$last_name', '$email', '$pass', '$uploadfile')";
    if($conn->query($sql)){
        echo "Данные успешно добавлены \r\n";
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
  }
}


?>