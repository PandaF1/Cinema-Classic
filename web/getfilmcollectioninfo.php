<?php
//получаем данные через $_POST
$count = $_POST['data1'];

if($count != null)
{
    $conn = new mysqli("localhost", "root", "", "cinema_classic");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
        exit();
    }

    //Фильтрация запроса
    $query = "SELECT * FROM `films` ORDER BY RAND() LIMIT ". $count ."";


    // Получаем результаты
    $row = $conn->query($query);
    $end_result = [];
    foreach($row as $r) {
        $film_obj = (object)array();

        $film_obj->Name = $r['Name'];
        $film_obj->Likes = $r['Count_likes'];
        $film_obj->Rating = $r['Film_score'];
        $film_obj->Img_scr = $r['Img_scr'];
        $film_obj->URL_trailer = $r['URL_trailer'];

        array_push($end_result, $film_obj);
    }

    echo json_encode($end_result);
}

?>