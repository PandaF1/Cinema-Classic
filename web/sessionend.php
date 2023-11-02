<?php
session_start();
unset($_SESSION['name']); // или $_SESSION = array() для очистки всех данных сессии
session_destroy();
?>