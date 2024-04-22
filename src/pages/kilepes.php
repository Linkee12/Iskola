<?php
session_start();

unset($_SESSION["loggedin"]);
unset($_SESSION["name"]);
unset($_SESSION["id"]);

session_destroy();


header("Location: index.php"); // Módosítsd az index.php-t az általad preferált oldalra

exit;
?>