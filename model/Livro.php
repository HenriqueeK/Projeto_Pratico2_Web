<?php
class Livro
{
    private $id;
    private $titulo;
    private $autor;
    private $genero;
    private $nPaginas;
 
    public function __construct($titulo, $autor, $genero, $nPaginas, $id = null)
    {
        $this->titulo   = $titulo;
        $this->autor  = $autor;
        $this->genero   = $genero;
        $this->nPaginas = $nPaginas;
        $this->id       = $id;
    }

    public function getId()     { return $this->id; }
    public function getTitulo()     { return $this->titulo; }
    public function getAutor()    { return $this->autor; }
    public function getGenero()     { return $this->genero; }
    public function getNPaginas()   { return $this->nPaginas; }
}