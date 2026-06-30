<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Comentário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Cadastrar Comentário</h2>

    <label>Livro</label>
    <input type="text" id="livro">
    <br>

    <label>Comentário</label>
    <input type="text" id="comentario">
    <br>

    <label>Nota (1 a 5)</label>
    <input type="number" id="nota" min="1" max="5">
    <br>

    <label>Seu nome</label>
    <input type="text" id="nomeUsuario">
    <br>

    <button id="btn">Cadastrar</button>
    <p id="resposta"></p>

    <script>
        document.getElementById('btn').addEventListener('click', async function () {
            const livro       = document.getElementById('livro').value;
            const comentario  = document.getElementById('comentario').value;
            const nota        = Number(document.getElementById('nota').value);
            const nomeUsuario = document.getElementById('nomeUsuario').value;

            const response = await fetch('https://6a289af14e1e783349a5b48f.mockapi.io/api/livro/aviso', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ livro, comentario, nota, nomeUsuario }),
            });

            const data = await response.json();
            document.getElementById('resposta').textContent = 'Comentário cadastrado com sucesso!';
        });
    </script>

    <a href="ListaComentario.php">Ver comentários</a>
    <br>
    <a href="index.php">Voltar para a página principal</a>
</body>
</html>