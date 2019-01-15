<?php
	
	$pdo = null;

   $erreur = null;
   $dbtype = 'mysql';
   $dbname = '***';
   $dbhost = 'infodb.iutmetz.univ-lorraine.fr';
   $dbuser = '***';
   $dbpass = '***';

    try {
      $dsn = "{$dbtype}:host={$dbhost};dbname={$dbname}";
	  
      $pdo =  new PDO($dsn,$dbuser,$dbpass);

	  $pdo->query('SET NAMES utf8');
        }
		
	catch (PDOException $erreur) {

      print "Erreur ! : " . $erreur->getMessage();
      
      die();
	  }
?>
