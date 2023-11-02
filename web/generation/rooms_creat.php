<?php
$conn = new mysqli("localhost", "root", "", "cinema_classic");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
        exit();
    }

    $x = 1;
    $i = 2;
    $count_r = 0;
    $rooms = "";

	while ($i<=7)
	{
		switch ($i) {
			case 2:
				$count_r = 2;
				$rooms = "[{Name:Rus_room_B1,Size:B}, {Name:Rus_room_S1,Size:S}]";
				break;
			case 3:
				$count_r = 2;
				$rooms = "[{Name:Leyp_room_M1,Size:M}, {Name:Leyp_room_S1,Size:S}]";
				break;
			case 4:
				$count_r = 1;
				$rooms = "[{Name:Flor_room_M1,Size:M}]";
				break;
			case 5:
				$count_r = 11;
				$rooms = "[{Name:KinoMan_room_M1,Size:M}";
				while ($x <= 10)
				{
					$rooms .= ", ";
					$rooms .= "{Name:KinoMan_room_M" . ($x + 1) . ",Size:M}";
					$x++;
				}
				$x = 1;
				$rooms .= "]";
				break;
			case 6:
				$count_r = 6;
				$rooms = "[{Name:Octob_room_B1,Size:B}, {Name:Octob_room_M1,Size:M}";
				while ($x <= 3)
				{
					$rooms .= ", ";
					$rooms .= "{Name:KinoMan_room_S". ($x + 1) .",Size:S}";
					$x++;
				}
				$x = 1;
				$rooms .= "]";
				break;
			case 7:
				$count_r = 9;
				$rooms = "[{Name:PlanetKino_room_M1,Size:M}";
				while ($x <= 5)
				{
					$rooms .= ", ";
					$rooms .= "{Name:PlanetKino_room_M". ($x + 1) .",Size:M}";
					$x++;
				}
				$x = 0;
				while ($x <= 3)
				{
					$rooms .= ", ";
					$rooms .= "{Name:PlanetKino_room_S". ($x + 1) .",Size:S}";
					$x++;
				}
				$x = 1;
				$rooms .= "]";
				break;
			default:
				// code...
				break;
		}


		$sql = "UPDATE `cinema` SET `Count_rooms` = '{$count_r}',`Rooms` = '{$rooms}' WHERE `ID`={$i}";
	    if($conn->query($sql)){
	        echo "Данные успешно добавлены \r\n";
	    } else{
	        echo "Ошибка: " . $conn->error;
	    }

		$i++;
	}


    $conn->close();
?>