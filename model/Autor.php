<?php
class Autor
{
    private $id;
    private $nome;
    private $nacionalidade;
    private $dtNascimento;
    private $cep;
    private $cidade;
    private $estado;

    public function __construct($nome, $nacionalidade, $dtNascimento, $cep, $cidade, $estado, $id = null)
    {
        $this->nome = $nome;
        $this->nacionalidade = $nacionalidade;
        $this->dtNascimento = $dtNascimento;
        $this->cep = $cep;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->id = $id;
    }

    public function getId()       { return $this->id; }
    public function getNome()   { return $this->nome; }
    public function getNacionalidade()   { return $this->nacionalidade; }
    public function getDtNascimento() { return $this->dtNascimento; }
    public function getCep()    { return $this->cep; }
    public function getCidade() { return $this->cidade; }
    public function getEstado() { return $this->estado; }
}