<?php
// Parâmetros de conexão
$serverName = "localhost"; // Atualize para o seu endereço de servidor
$connectionOptions = array(
    "Database" => "Bibliotecason", // Atualize para o nome do seu banco de dados
    "Uid" => "", // Usuário do banco de dados
    "PWD" => "" // Senha do banco de dados
);

// Conectar ao banco de dados
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
