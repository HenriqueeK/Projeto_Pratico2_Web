

<?php
require_once __DIR__ . '/../controller/ControlaAutor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new ControlaAutor();
    $controller->salvar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Autor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Cadastro de Autor</h2>
    
    <form action="" method="POST" class="formulario">
        <label>Nome</label>
        <input type="text" name="nome" required>
        <br><br>
        
        <label>Nacionalidade</label>
        <input type="text" name="nacionalidade" required>
        <br><br>
        
        <label>Data de Nascimento</label>
        <input type="date" name="dtNascimento" required>
        <br><br>

        <div class="search-container">
            <label>CEP</label>
            <input type="text" id="cepInput" name="cep" maxlength="9" placeholder="00000-000">
            <button type="button" id="searchButtonCep">Buscar</button>
        </div>
        
        <div class="loading-container">
            <div id="loadingDotsCep" class="loading-dots">............</div>
        </div>

        <div class="result-container">
            <table id="resultTableCep">
                </table>
        </div>
        <br>

        <label>Cidade</label>
        <input type="text" id="cidade" name="cidade" readonly required>
        <br><br>

        <label>Estado</label>
        <input type="text" id="estado" name="estado" readonly required>
        <br><br>

        <input type="submit" value="Enviar">
    </form>

    <br>
    <a href="ListaAutor.php">Ver autores cadastrados</a>
    <br>
    <a href="index.php">Voltar para a página principal</a>

    <script>

        const cepInput = document.getElementById("cepInput");
        const searchButtonCep = document.getElementById("searchButtonCep");
        const loadingDotsCep = document.getElementById("loadingDotsCep");
        const resultTableCep = document.getElementById("resultTableCep");

        searchButtonCep.addEventListener("click", function () {
            const cep = cepInput.value.replace(/\D/g, "");

            if (cep.length !== 8) {
                alert("Por favor, digite um CEP válido com 8 dígitos.");
                return;
            }

            loadingDotsCep.classList.remove("gray-dots");
            loadingDotsCep.style.animation = "loading 2s linear infinite";

            setTimeout(function () {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then((response) => response.json())
                    .then((data) => {
                        loadingDotsCep.style.animation = "none";

                        if (data.erro) {
                            alert("CEP não encontrado.");
                            return;
                        }

                        document.getElementById("cidade").value = data.localidade;
                        document.getElementById("estado").value = data.uf;
                    })
                    .catch((error) => {
                        loadingDotsCep.style.animation = "none";
                        console.error("Erro ao buscar CEP:", error);
                    });
            }, 2000);
        });

    </script>
</body>
</html>