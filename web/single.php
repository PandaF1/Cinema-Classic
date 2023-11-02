<?php
  if(isset($_GET["search"]))
  {
  	$conn = new mysqli("localhost", "root", "", "cinema_classic");
	if($conn->connect_error){
	    die("Ошибка: " . $conn->connect_error);
	    exit();
	}

	$Film_Name;

	$word = $_GET["search"];
	$query = "SELECT * FROM `films` WHERE Name = '" . $word . "'";

	// Получаем результаты
	$data_r = $conn->query($query);

	if($data_r)
	foreach($data_r as $row) {
		$Film_ID			= $row['ID'];
		$Film_Name			= $row['Name'];
		$Film_Category 		= $row['Category'];
		$Film_Year			= $row['Year'];
		$Film_Country		= $row['Country'];
		$Film_Actors		= $row['Actors'];
		$Film_Director		= $row['Director'];
		$Film_Description	= $row['Description'];
		$Film_Img_scr_film 	= $row['Img_scr'];
		$Film_Count_likes 	= $row['Count_likes'];
		$Film_score 		= $row['Film_score'];
		$Film_Show_time		= $row['Show_time'];
		$Film_Show_date		= $row['Show_date'];
		$Film_URL_trailer 	= $row['URL_trailer'];
	}
	if($Film_URL_trailer != null)
		$Film_URL_trailer = str_replace("watch?v=", "embed/", $Film_URL_trailer);

	$date = new DateTime($Film_Show_date);
	$Film_Show_date = $date->format('d(D).m(F).Y');
  }
  function console_log($data){ // сама функция
    if(is_array($data) || is_object($data)){
		echo("<script>console.log('php_array: ".json_encode($data)."');</script>");
	} else {
		echo("<script>console.log('php_string: ".$data."');</script>");
	}
}
 ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Cinema Classic | <? echo $Film_Name; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Movie_store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- start plugins -->
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.min.js?v=502"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<script type="text/javascript">
	$(document).ready(function(){
		var count = 3;
		$.ajax({
                type: "POST",
                url: "getfilmcollectioninfo.php",
                data: { data1: count },
               	success: function(response){
               		var mas = jQuery.parseJSON(response);
				    //$("#log_name").text(mas[0] + " " + mas[1]);
				    try{
				    	$("#ObjImg1").attr("src",mas[0]["Img_scr"]);
					    $("#ObjImg1").css("width", '100%');
					    $("#ObjName1").text(mas[0]["Name"]);
					    $("#ObjLike1").text(mas[0]["Likes"]);
					    $("#ObjA1").attr("href",'single.php?search=' + encodeURIComponent(mas[0]["Name"]));


					    $("#ObjImg2").attr("src",mas[1]["Img_scr"]);
					    $("#ObjImg2").css("width", '100%');
					    $("#ObjName2").text(mas[1]["Name"]);
					    $("#ObjLike2").text(mas[1]["Likes"]);
					    $("#ObjA2").attr("href",'single.php?search=' + encodeURIComponent(mas[1]["Name"]));


					    $("#ObjImg3").attr("src",mas[2]["Img_scr"]);
					    $("#ObjImg3").css("width", '100%');
					    $("#ObjName3").text(mas[2]["Name"]);
					    $("#ObjLike3").text(mas[2]["Likes"]);
					    $("#ObjA3").attr("href",'single.php?search=' + encodeURIComponent(mas[2]["Name"]));


					} catch (error)	{
						alert("ERROR : ", error);
					}

              	},
              	error: function(e) { console.log("ERROR : ", e);  }
            });
	});
	function MyFunc(){
		$.ajax({
                type: "POST",
                url: "generation/session_creat.php",
                data: 13,
               	success: function(response){
               		try{
               			console.log("Response : " + response);
               		   } catch (error)	{
						alert("ERROR : ", error);
					}
              	},
              	error: function(e) { console.log("ERROR : ", e);  }
            });
	}
