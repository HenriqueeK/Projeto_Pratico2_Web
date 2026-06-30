<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../model/Livro.php';

class LivroDao
{
    private $tabela = 'livro';
    private $connection;

    public function __construct()
    {
        $db               = new Database();
        $this->connection = $db->connection;
    }

    public function salvar(Livro $livro)
    {
        $sql  = "INSERT INTO $this->tabela (titulo, autor, genero, n_paginas) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$livro->getTitulo(), $livro->getAutor(), $livro->getGenero(), $livro->getNPaginas()]);
    }

    public function listar()
    {
        $sql  = "SELECT * FROM $this->tabela";
        $stmt = $this->connection->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $livros = [];
        foreach ($rows as $row) {
            $livros[] = new Livro($row['titulo'], $row['autor'], $row['genero'], $row['n_paginas'], $row['id_livro']);
        }
        return $livros;
    }

    public function buscarPorId($id)
    {
        $sql  = "SELECT * FROM $this->tabela WHERE id_livro = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;
        return new Livro($row['titulo'], $row['autor'], $row['genero'], $row['n_paginas'], $row['id_livro']);
    }

    public function atualizar(Livro $livro)
    {
        $sql  = "UPDATE $this->tabela SET titulo = ?, autor = ?, genero = ?, n_paginas = ? WHERE id_livro = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            $livro->getTitulo(), 
            $livro->getAutor(),
            $livro->getGenero(), 
            $livro->getNPaginas(), 
            $livro->getId()
        ]);
    }

    public function deletar($id)
    {
        $sql  = "DELETE FROM $this->tabela WHERE id_livro = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
    }
}