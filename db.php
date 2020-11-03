<?php
try
{
	$db=new PDO("mysql:host=91.216.107.219; dbname=regow1442465;charset=utf8", "regow1442465", "PASSWORD");
}
catch(Exception $e)
{
	die("Erreur :".$e->getMessage());
}