</script>
</head>
<body>
<div class="container">
	<div class="container_wrap">
		<div class="header_top">
		    <div class="col-sm-3 logo"><a href="index.html"><img src="images/logo.png" alt=""/></a></div>
		    <div class="col-sm-6 nav">
			  <ul id="nav_bar">
				 <!-- <li> <span class="simptip-position-bottom simptip-movable" data-tooltip="comic"><a href="movie.html"> </a></span></li> -->
				 <li><span class="simptip-position-bottom simptip-movable" data-tooltip="movie"><a href="movie.html"> </a> </span></li>
				 <li><span class="simptip-position-bottom simptip-movable" data-tooltip="main"><a href="index.html"> </a></span></li>
				 <!-- <li><span class="simptip-position-bottom simptip-movable" data-tooltip="game"><a href="movie.html"> </a></span></li> -->
			 </ul>
			</div>
			<div class="col-sm-3 header_right">
			   <ul class="header_right_box">
				 <li><img src="images/p1.png" id="log_img" alt=""/></li>
				 <li><p><a href="login.html" id="log_name">Unnamed</a></p></li>
				 <li class="last"><a href="#" id="exit"><i class="edit"></i></a></li>
				 <div class="clearfix"> </div>
			   </ul>
			</div>
			<div class="clearfix"> </div>
	      </div>
	   <div class="content">
      	   <div class="movie_top">
      	         <div class="col-md-9 movie_box">
      	         		<h2 class="movie_name"><? echo $Film_Name; ?></h1>
                        <div class="grid images_3_of_2">
                        	<div class="movie_image">
                                <span class="movie_rating"><? echo $Film_score; ?></span>
                                <img src="<? echo $Film_Img_scr_film; ?>" class="img-responsive" style="margin: auto; height:400px" alt=""/>
                            </div>
                            <div class="movie_rate">
                            	<div class="rating_desc"><p>Your Vote :</p></div>
                            	<form action="" class="sky-form">
							     <fieldset>					
								   <section>
								     <div class="rating">
										<input type="radio" name="stars-rating" id="stars-rating-5">
										<label for="stars-rating-5"><i class="icon-star"></i></label>
										<input type="radio" name="stars-rating" id="stars-rating-4">
										<label for="stars-rating-4"><i class="icon-star"></i></label>
										<input type="radio" name="stars-rating" id="stars-rating-3">
										<label for="stars-rating-3"><i class="icon-star"></i></label>
										<input type="radio" name="stars-rating" id="stars-rating-2">
										<label for="stars-rating-2"><i class="icon-star"></i></label>
										<input type="radio" name="stars-rating" id="stars-rating-1">
										<label for="stars-rating-1"><i class="icon-star"></i></label>
									 </div>
								  </section>
							    </fieldset>
						  	   </form>
						  	   <div class="clearfix"> </div>
                            </div>
                        </div>
                        <div class="desc1 span_3_of_2">
                        	<p class="movie_option"><strong>Country: </strong><? echo $Film_Country; ?></p>
                        	<p class="movie_option"><strong>Year: </strong><? echo $Film_Year; ?></p>
                        	<p class="movie_option"><strong>Category: </strong><? echo $Film_Category; ?></p>
                        	<p class="movie_option"><strong>Show Date: </strong><? echo $Film_Show_date; ?></p>
                        	<p class="movie_option"><strong>Show Time: </strong><? echo $Film_Show_time; ?> m.</p>
                        	<p class="movie_option"><strong>Director: </strong><? echo $Film_Director; ?></p>
                        	<p class="movie_option"><strong>Actors: </strong><? echo $Film_Actors; ?></p>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" data-bs-name="<? echo $Film_Name; ?>" data-bs-id="<? echo $Film_ID; ?>">Where to BUY</button>
                            <div class="down_btn">
                            	<!-- <a class="btn1" onclick="MyFunc()" href="#"><span></span>Buy</a> -->
                            </div>
                         </div>
                        <div class="clearfix"></div>
	                	<div class="col-md-12">
	                  	<div class="video">
									      <iframe width="100%" height="420px" src="<? echo $Film_URL_trailer; ?>" frameborder="0" style="margin-bottom:1em;  margin-top:1.5em" allowfullscreen></iframe>
									    </div>
	                	</div>
	                	<div class="col-md-12">
	                      <p class="m_4"><? echo $Film_Description; ?></p>
										</div>
                  <div class="clearfix"> </div>
	                <form method="post" action="contact-post.html">
										<div class="text">
		                	<textarea value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message:</textarea>
		                </div>
		                <div class="form-submit1">
				           		<input name="submit" type="submit" id="submit" value="Submit Your Message"><br>
				        		</div>
										<div class="clearfix"></div>
               		</form>
		                <div class="single">
		                <h1>10 Comments</h1>
		                <ul class="single_list">
					        <li>
					            <div class="preview"><a href="#"><img src="images/2.jpg" class="img-responsive" alt=""></a></div>
					            <div class="data">
					                <div class="title">Movie  /  2 hours ago  /  <a href="#">reply</a></div>
					                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
					            </div>
					            <div class="clearfix"></div>
					        </li>
					         <li>
					            <div class="preview"><a href="#"><img src="images/3.jpg" class="img-responsive" alt=""></a></div>
					            <div class="data">
					                <div class="title">Wernay  /  2 hours ago  /  <a href="#">reply</a></div>
					                <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent </p>
					            </div>
					            <div class="clearfix"></div>
					        </li>
					         <li>
					            <div class="preview"><a href="#"><img src="images/4.jpg" class="img-responsive" alt=""></a></div>
					            <div class="data">
					                <div class="title">mr.dev  /  2 hours ago  /  <a href="#">reply</a></div>
					                <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram,</p>
					            </div>
					           <div class="clearfix"></div>
					        </li>
					     	<li class="middle">
					            <div class="preview"><a href="#"><img src="images/5.jpg" class="img-responsive" alt=""></a></div>
					            <div class="data-middle">
					                <div class="title">Wernay  /  2 hours ago  /  <a href="#">reply</a></div>
					                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
					            </div>
					            <div class="clearfix"></div>
					        </li>
					        <li class="last-comment">
					            <div class="preview"><a href="#"><img src="images/6.jpg" class="img-responsive" alt=""></a></div>
					            <div class="data-last">
					                <div class="title">mr.dev  /  2 hours ago  /  <a href="#">reply</a></div>
					                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit </p>
					            </div>
					            <div class="clearfix"></div>
					        </li>
					         <li>
					            <div class="preview"><a href="#"><img src="images/7.jpg" class="img-responsive" alt=""></a></div>
					            <div class="data">
					                <div class="title">denpro  /  2 hours ago  /  <a href="#">reply</a></div>
					                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
					            </div>
					            <div class="clearfix"></div>
					        </li>
			  			</ul>
                      </div>
                      </div>
              <div class="col-md-3">
              	<div class="movie_img"><div class="grid_2">
              		<a href="" id="ObjA1">
								<img src="images/pic6.jpg" id="ObjImg1" class="img-responsive" alt="">
								<div class="caption1">
										<ul class="list_5 list_7">	<li> <!-- <i class="icon5"> </i><p id="ObjLike1">3,548</p></li>	 --></ul>
								    	<p class="m_3" id="ObjName1">Guardians of the Galaxy</p>
								</div>
							</a>
						    </div>
						   </div>
            	  <div class="grid_2 col_1">
            	  	<a href="#" id="ObjA2">
								<img src="images/pic2.jpg" id="ObjImg2" class="img-responsive" alt="">
								<div class="caption1">
									<ul class="list_3 list_7"> <li> <!-- <i class="icon5"> </i><p id="ObjLike2">3,548</p></li> --></ul>
							    	<p class="m_3" id="ObjName2">Guardians of the Galaxy</p>
								</div>
							</a>
						   </div>
						    <div class="grid_2 col_1">
					    	<a href="#" id="ObjA3">
								<img src="images/pic9.jpg" id="ObjImg3" class="img-responsive" alt="">
								<div class="caption1">
									<ul class="list_3 list_7"> <li><!-- <i class="icon5"> </i><p id="ObjLike3">3,548</p></li>  --></ul>
							    	<p class="m_3" id="ObjName3" >Guardians of the Galaxy</p>
								</div>
							</a>
						   </div>
		               </div> 
                      <div class="clearfix"> </div>
                  </div>
           </div>
    </div>
