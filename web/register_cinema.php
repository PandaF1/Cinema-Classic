<?php
$name = "";
$location = "";
$likes = "";
$Description = "";

if($_FILES['upload_file']['size']>0) {
    $namef = $_FILES['upload_file']['name'];
    $sizef = $_FILES['upload_file']['size'];
    echo "Получен файл $namef \r\n Pазмером $sizef байт\r\n";

    $uploaddir = 'images/Cinema/';
    $uploadfile = $uploaddir . $namef;

    if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $uploadfile)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
        exit();
    }

    if(isset($_POST["name"]))           { $name = $_POST["name"]; }
    if(isset($_POST["location"]))       { $location = $_POST["location"]; }
    if(isset($_POST["likes"]))          { $likes = $_POST["likes"]; }
    if(isset($_POST["text"]))           { $Description = $_POST["text"]; }

    echo "Cinema: $name \r\n Location: $location \r\n Описание: $Description \r\n";

    $conn = new mysqli("localhost", "root", "", "cinema_classic");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
        exit();
    }

    $sql = "INSERT INTO `cinema` (Name, Location, Description, Count_likes, Img_scr) VALUES ('$name', '$location', '$Description', '$likes', '$uploadfile')";
    if($conn->query($sql)){
        echo "Данные успешно добавлены \r\n";
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
}
?>