$.ajax({
    type: "GET",
    url: '../session.php',
    success: function(data){
        var mas = jQuery.parseJSON(data);
        var logName = mas[0] + " " + mas[1];
        $("#log_name").text(logName);
        $("#log_img").attr("src",mas[2]);

        if(logName = "Admin *")
            $("#nav_bar").append('<li><span class="simptip-position-bottom simptip-movable" data-tooltip="reg Film"><a href="register_film.php"> </a></span></li><li><span class="simptip-position-bottom simptip-movable" data-tooltip="reg Cinema"><a href="register_cinema.html"> </a></span></li>');
    }
});

$("#exit").click(function() {
  $.ajax({
    type: "GET",
    url: '../sessionend.php',
    success: function(data){
        location.reload();
    }
});
});