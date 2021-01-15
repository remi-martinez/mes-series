<?php
try
{
	$db=new PDO('sqlite:'.dirname(__FILE__).'/db.sqlite3');
}
catch(Exception $e)
{
	die("Erreur : ".$e->getMessage());
}