<!doctype html>
<html>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="listar.css">
<title>CYBERLAKE</title>

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
</body>

</html>

<?php 
//Importando arquivo de conexão com o banco de dados
require_once("../conexao.php");

//Abrindo conexão com o banco de dados
$conexao = ObterConexao(); 

$resultado = mysqli_query($conexao, "SELECT p.ID, p.TITULO, p.DATA_PUBLICACAO, c.NOME_CATEGORIA, p.CONTEUDO FROM posts p, categoria c WHERE p.ID_CATEGORIA = c.ID_CATEGORIA ORDER BY DATA_PUBLICACAO DESC");

echo "<table>";

echo "<thead><td>CODIGO</td><td>TITULO</td><td>DATA DA PUBLICAÇÃO</td><td>CATEGORIA</td><td>CONTEUDO</td></thead>";

while(list($ID, $TITULO, $DATA_PUBLICACAO, $NOME_CATEGORIA, $CONTEUDO) = mysqli_fetch_row($resultado)) {
    echo "<tr>
        <td>$ID</td><td>$TITULO</td><td>", date('d/m/Y', strtotime($DATA_PUBLICACAO)), "</td><td>$NOME_CATEGORIA</td><td>$CONTEUDO</td>
    </tr>";
}

echo "</table>";
?>