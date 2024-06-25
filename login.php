<?php
include 'connection.php'; 

session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    // Query SQL para buscar o usuário pelo email
    $sql = "SELECT * FROM users WHERE email = ?";
    $params = array($email);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo "Erro ao buscar usuário: ";
        die(print_r(sqlsrv_errors(), true));
    }

    // Verificando se um usuário com o email existe
    if ($user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        // Verifica a senha
        if (password_verify($senha, $user['password'])) {
            // Armazena as informações do usuário em sessão
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nome'] = $user['nome']; // Adicione outros dados do usuário que deseja manter na sessão

            header('Location: index.php');
            exit(); // Finaliza o script após o redirecionamento
        } else {
            $response = '<p class="erro">
                Falhou a senha
                    </p>';
        }
    } else {
        echo "Usuário não encontrado!";
    }

    // Fechando a conexão e o statement
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>
