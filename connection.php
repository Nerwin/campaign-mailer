<?php
$hostname='localhost';
$username='root';
$password='';


try {
$dbh = new PDO("mysql:host=$hostname;dbname=newsletterdb",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "Erreur";
	echo $e->getMessage();
}

?> 