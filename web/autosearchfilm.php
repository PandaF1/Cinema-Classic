<?php
//получаем данные через $_POST
$word = $_POST['data1'];
if($word != null)
{
    $conn = new mysqli("localhost", "root", "", "cinema_classic");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
        exit();
    }

    //Фильтрация запроса
    $query = "SELECT * FROM `films` WHERE Name LIKE '%" . $word . "%' ORDER BY Name LIMIT 10";

    // Получаем результаты
    $row = $conn->query($query);
    $end_result = '';
    foreach($row as $r) {
        $result         = $r['Name'];
        $end_result     .= '<option value="' . $result . '" >' . $result . '</option>';
    }
    echo '<datalist id="search">' . $end_result . '</datalist>';
}
else {
        echo '<li>По вашему запросу ничего не найдено</li>';
    }
?>