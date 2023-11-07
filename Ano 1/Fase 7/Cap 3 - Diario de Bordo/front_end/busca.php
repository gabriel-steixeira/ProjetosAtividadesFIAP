<?php
include '../conexao.php';

// Conectar-se ao banco de dados
$conn = ObterConexao();

// Verificar a conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Obter o termo de busca da URL
$termoBusca = isset($_GET['term']) ? trim($_GET['term']) : '';

// Evitar injeção de SQL usando mysqli_real_escape_string
$termoBusca = mysqli_real_escape_string($conn, $termoBusca);

// Consultar o banco de dados para obter os resultados da busca apenas no campo TITULO
$sql = "SELECT * FROM posts WHERE TITULO LIKE '%$termoBusca%'";
$result = mysqli_query($conn, $sql); 

//Se não retornar registros, realiza tentativa com tudo em Maiúsculo
if (mysqli_num_rows($result) == 0) {
    $termoBusca = strtoupper($termoBusca);
    $sql = "SELECT * FROM posts WHERE TITULO LIKE '%$termoBusca%'";
    $result = mysqli_query($conn, $sql); 
}

//Se não retornar registros, realiza tentativa com tudo em minúsculo
if (mysqli_num_rows($result) == 0) {
    $termoBusca = strtolower($termoBusca);
    $sql = "SELECT * FROM posts WHERE TITULO LIKE '%$termoBusca%'";
    $result = mysqli_query($conn, $sql); 
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Busca</title>
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

    <nav class="navbar">
        <ul>
            <li><a href="index.php?categoria=1">CATEGORIA 1</a></li>
            <li><a href="index.php?categoria=2">CATEGORIA 2</a></li>
            <li><a href="index.php?categoria=3">CATEGORIA 3</a></li>
            <li><a href="index.php?categoria=4">CATEGORIA 4</a></li>
        </ul>
    </nav>

    <div class="search-container">
        <form action="busca.php" method="GET">
            <input type="text" name="term" placeholder="Digite sua busca">
            <button type="submit">BUSCA</button>
        </form>
    </div>

    <h1>Resultado da Busca</h1>

    <?php
    echo '<p>Buscando por: ' . $termoBusca . '</p>';

    // Verificar se há resultados
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Exibir resultados da busca
            echo '<div class="resultado-busca">';
            echo '<h2>' . $row['TITULO'] . '</h2>';
            echo '<p>' . mb_strimwidth($row['CONTEUDO'], 0, 30) . ' ... <a href="item.php?id=' . $row['ID'] . '">leia mais.</a>' . '</p>';
            echo '</div>';
        }
    } else {
        // Caso não haja resultados
        echo '<p>Nenhum resultado encontrado para: ' . $termoBusca . '</p>';
    }

    // Fechar a conexão
    mysqli_close($conn);
    ?>

</body>

<style>

    body {
        margin: 0;
        padding: 10px 10px;
        position: relative;
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

    .navbar {
        text-align: center;
        margin-top: -1%;
        font-size: 20px;
    }

    .navbar ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: inline-block;
    }

    .navbar li {
        display: inline-block;
        margin-right: 15px;
    }

    .navbar a {
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    .search-container {
        text-align: center;
        margin-top: 20px;
    }

    .search-container input {
        padding: 10px;
        margin-right: 10px;
        width: 90%;
        font-size: 16px;
    }

    .search-container button {
        padding: 10px 20px;
        font-size: 16px;
    }
</style>

</html>