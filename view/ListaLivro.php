<?php
require_once __DIR__ . '/../controller/ControlaLivro.php';

$controller   = new ControlaLivro();
$livros = $controller->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Livros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class = body>
    <h2 class="titulo">Livros cadastrados</h2>
    <?php if (count($livros) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Genero</th>
                    <th>Número de Paginas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td><?= $livro->getId() ?></td>
                        <td><?= $livro->getTitulo() ?></td>
                        <td><?= $livro->getAutor() ?></td>   
                        <td><?= $livro->getGenero() ?></td>
                        <td><?= $livro->getNPaginas() ?></td>     
                        <td>
                            <a href="EditaLivro.php?id=<?= $livro->getId() ?>">Editar</a>
                            <form action="DeletaLivro.php" method="POST" style="display:inline"
                                onsubmit="return confirm('Deseja excluir <?= $livro->getTitulo() ?>?')">
                                <input type="hidden" name="id" value="<?= $livro->getId() ?>">
                                <button type="submit">Deletar</button>
                            </form>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum livro cadastrado.</p>
    <?php endif; ?>
    <a href="CadastrarLivro.php" class="cadastrar">Cadastrar novo livro</a>
    <br>
    <a href="index.php" class="voltarPagina">Voltar para a página principal</a>
</body>
</html>