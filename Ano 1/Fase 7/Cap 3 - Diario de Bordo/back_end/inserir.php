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

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Conexão com o banco de dados
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "DiarioBordo";

        $con = new mysqli($host, $username, $password, $database);

        if ($con->connect_error) {
            die("Erro na conexão com o banco de dados: " . $con->connect_error);
        }

        // Dados do formulário
        $titulo = $_POST["titulo"];
        $conteudo = $_POST["conteudo"];
        $categoria = $_POST["categoria"];
        $data_publicacao = date("Y-m-d");

        // Processamento do upload da imagem (caso necessário)
        if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
            $imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
        } else {
            $imagem = null;
        }

        // Consulta para inserir o post no banco de dados
        $query = "INSERT INTO posts (TITULO, DATA_PUBLICACAO, ID_CATEGORIA, CONTEUDO, IMAGEM) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ssisb", $titulo, $data_publicacao, $categoria, $conteudo, $imagem);

        if ($stmt->execute()) {
            echo "Post inserido com sucesso!";
        } else {
            echo "Erro ao inserir o post: " . $stmt->error;
        }

        $stmt->close();
        $con->close();
    }
    ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="titulo" placeholder="Título" required>
        <textarea name="conteudo" placeholder="Conteúdo" required></textarea>
        <select name="categoria">
            <option value="1">Categoria 1</option>
            <option value="2">Categoria 2</option>
            <option value="2">Categoria 3</option>
            <option value="2">Categoria 4</option>
        </select>
        <input type="file" name="imagem" accept="image/*">
        <input type="submit" value="Inserir">
    </form>

</body>

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

    form {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    input[type="text"],
    textarea,
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="file"],
    input[type="submit"] {
        padding: 10px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="file"] {
        margin-bottom: 15px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

</style>

</html>