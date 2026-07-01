<?php
require_once __DIR__ . '/../model/Comentario.php';

class ComentarioDao
{
    private $apiUrl = 'https://6a289af14e1e783349a5b48f.mockapi.io/api/livro/aviso';

    public function listar()
    {
        $response = file_get_contents($this->apiUrl);
        $dados    = json_decode($response, true);

        $comentarios = [];
        foreach ($dados as $item) {
            $comentarios[] = new Comentario(
                $item['livro'],
                $item['comentario'],
                $item['nota'],
                $item['nomeUsuario'],
                $item['id']
            );
        }
        return $comentarios;
    }
}