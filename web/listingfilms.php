<?php
	$date = $_POST['data1'];
	$genre = $_POST['data2'];

	$datelist = [];
	$filmlistid = [];
    $fimls_obj_massive = [];
    $list_category = [];
    $str_category = "";

	$conn = new mysqli("localhost", "root", "", "cinema_classic");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
        exit();
    }

    $query = "SELECT DATE(DataTime) AS Date FROM session GROUP BY Date";
    $row = $conn->query($query);
    foreach($row as $r)
    	array_push($datelist, $r['Date']);


    //Выборка из сессии фильмов по дате
	if($date == "All Dates")
		$query = "SELECT Film_id FROM session GROUP BY Film_id";
	else
		$query = "SELECT Film_id FROM session WHERE DATE(DataTime) = \"$date\" GROUP BY Film_id";
	$row = $conn->query($query);
	foreach($row as $r)
        array_push($filmlistid, $r['Film_id']);
    sort($filmlistid);


    $query = "SELECT * FROM `films`";
    $row = $conn->query($query);
    $x = 0;

    foreach($row as $r) {
    	if(count($filmlistid) == $x)
    		break;
    	if($filmlistid[$x] == $r['ID'])
    	{
    		//Автозаполнение Категории
	        if($str_category == "")
	        	$str_category = $r['Category'];
	        else
	        	$str_category = $str_category . ", " . $r['Category'];

	        $x++;
    	}
    }
    $x = 0;

    foreach($row as $r) {
    	if(count($filmlistid) == $x)
    		break;
    	if($filmlistid[$x] == $r['ID'])
    	{
	        $film_obj = (object)array();

	        $film_obj->ID = $r['ID'];
	        $film_obj->Name = $r['Name'];
	        $film_obj->Category = $r['Category'];
	        $film_obj->Year = $r['Year'];
	        $film_obj->Actors = $r['Actors'];
	        $film_obj->Likes = $r['Count_likes'];
	        $film_obj->Rating = $r['Film_score'];
	        $film_obj->Img_scr = $r['Img_scr'];
	        $film_obj->Description = $r['Description'];
	        $film_obj->Show_time = $r['Show_time'];
	        $film_obj->Info_Category = false;

	        if($genre == "All Genres")
	        	$film_obj->Info_Category = true;
	        else
	        {
	        	$pos = strpos($r['Category'], $genre);
	        	if($pos === false)
	        		$film_obj->Info_Category = false; //"Строка " . $genre . " не найдена в строке " . $r['Category'];
	        	else
	        		$film_obj->Info_Category = true; //"Строка " . $genre . " Найдена в строке " . $r['Category'];
	        }

	        if($film_obj->Info_Category)
	        	array_push($fimls_obj_massive, $film_obj);

        	if($filmlistid[$x] <= $r['ID'])
        		$x++;

	    }
    }
    $mas = explode(", ", $str_category);
    foreach(array_unique($mas) as $r) //array_unique - уборка дубликатов
    	array_push($list_category, $r);

    $Array_div_films = [];
    foreach($fimls_obj_massive as $obj)
    {
    	$data = array(
		    'search' => $obj->Name
		);
		$url = "single.php?" . http_build_query($data);

		$rate = $obj->Rating;
		$src_rate = 2;

    	if($rate >= 9.0)
    		$src_rate = 5;
    	else if($rate >= 7.0 && $rate <= 8.9)
    		$src_rate = 4;
    	else if($rate >= 5.0 && $rate <= 6.9)
    		$src_rate = 3;
    	else if(4.9 >= $rate)
    		$src_rate = 2;



    	$str = '<div class="movie movie-test movie-test-dark">
                    <div class="movie__images col-md-3 center_f">
                        <a href="'.$url.'" class="movie-beta__link">
                            <img alt="" src="'.$obj->Img_scr.'" class="img-responsive" style="height:300px" alt=""/>
                        </a>
                    </div>
					<div class="movie__info col-md-4">
                        <a href="'.$url.'" class="movie__title">'.$obj->Name.' ('.$obj->Year.')</a>
                        <p class="movie__time">'.$obj->Show_time.' min</p>
						<p class="movie__option">'.$obj->Category.'</p>
						<p><br>'.$obj->Actors.'</p>
						<p><br>Rating : &nbsp;&nbsp;<img src="images/rating'.$src_rate.'.png" alt="">&nbsp;&nbsp;'.$obj->Rating.'</p>
						<ul class="list_6 center_li">
			    			<li style="justify-content: left;"><i class="icon1"></i><p>'.number_format($obj->Likes, 0, '', ' ').'</p></li>
							<div class="clearfix"> </div>
			    		</ul>
                     </div>
                     <div class="movie__info col-md-4 center_text">
                     	<p>'.$obj->Description.'</p>
                     </div>
                    <div class="movie__info col-md-1 center_f">
                    	<ul class="list_6 center_li">
		    				<li><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" data-bs-name="'.$obj->Name.'" data-bs-id="'.$obj->ID.'">Where<br>to<br>BUY</button></li>
		    				<div class="clearfix"> </div>
			    		</ul>
                 	</div>
                    <div class="clearfix"> </div>
                </div>';
        array_push($Array_div_films, $str);
    }

    echo json_encode(array($datelist, $list_category, $filmlistid, $fimls_obj_massive, $Array_div_films));
?>