</div>
<!-- Modal -->
<!-- Vertically centered scrollable modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="modal-cont">
        <h5 class="modal-title" id="myModalLabel">New message</h5>
      </div>
    </div>
  </div>
</div>
<div class="container"> 
 <footer id="footer">
 	<div id="footer-3d">
		<div class="gp-container">
			<span class="first-widget-bend"> </span>
		</div>		
	</div>
    <div id="footer-widgets" class="gp-footer-larger-first-col">
		<div class="gp-container">
            <div class="footer-widget footer-1">
            	<div class="wpb_wrapper">
					<img src="images/Logo1.png" width="200" style="display: block; margin: auto; margin-bottom: -15px; margin-top: -30px;" alt=""/>
				</div> 
	          <br>
	          <p>It is a long established fact that a reader will be distracted by the readable content of a page.</p>
			  <p class="text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered.</p>
			 </div>
			 <div class="footer_box">
			  <div class="col_1_of_3 span_1_of_3">
					<h3>Categories</h3>
					<ul class="first">
						<li><a href="http://web/movie.html?date=All%20Dates&genre=%D0%9A%D0%BE%D0%BC%D0%B5%D0%B4%D0%B8%D1%8F">Комедия</a></li>
						<li><a href="http://web/movie.html?date=All%20Dates&genre=%D0%A4%D0%B0%D0%BD%D1%82%D0%B0%D1%81%D1%82%D0%B8%D0%BA%D0%B0">Фантастика</a></li>
						<li><a href="#">Ужасы</a></li>
					</ul>
		     </div>
		     <div class="col_1_of_3 span_1_of_3">
					<ul class="first">
						<li><a href="#">Аниме</a></li>
						<li><a href="http://web/movie.html?date=All%20Dates&genre=%D0%91%D0%BE%D0%B5%D0%B2%D0%B8%D0%BA">Боевик</a></li>
						<li><a href="http://web/movie.html?date=All%20Dates&genre=%D0%94%D0%B5%D1%82%D0%B5%D0%BA%D1%82%D0%B8%D0%B2">Детектив</a></li>
						<li><a href="#">Мистика</a></li>
						<li><a href="http://web/movie.html?date=All%20Dates&genre=%D0%9C%D0%B5%D0%BB%D0%BE%D0%B4%D1%80%D0%B0%D0%BC%D0%B0">Мелодрама</a></li>
					</ul>
		     </div>
		     <div class="col_1_of_3 span_1_of_3">
					<h3>Follow Us</h3>
					<ul class="first">
						<li><a href="#">Facebook</a></li>
						<li><a href="#">Twitter</a></li>
						<li><a href="#">Youtube</a></li>
					</ul>
					<div class="copy">
				      <p>&copy; 2021 Template by <a href="index.html" target="_blank"> Cinema Classic</a></p>
			        </div>
		     </div>
		    <div class="clearfix"> </div>
	        </div>
	        <div class="clearfix"> </div>
		</div>
	</div>
  </footer>
