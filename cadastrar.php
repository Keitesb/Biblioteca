<?php
include 'connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    // Criptografando a senha antes de inserir no banco
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Query SQL
    $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
    $params = array($nome, $email, $senha_criptografada);

    // Preparando e executando a consulta
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo "Erro ao inserir dados: ";
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
    }

    // Fechando a conexão e o statement
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>

