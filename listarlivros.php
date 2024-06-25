<?php
include("connection.php");

if(isset($_POST['input'])) {
    $input = $_POST['input'];
    $query = "SELECT * FROM Books WHERE title LIKE '%' + ? + '%' OR author LIKE '%' + ? + '%'";

    // Preparar a consulta
    $stmt = sqlsrv_prepare($conn, $query, array(&$input, &$input));

    if(!$stmt) {
        die(print_r(sqlsrv_errors(), true));
    }

    if(sqlsrv_execute($stmt)) {
        $response = '<table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>ISBN</th>
                    <th>Add to List</th>
                </tr>
            </thead>
            <tbody>';

        while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
            $title = ($row['title']);
            $author = ($row['author']);
            $genre = ($row['genre']);
            $ISBN = ($row['ISBN']);
            $urlTitle = ($title);
            $urlAuthor = ($author);

            $response .= "<tr>
                <td>$title</td>
                <td>$author</td>
                <td>$genre</td>
                <td>$ISBN</td>
                <td><a href='listadelivros.php?title=$urlTitle&author=$urlAuthor&genre=$genre&isbn=$ISBN'>Adicionar à Lista</a></td>
            </tr>";
        }

        $response .= '</tbody></table>';
    } else {
        $response = "Nenhum resultado encontrado.";
    }

    echo $response;
}
?>
