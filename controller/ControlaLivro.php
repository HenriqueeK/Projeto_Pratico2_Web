<?php
require_once __DIR__ . '/../dao/LivroDao.php';
require_once __DIR__ . '/../model/Livro.php';

class ControlaLivro
{
    public function listar()
    {
        $dao = new LivroDao();
        return $dao->listar();
    }

    public function salvar()
    {
        $livro = new Livro(
            $_POST['titulo'],
            $_POST['autor'],
            $_POST['genero'],
            $_POST['nPaginas'],
        );

        $dao = new LivroDao();
        $dao->salvar($livro);
        header("Location: ListaLivro.php");
    }

    public function buscarPorId($id)
    {
        $dao = new LivroDao();
        return $dao->buscarPorId($id);
    }

    public function atualizar()
    {
        $livro = new Livro(
            $_POST['titulo'], $_POST['autor'],
            $_POST['genero'], $_POST['nPaginas'], $_POST['id']
        );
        $dao = new LivroDao();
        $dao->atualizar($livro);
        header("Location: ListaLivro.php");
    }

    public function deletar()
    {
        $dao = new LivroDao();
        $dao->deletar($_POST['id']);
        header("Location: ListaLivro.php");
    }
}