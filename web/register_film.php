<!DOCTYPE HTML>
<html>
<head>
<title>Cinema Classic | Register Films</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- start plugins -->
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container">
	<div class="container_wrap">
		<div class="header_top">
		    <div class="col-sm-3 logo"><a href="index.html"><img src="images/logo.png" style="height: 30px;" alt=""/></a></div>
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
      	     <div class="register-but">
		  	  <form id="reg_form" method="POST" enctype="multipart/form-data" class="rf">
				 <div class="register-top-grid">
					<h3>Film Information</h3>
					 <div>
						<span>Name<label>*</label></span>
						<input type="text" name="name" placeholder="Назва фільму..." class="rfield">
					 </div>
                     <div>
                         <span>Years<label>*</label></span>
                         <input type="number" name="years" pattern="^[0-9]+$" value="0" min="1970" id="input_number" placeholder="Рік виходу..." class="rfield">
                     </div>
                     <div class="clearfix"> </div>
                     <div>
                        <span>Country<label>*</label></span>
                        <input type="text" name="country" placeholder="Країна походження..." class="rfield">
                     </div>
                     <div>
                         <span>Likes<label>*</label></span>
                         <input type="number" name="likes" pattern="^[0-9]+$" value="0" min="0" id="input_number" placeholder="Кількість відміток..." class="rfield">
                     </div>
                     <div class="clearfix"> </div>
                     <div>
                        <span>Director<label>*</label></span>
                        <input type="text" name="director" placeholder="Директор..." class="rfield">
                     </div>
                     <div>
                         <span>Film score<label>*</label></span>
                         <input type="number" name="score" pattern="^[0-9.]+$" placeholder="5.0" step="0.1" min="1" max="10" id="input_number" class="rfield">
                     </div>
                     <div class="clearfix"> </div>
                     <div>
                        <span>Category<label>*</label></span>
                        <select type="text" name="category[]" class="rfield" multiple="multiple">
                            <?php
                                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                                $link = mysqli_connect("localhost", "root", "", "cinema_classic");
                                $query = "SELECT * FROM category";
                                if($result = mysqli_query($link, $query)){
                                    foreach($result as $row){
                                        echo "<option value=\"" . $row['type']. "\">" . $row['id']. ". " . $row['type']. "</option>";
                                    }
                                }else {
                                  echo "0 results";
                                }
                            ?>
                        </select>
                     </div>
					 <div>
					 	 <span>Show date<label>*</label></span>
					 	 <input type="text" name="Show_date" pattern="\d{1,2}\.\d{1,2}\.\d{4}" placeholder="dd.mm.yyyy" id="input_number" class="rfield">

					 	 <span>Trailer URL<label>*</label></span>
					 	 <input type="text" name="URL_trailer" placeholder="URL посилання на трейлер фільму..." class="rfield">

 					 	 <span>Show time<label>*</label></span>
					 	 <input type="number" name="Show_time" pattern="^[0-9]+$" placeholder="Тривалість фільму в хвилинах..." id="input_number" class="rfield">

						 <span>Image<label>*</label></span>
						 <label for="file-uploader" id="targf" class="btn">
						    Select a file
						 </label>
						 <input type="file" name="upload_file" id="file-uploader" class="rfield" accept="image/jpeg, image/png">
						 <div id="feedback"></div>
					 </div>
					 </div>
                     <div class="clearfix"> </div>
				     <div class="register-bottom-grid">
                            <div>
    						    <h3>Actors</h3>
                                <div>
                                    <textarea name="actors" class="rfield" id="textarea" placeholder="Список акторів..." cols="30"></textarea>
                                </div>
                            </div>
                            <div>
                                <h3>Description</h3>
    							<div>
    								<textarea name="text" class="rfield" id="textarea" placeholder="Опис фільму..." cols="30"></textarea>
    							</div>
                            </div>
					 </div>
					 <div class="clearfix"> </div>
					 <input type="button" value="submit" id="btnSubmit" class="btn_submit disabled">
				   	 <div id="round-a-gray"><span id="result"></span></div>
				</form>
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
					<img src="images/Logo1.png" width="200" style="display: block; margin: 0 auto; margin-bottom: -15px; margin-top: -30px;" alt=""/>
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
<script type="text/javascript" src="js/valid-form.js"></script>
<script type="text/javascript" src="js/upload-form-to-base.js"></script>
<script type="text/javascript" src="js/session.js"></script>
<script type="text/javascript">
//скрипт отправки формы
function regAjax() {
	var form = $('#reg_form')[0];
    var data = new FormData(form);
    $("#btnSubmit").prop("disabled", true);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: 'reg_film.php',
        data: data,
        processData: false,  // Important!
        contentType: false,
        cache: false,
        success: function(data) {
        	if(data != "")
        	{
	        	$("#result").text(data);
	        	document.getElementById("round-a-gray").style.display = "block";
        	}
        	console.log("SUCCESS : ", data);
        	$("#btnSubmit").prop("disabled", false);
		},
		error: function(e) {
		        $("#result").text(e.responseText);
		        console.log("ERROR : ", e);
		        document.getElementById("round-a-gray").style.display = "block";
		        $("#btnSubmit").prop("disabled", false);
		    }
		});
}
</script>
</body>
</html>