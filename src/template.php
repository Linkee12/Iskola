<?php
$navigation=array(
	'/' => array('file' => 'home', 'show' => 'Főoldal', 'isLoggedIn' => array(1,1)),
	'galery' => array('file' => 'galery', 'show' => 'Galéria', 'isLoggedIn' => array(1,1)),
	'info' => array('file' => 'kapcsolat', 'show' => 'Kapcsolat', 'isLoggedIn' => array(1,1)),
    'messages' => array('file' => 'uzenetek', 'show' => 'Üzenetek', 'isLoggedIn' => array(1,1)),
    'login' => array('file' => 'login', 'show' => 'Belépés', 'isLoggedIn' => array(1,0)),
    'kilepes' => array('file' => 'kilepes', 'show' => 'Kilépés', 'isLoggedIn' => array(0,1)),
    'regisztral' => array('file' => 'regisztral', 'show' => '', 'isLoggedIn' => array(0,0)),
);
?>