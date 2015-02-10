<?php
	//https://www.youtube.com/watch?v=ueWpNe0PG34
	//https://www.youtube.com/watch?v=lB9aKoFjwkg&list=PL5A60C9222A50CD6A
	//http://stackoverflow.com/questions/15089294/slim-framework-for-beginners
	$user = 'root';
	$password = 'admin';
	$db = 'users';

	$db = new mysqli('localhost',$user,$password,$db) or die("Unable to connect");
	echo "Great work";
?>