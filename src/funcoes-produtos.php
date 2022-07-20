<?php
require_once "../vendor/autoload.php";

// Função de leitura de produtos com comando SQL PDO(PHP Data Objects) é um módulo de PHP montado sob o paradigma Orientado a Objetos, cujo objetivo é prover uma padronização da forma com que PHP se comunica com um banco de dados relacional.
function lerProdutos(PDO $conexao):array{
    $sql = "SELECT produtos.id, produtos.nome, produtos.descricao, produtos.preco, produtos.quantidade, fabricante_id, fabricantes.nome AS fabricante FROM produtos INNER JOIN fabricantes 
    ON produtos.fabricante_id = fabricantes.id ORDER BY fabricantes.nome";

    try {
        $consulta = $conexao->prepare($sql);
        //Não é necessário o bindParam() pois é uma consulta apenas de exibição.
        $consulta->execute();
        // Transformando os dados em um Array com a função fetchAll para termos os dados tratados (PDO: FETCH_ASSOC)= Transforma em um array associativo.
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro:". $erro->getMessage());
    }
    return $resultado; 
}

function inserirProduto(PDO $conexao, string $nome,float $preco, int $quantidade, string $descricao, int $fabricanteId):void {
    $sql = "INSERT INTO produtos (nome, preco, quantidade, descricao, fabricante_id) VALUES(:nome, :preco, :quantidade, :descricao, :fabricante_id)";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(':nome',$nome, PDO::PARAM_STR);
        $consulta->bindParam(':preco',$preco, PDO::PARAM_STR);
        $consulta->bindParam('quantidade',$quantidade,PDO::PARAM_INT);
        $consulta->bindParam('descricao',$descricao, PDO::PARAM_STR);
        $consulta->bindParam('fabricante_id', $fabricanteId, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro:". $erro->getMessage());
    }
}

function lerUmProduto(PDO $conexao, int $id):array{
    $sql = "SELECT id, nome, preco, quantidade, descricao, fabricante_id FROM produtos WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ".$erro->getMessage());
    }
    return $resultado;
} 








function atualizarProduto(PDO $conexao, int $id ,string $nome, float $preco, int $quantidade, string $descricao, int $fabricanteId):void {
    $sql = "UPDATE  produtos SET nome = :nome, preco = :preco, quantidade = :quantidade, descricao = :descricao, fabricante_id = :fabricanteId WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':nome',$nome, PDO::PARAM_STR);
        $consulta->bindParam(':preco',$preco, PDO::PARAM_STR);
        $consulta->bindParam('quantidade',$quantidade,PDO::PARAM_INT);
        $consulta->bindParam('descricao',$descricao, PDO::PARAM_STR);
        $consulta->bindParam('fabricanteId', $fabricanteId, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro:". $erro->getMessage());
    }

}

// função de exclusão de produto (com a linguagem SQL )
function excluirProduto(PDO $conexao, int $id):void {
    $sql = "DELETE FROM produtos  WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro:". $erro->getMessage());
    }

}

// Funções Ultilitárias
function dump($dados){
    echo"<pre>";
    var_dump($dados);
    echo"</pre>";
}

function formataMoeda(float $valor):string {
    return "R$ ".number_format($valor,2, ",", ".");
}