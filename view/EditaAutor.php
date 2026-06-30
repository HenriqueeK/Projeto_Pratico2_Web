<?php
require_once __DIR__ . '/../controller/ControlaAutor.php';

$controller = new ControlaAutor();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->atualizar();
    exit;
}

$id    = $_GET['id'] ?? null;
$autor = $id ? $controller->buscarPorId($id) : null;

if (!$autor) {
    header("Location: ListaAutor.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Autor</title>
</head>
<body>
    <h2>Editar Autor</h2>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($autor->getId()) ?>">

        <label>Nome</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($autor->getNome()) ?>" required>
        <br>

        <label>Nacionalidade</label>
        <input type="text" name="nacionalidade" value="<?= htmlspecialchars($autor->getNacionalidade()) ?>" required>
        <br>

        <label>Data de Nascimento</label>
        <input type="date" name="dtNascimento" value="<?= htmlspecialchars($autor->getDtNascimento()) ?>" required>
        <br>

        <label>CEP</label>
        <input type="text" id="cepInput" name="cep" value="<?= htmlspecialchars($autor->getCep()) ?>" maxlength="9" placeholder="00000-000">
        <button type="button" id="searchButtonCep">Buscar</button>
        <br>

        <label>Cidade</label>
        <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($autor->getCidade()) ?>" readonly>
        <br>

        <label>Estado</label>
        <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($autor->getEstado()) ?>" readonly>
        <br>

        <button type="submit">Salvar alterações</button>
    </form>
    <a href="ListaAutor.php">Cancelar</a>

    <script>
        const cepInput = document.getElementById("cepInput");
        const searchButtonCep = document.getElementById("searchButtonCep");

        searchButtonCep.addEventListener("click", function () {
            const cep = cepInput.value.replace(/\D/g, "");
            if (cep.length !== 8) {
                alert("Por favor, digite um CEP válido com 8 dígitos.");
                return;
            }
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.erro) {
                        alert("CEP não encontrado.");
                        return;
                    }
                    document.getElementById("cidade").value = data.localidade;
                    document.getElementById("estado").value = data.uf;
                })
                .catch((error) => console.error("Erro ao buscar CEP:", error));
        });
    </script>
</body>
</html>
