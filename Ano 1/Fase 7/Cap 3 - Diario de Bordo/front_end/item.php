<?php
include '../conexao.php';

// Conectar-se ao banco de dados
$conn = ObterConexao();

// Verificar a conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Obter o ID do post da URL
$postID = $_GET['id'];

// Consultar o banco de dados para obter os detalhes do post
$sql = "SELECT * FROM posts WHERE ID = $postID";
$result = mysqli_query($conn, $sql);

// Verificar se há resultados e obter os detalhes do post
if ($result && $row = mysqli_fetch_assoc($result)) {
    $titulo = $row['TITULO'];
    $data = date('d/m/Y', strtotime($row['DATA_PUBLICACAO']));
    $conteudo = $row['CONTEUDO'];
    $imagem = "../assets/img/img4.jpg";
    var_dump($row['IMAGEM']);
} else {
    echo "Post não encontrado.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
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

    <div class="post-details">
        <h2><?php echo $titulo; ?></h2>
        <p>Data de Publicação: <?php echo $data; ?></p>
        <img class="post-image" src="<?php echo $imagem; ?>" alt="Imagem do Post">
        <div class="conteudo">
            <?php echo $conteudo; ?>
        </div>
    </div>

</body>

<style>
    .post-image {
        max-width: 50%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

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

<?php
// Fechar a conexão
mysqli_close($conn);
?>