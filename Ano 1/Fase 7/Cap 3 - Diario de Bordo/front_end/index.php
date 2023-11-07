<?php
include '../conexao.php';

// Conexão com o banco de dados
$conn = ObterConexao();

// Verifica a conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Consulta SQL para obter as notícias
$sql = "SELECT * FROM posts ORDER BY DATA_PUBLICACAO DESC";
$result = mysqli_query($conn, $sql);

// Verifica se há resultados
if ($result && mysqli_num_rows($result) > 0) {
    // Inicializa o array de notícias
    $noticias = array();

    // Loop através dos resultados e adiciona as notícias ao array
    while ($row = mysqli_fetch_assoc($result)) {
        $noticias[] = array(
            "imagem" => "../assets/img/img4.jpg" . $row['IMAGEM'],
            "titulo" => $row['TITULO'],
            "data" => date('d/m/Y', strtotime($row['DATA_PUBLICACAO'])),
            "previa" => substr($row['CONTEUDO'], 0, 150) . '...',
            "link" => "item.php?id=" . $row['ID']
        );
    }
} else {
    echo "0 resultados encontrados";
}

// Fechar a conexão
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>CYBERLAKE</title>
    <style>
        .card-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .card {
            width: 68%;

            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card img {
            width: 20%;
            height: auto;
        }

        .card-content {
            flex: 1;
            padding: 15px;
        }

        .card-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-preview {
            margin-bottom: 10px;
        }

        .read-more {
            display: block;
            text-align: right;
            margin-top: 10px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        .card-date {
            font-size: 0.8em;
            color: #777;
        }

        .ad-container {
            position: absolute;
            top: 105.8px;
            right: -320px;
            max-width: 100%;
        }

        .ad-container img {
            width: 45%;
            height: 97.3vh;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
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
            <li><a href="#">CATEGORIA 1</a></li>
            <li><a href="#">CATEGORIA 2</a></li>
            <li><a href="#">CATEGORIA 3</a></li>
            <li><a href="#">CATEGORIA 4</a></li>
        </ul>
    </nav>

    <div class="search-container">
        <form action="busca.php" method="GET">
            <input type="text" name="term" placeholder="Digite sua busca">
            <button type="submit">BUSCA</button>
        </form>
    </div>

    <div class="card-container">
        <?php foreach ($noticias as $noticia) : ?>
            <div class="card">
                <div class="card-imagem">
                    <img src="<?php echo $noticia['imagem']; ?>" alt="Imagem da Notícia">
                </div>
                <div class="card-content">
                    <div class="card-title"><?php echo $noticia['titulo']; ?></div>
                    <div class="card-date"><?php echo $noticia['data']; ?></div>
                    <div class="card-preview"><?php echo $noticia['previa']; ?></div>
                    <a href="<?php echo $noticia['link']; ?>" class="read-more">LER MAIS...</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="ad-container">
        <?php
        echo '<img src="../assets/img/teste.png" alt="Banner de Publicidade">';
        ?>
    </div>

</body>

</html>