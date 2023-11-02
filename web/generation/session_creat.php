<?php
    class Cinema_Rooms
	{
	    public $cinema_ID;
	    public $count;
	    public $cost;
	    public $list;
	}
	class Films
	{
	    public $film_ID;
	    public $year;
	    public $score;
	    public $chance;
	}
	$conn = new mysqli("localhost", "root", "", "cinema_classic");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
        exit();
    }


	$sql = "SELECT * FROM `cinema`";
    if($conn->query($sql)){
        echo "Данные успешно изъяты \r\n";
        $data_r = $conn->query($sql);
    } else{
        echo "Ошибка: " . $conn->error;
    }
	$Rooms = array();
	$i = 0;
	if($data_r)
	foreach($data_r as $r)
	{
		$Rooms[$i] = new Cinema_Rooms();

		$Rooms[$i]->cinema_ID = $r['ID'];
        $Rooms[$i]->count = $r['Count_rooms'];
        $Rooms[$i]->cost = $r['Cost'];
        $Rooms[$i]->list = $r['Rooms'];

        $i++;
	}
	$chars = ['[',']','{','}',' ','Name:', 'Size:']; // символы для удаления
	foreach($Rooms as $ObjRooms)
	{
		$ObjRooms->list = explode("},", $ObjRooms->list);
		$end_result = [];
		foreach($ObjRooms->list as $s)
		{
			$rooms_obj = (object)array();

			$s = str_replace($chars, '', $s);
			$newStr = [];
			$newStr = explode(",", $s);

			$rooms_obj->Name = $newStr[0];
			$rooms_obj->Size = $newStr[1];
			array_push($end_result, $rooms_obj);
		}
		$ObjRooms->list = $end_result;
	}


	$sql = "SELECT * FROM `films`";
    if($conn->query($sql)){
        echo "Данные успешно изъяты \r\n";
        $data_r = $conn->query($sql);
    } else{
        echo "Ошибка: " . $conn->error;
    }
	$Films = array();
	$i = 0;
	if($data_r)
	foreach($data_r as $r)
	{
		$Films[$i] = new Films();

		$Films[$i]->film_ID = $r['ID'];
        $Films[$i]->year = $r['Year'];
        $Films[$i]->score = $r['Film_score'];

        $score = (int)str_replace('.', '', $Films[$i]->score);
        $year = (int)$Films[$i]->year;
        $chance = (($score - 50) / 1.05) + (($year - 1970) / 1.00025);


        $Films[$i]->chance = round($chance, 2);

        $i++;
	}
	usort($Films, "cmp");
	//print_r($Rooms);
	//print_r($Films);

	//$date = date("Y") . "-" . date("m") . "-" . (date("d") + $y) . " " . (9 + ($x * 3)) . ":00";
	for($y = 0; $y < 7; $y++) // days
		for($x = 0; $x < 5; $x++)
		{
			$date = date("Y") . "-01-" . (1 + $y) . " " . (9 + ($x * 3)) . ":00";
			foreach($Rooms as $ObjRooms)
			{
				$ListObj = array();
				$ListObj = $ObjRooms->list;
				foreach($ListObj as $str)
				{
					$choise_chns = choise($Films[0]->chance, end($Films)->chance);
					$i = 0;
					$idFilm;
					foreach($Films as $Objarr)
					{
						if($choise_chns < $Films[$i]->chance)
						{
							if($i > 0)
								if(abs($Films[$i]->chance - $choise_chns) < abs($Films[$i - 1]->chance - $choise_chns))
								{
									$idFilm = $Films[$i]->film_ID;
									break;
								}
								else if(abs($Films[$i]->chance - $choise_chns) > abs($Films[$i - 1]->chance - $choise_chns))
								{
									$idFilm = $Films[$i - 1]->film_ID;
									break;
								}
							else
							{
								$idFilm = $Films[0]->film_ID;
								break;
							}
						}$i++;
					}

					$Str_seats = "[1]=0";
					if($str->Size == 'B')
					{
						$num_seats = 300;
						$Cost_ticket = $ObjRooms->cost;
						for($seats = 2; $seats <= 300; $seats++)
							$Str_seats = $Str_seats . ", [" . $seats . "]=0";
					}
					else if($str->Size == 'M')
					{
						$num_seats = 200;
						$Cost_ticket = $ObjRooms->cost*1.25;
						for($seats = 2; $seats <= 200; $seats++)
							$Str_seats = $Str_seats . ", [" . $seats . "]=0";
					}
					else if($str->Size == 'S')
					{
						$num_seats = 100;
						$Cost_ticket = $ObjRooms->cost*1.5;
						for($seats = 2; $seats <= 100; $seats++)
							$Str_seats = $Str_seats . ", [" . $seats . "]=0";
					}

					$sql = "INSERT INTO `session` (Cinema_id, Name_rooms, Film_id, Cost, Number_seats, Available_seats, DataTime, Size_rooms, Str_seats) VALUES ('$ObjRooms->cinema_ID', '$str->Name', '$idFilm', '$Cost_ticket', '$num_seats', '$num_seats', '$date', '$str->Size', '$Str_seats')";
				    if($conn->query($sql))
				        echo "Данные успешно добавлены \r\n";
				    else
				        echo "Ошибка: " . $conn->error . "\r\n";
				}
			}
		}


	$conn->close();
	function cmp($a, $b) { return strcmp($a->chance, $b->chance); }
	function choise($a, $b) {

		$choise_chns = 0;

		if(rand(0,100) < 70)
			$choise_chns = rand(7000, $b*100)/100;
		else if(rand(0,100) < 60)
			$choise_chns = rand(6000, 6900)/100;
		else if(rand(0,100) < 50)
			$choise_chns = rand(5000, 5900)/100;
		else if(rand(0,100) < 40)
			$choise_chns = rand(4000, 4900)/100;
		else if(rand(0,100) < 30)
			$choise_chns = rand($a*100, 3900)/100;
		else
			$choise_chns = rand($a*100, 5000)/100;


		return $choise_chns;
	}
?>