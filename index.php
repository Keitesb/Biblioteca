<?php
include("connection.php");
session_start();

// Verificar se o usuário está autenticado
if(!isset($_SESSION['user_id'])) {
    // Se não estiver, redirecionar para a página de login ou registro
    header("Location: criarcont.php"); // Substitua "login.php" pelo caminho da sua página de login
    exit;
}

// Se o usuário estiver autenticado, você pode continuar exibindo o conteúdo da página
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h3>BOOKAQUIMZ</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre Nos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listadelivros.php">Lista de livros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="criarcont.php">Entrar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content-->
    <div class="container">

        <div class="card">
            <div class="card-content">
                <h2 class="card-title">Pesquisa aqui</h2>
                <p class="card-text">Encontre connosco o seu livro, tenha a localizacao e informacoes de disponibilidade em bibliotecas nacionais.</p>

                    <div class="search-container">
                        <input type="text" class="form-control" placeholder="Pesquisar..." id="searchbk" autocomplete="off">
                    </div>
            </div>
        </div>
        <span id="message"></span>
        <div class="social-icons">
            <a href="#" class="icon facebook"></a>
            <a href="#" class="icon twitter"></a>
            <a href="#" class="icon instagram"></a>
            <a href="https://mz.linkedin.com/in/keite-banze?trk=public_profile_browsemap" class="icon linkedin"></a>
        </div>

        <footer>
            <div class="footer-content">
                <div class="footer-section about">
                    <h3>Sobre</h3>
                    <p>Nossa biblioteca online oferece uma ampla variedade de livros digitais em várias categorias.
                        <br>Aqui podes fazer as pesquisas das suas obras e descobrir tambem em que biblioteca podes
                        <br>encontra-lo em formato fisico, para alem de saber sua disponibilidade</p>
                </div>
                <div class="footer-section links">
                    <h3>Links Rápidos</h3>
                    <ul>
                        <li><a href="#">Página Inicial</a></li>
                        <li><a href="#">Livros</a></li>
                        <li><a href="#">Sobre</a></li>
                        <li><a href="#">Contato</a></li>
                    </ul>
                </div>
                <div class="footer-section contact">
                    <h3>Contato</h3>
                    <ul>
                        <li>Email: 202202780@ustm.ac.mz</li>
                        <li>Telefone: +258 859307881</li>
                        <li>Endereço: Rua de umbeluzi, 754</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2024 Biblioteca Online. Todos os direitos reservados.
            </div>
        </footer>

		<style>
			.card {
    width: 50%;
    height: 50%;
    border: 1px solid rgb(5, 5, 23);
    ;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(19, 30, 112, 0.1);
    margin-top: 45px;
    margin-left: auto;
    margin-right: auto;
}

.card1 {
    padding: 10px;
    width: 220px;
    height: 150px;
    border: 1px solid rgb(5, 5, 23);
    ;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(19, 30, 112, 0.1);
    margin-top: 45px;
    margin-left: auto;
    margin-right: auto;
}

.card-content {
    padding: 20px;
}

.card-title {
    font-size: 24px;
    margin-bottom: 10px;
    text-align: center;
}

.card-text {
    font-size: 16px;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.search-container {
    position: relative;
    max-width: 400px;
    margin: 50px auto;
}

input[type="text"] {
    width: 100%;
    padding: 12px 20px;
    border: none;
    border-radius: 25px;
    background-color: #1e2a3a;
    color: #fff;
    font-size: 16px;
    outline: none;
}

input[type="text"]::placeholder {
    color: #ccc;
}

button[type="submit"] {
    position: absolute;
    right: 0;
    top: 0;
    padding: 10px 20px;
    background-color: #1e2a3a;
    border: none;
    border-radius: 0 25px 25px 0;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #1e2a3a;
}

.fa-search {
    color: #fff;
}

.social-icons {
    display: flex;
    justify-content: center;
    margin-top: 50px;
}

.icon {
    width: 20px;
    height: 20px;
    margin: 0 10px;
    background-size: cover;
}

.facebook {
    background-image: url('https://cdn-icons-png.flaticon.com/512/174/174848.png');
}

.twitter {
    background-image: url('https://cdn-icons-png.flaticon.com/512/174/174876.png');
}

.instagram {
    background-image: url('https://cdn-icons-png.flaticon.com/512/174/174855.png');
}

.linkedin {
    background-image: url('https://cdn-icons-png.flaticon.com/512/174/174857.png');
}

footer {
    background-color: #333;
    color: #fff;
    padding: 15px;
    margin-top: 75px;
    width: 1200px;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.footer-section {
    width: 30%;
}

.footer-section h3 {
    color: #fff;
}

.footer-section ul {
    list-style-type: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    color: #fff;
    text-decoration: none;
}

.footer-bottom {
    background-color: #222;
    padding: 10px 0;
    text-align: center;
}

.book-list {
    margin-top: 50px;
    visibility: hidden;
}
</style>
<script>
$(document).ready(function() {
    $("#searchbk").keyup(function() {
        var input = $(this).val();
       // alert(input);
        if(input != ""){
            $.ajax({
                url: "listarlivros.php",
                method: "POST",
                data:{input:input},

                success: function(data){
                    $("#message").html(data);

                }
            });
        }else{
            $("#messsage").css("display", "none");
        }
    });
});
</script>
</body>
</html>
