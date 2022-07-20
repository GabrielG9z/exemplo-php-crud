<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "vendas";

try {
    //Criando a conexão com o MySQL (API/Driver de conexão)
 $conexao = new PDO(
    "mysql:host=$servidor; dbname=$banco; charset=utf8",$usuario,$senha);

    // Habilitando a verificação de erros
$conexao->setAttribute(PDO::ATTR_ERRMODE, //constante de erros em geral
PDO::ERRMODE_EXCEPTION );//constante de exceções de erros


    } catch(Exception $erro) {
        die("Erro: " .$erro->getMessage());
    }
