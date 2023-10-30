<style>
    table, tr, td {
        border: solid 1px black;
    }
</style>
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