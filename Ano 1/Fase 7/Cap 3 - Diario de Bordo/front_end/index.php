<?php
$noticias = array(
    array(
        "imagem" => "teste.png",
        "titulo" => "Título da Notícia 1",
        "previa" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo sit amet nisl cursus aliquet.",
        "link" => "noticia1.html"
    ),
    array(
        "imagem" => "teste.png",
        "titulo" => "Título da Notícia 2",
        "previa" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo sit amet nisl cursus aliquet.",
        "link" => "noticia2.html"
    ),
    array(
        "imagem" => "teste.png",
        "titulo" => "Título da Notícia 3",
        "previa" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo sit amet nisl cursus aliquet.",
        "link" => "noticia3.html"
    )
);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>CYBERLAKE</title>
</head>
<body>

    <div class="logo">
        <img src="logo.png" alt="imagem com logotipo da empresa ao lado do laço símbolo do autismo" class="logo">
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
        <form action="pagina-de-busca.php" method="GET">
            <input type="text" name="term" placeholder="Digite sua busca">
            <button type="submit">BUSCA</button>
        </form>
    </div>

    <div class="card-container">
        <?php foreach ($noticias as $noticia): ?>
            <div class="card">
                <div class="card-imagem">
                    <img src="<?php echo $noticia['imagem']; ?>" alt="Imagem da Notícia">
                </div>
                <div class="card-content">
                    <div class="card-title"><?php echo $noticia['titulo']; ?></div>
                    <div class="card-preview"><?php echo $noticia['previa']; ?></div>
                    <a href="<?php echo $noticia['link']; ?>" class="read-more">LER MAIS...</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="ad-container">
            <?php
            echo '<img src="teste.png" alt="Banner de Publicidade">';
            ?>
    </div>

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
}

.card img {
    width: 100%;
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

.ad-container {
    max-width: 100%;
    text-align: right;
    justify-content: space-between;
    margin: 0 10px;
    margin-top: -742.3px;
}

.ad-container img {
    width: 30%;
    height: 97.3vh;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

</style>

</body>
</html>