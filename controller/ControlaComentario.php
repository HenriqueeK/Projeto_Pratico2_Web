<?php
require_once __DIR__ . '/../dao/ComentarioDao.php';

class ControlaComentario
{
    public function listar()
    {
        $dao = new ComentarioDao();
        return $dao->listar();
    }
}