</div>
<script type="text/javascript" src="js/session.js"></script>
<script type="text/javascript">
	$('#myModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var film = button.data('bs-name');
	  var film_id = button.data('bs-id');
	  var modal = $(this);
	  var date = "All Dates";
	  console.log("Fack :\n");

	  $.ajax({
                type: "POST",
                url: "sessionlisting.php",
                data: { data1: date, data2: film_id },
               	success: function(response){ // запустится после получения результатов
               		var mas = jQuery.parseJSON(response);
           			//console.log("Finish :\n", mas);

           			var main = document.getElementById("modal-cont");
           			main.innerHTML = "";
           			var str = '<div class="modal-header" id="modal-cont"><h5 class="modal-title" id="myModalLabel">Film - ' + film + ' (' + date + ')</h5></div>';
           			var count = 1;
           			var cinemaName = "";
           			var sizeroom = "";
           			mas.forEach(v => {
           				if(cinemaName != "" && cinemaName != v.Cinema_Name)
           					str += '</div>';
           				if(cinemaName == "" || cinemaName != v.Cinema_Name)
           				{
					  		str += '<div class="row"><div class="ms-auto center_f" style="height:auto"> <label id="Cinema-name' + count + '" class="col-form-label">' + v.Cinema_Name + ': </label></div>';
					  		cinemaName = v.Cinema_Name;
           				}
           				if(v.Size_rooms == 'S')
           					sizeroom = 'Малой зал';
           				else if(v.Size_rooms == 'M')
           					sizeroom = 'Средний зал';
           				else if(v.Size_rooms == 'B')
           					sizeroom = 'Большой зал';

str += '<div class="col-sm-3 modal-body"><div class="row"><div class="col-sm-12 ms-auto center_f" style="height:auto"><label id="Date-ticket ' + count + '" class="col-form-label">' + v.Date + '</label></div>';
str += '<div class="col-sm-12 ms-auto center_f" style="height:auto"><label id="Rooms-size ' + count + '" class="col-form-label">' + sizeroom + '</label></div>';
str += '<div class="col-sm-12 ms-auto center_f" style="height:auto"><label id="Rooms-name ' + count + '" class="col-form-label">' + v.Name_rooms + '</label></div>';
str += '<div class="col-sm-12 ms-auto center_f" style="height:auto"><label id="Cost-ticket ' + count + '" class="col-form-label">Цена: ' + v.Cost + ' грн</label></div></div>';
str += '<div class="modal-footer"><div class="ms-auto center_f" style="height:auto"><button type="button" id="Time-ticket ' + count + '" class="btn btn-secondary">' + v.Time + '</button></div></div></div>';
					count++;
					});
      				main.innerHTML += str;

              	},
              	error: function(e) { console.log("ERROR :\n", e);  }
            });
	})
</script>
</body>
</html>
