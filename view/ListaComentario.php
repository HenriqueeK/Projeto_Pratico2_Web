<?php
require_once __DIR__ . '/../controller/ControlaComentario.php';

$controller  = new ControlaComentario();
$comentarios = $controller->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Comentários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Comentários cadastrados</h2>
    <?php if (count($comentarios) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Livro</th>
                    <th>Comentário</th>
                    <th>Nota</th>
                    <th>Usuário</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comentarios as $comentario): ?>
                    <tr>
                        <td><?= $comentario->getId() ?></td>
                        <td><?= $comentario->getLivro() ?></td>
                        <td><?= $comentario->getComentario() ?></td>
                        <td><?= $comentario->getNota() ?></td>
                        <td><?= $comentario->getNomeUsuario() ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum comentário cadastrado.</p>
    <?php endif; ?>
    <a href="CadastraComentario.php">Cadastrar novo comentário</a>
    <br>
    <a href="index.php">Voltar para a página principal</a>
</body>
</html>