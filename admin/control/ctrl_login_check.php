<?php
	session_start();
	include_once("model/md_login.php");
	if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
		if(!tv_login($_SESSION['username'],$_SESSION['password'])){
			header("Location: login.php");
			//'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
		}
	}
	else
		header("Location: login.php");
 ?>
