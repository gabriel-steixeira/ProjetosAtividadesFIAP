<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conexão com o banco de dados
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "DiarioBordo";

    $con = new mysqli($host, $username, $password, $database);

    if ($con->connect_error) {
        die("Erro na conexão com o banco de dados: " . $con->connect_error);
    }

    // Consulta para excluir o post
    $query = "DELETE FROM posts WHERE ID = $id";
    $result = $con->query($query);

    if ($result) {
        echo 'Post excluído com sucesso! <a href="admin/listar.php">Voltar para a lista de posts</a>';
    } else {
        echo 'Erro ao excluir o post.';
    }

    $con->close();
} else {
    echo 'ID do post não fornecido.';
}
?>
