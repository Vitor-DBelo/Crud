<?php
// Definindo as constantes para a conexão com o banco de dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'TaskFlow'); 

// Criando a conexão MySQLi usando as constantes
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if ($mysqli->connect_error) {
    die('Erro de conexão: ' . $mysqli->connect_error);
}

// Define o charset para evitar problemas de codificação
$mysqli->set_charset("utf8mb4");


?>