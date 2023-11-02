<?php
session_start();
if (isset($_SESSION['id_user']))
{
	$fir = $_SESSION['First_name'];
	$last = $_SESSION['Last_name'];
	$img = $_SESSION['Img_src'];

	$content = array($fir, $last, $img);
	echo json_encode($content);
}

?>