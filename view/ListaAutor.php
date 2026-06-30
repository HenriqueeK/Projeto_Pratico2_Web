<?php
require_once __DIR__ . '/../controller/ControlaAutor.php';

$controller   = new ControlaAutor();
$autores = $controller->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Livros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2 class="titulo">Autores cadastrados</h2>
    <?php if (count($autores) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nacionalidade</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autores as $autor): ?>
                    <tr>
                        <td><?= $autor->getId() ?></td>
                        <td><?= $autor->getNome() ?></td>
                        <td><?= $autor->getNacionalidade() ?></td>
                        <td><?= $autor->getDtNascimento() ?></td>
                        <td>
                            <a href="EditaAutor.php?id=<?= $autor->getId() ?>">Editar</a>
                            <form action="DeletaAutor.php" method="POST" style="display:inline"
                                onsubmit="return confirm('Deseja excluir <?= $autor->getNome() ?>?')">
                                <input type="hidden" name="id" value="<?= $autor->getId() ?>">
                                <button type="submit">Deletar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum autor cadastrado.</p>
    <?php endif; ?>
    <a href="CadastrarAutor.php" class="cadastrar">Cadastrar novo autor</a>
    <br>
    <a href="index.php" class="voltarPagina">Voltar para a página principal</a>
</body>
</html>