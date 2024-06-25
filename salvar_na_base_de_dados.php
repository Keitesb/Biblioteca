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

// Verifica se a requisição é do tipo POST e se há dados recebidos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedBooks'])) {
    $selectedBooks = json_decode($_POST['selectedBooks']);

    // Preparar e executar a inserção dos dados na tabela do banco de dados
    foreach ($selectedBooks as $book) {
        $user_id = $book->user_id;
        $book_id = $book->book_id;
        $date_added = date("Y-m-d H:i:s"); // Data atual

        // Query para inserção dos dados
        $sql = "INSERT INTO ListOfBooks (user_id, book_id, date_added) VALUES (?, ?, ?)";

        // Preparar a declaração
        $stmt = sqlsrv_prepare($conn, $sql, array(&$user_id, &$book_id, &$date_added));

        // Executar a declaração
        if (sqlsrv_execute($stmt) === false) {
            die(print_r(sqlsrv_errors(), true)); // Se houver um erro, exibe-o
        }

        // Liberar os recursos
        sqlsrv_free_stmt($stmt);
    }
}

// Fechar a conexão com o banco de dados (opcional, dependendo do restante do código)
sqlsrv_close($conn);
?>

