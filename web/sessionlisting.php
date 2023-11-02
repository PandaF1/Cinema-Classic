<?php
$date = $_POST['data1'];
$film_id = $_POST['data2'];

$cinema_list = [];
$sessions_obj_massive = [];
$count_cinema = 0;

$conn = new mysqli("localhost", "root", "", "cinema_classic");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
    exit();
}

$query = "SELECT ID, Name FROM cinema";
$row = $conn->query($query);
foreach($row as $r)
{
	$cinema_obj = (object)array();

    $cinema_obj->ID = $r['ID'];
    $cinema_obj->Name = $r['Name'];
	array_push($cinema_list, $cinema_obj);
	$count_cinema++;
}

if($date == "All Dates")
	$query = "SELECT ID, Cinema_id, Name_rooms, Cost, Time(DataTime) As Time, Date(DataTime) As Date, Size_rooms, Number_seats, Available_seats FROM session WHERE Film_ID = $film_id";
else
	$query = "SELECT ID, Cinema_id, Name_rooms, Cost, Time(DataTime) As Time, Date(DataTime) As Date, Size_rooms, Number_seats, Available_seats FROM session WHERE Film_ID = $film_id AND DATE(DataTime) = \"$date\"";
$row = $conn->query($query);
foreach($row as $r)
{
	$session_obj = (object)array();

	$session_obj->ID = $r['ID'];
	$session_obj->Cinema_ID = $r['Cinema_id'];
	for ($i = 0; $i < $count_cinema; $i++) {
		if($cinema_list[$i]->ID == $r['Cinema_id'])
		{
			$session_obj->Cinema_Name = $cinema_list[$i]->Name;
			break;
		}
	}
	$session_obj->Film_id = $film_id;
	$session_obj->Name_rooms = $r['Name_rooms'];
	$session_obj->Cost = $r['Cost'];
	$session_obj->Time = $r['Time'];
	$session_obj->Date = $r['Date'];
	$session_obj->Size_rooms = $r['Size_rooms'];
	$session_obj->Number_seats = $r['Number_seats'];
	$session_obj->Available_seats = $r['Available_seats'];

	array_push($sessions_obj_massive, $session_obj);
}

usort($sessions_obj_massive, "cmp");
echo json_encode($sessions_obj_massive);

function cmp($a, $b)
{
    return strcmp($a->Cinema_Name, $b->Cinema_Name);
}
?>