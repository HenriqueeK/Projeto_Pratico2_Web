<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../model/Autor.php';

class AutorDao
{
    private $tabela = 'autor';
    private $connection;

    public function __construct()
    {
        $db               = new Database();
        $this->connection = $db->connection;
    }

    public function salvar(Autor $autor){

    $sql = "INSERT INTO autor (nome, nacionalidade, dt_nascimento, cep, cidade, estado) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->connection->prepare($sql);  
    $stmt->execute([$autor->getNome(), $autor->getNacionalidade(), $autor->getDtNascimento(), $autor->getCep(), $autor->getCidade(), $autor->getEstado()]);

    }

    public function listar()
    {
        $sql  = "SELECT * FROM $this->tabela ORDER BY id_autor = ?";
        $stmt = $this->connection->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $autores = [];

        foreach ($rows as $row) {
            $autores[] = new Autor($row['nome'], $row['nacionalidade'], $row['dt_nascimento'], $row['cep'], $row['cidade'], $row['estado'], $row['id_autor']);
        }
        return $autores;
    }

    public function buscarPorId($id)
    {
        $sql  = "SELECT * FROM $this->tabela WHERE id_autor = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        return new Autor($row['nome'], $row['nacionalidade'], $row['dt_nascimento'], $row['cep'], $row['cidade'], $row['estado'], $row['id_autor']);
    }

    public function atualizar(Autor $autor)
    {
        $sql  = "UPDATE $this->tabela SET nome = ?, nacionalidade = ?, dt_nascimento = ?, cep = ?, cidade = ?, estado = ? WHERE id_autor = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            $autor->getNome(), 
            $autor->getNacionalidade(), 
            $autor->getDtNascimento(),
            $autor->getCep(), 
            $autor->getCidade(), 
            $autor->getEstado(), 
            $autor->getId()
        ]);
    }

    public function deletar($id)
    {
        $sql  = "DELETE FROM $this->tabela WHERE id_autor = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
    }
}