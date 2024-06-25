<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está autenticado
if(isset($_SESSION['user_id'])) {
    // O ID do usuário está disponível na sessão
    $user_id = $_SESSION['user_id'];
    // Agora você pode usar $user_id em seu código
} else {
    // O usuário não está autenticado, redirecioná-lo para a página de login
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
      
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: black; /* Ajustado para um azul quase cinza */
            color: white;
            padding: 12px 20px; /* Maior padding para uma navbar maior */
        }

        .navbar a {
            color: white;
            padding: 12px 15px;
            text-decoration: none;
            font-size: 16px; /* Tamanho de fonte aumentado para melhor legibilidade */
        }

        .navbar .logo a {
            font-weight: bold;
            font-size: 1.5em; /* Aumentar um pouco o tamanho da fonte para o logo */
        }

        .navbar .menu a:hover {
            background-color: #4C5A68; /* Cor mais escura para o hover */
        }

        .navbar .menu a.active {
            background-color: #2D3E50; /* Cor diferenciada para o item ativo */
        }

        @media screen and (max-width: 600px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .navbar .menu {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }
            .navbar .menu a {
                width: 100%;
                text-align: left;
            }
        }
     
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background-color: #f0f0f0;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

th {
    text-align: left;
}

tbody tr:hover {
    background-color: #f9f9f9;
}

    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <a href="#">BOOKAQUIMZ</a>
        </div>
        <div class="menu">
            <a href="index.php">Início</a>
            <a href="#">Sobre Nós</a>
            <a href="#">Lista de Livros</a>
            <a href="#">Blog</a>
            <a href="criarcont.php">Entrar</a>
        </div>
    </div>


    <div class="container mt-5">
    <h1>Lista de Livros Selecionados</h1>
    <table id="book-table" class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>ISBN</th>
                <th>Ações</th> <!-- Nova coluna para os botões de ação -->
            </tr>
        </thead>
        <tbody id="book-list"></tbody>
    </table>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var urlParams = new URLSearchParams(window.location.search);

    // Verifica se os parâmetros estão presentes
    if (urlParams.has('title') && urlParams.has('author') && urlParams.has('genre') && urlParams.has('isbn')) {
        var newBook = {
            title: urlParams.get('title'),
            author: urlParams.get('author'),
            genre: urlParams.get('genre'),
            isbn: urlParams.get('isbn'),
            user_id: <?php echo $_SESSION['user_id']; ?> // Adicione o ID do usuário
        };

        // Pega a lista de livros selecionados
        var selectedBooks = JSON.parse(localStorage.getItem('selectedBooks')) || [];
        selectedBooks.push(newBook);
        localStorage.setItem('selectedBooks', JSON.stringify(selectedBooks));
    }

    // Atualiza a lista na página
    updateBookList();
});

function updateBookList() {
    var selectedBooks = JSON.parse(localStorage.getItem('selectedBooks')) || [];
    var tbody = document.getElementById('book-list');
    tbody.innerHTML = '';

    // Adiciona cada livro à tabela
    selectedBooks.forEach(function(book, index) {
        // Verifica se o livro pertence ao usuário logado
        if (book.user_id === <?php echo $_SESSION['user_id']; ?>) {
            var row = document.createElement('tr');
            row.innerHTML = `
                <td>${book.title}</td>
                <td>${book.author}</td>
                <td>${book.genre}</td>
                <td>${book.isbn}</td>
                <td><button onclick="removeBook(${index})">Remover</button></td> <!-- Botão para remover o livro -->
            `;
            tbody.appendChild(row);
        }
    });
}

function removeBook(index) {
    var selectedBooks = JSON.parse(localStorage.getItem('selectedBooks')) || [];
    selectedBooks.splice(index, 1); // Remove o livro da posição 'index'
    localStorage.setItem('selectedBooks', JSON.stringify(selectedBooks));
    updateBookList(); // Atualiza a lista na página após a remoção
}
</script>

</body>
</html>

