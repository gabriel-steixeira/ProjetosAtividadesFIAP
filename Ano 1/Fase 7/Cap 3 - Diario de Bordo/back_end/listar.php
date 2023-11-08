<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Posts</title>
</head>

<body>

    <div class="logo">
        <img src="../assets/img/logo.png" alt="imagem com logotipo da empresa ao lado do laço símbolo do autismo" class="logo">
    </div>

    <div class="data">
        <?php
        date_default_timezone_set('America/Sao_Paulo');
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
        $dataAtual = strftime('%d de %B de %Y - %H:%M');
        echo $dataAtual;
        ?>
    </div>

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

    // Consulta para listar os posts por ordem decrescente
    $query = "SELECT p.ID, p.TITULO, p.DATA_PUBLICACAO, c.NOME_CATEGORIA FROM posts p LEFT JOIN categoria c ON p.ID_CATEGORIA = c.ID_CATEGORIA ORDER BY p.DATA_PUBLICACAO DESC";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="post">';
            echo '<h2>' . $row['TITULO'] . '</h2>';
            echo '<p>Data de Publicação: ' . $row['DATA_PUBLICACAO'] . '</p>';
            echo '<p>Categoria: ' . $row['NOME_CATEGORIA'] . '</p>';
            echo '<a href="admin/alterar.php?id=' . $row['ID'] . '">Editar</a>';
            echo '<a href="admin/excluir.php?id=' . $row['ID'] . '">Excluir</a>';
            echo '</div>';
        }
    } else {
        echo 'Nenhuma notícia encontrada.';
    }

    $con->close();
    ?>

    <style>
        body {
            margin: 0;
            padding: 20px;
            position: relative;
            font-family: 'Arial', sans-serif;
        }

        .logo {
            width: 220px;
            margin-right: 20px;
            cursor: pointer;
        }

        .data {
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            font-size: 15px;
            padding: 10px 5px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .post {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
            margin-bottom: 10px;
        }

        a {
            color: #3498db;
            text-decoration: none;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .no-posts {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            color: #777;
        }
    </style>