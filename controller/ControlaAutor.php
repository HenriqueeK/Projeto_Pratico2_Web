<?php
require_once __DIR__ . '/../dao/AutorDao.php';


class ControlaAutor
{
    public function listar()
    {
        $dao = new AutorDao();
        return $dao->listar();
    }

    public function salvar()
    {
        $autor = new Autor(
        $_POST['nome'],
        $_POST['nacionalidade'],
        $_POST['dtNascimento'],
        $_POST['cep'],
        $_POST['cidade'],
        $_POST['estado']
        );

        $dao = new AutorDao();
        $dao->salvar($autor);
        header("Location: ListaAutor.php");
    }

    public function buscarPorId($id)
    {
        $dao = new AutorDao();
        return $dao->buscarPorId($id);
    }

    public function atualizar()
    {
        $autor = new Autor(
            $_POST['nome'], $_POST['nacionalidade'], $_POST['dtNascimento'],
            $_POST['cep'], $_POST['cidade'], $_POST['estado'], $_POST['id']
        );
        $dao = new AutorDao();
        $dao->atualizar($autor);
        header("Location: ListaAutor.php");
    }

    public function deletar()
    {
        $dao = new AutorDao();
        $dao->deletar($_POST['id']);
        header("Location: ListaAutor.php");
    }
}