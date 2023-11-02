<?php
$name = "";
$category = "";
$years = "";
$likes = "";
$country = "";
$director = "";
$score = "";
$actors = "";
$Description = "";
$URL_trailer = "";
$Show_time = "";
$Show_date = "";



if($_FILES['upload_file']['size']>0) {
    $namef = $_FILES['upload_file']['name'];
    $sizef = $_FILES['upload_file']['size'];
    echo "Получен файл $namef \r\n Pазмером $sizef байт\r\n";

    if(isset($_POST["name"]))         { $name = $_POST["name"]; }
    if(isset($_POST["years"]))        { $years = $_POST["years"]; }
    if(isset($_POST["likes"]))        { $likes = $_POST["likes"]; }
    if(isset($_POST["country"]))      { $country = $_POST["country"]; }
    if(isset($_POST["director"]))     { $director = $_POST["director"]; }
    if(isset($_POST["URL_trailer"]))  { $URL_trailer = $_POST["URL_trailer"]; }
    if(isset($_POST["score"]))        { $score = $_POST["score"]; }
    if(isset($_POST["Show_time"]))    { $Show_time = $_POST["Show_time"]; }
    if(isset($_POST["Show_date"]))    { $Show_date = $_POST["Show_date"]; }
    if(isset($_POST["actors"]))       { $actors = $_POST["actors"]; }
    if(isset($_POST["text"]))         { $Description = $_POST["text"]; }

    $uploaddir = 'images/Films/';

    $nameimg = $name;
    $nameimg = str_replace(':', '', $nameimg);
    $uploadfile = $uploaddir . $nameimg . ".png";

    if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $uploadfile)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
        exit();
    }

    if(isset($_POST["category"]))     {

           foreach($_POST["category"] as $row){
            $category .= $row . ", ";
        }
        $category = substr($category, 0, -2);
    }

    echo "Фильм: $name \r\n Категория: $category \r\n Год: $years \r\n Время показа: $Show_time \r\n Дата показа: $Show_date \r\n Кол. Лайков: $likes \r\n Страна: $country \r\n Директор: $director \r\n Общ. Балл: $score \r\n Актеры: $actors \r\n Описание: $Description\r\n";

    $conn = new mysqli("localhost", "root", "", "cinema_classic");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
        exit();
    }

    $sql = "INSERT INTO `films` (Name, Category, Year, Country, Actors, Director, Description, Img_scr, Count_likes, Film_score, URL_trailer, Show_time, Show_date) VALUES ('$name', '$category', '$years', '$country', '$actors', '$director', '$Description', '$uploadfile', '$likes' , '$score', '$URL_trailer', '$Show_time', '$Show_date')";
    if($conn->query($sql)){
        echo "Данные успешно добавлены \r\n";
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
}
?>