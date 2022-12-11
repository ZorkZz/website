<?php
//PDO
$servername = 'localhost';
$username = 'zorkz';
$password = 'KgTx5wytGTL!96?';
$dbname = 'tchat';

try{
    $PDO = new PDO("mysql:host=$servername;dbname=$dbname;", "$username", "$password");
}catch(PDOException $e){
    echo "erreur : ".$e->getMessage();
};

//SQLI

try{
    $SQL = new mysqli($servername, $username, $password, $dbname);
}catch(Exception $e){
    echo "erreur" .$e->getMessage();
}

?>