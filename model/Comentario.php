<?php
class Comentario
{
    private $id;
    private $livro;
    private $comentario;
    private $nota;
    private $nomeUsuario;

    public function __construct($livro, $comentario, $nota, $nomeUsuario, $id = null)
    {
        $this->livro       = $livro;
        $this->comentario  = $comentario;
        $this->nota        = $nota;
        $this->nomeUsuario = $nomeUsuario;
        $this->id          = $id;
    }

    public function getId()          { return $this->id; }
    public function getLivro()       { return $this->livro; }
    public function getComentario()  { return $this->comentario; }
    public function getNota()        { return $this->nota; }
    public function getNomeUsuario() { return $this->nomeUsuario; }
}