<?php
require_once __DIR__ . '/../controller/ControlaLivro.php';

$controller = new ControlaLivro();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->atualizar();
    exit;
}

$id    = $_GET['id'] ?? null;
$livro = $id ? $controller->buscarPorId($id) : null;

if (!$livro) {
    header("Location: ListaLivro.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
</head>
<body>
    <h2>Editar Livro</h2>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($livro->getId()) ?>">

        <label>Título</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($livro->getTitulo()) ?>" required>
        <br>

        <label>Autor</label>
        <input type="text" name="autor" value="<?= htmlspecialchars($livro->getAutor()) ?>" required>
        <br>

        <label>Gênero</label>
        <input type="text" name="genero" value="<?= htmlspecialchars($livro->getGenero()) ?>" required>
        <br>

        <label>Número de Páginas</label>
        <input type="number" name="nPaginas" value="<?= htmlspecialchars($livro->getNPaginas()) ?>" required>
        <br>

        <button type="submit">Salvar alterações</button>
    </form>
    <a href="ListaLivro.php">Cancelar</a>
</body>
</html>
