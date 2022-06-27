<?php
namespace CrudPoo;
use PDO, Exception;

final class Fabricante {
    private int $id;
    private string $nome;

    /* Esta propriedade receberá os recursos PDO
    através da classe Banco (denpendência do projeto) */
    private PDO $conexao;

    public function __construct()
    {
        /* No momento em que for criado um objeto a partir
        da classe Fabricante, automaticamente será
        feita a conexão com o banco. */
        $this->conexao = Banco::conecta();        
    }


    public function lerFabricantes():array {
        $sql = "SELECT id, nome FROM fabricantes ORDER BY nome";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
        return $resultado; 
    }

    public function inserirFabricante():void {
        $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: " .$erro->getMessage());
        }
    }



    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}