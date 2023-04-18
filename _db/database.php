<?php


define('HOST', 'localhost');
define('DB_NAME', 'projetgreta');
define('USER', 'aure');
define('PASS', '');

try {
  $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connecté !";
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
