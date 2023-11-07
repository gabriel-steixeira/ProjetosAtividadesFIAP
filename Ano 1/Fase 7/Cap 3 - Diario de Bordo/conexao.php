<?php

function ObterConexao()
{
    try {
        //Configurando chaves de conexão com o banco
        $servidor = "localhost";
        $username = "root";
        $password = "";
        $database = "DiarioBordo";

        //Função que abre conexão com o banco de dados
        $conexao = mysqli_connect($servidor, $username, $password, $database);

        //Verificando status da conexão
        return $conexao;
    } catch (\Throwable $th) {
        throw $th;
    }
}

?>