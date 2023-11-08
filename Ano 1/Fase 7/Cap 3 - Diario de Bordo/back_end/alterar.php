<!DOCTYPE html>
<html>
<head>
    <title>Editar Post</title>
</head>
<body>
    <h1>Editar Post</h1>
    
    <?php
    // Conexão com o banco de dados
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "DiarioBordo";

    $con = new mysqli($host, $username, $password, $database);

    if ($con->connect_error) {
        die("Erro na conexão com o banco de dados: " . $con->connect_error);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Consulta para buscar o post a ser editado
        $query = "SELECT * FROM posts WHERE ID = $id";
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Formulário preenchido com os dados do post
            echo '<form method="POST" action="processar_alterar.php?id=' . $row['ID'] . '" enctype="multipart/form-data">';
            echo '<input type="text" name="titulo" value="' . $row['TITULO'] . '" required>';
            echo '<textarea name="conteudo" required>' . $row['CONTEUDO'] . '</textarea>';
            echo '<select name="categoria">';
            echo '<option value="1">Categoria 1</option>';
            echo '<option value="2">Categoria 2</option>';
            echo '</select>';
            echo '<input type="file" name="imagem" accept="image/*">';
            echo '<input type="submit" value="Salvar Alterações">';
            echo '</form>';
        } else {
            echo 'Post não encontrado.';
        }
    }

    $con->close();
    ?>
</body>
</html>
